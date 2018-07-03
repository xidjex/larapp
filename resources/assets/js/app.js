
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('example', require('./components/Example.vue'));
Vue.component('ApartmentsList', require('./components/ApartmentsList.vue'));
Vue.component('AddApartmentModal', require('./components/AddApartmentModal.vue'));
Vue.component('ApartmentDetailsModal', require('./components/ApartmentDetailsModal.vue'));

const app = new Vue({
    el: '#app',
    data: {
        list: null,
        user: null,
        selectedIndex: null,
    },
    methods: {
        _loadList() {
            axios.get('/apartment/list')
                .then((response) => {
                    this.list = response.data.list;
                    this.user = response.data.user;
                    console.log(this.user);
                })
                .catch((error) => {
                    alert("Произошла ошибка! (Посмотрите в логи)")
                    console.log(error);
                });
        },
        showDetails(index) {
            this.selectedIndex = index;
        },
    },
    mounted() {
        this._loadList();
    }
});
