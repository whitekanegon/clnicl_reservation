/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');
window.axios = require('axios');
window.jQuery = require('jquery');
//global.jquery = jQuery;
//global.jq = jQuery;
//window.jq = window.jQuery = require('jquery');
window.Vcalendar = require('v-calendar');
window.moment = require('moment');
window.smoothScroll = require('vue-smoothscroll');

window.VeeValidate = require('vee-validate');
window.ja = require('vee-validate/dist/locale/ja');

Vue.use(Vcalendar);
Vue.use(smoothScroll);
VeeValidate.Validator.localize('ja', ja);
const dictionary = {
    ja: {
      messages:{
        email: () => '有効なメールアドレスではありません'
      }
    },
  };
VeeValidate.Validator.localize(dictionary);
Vue.use(VeeValidate, { locale: ja });
Vue.config.productionTip = false;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));


bus = new Vue();
Vue.component('kty-container', require('./components/KtyContainer.vue').default);
Vue.component('kty-clinic-items', require('./components/ktyClinicItems.vue').default);
Vue.component('kty-reserve-calendar', require('./components/KtyReserveCalendar.vue').default);
Vue.component('kty-user-input', require('./components/ktyUserInput.vue').default);
Vue.component('kty-side', require('./components/ktySide.vue').default);
Vue.component('kty-complete', require('./components/ktyComplete.vue').default);

const app = new Vue({
    el: '#app',
});
