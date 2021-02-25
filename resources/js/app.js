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

import 'vue2-dropzone/dist/vue2Dropzone.min.css'

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
import ContactLists from './components/contactList.vue';
import IssueForm from './components/issueForm.vue';
import issueDetail from './components/issueDetail.vue';
import careerForm from './components/careerForm.vue';
import careerView from './components/careerView.vue';

// membuat router
const routes = [{
        name: 'home',
        path: '/tools',
        component: Index
    }, {
        name: 'user',
        path: '/users-management',
        component: UserLists
    },
    {
        name: 'contact lists',
        path: '/contact-list',
        component: ContactLists
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
        name: 'new issues',
        path: '/new-issue',
        component: IssueForm
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
    }, {
        name: 'detail-issue',
        path: '/issues/:id',
        component: issueDetail,
    }, {
        name: 'new-career',
        path: '/career/new',
        component: careerForm,
    }, {
        name: 'career-details',
        path: '/career/:id',
        component: careerView,
    }
]

const router = new VueRouter({
    mode: 'history',
    routes: routes,
    scrollBehavior(to, from, savedPosition) {
        return {
            x: 0,
            y: 0
        }
    },
    linkActiveClass: 'mm-active'
});
new Vue(Vue.util.extend({
    router,
    vuetify
})).$mount("#App");
