<template>
  <section>
    <h2 class="ktyHeading01">仮予約の受付完了</h2>
    <div v-if="mailSettings">
    <div class="ktyCompleteMsg">{{getObjectOne(mailSettings,'name','thanks_text').content}}</div>
    <div class="ktyCompleteNotice" v-if="getObjectOne(mailSettings,'name','thanks_notice').content">{{getObjectOne(mailSettings,'name','thanks_notice').content}}</div>
    </div>
    <div class="ktyBtnNext"><a href="./">予約トップに戻る</a></div>
  </section>
</template>

<script>
export default {
  data: function() {
    return {
      setComplete: true,
      mailSettings : null,
    };
  },
  mounted : function(){
    this.getMailSettings();
  },
  methods: {
    getMailSettings: function(){
      axios.get('api/mail_settings')
      .then((res) => {
        this.mailSettings = res.data.data;
      });
    },
    getObjectOne: function(array,key,val){
      let target = array.filter(function(object) {
        return object[key] == val
      }).shift();
      return target;
    },
  }
};
</script>
