
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

Vue.component('ApartmentsList', require('./components/ApartmentsList.vue'));
Vue.component('AddApartmentModal', require('./components/AddApartmentModal.vue'));
Vue.component('ApartmentDetailsModal', require('./components/ApartmentDetailsModal.vue'));
Vue.component('ProgressBar', require('./components/ProgressBar.vue'));
Vue.component('Search', require('./components/Search.vue'));

const app = new Vue({
    el: '#app',
    data: {
        apartments: null,
        user: {
            name: 'nobody'
        },
        selectedIndex: null,
        search: null,
        progress: false
    },
    methods: {
        _loadList() {
            this.progress = true;
            
            axios.get('/apartment/list') 
                .then((response) => {
                    this.apartments = response.data.list;
                    this.user = response.data.user;
                    this.progress = false;
                })
                .catch((error) => {
                    alert("Произошла ошибка! (Посмотрите в логи)");
                    console.log(error);
                    this.progress = false;
                });
        },
        showDetails(index) {
            this.selectedIndex = index;
        },
        searchError() {
            alert('Ничего не найдено!');
        }
    },
    computed: {
      list() {
          return this.searched || this.apartments;
      },
    },
    mounted() {
        this._loadList();
    }
});
