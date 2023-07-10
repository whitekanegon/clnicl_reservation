<template>
  <div>
    <div id="ktyContentHeader">
			<h1>診療予約</h1>
      <div v-show="loading" class="loading"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
      <div v-if="mailSettings">
			<div v-if="!sendComplete && getObjectOne(mailSettings,'name','thanks_notice').content" :class="{dispAllSP: userInputs}">
        <div class="toujitsu">
         <p>※当日予約は、クリニックへ直接お電話ください。</p>
         <p><a href="tel:0788557585">&#x260e; 078-855-7585</a></p>
        </div>
        <p class="notice" v-html="getObjectOne(mailSettings,'name','thanks_notice').content"></p>
      </div>
      </div>
		</div>

   <div id="ktyContainer" v-if="!sendComplete" :class="{dispAllSP: userInputs}">
    <div id="ktyContents">

    <kty-clinic-items
    @setInitData="setInitData"
    @setClinicalItem="setClinicalItem"
    @showCalendar="showCalendar"
    @setReserveDay="setReserveDay"
    ></kty-clinic-items>

    <kty-reserve-calendar
    ref="reserveCalendar"
    @setReserveDay="setReserveDay"
    @setReserveTime="setReserveTime"
    @showUserInput="showUserInput"
    :userInputs="userInputs"
    ></kty-reserve-calendar>

    <kty-user-input
    ref="userInput"
    :clinicalItem="clinicalItem"
    :reserveDay="reserveDay"
    :reserveTime="reserveTime"
    @setUserInputs="setUserInputs"
    @setInputItems="setInputItems"
    @setComplete="setComplete"
    ></kty-user-input>

    </div>
    <div id="ktySide">
    <kty-side
    :initData="mailSettings"
    :clinicalItem="clinicalItem"
    :reserveDay="reserveDay"
    :reserveTime="reserveTime"
    :userInputs="userInputs"
    :inputItems="inputItems"
    ></kty-side>
    </div>
   </div>
   <div id="ktyContainer" class="ktyComplete" v-else>
     <div id="ktyContents">
       <kty-complete
       @setComplete="setComplete"
       ></kty-complete>
     </div>
   </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      clinicalItem: null,
      reserveDay: null,
      reserveTime: null,
      userInputs: null,
      inputItems: null,
      sendComplete: null,
      mailSettings: null,
      loading: true,
    }
  },
  methods : {
    setInitData : function(setInitData){
      this.mailSettings = setInitData;
      this.loading = false;
    },
    setClinicalItem : function(clinicalItem){
      this.clinicalItem = clinicalItem;
      this.reserveDay = '';
      this.reserveTime = '';
    },
    showCalendar : function(clinicalItem){
      this.$refs.reserveCalendar.$emit('clinicalItem',clinicalItem);
    },
    setReserveDay : function(reserveDay){
      this.reserveDay = reserveDay;
    },
    setReserveTime : function(reserveTime){
      this.reserveTime = reserveTime;
    },
    showUserInput : function(showUserInput){
      this.$refs.userInput.$emit('userInput',showUserInput);
    },
    setUserInputs : function(userInputs){
      this.userInputs = userInputs;
    },
    setInputItems : function(inputItems){
      this.inputItems = inputItems;
    },
    setComplete : function(complete){
      this.sendComplete = complete;
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
