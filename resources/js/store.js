import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);
export const store = new Vuex.Store({
state:{
    loged_in:false,
    user:null,
    patient:null,
}



});
