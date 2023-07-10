<template>
			<div v-if="isNextSection" id="ktyUserInput" :class="{loadingActive: !inputTypes}">
        <div v-show="loading" class="loading" :class="{secondTime: inputTypes}"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
        <section v-show="inputTypes" class="v-fade">
				<h2 class="ktyHeading01">受診者について</h2>
				<div class="ktyBox01">
					<p class="ktyNotice"><span class="ktyHissu">*</span>は必須項目です</p>
        <input type="hidden"
                name="clinicalItem"
                v-validate="'required'"
                v-model="clinicalItem.name"
      >
        <input type="hidden"
                name="reserveDay"
                v-validate="'required'"
                v-model="reserveDay"
      >
        <input type="hidden"
                name="reserveTime"
                v-validate="'required'"
                v-model="reserveTime"
      >
					<table class="ktyForm">
						<tbody>
              <tr v-for="inputItem in inputItems" v-if="inputItem.status">
                <th><span v-if="inputItem.required > 0" class="ktyHissu">*</span>{{inputItem.name}}</th>
                <td v-if="inputTypes">
                  <template v-if="pickInputType(inputItem.input_type_id,'text')">
                    <input
                    type="text"
                    :name="inputItem.identify_name"
                    v-validate="formParts[inputItem.id].required"
                    v-model="formParts[inputItem.id].input"
                    :class="{ 'has-error': errors.has(inputItem.identify_name) }"
                    :data-vv-as="inputItem.name"
                    :placeholder="inputItem.explain"
                    >
                    <p v-show="errors.first(inputItem.identify_name)" class="has-error-message">{{ errors.first(inputItem.identify_name) }}</p>

                  </template>
                  <template v-if="pickInputType(inputItem.input_type_id,'textarea')">
                    <textarea
                    :name="inputItem.identify_name"
                    v-validate="formParts[inputItem.id].required"
                    v-model="formParts[inputItem.id].input"
                    :class="{ 'has-error': errors.has(inputItem.identify_name) }"
                    :data-vv-as="inputItem.name"
                    rows="7"
                    >
                    </textarea>
                    <p v-show="inputItem.explain" class="ktyExplain">{{inputItem.explain}}</p>
                    <p v-show="errors.first(inputItem.identify_name)" class="has-error-message">{{ errors.first(inputItem.identify_name) }}</p>
                  </template>
                  <template v-if="pickInputType(inputItem.input_type_id,'radio')">
                    <ul class="ktyRadio">
                      <li v-for="(item, index) in inputItem.input_selections" :key="item.id">
                        <input type="radio"
                         v-if="index == 0"
                         v-validate="formParts[inputItem.id].required"
                         :name="inputItem.identify_name"
                         v-model="formParts[inputItem.id].input"
                         :data-vv-as="inputItem.name"
                         :id="item.name"
                         :value="item.name">
                        <input type="radio"
                         v-else
                         :name="inputItem.identify_name"
                         v-model="formParts[inputItem.id].input"
                         :data-vv-as="inputItem.name"
                         :id="item.name"
                         :value="item.name">
											  <label :for="item.name">{{item.name}}</label>
                      </li>
                    </ul>
                    <p v-show="inputItem.explain" class="ktyExplain">{{inputItem.explain}}</p>
                    <p v-show="errors.first(inputItem.identify_name)" class="has-error-message">{{ errors.first(inputItem.identify_name) }}</p>
                  </template>
                  <template v-if="pickInputType(inputItem.input_type_id,'checkbox')">
                    <ul class="ktyRadio">
                      <li v-for="(item, index) in inputItem.input_selections" :key="item.id">
                        <input
                        type="checkbox"
                        :name="inputItem.identify_name+'[]'"
                        :id="item.name"
                        v-model="formParts[inputItem.id].input"
                        :value="item.name">
											  <label :for="item.name">{{item.name}}</label>
                      </li>
                    </ul>
                    <p v-show="inputItem.explain" class="ktyExplain">{{inputItem.explain}}</p>
                  </template>
                  <template v-if="pickInputType(inputItem.input_type_id,'select')">
                    <div class="ktySelectBox inline">
                    <select
                    :name="inputItem.identify_name"
                    v-validate="formParts[inputItem.id].required"
                    v-model="formParts[inputItem.id].input"
                    :class="{ 'has-error': errors.has(inputItem.identify_name) }"
                    :data-vv-as="inputItem.name"
                    >
                      <option v-for="item in inputItem.input_selections" :value="item.name" :key="item.id">{{item.name}}</option>
                    </select>
                    </div>
                    <p v-show="inputItem.explain" class="ktyExplain">{{inputItem.explain}}</p>
                    <p v-show="errors.first(inputItem.identify_name)" class="has-error-message">{{ errors.first(inputItem.identify_name) }}</p>
                  </template>
                  <template v-if="pickInputType(inputItem.input_type_id,'birthday')">
                    <ul class="ktyBirth">
										<li>
											<div class="ktySelectBox">
												<select
                        :name="inputItem.identify_name"
                        v-model="formParts[inputItem.id].input[0]"
                        v-validate="formParts[inputItem.id].required"
                        :class="{ 'has-error': errors.has(inputItem.identify_name) }"
                        :data-vv-as="inputItem.name"
                        @change="calcDaysMax(inputItem.id)">
													<option v-for="n in 100" :value="n + yearStart">{{n + yearStart}}</option>
												</select>
											</div>
											年
										</li>
										<li>
											<div class="ktySelectBox">
												<select name="月" v-model="formParts[inputItem.id].input[1]" @change="calcDaysMax(inputItem.id)">
													<option v-for="n in 12" :value="n">{{n}}</option>
												</select>
											</div>
											月
										</li>
										<li>
											<div class="ktySelectBox">
												<select
                        name="日"
                        v-model="formParts[inputItem.id].input[2]"
                        >
													<option v-for="n in daysMax" :value="n">{{n}}</option>
												</select>
											</div>
											日
										</li>
									</ul>
                  <p v-show="inputItem.explain" class="ktyExplain">{{inputItem.explain}}</p>
                  <p v-show="errors.first(inputItem.identify_name)" class="has-error-message">{{ errors.first(inputItem.identify_name) }}</p>
                  </template>
                </td>
              </tr>
						</tbody>

					</table>
				</div>
        </section>
        <section v-show="inputTypes" class="v-fade" id="ktySubmit">
				<div class="ktyBox01">
					<h3 class="ktyHeading">プライバシーポリシー</h3>
					<div class="ktyPrivacy" v-for="mailSetting in mailSettings" v-if="mailSetting.name == 'privacy_policy'">{{mailSetting.content}}</div>
					<div class="ktyForm" v-if="formParts.complete">
						<ul class="ktyRadio ktyCheckbox">
							<li>
								<input
                type="checkbox"
                name="プライバシーポリシーに同意する"
                id="privacy"
                v-validate="'required'"
                data-vv-as="プライバシーポリシーの同意"
                >
								<label for="privacy"><span class="ktyHissu">*</span>個人情報の取扱いに同意する</label>
							</li>
						</ul>
            <p v-show="errors.first('プライバシーポリシーに同意する')" class="has-error-message txt-center">{{ errors.first("プライバシーポリシーに同意する") }}</p>
					</div>
				</div>
        <div class="ktySubmitBox">
        <p v-show="!formInvalid && !isSP" class="ktyLastConfirm">ご入力内容を確認いただき、よろしければ申し込みボタンを押してください。</p>
        <p v-show="formInvalid" class="ktyLastConfirm has-error-text">未入力の必須項目があります。</p>
				<div class="ktyBtnSubmit" v-if><button @click="postApp" :class="{disabled : formInvalid}">仮予約を申し込む</button></div>
        </div>
			</section>
			</div>
