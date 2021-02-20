require('./bootstrap');

import Vue from 'vue';
window.Vue = require('vue');

// import dependecies tambahan
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Axios from 'axios';
import titleMixin from './mixins/titleMixins.js';
import VueSweetalert2 from 'vue-sweetalert2';
import vuetify from './plugins/vuetify.js';

Vue.mixin(titleMixin);
Vue.use(VueRouter, VueAxios, Axios, VueSweetalert2);

import Index from './components/index.vue';
import UserLists from './components/user-lists.vue';
import Career from './components/career.vue';
import Candidate from './components/candidate.vue';
import Issue from './components/issue.vue';
import Quote from './components/quote.vue';
import Gallery from './components/gallery.vue';
import Blog from './components/blog.vue';
import TrackDev from './components/trackDelivery.vue';
import VersionControl from './components/version-control.vue';
import userForm from './components/userForm.vue';

// membuat router
const routes = [{
    name: 'home',
    path: '/tools',
    component: Index
}, {
    name: 'user',
    path: '/users-management',
    component: UserLists
}, {
    name: 'career',
    path: '/career',
    component: Career
}, {
    name: 'candidate',
    path: '/candidate',
    component: Candidate
}, {
    name: 'issues',
    path: '/issues',
    component: Issue
}, {
    name: 'quote',
    path: '/quote',
    component: Quote
}, {
    name: 'gallery',
    path: '/gallery',
    component: Gallery
}, {
    name: 'blog',
    path: '/blog-management',
    component: Blog
}, {
    name: 'track-delivery',
    path: '/track-delivery',
    component: TrackDev
}, {
    name: 'version-control',
    path: '/version-control',
    component: VersionControl
}, {
    name: 'update-user',
    path: '/detail/user/:id',
    component: userForm,
}]

const router = new VueRouter({
    mode: 'history',
    routes: routes,
    linkActiveClass: 'mm-active'
});
new Vue(Vue.util.extend({
    router,
    vuetify
})).$mount("#App");
