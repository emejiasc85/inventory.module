
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('modal', require('./components/Modal.vue'));
Vue.component('invoice', require('./views/invoice.vue'));
Vue.component('gift-cards', require('./views/gift_cards.vue'));

import VTooltip from 'v-tooltip';
import CheckboxRadio from 'vue-checkbox-radio';
import Toastr from 'vue-toastr';
require('vue-toastr/src/vue-toastr.scss');

// Register plugin
Vue.use(Toastr);
Vue.use(VTooltip)
Vue.use(CheckboxRadio);

// Register a global custom directive called v-focus
Vue.directive('focus', {
    // When the bound element is inserted into the DOM...
    inserted: function (el) {
      // Focus the element
      el.focus()
    }
  })

const app = new Vue({
    el: '#app'
});