</template>

<script>
const mediaSP = window.matchMedia('(max-width: 767px)');
export default {
  data: function() {
    return {
      inputItems: null,
      inputTypes:null,
      mailSettings:null,
      isNextSection: null,
      loading: true,
      yearStart: null,
      daysMax : 31,
      formParts : {
        complete : false,
      },
      setComplete : null,
    }
  },
	props : {
		'clinicalItem' : {
			type : Object
		},
		'reserveDay' : {
			type : [Date,String]
		},
		'reserveTime' : {
			type : String
		},
	},
  created: function() {
    this.$on('userInput',this.getInputItems);
  },
  watch: {
    fields : function(val,oldVal){
      let fieldsLength = Object.keys(val).length;
      //console.log('fieldsLength:'+fieldsLength);
    },
    formParts : function(val,oldVal){
      let formPartsLength = Object.keys(val).length;
      //console.log('formPartsLength:'+formPartsLength);
    }

  },
  computed: {
    formInvalid : function() {
      let flagInvalid = false;
      let fieldsLength = Object.keys(this.fields).length;
      let formPartsLength = Object.keys(this.formParts).length - 1;
      if(fieldsLength == (formPartsLength + 4)){
        for(let key in this.fields){
          if(this.fields[key]['invalid'] == true){
            flagInvalid = true;
            break;
          }
        }
      }
      return flagInvalid;
    },
    isSP: function(){
			if(mediaSP.matches){
				return true;
			}else{
				return false;
			}
		}
  },
  mounted : function(){
    //bus.$on('bus-userinput',this.getInputItems);
    //this.getInputItems(true);
    //this.calcDaysMax();
  },
  methods: {
    postApp: function () {
  // バリデートの判定
  this.$validator.validateAll().then((result) => {
      if (result) {
         console.log('submit!');
         let params = {};
         params['clinicalName'] = '【診療希望内容】 '+ this.clinicalItem.name;
         params['reserveDay'] = '【予約希望日時】 '+ moment(this.reserveDay).format('YYYY年MM月DD日（ddd）') + this.reserveTime;
         for(let i=0; i<this.inputItems.length; i++){
           if(this.inputItems[i].status > 0){
             let key = this.inputItems[i].identify_name;
             let name = this.inputItems[i].name;
             let detail = this.formParts[this.inputItems[i].id].input
             if(this.inputItems[i].identify_name == 'birthday'){
               detail = this.formParts[this.inputItems[i].id].input[0] + '年' + this.formParts[this.inputItems[i].id].input[1] + '月' + this.formParts[this.inputItems[i].id].input[2] + '日';
             }else if(Array.isArray(detail)){
               detail = detail.join('、');
             }
             params[key] = '【' + name + '】 ' + detail;
             if(this.inputItems[i].identify_name == 'name'){
               params['nameofUser'] = detail;
             }
             if(this.inputItems[i].identify_name == 'email'){
               params['emailtoUser'] = detail;
             }
           }

         }
        //console.log(params);
        this.setComplete = true;
        this.loading = true;
        let self = this;
         axios.post('sendmail',params)
            .then(function(response){
              console.log(response);
              self.setComplete = true;
              self.loading = false;
              self.$emit('setComplete',self.setComplete);
            })
            .catch(function(error){
              console.log(error);
            });
      }else{
        let firstError = document.getElementsByName([this.$validator.errors.items[0].field])[0];
        //console.log(firstError.name);
        if(firstError.name == 'reserveDay' || firstError.name == 'reserveTime'){
          let element = document.getElementById('ktyReserveCalendar');
          element.scrollIntoView({
        behavior: "smooth",
        block: "start"
      });
        }else{
        firstError.scrollIntoView({
        behavior: "smooth",
        block: "start"
      });
        }
      }
  });
},
    addFormPartsData: function(){
      for(let i in this.inputItems){
        if(this.inputItems[i].status > 0){

         let required = '';
         if(this.inputItems[i].required > 0){
           required = 'required';
         }
         let identify_name;
         let input_type = this.getObjectOne(this.inputTypes, 'input_type_id', this.inputItems[i].input_type_id).type;
         if(this.inputItems[i].identify_name != ''){
           identify_name = this.inputItems[i].identify_name;
         }else {
           identify_name = input_type + this.inputItems[i].id;
           this.inputItems[i].identify_name = identify_name;
         }
         if(identify_name.match(/email/g)){
           if(required){
             required = required + '|email';
           }else{
             required = 'email';
           }
         }

         if(input_type == 'checkbox'){
           this.$set(this.formParts, this.inputItems[i].id, { input: [], required: required });
         }
         else if(identify_name.match(/birth/g)){
           this.$set(this.formParts, this.inputItems[i].id, { input: [], required: required });
           this.yearStart = moment().year() - 101;
           this.formParts[this.inputItems[i].id].input[0] = '';
           //this.formParts[this.inputItems[i].id].input[0] = this.yearStart + 50;
           this.formParts[this.inputItems[i].id].input[1] = 1;
           this.formParts[this.inputItems[i].id].input[2] = 1;
         }
         else{
           this.$set(this.formParts, this.inputItems[i].id, { input: '', required: required });
         }
         if(i == this.inputItems.length - 1){
           this.formParts.complete = true;
           this.$emit('setUserInputs',this.formParts);
           this.$emit('setInputItems',this.inputItems);
         }
        }
      }
    },
    moment(...args){
			moment.lang('ja', {
    weekdays: ["日曜日","月曜日","火曜日","水曜日","木曜日","金曜日","土曜日"],
    weekdaysShort: ["日","月","火","水","木","金","土"],
});
      return moment(...args);
		},
    calcDaysMax : function(id){
      this.daysMax = new Date(this.formParts[id].input[0], this.formParts[id].input[1], 0).getDate();
    },
    getInputItems: function(isNextSection){
      this.isNextSection = isNextSection;
      axios.get('api/input_items')
      .then((res) => {
        this.inputItems = res.data.data;
        this.getInputTypes();
      });
    },
    getInputTypes: function(){
      axios.get('api/input_types')
      .then((res) => {
        this.inputTypes = res.data.data;
        this.$SmoothScroll(document.querySelector('#ktyUserInput'),400,null,null,'y');
        this.addFormPartsData();
        this.getMailSettings();
        this.loading = false;
      });
    },
    getMailSettings: function(){
      axios.get('api/mail_settings')
      .then((res) => {
        this.mailSettings = res.data.data;
      });
    },
    pickInputType: function(input_type_id,type){
      let target = this.inputTypes.filter(function(object) {
        return object['input_type_id'] == input_type_id
      }).shift();
      if(target.type == type){
        return true;
      }else{
        return false;
      }
    },
    getObjectOne: function(array,key,val){
      let target = array.filter(function(object) {
        return object[key] == val
      }).shift();
      return target;
    },


	}
}
</script>
