<template>
				<section v-if="clinicalItemId" id="ktyReserveCalendar">
        <div v-show="loading" class="loading" :class="{secondTime: isComponentloading}"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
        <template v-if="isComponentloading">
				<h2 class="ktyHeading01">予約希望日時</h2>
        <p class="txt-center" :class="{'has-error-text': isDateNothing()}">日付の選択</p>
        <!--<p>nowDay={{moment().format('YYYY-MM-DD')}}</p>-->
        <!--<p>expiredDay={{expiredDay}}</p>-->
        <div class="ktyCalendarWrap">
          <v-calendar
          is-expanded
          :min-page="minMonth"
          :max-page="maxMonth"
          @transition-end="updateCalendar"
          ref="calendar"
          >
<template slot='header-title' slot-scope='props'>
      {{props.yearLabel}}年{{props.monthLabel}}
    </template>
<template slot='day-content' slot-scope='props'>
  <div class="cell-wrap" @click="onDaySelect(props.day.date,props.day.weekday - 1)" :class="[{'current': isDayActive == props.day.date},thisDayClass(props.day.date,props.day.weekday - 1)]">
    <div class="cell-header">
{{props.day.day}}
    </div>
<div class="cell-content">
{{thisDayIcon(props.day.date,props.day.weekday - 1)}}
</div>
  </div>
  </template>
					</v-calendar>
          <ul class="ktyHanrei">
            <li v-for="reserveStatus in reserveStatuses" v-if="reserveStatus.status > 0">
              <span>{{getObjectOne(reserveIcons,'id',reserveStatus.reserve_icon_id).icon}}</span>：{{reserveStatus.name}}
            </li>
          </ul>
        </div>
        <div id="ktyDaySelect" class="ktyBox01" v-if="isDayActive">
				<div class="v-fade" v-show="isDayActive">
					<h3 class="ktyHeading" :class="{'has-error-text': isTimeNothing()}">時間を選択してください</h3>
          <div v-show="!reserveTimesSets" class="loading"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
					<ul class="ktyReserveTimes" v-if="reserveTimesSets">
            <li v-for="timeID in reserveTimesSets"><a href="#" @click.prevent.stop="onTimeSelect(timeID)" :class="{'current': isTimeActive == timeID}">{{getObjectOne(reserveTimes,'id',timeID).name}}</a></li>
					</ul>
				</div>
        </div>
				<div class="ktyBtnNext v-fade" v-show="isTimeActive" v-if="!isNextSection"><a href="#" @click.prevent.stop="showNext()">受診者情報を入力する</a></div>

        </template>
        </section>

</template>

