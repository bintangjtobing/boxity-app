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
import 'feather-icons';
import moment from 'moment';

import 'vue2-dropzone/dist/vue2Dropzone.min.css';

// Language MOMENT
require('moment/locale/en-au');
moment.locale('en-au');

Vue.mixin(titleMixin);
Vue.use(VueRouter, VueAxios, Axios, VueSweetalert2);

import App from './components/App.vue';
import Index from './components/index.vue';
import UserLists from './components/user-lists.vue';
import Career from './components/career.vue';
import Candidate from './components/candidate.vue';
import candidateDetail from './components/candidateDetail.vue';
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
import careerFormEdit from './components/careerFormEdit.vue';
import careerView from './components/careerView.vue';
import blogView from './components/blogView.vue';
import blogEdit from './components/blogEdit.vue';
import userProfileEdit from './components/userProfileEdit.vue';
import userProfile from './components/userProfile.vue';
import quoteForm from './components/quoteForm.vue';
import quoteFormEdit from './components/quoteFormEdit.vue';
import quoteView from './components/quoteView.vue';
import galleryForm from './components/galleryForm.vue';
import trackForm from './components/trackForm.vue';
import trackView from './components/trackView.vue';
import notePad from './components/notePad.vue';
import goodsReceipt from './components/goodsReceipt.vue';
import versionView from './components/versionView.vue';
import userGuide from './components/userGuide.vue';
import notFoundPage from './components/notFoundPage.vue';
import directMessage from './components/dm.vue';
import settings from './components/settings.vue';
import customers from './components/customers.vue';
import customerForm from './components/customersForm.vue';
import suppliers from './components/suppliers.vue';
import supplierForm from './components/supplierForm.vue';
import warehouseMgmt from './components/warehouseMgmt.vue';
import assetMgmt from './components/assetMgmt.vue';

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
        name: 'candidate-detal',
        path: '/candidate/detail/:id',
        component: candidateDetail
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
    }, {
        name: 'career-edit',
        path: '/edit/career/:id',
        component: careerFormEdit,
    }, {
        name: 'blog-view',
        path: '/detail/blogs/:id',
        component: blogView,
    }, {
        name: 'blog-edit',
        path: '/edit/blog/:id',
        component: blogEdit,
    }, {
        name: 'userProfileEdit',
        path: '/u/:username/edit',
        component: userProfileEdit,
    }, {
        name: 'user-profile',
        path: '/u/:username',
        component: userProfile,
    }, {
        name: 'new-quote',
        path: '/quote/new',
        component: quoteForm,
    }, {
        name: 'quote-details',
        path: '/quote/:id',
        component: quoteView,
    }, {
        name: 'quote-edit',
        path: '/edit/quote/:id',
        component: quoteFormEdit,
    }, {
        name: 'gallery-form',
        path: '/gallery/new',
        component: galleryForm
    }, {
        name: 'track-form',
        path: '/track-delivery/new',
        component: trackForm,
    }, {
        name: 'track-view',
        path: '/track-delivery/:id',
        component: trackView,
    }, {
        name: 'notepad',
        path: '/notepad',
        component: notePad
    }, {
        name: 'goods-receipt',
        path: '/goods-receipt',
        component: goodsReceipt
    }, {
        name: 'versionView',
        path: '/v/:version',
        component: versionView
    }, {
        name: 'user-guide',
        path: '/user-guide',
        component: userGuide
    }, {
        path: '*',
        component: notFoundPage
    }, {
        name: 'direct-message',
        path: '/direct-message',
        component: directMessage
    }, {
        name: 'settings',
        path: '/settings',
        component: settings
    }, {
        name: 'suppliers',
        path: '/suppliers',
        component: suppliers
    }, {
        name: 'update-supplier',
        path: '/detail/supplier/:id',
        component: supplierForm,
    }, {
        name: 'customers',
        path: '/customers',
        component: customers
    },
    {
        name: 'update-customer',
        path: '/detail/customer/:id',
        component: customerForm,
    }, {
        name: 'warehouse-management',
        path: '/warehouse-management',
        component: warehouseMgmt
    }, {
        name: 'asset-management',
        path: '/asset-management',
        component: assetMgmt
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
    linkActiveClass: 'active'
});
new Vue(Vue.util.extend({
    router,
    vuetify,
    render: function (h) {
        return h(App)
    }
})).$mount("#app");
