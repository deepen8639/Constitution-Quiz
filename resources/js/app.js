/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import '@mdi/font/css/materialdesignicons.css';

//pagecomponentのimport
import ConstitutionHomeComponent from "./components/ConstitutionHomeComponent";
import ConstitutionQuizComponent from "./components/ConstitutionQuizComponent";
import ConstitutionResultComponent from "./components/ConstitutionResultComponent";
import HeaderComponent from "./components/HeaderComponent";
import LoginFormComponent from "./components/LoginFormComponent";
import RegisterFormComponent from "./components/RegisterFormComponent";
import VuetifyHomeComponent from "./components/VuetifyHomeComponent";
import Practice from "./components/Practice";

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuetify);

const router = new VueRouter({
    mode: 'history',
    routes: [

        {
            path: '/constitution',
            name: 'constitution.home',
            component: ConstitutionHomeComponent
        },
        {
          path: '/constitution/:chapterId/quiz',
          name: 'constitution.quiz',
          component: ConstitutionQuizComponent,
          props: true
        },
        {
          path: '/constitution/result',
          name: 'constitution.result',
          component: ConstitutionResultComponent,
          props: true
        },
        {
          path: '/constitution/login',
          name: 'constitution.login',
          component: LoginFormComponent,
        },
        {
          path: '/constitution/register',
          name: 'constitution.register',
          component: RegisterFormComponent,
        },
        {
          path: '/constitution/vuetifyhome',
          name: 'constitution.vuetifyhome',
          component: VuetifyHomeComponent,
        },
        {
          path: '/practice',
          name: 'practice',
          component: Practice,
        },
    ]
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('header-component', HeaderComponent);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(),
    mounted : function(){
   console.log('app mounted')
   console.log(this.$el)
 }
});
