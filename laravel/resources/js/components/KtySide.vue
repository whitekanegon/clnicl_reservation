<template>
			<div v-if="initData" class="ktyFixedWrap" :class="{hide : hideSideSP}">
				<p v-show="isSP" class="ktyLastConfirm">ご入力内容を確認いただき、<br>よろしければ申し込みボタンを押してください。</p>
				<div class="ktyBoxInfo">
					<h2 class="KtyHeading">ご入力内容</h2>
					<div class="ktyInputDetails">
					<section>
						<h3>診療希望内容<span class="ktyModify" v-if="reserveDay || userInputs" @click="modifySection('ktyClinicalItems')">修正</span></h3>
						<div class="detail" v-if="clinicalItem">{{clinicalItem.name}}</div>
					</section>
					<section>
						<h3>予約希望日時<span class="ktyModify" v-if="userInputs" @click="modifySection('ktyReserveCalendar')">修正</span></h3>
						<div class="detail" v-if="reserveDay">
							{{moment(reserveDay).format('YYYY年MM月DD日（ddd）')}}
						<div v-if="reserveTime">{{reserveTime}}</div>
						</div>
					</section>
					<section>
						<h3>受診者について<span class="ktyModify" v-if="userInputs" @click="modifySection('ktyUserInput')">修正</span></h3>
						<div class="detail" v-if="userInputs">
							<ul class="ktyFormConfirm">
								 <li v-for="(item, index) in inputItems" :key="item.id" v-if="item.status">
									 <span class="formName">{{item.name}}：</span>
										<span>{{dispCheckbox(userInputs[item.id].input,item.identify_name)}}</span>
									</li>
							</ul>
						</div>
					</section>
					</div>
				</div>
			</div>

</template>

<script>
const mediaSP = window.matchMedia('(max-width: 767px)');
export default {
	data : function() {
		return {
		}
	},
	props : {
		'initData' : {
			type : Array
		},
		'clinicalItem' : {
			type : Object
		},
		'reserveDay' : {
			type : [Date,String]
		},
		'reserveTime' : {
			type : String
		},
		'userInputs' : {
			type : Object
		},
		'inputItems' : {
			type : Array
		},
	},
	watch: {
		initData: {
  		immediate: true,
  		handler() {
				if(this.initData){
					this.$nextTick(function () {
						this.sideFixed();
  				});
				}
  		}
  	}
	},
	methods : {
		moment(...args){
			moment.lang('ja', {
    	weekdays: ["日曜日","月曜日","火曜日","水曜日","木曜日","金曜日","土曜日"],
    	weekdaysShort: ["日","月","火","水","木","金","土"],
			});
      return moment(...args);
		},
		dispCheckbox : function(inputs,identify_name) {
			if(Array.isArray(inputs)){
				if(identify_name == 'birthday'){
					return inputs[0]+'年'+inputs[1]+'月'+inputs[2]+'日';
				}else{
					return inputs.join('、');
				}

			}else{
				return inputs;
			}
		},
		modifySection: function(id){
			let element = document.getElementById(id);
      element.scrollIntoView({
        behavior: "smooth",
        block: "start"
      });
		},
		sideFixed: function(){
			if(jQuery('.ktyFixedWrap').length){
				var navPos = jQuery('.ktyFixedWrap').offset().top - 20;
				jQuery(window).on('scroll', function () {
					if(mediaSP.matches){
						jQuery('.ktyFixedWrap').removeAttr('style');
					}else{
				 	 var contentHeight=0,sideHeight=0;
				 	 jQuery('#ktyContents').children().each(function(){
				 	   contentHeight = contentHeight + jQuery(this).outerHeight();
				 	 });
				 	 jQuery('.ktyFixedWrap').children().each(function(){
				 	   sideHeight = sideHeight + jQuery(this).outerHeight();
				 	 });
				 	 if(contentHeight > sideHeight){
				 	   var winHeight = jQuery(window).height();
				 	   if (jQuery(this).scrollTop() > navPos) {
				 	     jQuery('.ktyFixedWrap').addClass('fixed').height(winHeight);
				 	   } else {
				 	     jQuery('.ktyFixedWrap').removeClass('fixed');
				 	   }
				 	 }
					}

				});
			}
		},

	},
	computed: {
		hideSideSP: function(){
			if(mediaSP.matches && this.userInputs == null){
				return true;
			}else{
				return false;
			}
		},
		isSP: function(){
			if(mediaSP.matches){
				return true;
			}else{
				return false;
			}
		}
	},
}

</script>
