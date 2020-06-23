

import '@mdi/font/css/materialdesignicons.css';

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import 'es6-promise/auto';
import VueRouter from 'vue-router';
import dashboardComponent from "./components/dashboardComponent";
import loginComponent from "./components/loginComponent";
import dispensaryComponent from './components/dispensaryComponent';
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
import opdviewComponent from "./components/partials/opdviewComponent";
import newconsultingComponent from "./components/newconsultingComponent";
import OPDComponent from "./components/partials/OPDComponent";
import vitalsComponent from "./components/vitalsComponent";
import labComponent from "./components/partials/labComponent";
import newdispensaryComponent from "./components/partials/newdispensaryComponent";
import opdpreviewComponent from "./components/opdpreviewComponent";
import detentionComponent from "./components/detentionComponent";
import detentionviewComponent from "./components/partials/detentionviewComponent";
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'
import patientpreviewComponent from "./components/patientpreviewComponent";

Vue.use(Chartkick.use(Chart));
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
        path:'/patient/:id',
        name:'patient',
        component:patientpreviewComponent,
        meta: { requiresAuth: true }
    },

    {
        path:'/dispensary',
        name:'dispensary',
        component:dispensaryComponent,
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
    },
    {
        path:'/consulting/:id',
        name:'consulting',
        component:newconsultingComponent,
        meta: { requiresAuth: true }
    },

    {
        path:'/opd',
        name:'opd',
        component:opdviewComponent,
        meta: { requiresAuth: true }
    },
    {
        path:'/vitals/:id',
        name:'vitals',
        component:vitalsComponent,
        meta: { requiresAuth: true }
    },

    {
        path:'/lab/:id',
        name:'lab',
        component:labComponent,
        meta: { requiresAuth: true }
    },
    {
        path:'/dispensary/:id',
        name:'dispensary',
        component:newdispensaryComponent,
        meta: { requiresAuth: true }
    },
    {
        path:'/opd/:id',
        name:'opview',
        component:opdpreviewComponent,
        meta: { requiresAuth: true }
    },
    {
        path:'/detention',
        name:'detention',
        component:detentionComponent,
        meta: { requiresAuth: true }
    },
    {
        path:'/detention/:id',
        component:detentionviewComponent,
        meta: { requiresAuth: true }
    },
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
            menu:false,
            drawer:true,
            mini_drawer: true,
            initialised:false,
            logout_dialog:false,
            logout_progress:false,
            navs:[
                {
                    text:'Dasboard',
                    icon:'mdi-dashboard',
                    route:'/'
                },
                {
                    text:'Patients',
                    icon:'mdi-account-group',
                    route:'/patients'
                },
                {
                    text:'Dispensary',
                    icon:'mdi-pill',
                    route:'/dispensary'
                },

                {
                    text:'OPD',
                    icon:'mdi-book',
                    route:'/opd'
                },


                {
                    text:'detention',
                    icon:'mdi-bed',
                    route:'/detention'
                },
            ]
        }
    },
    methods:{
        logout(){
            this.logout_progress=true;
            axios.post('/Authlogout')
                .then(res=>{
                    this.logout_progress=false;
                    this.$store.state.loged_in=false;
                    this.check_user();
                    this.$router.push({
                        path:'/login'
                    });
                    this.logout_dialog=false;
                });



        },
        check_user(){
            this.initialised=false;


            axios.get('/api/user')
                .then(res=>{

                    this.initialised=true;

                    this.$store.state.user = res.data;
                    this.$store.state.loged_in = true;

                })
                .catch(err=>{
                    this.initialised=true;
                    this.$store.state.loged_in = false;
                    router.push({path:'/login'});


                });
        }
    },

    mounted(){
    },

  created() {
        this.check_user();
  }
});

Vue.filter('currency_symbol',(d)=>{

    if(d < 0){
        return '-'+"GHS"+d/-1;

    }else{


        return "GHS"+d;

    }


});

Vue.filter('toMoney',(d)=>{
    if(d){


        return  (Number(d)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

    }else{
        return '0.00';
    }

});
