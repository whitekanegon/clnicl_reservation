<template>
			<section id="ktyClinicalItems">
        <div v-show="!loading" class="v-fade">
				<h2 class="ktyHeading01">診療希望内容</h2>
				<div class="ktyBox01">
					<h3 class="ktyHeading">診療希望内容を選択してください。</h3>
					<ul class="ktyClinicItems">
            <li v-for="(item, key, index) in items" v-if="item.status > 0"><a href="#" @click.prevent.stop="isSelect(item.id,item.name)" :class="{'current': clinicalItem.id === item.id}">{{item.name}}</a></li>
					</ul>
				</div>
				<div class="ktyBtnNext v-fade" v-show="clinicalItem.id" v-if="!isNextSection"><a href="#" @click.prevent.stop="showNext()">予約日時を選択する</a></div>
        </div>
			</section>
</template>

<script>

export default {
  data: function() {
    return {
      items: null,
      clinicalItem: {id:'', name: ''},
      isNextSection: false,
      loading: true,
      mailSettings: null,
    }
  },
  mounted: function() {
    this.getItems();
  },
  methods: {
    getItems: function(){
      axios.get('api/clinical_items')
      .then((res) => {
        this.items = res.data.data;
        this.getMailSettings();
      });
    },
    getMailSettings: function(){
      axios.get('api/mail_settings')
      .then((res) => {
        this.mailSettings = res.data.data;
        this.$emit('setInitData',this.mailSettings);
        this.loading = false;
      });
    },
    isSelect: function(num, name){
      this.clinicalItem = {
        id: num,
        name: name,
      }
      if(this.isNextSection){
        this.$emit('setReserveDay','');
        this.$emit('showCalendar',this.clinicalItem);
      }
      this.$emit('setClinicalItem',this.clinicalItem);
    },
    showNext: function(){
      this.$emit('showCalendar',this.clinicalItem);
      this.isNextSection = true;
    }
  }
}
</script>
