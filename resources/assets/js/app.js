
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

const app = new Vue({
    el: '#app',
    data: {
        list: [
            {
                number: 1,
                floor: 1,
                entrance: 1,
                status: 0,
                owners: [
                    {
                        name: 'lololololol',
                        number: '0668539494'
                    }
                ]
            },
            {
                number: 2,
                floor: 1,
                entrance: 1,
                status: 1,
                owners: [
                    {
                        name: 'lololololol',
                        number: '0668539494'
                    }
                ]
            },
            {
                number: 3,
                floor: 1,
                entrance: 1,
                status: 2,
                owners: [
                    {
                        name: 'lololololol',
                        number: '0668539494'
                    }
                ]
            },
            {
                number: 4,
                floor: 1,
                entrance: 1,
                status: 3,
                owners: [
                    {
                        name: 'lololololol',
                        number: '0668539494'
                    },
                    {
                        name: 'lololololol22',
                        number: '0668539494222'
                    }
                ]
            }
        ]
    }
});
