
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

const app = new Vue({
    el: '#app',
    data: {
        apartments: null,
        search: null,
        user: null,
        selectedIndex: null,
        inputSearch: null
    },
    methods: {
        _loadList() {
            axios.get('/apartment/list')
                .then((response) => {
                    this.apartments = response.data.list;
                    this.user = response.data.user;
                })
                .catch((error) => {
                    alert("Произошла ошибка! (Посмотрите в логи)")
                    console.log(error);
                });
        },
        searchIn(target = null, value = 0) {
         
            this.search = _.filter(this.apartments, {'status': 0});
        },
        showDetails(index) {
            this.selectedIndex = index;
        },
        searchAll() {
            var command = this.inputSearch.split(':', 2);
            command[0] = _.lowerCase(_.trim(command[0]));
            command[1] = _.toInteger(_.trim(command[1])) != 0 ? _.toInteger(_.trim(command[1])): _.toLowerCase(_.trim(command[1]));
            
            this.search =  _.zipObject([command[0]], [command[1]]);
        }
    },
    computed: {
      list() {
          return this.sList || this.apartments;
      },
        sList() {
            return _.filter(this.apartments, this.search);
        }
    },
    mounted() {
        this._loadList();
    }
});
