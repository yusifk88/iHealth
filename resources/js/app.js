

import '@mdi/font/css/materialdesignicons.css';

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import 'es6-promise/auto';
import VueRouter from 'vue-router';
import dashboardComponent from "./components/dashboardComponent";
import loginComponent from "./components/loginComponent";
import {store} from "./store";
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex'
import patientComponent from "./components/patientComponent";
import admissionComponent from "./components/admissionComponent";
Vue.use(Vuetify);
Vue.use(Vuex);

Vue.use(VueRouter);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
    {
        path:'/',
        name:'dashboard',
        component:dashboardComponent,
        meta: { requiresAuth: true }
    },

    {
        path:'/patients',
        name:'patients',
        component:patientComponent,
        meta: { requiresAuth: true }
    },

    {
        path:'/admit/:id',
        name:'admit',
        component:admissionComponent,
        meta: { requiresAuth: true }
    },
    {
        path:'/login',
        name:'login',
        component:loginComponent,
        meta: { requiresAuth: false }
    }
];

const router = new VueRouter({
routes,
    mode:'history'

});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!store.state.loged_in) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
});




const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
    store,
    data(){

        return{
            drawer:true,
            mini_drawer: true,
            navs:[
                {
                    text:'Patients',
                    icon:'mdi-account-group',
                    route:'/patients'
                },

                {
                    text:'Admissions',
                    icon:'mdi-book',
                    route:'/adminssions'
                },
            ]
        }
    },
    methods:{
        check_user(){

            axios.get('/api/user')
                .then(res=>{

                    this.$store.state.user = res.data;
                    this.$store.state.loged_in = true;

                })
                .catch(err=>{
                    this.$store.state.loged_in = false;
                    router.push({path:'/login'});


                });
        }
    },

    mounted(){
        this.check_user();
    }
});