<script>
export default {
  data: function() {
    return {
      minMonth: null,
      maxMonth: null,
      calendarLength: null,
      clinicalItemId: null,
      clinicalItem: null,
      expiredDay: null,
      currentDay: null,
      reserveCalendars: null,
      regularHolidays: null,
      regularWeeks: null,
      reserveStatuses: null,
      reserveIcons: null,
      reserveTimesSets: null,
      reserveTimes: null,
      isDayActive: null,
      isTimeActive: null,
      isTimesSetID: null,
      loading: true,
      isComponentloading: null,
      isNextSection: false,
      holidays: {},
    }
  },
  props : {
		'userInputs' : {
			type : Object
		},
	},
  created : function() {
    this.$on('clinicalItem',this.getClinicalItem)
  },
  methods: {
    getHolidays: function(){
      let today = new Date();
      today.setDate(1);
      for(let i=0; i<this.calendarLength; i++){
        if(i > 0){
          today.setMonth(today.getMonth() + 1);
        }
        axios.get('api/get_holidays',{
          params : {
            year : today.getFullYear(),
            month : today.getMonth() + 1,
          }
        })
        .then((res) => {
          Object.assign(this.holidays, res.data);
        });
      }
    },
    isDateNothing: function(){
      if(this.userInputs && !this.isDayActive){
        return true;
      }else{
        return false;
      }
    },
    isTimeNothing: function(){
      if(this.userInputs && !this.isTimeActive){
        return true;
      }else{
        return false;
      }
    },
    updateCalendar: function(){
      if(this.isDayActive){
        let dateClass = 'id-' + moment(this.isDayActive).format('YYYY-MM-DD');
        let tagElm = document.getElementsByClassName(dateClass);
        if(tagElm.length){
          tagElm[tagElm.length - 1].getElementsByClassName('cell-wrap')[0].classList.add('current');
        }
      }
    },
    getClinicalItem: function(clinicalItem){
      this.isDayActive = null;
      this.isTimeActive = null;
      this.dayClassReset();
      this.clinicalItemId = clinicalItem.id;
      this.getclinicalItemData(clinicalItem.id);
    },
    getclinicalItemData: function(id){
      axios.get('api/clinical_items',{
        params : {
          id : this.clinicalItemId,
        }
      })
      .then((res) => {
        this.clinicalItem = res.data.data;
        this.calendarLength = res.data.data.calendar_length;
        this.getHolidays();
        this.getStartEndMonth();
        this.reserveCalendars = res.data.data.reserve_calendars;
        this.regularHolidays = res.data.data.regular_holidays;
        this.regularWeeks = res.data.data.regular_weeks;
        this.getReserveStatuses();
      });
    },
    dayClassReset: function(){
      let cells = document.getElementsByClassName('cell-wrap');
      if(cells.length){
        for(let i=0; i<cells.length; i++){
          cells[i].classList.remove('current');
        }
      }
    },
    onDaySelect: function(date,weekday){
      if(this.thisDayClass(date,weekday).match(/dayAllow/g)){
        let currentDay = moment(date).format('YYYY-MM-DD');
        //weekdayが祝日なら上書き
        for(let holiday in this.holidays){
          if(currentDay == holiday){
            weekday = 7;
            break;
          }
        }
        this.dayClassReset();
        this.$emit('setReserveTime','');
        this.isDayActive = date;
        let timesSetID;

        if(this.reserveCalendars.some(obj => obj.date == currentDay)){
          timesSetID = this.getObjectOne(this.reserveCalendars,'date',currentDay).reserve_times_set_id;
        }
        else {
          timesSetID = this.getObjectOne(this.regularWeeks,'week_id',weekday).reserve_times_set_id;
        }
        this.isTimesSetID = timesSetID;
        if(!this.reserveTimesSets){
          this.$SmoothScroll(document.querySelector('#ktyReserveCalendar'),400,null,null,'y');
        }
        this.reserveTimesSets = null;
        this.isTimeActive = null;
        this.getReserveTimesSets(timesSetID);
        this.$emit('setReserveDay',currentDay);
      }
    },
    onTimeSelect: function(timeID){
      this.isTimeActive = timeID;
      this.$emit('setReserveTime',this.getObjectOne(this.reserveTimes,'id',timeID).name);
      if(!this.isNextSection){
        this.$SmoothScroll(document.querySelector('#ktyDaySelect'),400,null,null,'y');
      }

    },
    moment(...args){
      return moment(...args);
    },
    getStartEndMonth: function(){
      let today = new Date();
      today.setDate(1);
      this.minMonth = {
        month: today.getMonth() + 1,
        year: today.getFullYear(),
      }
      today.setMonth(today.getMonth() + (this.calendarLength - 1));
      this.maxMonth = {
        month: today.getMonth() + 1,
        year: today.getFullYear(),
      }
    },
    thisDayClass: function(date,weekday){
      let currentDay = moment(date).format('YYYY-MM-DD');
      let nowDay = moment().format('YYYY-MM-DD');
      let statusID,iconID,allow,weekdayClass;
      if(moment(currentDay).isBefore(nowDay)){
        return "dayPast";
      }else if(moment(currentDay).isBefore(this.expiredDay)){
        return "dayDeny";
      }else {
        //weekdayが祝日なら上書き
        for(let holiday in this.holidays){
          if(currentDay == holiday){
            weekday = 7;
            break;
          }
        }
        if(this.reserveCalendars.some(obj => obj.date == currentDay)){
          statusID = this.getObjectOne(this.reserveCalendars,'date',currentDay).reserve_status_id;
          allow = this.getObjectOne(this.reserveStatuses,'id',statusID).allow;
          if(allow > 0){
            return 'dayAllow';
          }else{
            return 'dayDeny';
          }
        }
        else if(this.regularHolidays.some(obj => obj.day == moment(currentDay).format('D'))){
          return 'dayDeny';
        }
        else if(this.regularWeeks.some(obj => obj.week_id == weekday)){
          statusID = this.getObjectOne(this.regularWeeks,'week_id',weekday).reserve_status_id;
          allow = this.getObjectOne(this.reserveStatuses,'id',statusID).allow;
          if(weekday == 7){
            weekdayClass = ' dayHoliday';
          }else{
            weekdayClass = '';
          }
          if(allow > 0){
            return 'dayAllow'+weekdayClass;
          }else{
            return 'dayDeny'+weekdayClass;
          }
        }
      }
    },
    thisDayIcon: function(date,weekday){
      let currentDay = moment(date).format('YYYY-MM-DD');
      let nowDay = moment().format('YYYY-MM-DD');
      let statusID,iconID,allow;
      if(moment(currentDay).isBefore(nowDay)){
        return "　";
      }
      else if(moment(currentDay).isBefore(this.expiredDay)){
        return "－";
      }
      else {
        //weekdayが祝日なら上書き
        for(let holiday in this.holidays){
          if(currentDay == holiday){
            weekday = 7;
            break;
          }
        }
        if(this.reserveCalendars.some(obj => obj.date == currentDay)){
          statusID = this.getObjectOne(this.reserveCalendars,'date',currentDay).reserve_status_id;
          iconID = this.getObjectOne(this.reserveStatuses,'id',statusID).reserve_icon_id;
          return this.getObjectOne(this.reserveIcons,'id',iconID).icon;
        }
        else if(this.regularHolidays.some(obj => obj.day == moment(currentDay).format('D'))){
          return '休';
        }
        else if(this.regularWeeks.some(obj => obj.week_id == weekday)){
          statusID = this.getObjectOne(this.regularWeeks,'week_id',weekday).reserve_status_id;
          iconID = this.getObjectOne(this.reserveStatuses,'id',statusID).reserve_icon_id;
          allow = this.getObjectOne(this.reserveStatuses,'id',statusID).allow;
          return this.getObjectOne(this.reserveIcons,'id',iconID).icon;
        }
      }
    },
    dayStatus: function(date,weekday){
      let currentDay = moment(date).format('YYYY-MM-DD');
      let nowDay = moment().format('YYYY-MM-DD');
      let statusID,allow;
      if(this.regularHolidays.some(obj => obj.day == moment(currentDay).format('D'))){
          return false;
      } else if(this.regularWeeks.some(obj => obj.week_id == weekday)){
        statusID = this.getObjectOne(this.regularWeeks,'week_id',weekday).reserve_status_id;
        allow = this.getObjectOne(this.reserveStatuses,'id',statusID).allow;
        if(allow > 0){
          return true;
        }else{
          return false;
        }
      } else {
        return true;
      }
    },

    calcExpiredDay: function(){
      this.expiredDay = moment().format('YYYY-MM-DD');
      let reserveTiming = this.clinicalItem.reserve_timing;
      let reserveIncludeHoliday = this.clinicalItem.reserve_include_holiday;
      let count = 1;
      let dayCount = 0;
      while(dayCount < reserveTiming){
        let day = moment().add(count,'days').format('YYYY-MM-DD');
        let wday = moment(day).day();
        if(!reserveIncludeHoliday){
          if(this.dayStatus(day,wday)){
            this.expiredDay = day;
            dayCount++;
          }
        }else{
          this.expiredDay = day;
          dayCount++;
        }
        count++;
      }
    },
    getReserveTimesSets: function(id){
      axios.get('api/reserve_times_sets',{
        params : {
          id : id,
        }
      })
      .then((res) => {
        this.reserveTimesSets = res.data.data.times;

      });
    },
    getReserveStatuses: function(){
      this.loading = true;
      axios.get('api/reserve_statuses')
      .then((res) => {
        this.reserveStatuses = res.data.data;
        this.calcExpiredDay();
        this.loading = false;
        this.getReserveIcons();
      });
    },
    getReserveIcons: function(){
      this.loading = true;
      axios.get('api/reserve_icons')
      .then((res) => {
        this.reserveIcons = res.data.data;
        this.loading = false;
        this.getReserveTimes();
      });
    },
    getReserveTimes: function(){
      this.loading = true;
      axios.get('api/reserve_times')
      .then((res) => {
        this.reserveTimes = res.data.data;
        this.loading = false;
        this.isComponentloading = true;
        this.$SmoothScroll(document.querySelector('#ktyReserveCalendar'),400,null,null,'y');
      });
    },
    getObjectOne: function(array,key,val){
      let target = array.filter(function(object) {
        return object[key] == val
      }).shift();
      return target;
    },
    showNext: function(){
      this.isNextSection = true;
      //bus.$emit('bus-userinput', this.isNextSection);
      this.$emit('showUserInput',this.isNextSection);
    }
	}
}
</script>
