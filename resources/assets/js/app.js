require('./bootstrap');

window.Vue = require('vue');

import VeeValidate from 'vee-validate';
import swal from 'sweetalert';
import baseComponent from './components/layouts/BaseComponent.vue';
import { routes } from './vueroutes.js'

Vue.use(VeeValidate);

// Add a response interceptor
axios.interceptors.response.use(function (response) {
    console.log(response)
    if(typeof response.data !== 'object' && response.data !== '') {
      swal({
        title: "Success",
        text: response.data,
        icon: "success",
        button: "ok"
      })
    }
    return response;
  }, function (error) {
    console.log(error)
    swal({
      title: "Error",
      text: "Sorry! Unstable connectivity from server side.",
      icon: "error",
      button: "ok"
    })
    return Promise.reject(error);
  });

Vue.filter('formatClock', function (value) {
    if (!value) return '00'
    var s = value+"";
    while (s.length < 2) s = "0" + s
    return s
});

const app = new Vue({
    el: '#app',
    components: {
        'base-component': baseComponent
    },
    router: routes
});
