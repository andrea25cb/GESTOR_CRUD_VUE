import Vue from 'vue'
import App from './App.vue'

import "bootstrap/dist/css/bootstrap.min.css";
import "datatables.net-bs4";
import "datatables.net-bs4/css/dataTables.bootstrap4.min.css";
import "jszip";
import "pdfmake";
import "datatables.net-buttons-bs4";
import "datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css";
import "datatables.net-buttons/js/buttons.colVis";
import "datatables.net-buttons/js/buttons.flash";
import "datatables.net-buttons/js/buttons.html5";
import "datatables.net-buttons/js/buttons.print";
import router from './router'
import VueSweetalert2 from 'vue-sweetalert2';
import Swal from 'sweetalert2';
window.Swal = Swal;

Vue.use(VueSweetalert2);

Vue.config.productionTip = false

new Vue({
    router,
    render: h => h(App)
}).$mount('#app')