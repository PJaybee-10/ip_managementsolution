require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Router Imported
import {routes} from './routes'

// Import User Class
import User from './Helpers/User'
window.User = User

// Import Notification Class
import Notification from './Helpers/Notification'
window.Notification = Notification

//Sweetalert2
import Swal from 'sweetalert2';
window.Swal = Swal;

import VuePdfApp from "vue-pdf-app";
window.VuePdfApp = VuePdfApp;
Vue.component('ipAddressModal', require('./components/modals/ipaddModal.vue').default);
Vue.component('navComponent', require('./components/template/nav.vue').default);
Vue.component('sidemenuComponent', require('./components/template/sidemenu.vue').default);
Vue.component('footerComponent', require('./components/template/footer.vue').default);
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    customClass: {
      container: 'my-swal'
    },
    showConfirmButton: false,
    timer: 60000,
    timerProgressBar: true,
});

window.Toast = Toast

const router = new VueRouter({
    routes,
    mode:'history'
})
  
import api from './Helpers/api';
window.api = api

const app = new Vue({
    el: '#app',
    router,
    data() {
        return {
        }
    }
});
