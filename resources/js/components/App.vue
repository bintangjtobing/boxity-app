<template>
    <div id="app">
        <div class="mobile-search"></div>
        <div class="mobile-author-actions"></div>
        <header class="header-top">
            <nav class="navbar navbar-light">
                <div class="navbar-left">
                    <a @click="sidebarToggle" class="sidebar-toggle">
                        <img class="svg" src="dashboard/img/svg/bars.svg" alt="img"></a>
                    <a class="navbar-brand" href="/">
                        <img class="svg dark" :src="company.logo" alt="company-logo">
                        <img class="light" :src="company.logoblack" alt="company-logo">
                    </a>
                    <div>
                        <span>{{user.customerCity}}</span>
                        <h4>{{user.customerName}}</h4>
                    </div>
                </div>
                <div class="navbar-right">
                    <div v-show="!isMobile">
                        <ul class="nav-right">
                            <!-- <li>
                                <button class="btn" onclick="turnOnDarkMode()"><span>
                                        <div id="sunmoon" class="fas fa-moon"></div>
                                    </span></button>
                            </li> -->
                            <!-- <li class="nav-message" v-if="user.role!='customer'">
                                <div class="dropdown-custom">
                                    <a href="/direct-message" class="nav-item-toggle">
                                        <i data-feather="send"></i></a>
                                </div>
                            </li> -->
                            <li class="nav-support">
                                <div class="dropdown-custom">
                                    <a href="https://help.boxity.id" target="_blank" class="nav-item-toggle">
                                        <span style="font-size: 1.10rem;" class="mx-2"><i
                                                class="fal fa-question-circle"></i></span>
                                    </a>
                                    <router-link to="/inbox" class="nav-item-toggle">
                                        <span style="font-size: 1.10rem;" class="mx-2"><i
                                                class="fal fa-inbox-in"></i></span>
                                    </router-link>
                                </div>
                            </li>
                            <li class="nav-author">
                                <div class="dropdown-custom">
                                    <a href="javascript:;" class="nav-item-toggle"><img
                                            v-bind:src="`dashboard/img/author/profile/`+user.avatar" alt="User"
                                            class="rounded-circle"></a>
                                    <div class="dropdown-wrapper">
                                        <div class="nav-author__info">
                                            <div class="author-img" v-if="user.role!='customer'">
                                                <img :src="`dashboard/img/author/profile/`+user.avatar" alt="User"
                                                    class="rounded-circle">
                                            </div>
                                            <div>
                                                <h6>{{user.name}}</h6>
                                                <span>{{user.email}}</span>
                                            </div>
                                        </div>
                                        <div class="nav-author__options">
                                            <ul>
                                                <li>
                                                    <router-link
                                                        :to="{ name: 'userProfileEdit', params: { username:user.username }}">
                                                        <i class="fad fa-user-cog"></i> Profile</router-link>
                                                </li>
                                                <li>
                                                    <router-link to="/settings">
                                                        <i class="fad fa-cog"></i> Settings</router-link>
                                                </li>
                                            </ul>
                                            <a v-on:click="signOutConfirm" class="nav-author__signout">
                                                <i data-feather="log-out"></i> Sign Out</a>
                                        </div>
                                    </div>
                                    <!-- ends: .dropdown-wrapper -->
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="d-md-none" v-show="isMobile">
                        <a @click="more" class="btn-author-action">
                            <span data-feather="more-vertical"></span>
                        </a>
                    </div>
                </div>
            </nav>
            <div class="more" v-show="(isMore && isMobile)">
                <ul class="nav-right">
                    <!-- <li>
                        <button class="btn" onclick="turnOnDarkMode()"><span>
                                <div id="sunmoon" class="fas fa-moon"></div>
                            </span></button>
                    </li>
                    <li class="nav-message" v-if="user.role!='customer'">
                        <div class="dropdown-custom">
                            <a href="/direct-message" class="nav-item-toggle">
                                <i data-feather="send"></i></a>
                        </div>
                    </li> -->
                    <li class="nav-author">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle"><img
                                    v-bind:src="`dashboard/img/author/profile/`+user.avatar" alt="User"
                                    class="rounded-circle"> {{user.name}}</a>
                            <div class="dropdown-wrapper">
                                <div class="nav-author__info">
                                    <div class="author-img" v-if="user.role!='customer'">
                                        <img :src="`dashboard/img/author/profile/`+user.avatar" alt="User"
                                            class="rounded-circle">
                                    </div>
                                    <div>
                                        <h6>{{user.name}}</h6>
                                        <span>{{user.customerName}}</span>
                                    </div>
                                </div>
                                <div class="nav-author__options">
                                    <ul>
                                        <li>
                                            <router-link
                                                :to="{ name: 'userProfileEdit', params: { username:user.username }}">
                                                <i class="fad fa-user-cog"></i> Profile</router-link>
                                        </li>
                                        <li>
                                            <router-link to="/settings">
                                                <i class="fad fa-cog"></i> Settings</router-link>
                                        </li>
                                    </ul>
                                    <a v-on:click="signOutConfirm" class="nav-author__signout">
                                        <i data-feather="log-out"></i> Sign Out</a>
                                </div>
                            </div>
                            <!-- ends: .dropdown-wrapper -->
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <main class="main-content">
            <aside class="sidebar" :class="sidebar ? `` : `collapsed overflow`">
                <div class="sidebar__menu-group">
                    <ul class="sidebar_nav">
                        <div v-if="permission.includes('ViewIssue') || permission.includes('ViewContactLists') ||
                            permission.includes('ViewNotepad') || permission.includes('ViewQuoteReport') ||
                            permission.includes('ViewTrackDelivery')">
                            <li>
                                <menuCollapse
                                    v-bind="{ isSidebar: sidebar, title: 'General Applications', icon: 'build_circle', listId:'menuCollapse1' }">
                                    <ul id="menuCollapse1" style="padding: 0;">
                                        <li v-if="permission.includes('ViewIssue')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Issue center">
                                            <router-link style="margin:0; width:100%" to="/issues">
                                                <span>Issue center</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewContactLists')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Contact lists">
                                            <router-link style="margin:0; width:100%" to="/contact-list">
                                                <span>Contact lists</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewNotepad')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Notepad">
                                            <router-link style="margin:0; width:100%" to="/notepad">
                                                <span>Notepad</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewQuoteReport')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Quote report">
                                            <router-link style="margin:0; width:100%" to="/quote">
                                                <span>Quote report</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewTrackDelivery')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Track delivery">
                                            <router-link style="margin:0; width:100%" to="/track-delivery">
                                                <span>Track delivery</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </menuCollapse>
                            </li>
                        </div>
                        <div v-if="permission.includes('ViewUsers') || permission.includes('ViewCustomers') ||
                            permission.includes('ViewSuppliers') || permission.includes('ViewSalesPerson')">
                            <li>
                                <menuCollapse
                                    v-bind="{ isSidebar: sidebar, title: 'Associate', icon: 'groups', listId:'menuCollapse2' }">
                                    <ul id='menuCollapse2' style="padding: 0;">
                                        <li v-if="permission.includes('ViewCustomers')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Customers">
                                            <router-link style="margin:0; width:100%" to="/customers">
                                                <span>Customers</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewSuppliers')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Suppliers">
                                            <router-link style="margin:0; width:100%" to="/suppliers">
                                                <span>Suppliers</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewSalesPerson')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Sales Person">
                                            <a href="#" style="margin:0; width:100%">
                                                <span>Sales Person</span>
                                                <span class="badge badge-primary menuItem">Soon</span>
                                            </a>
                                        </li>
                                        <li v-if="permission.includes('ViewUsers')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Users management">
                                            <router-link style="margin:0; width:100%" to="/users-management">
                                                <span>Users management</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </menuCollapse>
                            </li>
                        </div>
                        <div v-if="permission.includes('ViewEmployee') || permission.includes('ViewJobVacancy') ||
                            permission.includes('ViewCandidate') || permission.includes('ViewLeaveRequest') ||
                            permission.includes('ViewLoan')">
                            <li>
                                <menuCollapse
                                    v-bind="{ isSidebar: sidebar, title: 'Human Resources Management', icon: 'person', listId:'menuCollapse3' }">
                                    <ul id="menuCollapse3" style="padding: 0;">
                                        <li v-if="permission.includes('ViewEmployee')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Employee">
                                            <router-link to="/employee" style="margin:0; width:100%">
                                                <span>Employee</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewJobVacancy')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Job Vacancy">
                                            <router-link style="margin:0; width:100%" to="/career">
                                                <span>Job Vacancy</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewCandidate')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Candidate">
                                            <router-link style="margin:0; width:100%" to="/candidate">
                                                <span>Candidate</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewLeaveRequest')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Leave Request">
                                            <a href="#" style="margin:0; width:100%">
                                                <span>Leave Request</span>
                                                <span class="badge badge-primary menuItem">Soon</span>
                                            </a>
                                        </li>
                                        <li v-if="permission.includes('ViewLoan')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Loan">
                                            <a href="#" style="margin:0; width:100%">
                                                <span>Loan</span>
                                                <span class="badge badge-primary menuItem">Soon</span>
                                            </a>
                                        </li>
                                    </ul>
                                </menuCollapse>
                            </li>
                        </div>
                        <div v-if="permission.includes('ViewWarehouse') || permission.includes('ViewStockGroup') ||
                            permission.includes('ViewItemGroup')">
                            <li>
                                <menuCollapse
                                    v-bind="{ isSidebar: sidebar, title: 'Warehouse', icon: 'inventory_2', listId:'menuCollapse4' }">
                                    <ul id="menuCollapse4" style="padding: 0;">
                                        <li v-if="permission.includes('ViewWarehouse')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Warehouse">
                                            <router-link style="margin:0; width:100%" :to="'/warehouse-list'">
                                                <span>Warehouse List</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </menuCollapse>
                            </li>
                        </div>
                        <div v-if="permission.includes('ViewInventoryItem') || permission.includes('ViewStockGroup') ||
                            permission.includes('ViewItemGroup')">
                            <li>
                                <menuCollapse
                                    v-bind="{ isSidebar: sidebar, title: 'Inventory Control', icon: 'inventory_2', listId:'menuCollapse5' }">
                                    <ul id="menuCollapse5" style="padding: 0;">
                                        <li v-if="permission.includes('ViewStockGroup')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Stock Group">
                                            <router-link style="margin:0; width:100%" :to="'/stock-group'">
                                                <span>Stock Group</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewItemGroup')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Item Group">
                                            <router-link style="margin:0; width:100%" :to="'/item-group'">
                                                <span>Item Group</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewInventoryItem')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Inventory Item">
                                            <router-link style="margin:0; width:100%" to="/inventory-item">
                                                <span>Inventory Item</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </menuCollapse>
                            </li>
                        </div>
                        <div v-if="permission.includes('ViewPurchaseOrder') || permission.includes('ViewPurchaseInvoice') ||
                            permission.includes('ViewPurchaseReturn') || permission.includes('ViewPurchaseRequest') ||
                            permission.includes('ViewDocumentsReceipt')">
                            <li>
                                <menuCollapse
                                    v-bind="{ isSidebar: sidebar, title: 'Receiving & Putaway', icon: 'list_alt', listId:'menuCollapse6' }">
                                    <ul id="menuCollapse6" style="padding: 0">
                                        <li v-if="permission.includes('ViewPurchaseOrder')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Purchase Order">
                                            <router-link style="margin:0; width:100%" to="/purchase/order">
                                                <span>Purchase Order</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewPurchaseInvoice')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Purchase Invoice">
                                            <router-link style="margin:0; width:100%" to="/purchase/invoices">
                                                <span>Purchase Invoice</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewPurchaseReturn')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Purchase Return">
                                            <router-link style="margin:0; width:100%" to="/purchase/return">
                                                <span>Purchase Return</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewPurchaseRequest')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Purchase Request">
                                            <router-link style="margin:0; width:100%" to="/purchase/request">
                                                <span>Purchase Request</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewDocumentsReceipt')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Goods receipt">
                                            <router-link style="margin:0; width:100%" to="/goods-receipt">
                                                <span>Documents Receipt</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </menuCollapse>
                            </li>
                        </div>
                        <div v-if="permission.includes('ViewSalesOrder') || permission.includes('ViewSalesInvoice') ||
                            permission.includes('ViewSalesReturn') || permission.includes('ViewDeliveryReceipt') ||
                            permission.includes('ViewDocumetsDelivery')">
                            <li>
                                <menuCollapse
                                    v-bind="{ isSidebar: sidebar, title: 'Dispatching', icon: 'request_page', listId:'menuCollapse7' }">
                                    <ul id="menuCollapse7" style="padding: 0;">
                                        <li v-if="permission.includes('ViewSalesOrder')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Sales Order">
                                            <router-link style="margin:0; width:100%" to="/sales/order">
                                                <span>Sales Order</span>

                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewSalesInvoice')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Sales Invoice">
                                            <router-link style="margin:0; width:100%" to="/sales/invoices">
                                                <span>Sales Invoice</span>

                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewSalesReturn')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Sales Return">
                                            <router-link style="margin:0; width:100%" to="/sales/return">
                                                <span>Sales Return</span>
                                                <span class="badge badge-primary menuItem">Soon</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewDeliveryReceipt')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Delivery Receipt">
                                            <router-link style="margin:0; width:100%" to="/delivery/receipt">
                                                <span>Delivery Receipt</span>

                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewDocumetsDelivery')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Goods receipt">
                                            <router-link style="margin:0; width:100%" to="/document/delivery">
                                                <span>Documents Delivery</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </menuCollapse>
                            </li>
                        </div>
                        <div>
                            <label>
                                <menuCollapse v-bind=" { isSidebar: sidebar, title: 'Report Card' , icon: 'receipt_long' ,
                            listId:'menuCollapse15' }">
                                    <ul id="menuCollapse15" style="padding: 0;">
                                        <!-- <li data-bs-toggle="tooltip" data-bs-placement="right" title="Stock Report">
                                            <router-link style="margin:0; width:100%" :to="'/report/stock'">
                                                <span>Stock Report</span>
                                            </router-link>
                                        </li> -->
                                        <li data-bs-toggle="tooltip" data-bs-placement="right" title="Warehouse Report">
                                            <router-link style="margin:0; width:100%" :to="'/report/warehouse'">
                                                <span>Warehouse Report</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </menuCollapse>
                            </label>
                        </div>
                        <div v-if="permission.includes('ViewSalesOrder')">
                            <li>
                                <menuCollapse v-bind=" { isSidebar: sidebar, title: 'E-Commerce' , icon: 'storefront' ,
                            listId:'menuCollapse14' }">
                                    <ul id="menuCollapse14" style="padding: 0;">
                                        <li v-if="permission.includes('ViewSalesOrder')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Sales Order">
                                            <router-link style="margin:0; width:100%" to="/e-commerce/sales/order">
                                                <span>Sales Order</span>

                                            </router-link>
                                        </li>
                                    </ul>
                                </menuCollapse>
                            </li>
                        </div>
                        <div v-if="permission.includes('ViewPermissionRole') || permission.includes('ViewGallery') ||
                            permission.includes('ViewBlog') || permission.includes('ViewPopupWindow')">
                            <li>
                                <menuCollapse v-bind="{ isSidebar: sidebar, title: 'Permissions & Role', icon: 'manage_accounts',
                                    listId:'menuCollapse13' }">
                                    <ul id="menuCollapse13" style="padding: 0;">
                                        <li v-if="permission.includes('ViewPermissionRole')" data-bs-toggle=" tooltip"
                                            data-bs-placement="right" title="Warehouse">
                                            <router-link style="margin:0; width:100%" :to="'/permission-role'">
                                                <span>Permissions & Role</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </menuCollapse>
                            </li>
                            <li>
                                <menuCollapse
                                    v-bind="{ listId:'menuCollapse8', isSidebar: sidebar, title: 'Main Web Config', icon: 'language' }">
                                    <ul id="menuCollapse8" style="padding: 0;">
                                        <li v-if="permission.includes('ViewGallery')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Gallery">
                                            <router-link style="margin:0; width:100%" to="/gallery">
                                                <span>Gallery</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewBlog')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Blog">
                                            <router-link style="margin:0; width:100%" to="/blog-management">
                                                <span>Blog</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewPopupWindow')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Popup Window">
                                            <router-link style="margin:0; width:100%" to="/popup-management">
                                                <span>Popup Window</span>
                                            </router-link>
                                        </li>
                                        <li v-if="permission.includes('ViewSubscriptions')" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Subscriptions">
                                            <router-link style="margin:0; width:100%" to="/subscriptions">
                                                <span>Subscriptions</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </menuCollapse>
                            </li>
                        </div>
                        <li>
                            <menuCollapse
                                v-bind="{ isSidebar: sidebar, title: 'Privacy & Others', icon: 'settings',listId:'menuCollapse9' }">
                                <ul id="menuCollapse9" style="padding: 0;">
                                    <li data-bs-toggle="tooltip" data-bs-placement="right" title="Trace logs">
                                        <a :href="'/api/logs'" v-show="user.role=='admin'" style="margin:0; width:100%">
                                            <span>Trace logs</span>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="right" title="User Guide">
                                        <router-link style="margin:0; width:100%" to="/user-logs">
                                            <span>Activity Log</span>
                                        </router-link>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="right" title="Sign out">
                                        <a style="margin:0; width:100%" v-on:click="signOutConfirm" class="text-danger">
                                            <span>Sign out</span>
                                        </a>
                                    </li>
                                </ul>
                            </menuCollapse>
                        </li>
                    </ul>
                </div>
            </aside>
            <div class="contents" :class="sidebar ? `` : `expanded`">
                <div class="container-fluid">
                    <router-view />
                    <!-- set progressbar -->
                    <vue-progress-bar></vue-progress-bar>
                </div>
            </div>
            <footer class="footer-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="footer-copyright">
                                <p>&copy; Copyright -<a href="/"
                                        target="_blank"><abbr>{{company.company_name}}</abbr></a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-menu text-right">
                                <ul>
                                    <li>
                                        <a href="https://help.boxity.id/platform/releases#v109" target="_blank">
                                            Web Platform | Beta
                                            version 1.0.9</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- ends: .Footer Menu -->
                        </div>
                    </div>
                </div>
            </footer>
        </main>
        <div id="overlayer">
            <span class="loader-overlay">
                <div class="atbd-spin-dots spin-lg">
                    <span class="spin-dot badge-dot dot-primary"></span>
                    <span class="spin-dot badge-dot dot-primary"></span>
                    <span class="spin-dot badge-dot dot-primary"></span>
                    <span class="spin-dot badge-dot dot-primary"></span>
                </div>
            </span>
        </div>
        <div class="overlay-dark-sidebar"></div>
        <div class="customizer-overlay"></div>
    </div>
</template>
<script>
    import feather from 'feather-icons';
    import Swal from 'sweetalert2';
    export default {
        components: {
            menuCollapse: () => import("./item/menuCollapse.vue")
        },
        data() {
            return {
                publicPath: process.env.BASE_URL,
                user: {},
                version: {},
                company: {},
                sidebar: true,
                isMore: false,
                isMobile: false,
                permission: []
            }
        },
        mounted() {
            feather.replace();
            this.companyGet();
            this.$Progress.finish();
        },
        beforeMount() {
            this.userGet();
        },
        created() {
            window.addEventListener('resize', this.handleResize);
            this.handleResize();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize);
        },
        methods: {
            more() {
                this.isMore = !this.isMore
            },
            handleResize() {
                var w = window.innerWidth;
                this.isMobile = w > 768 ? false : true;
            },
            sidebarToggle() {
                this.sidebar = !this.sidebar;
            },
            async companyGet() {
                const resp = await axios.get('/api/company-details/1');
                this.company = resp.data;
            },
            async userGet() {
                const resp = await axios.get('/getUserLoggedIn');
                this.user = resp.data;
                this.permission = resp.data.permission;
                this.$store.dispatch("SET_PERMISSIONS", resp.data.permission)
            },
            signOutConfirm() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Do you want to sign out?',
                    showCancelButton: true,
                    confirmButtonText: `Sure!`,
                    denyButtonText: `Cancel`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = '/sign-out';
                    }
                })
            }
        },
    }

</script>

<style scoped>
    .overflow {
        overflow-y: unset;
    }

    header,
    nav {
        height: 74px;
    }

    .sidebar {
        /* scroll for Firefox */
        scrollbar-width: thin;
    }

    /* width */
    .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    .sidebar::-webkit-scrollbar-track {
        background: #eee;
    }

    /* Handle */
    .sidebar::-webkit-scrollbar-thumb {
        background: #ccc;
    }

    /* Handle on hover */
    .sidebar::-webkit-scrollbar-thumb:hover {
        background: #b3b3b3;
    }

    .sidebar.collapsed .sidebar__menu-group li a {
        border-radius: 0%;
    }

    .nav-right .nav-author .dropdown-wrapper {
        min-width: 300px;
    }

    .nav-right .nav-author img {
        width: 34px;
        height: 34px;
    }

    .nav-right .nav-author__info {
        background: #f4f5f7;
        border-radius: 8px;
        margin: 10px;
        display: flex;
        align-items: center;
        padding: 20px 25px;
    }

    .nav-right .nav-author__info .author-img {
        margin-right: 15px;
    }

    .nav-right .nav-author__info .author-img img {
        max-width: 40px;
    }

    .nav-right .nav-author__info h6 {
        font-weight: 500;
        font-size: 14px;
    }

    .contents.expanded {
        transition: all 0.3s ease !important;
    }

    .nav-right {
        list-style: none;
        display: flex;
        align-items: center;
        margin: 0 -12px;
    }

    .nav-right>li {
        padding: 0 12px;
    }

    .nav-right .nav-item-toggle {
        position: relative;
        color: #9299b8;
    }

    .nav-right .nav-author__options ul {
        list-style: none;
        margin: 0;
        padding: 0 0 15px;
    }

    .nav-right .nav-author__options ul li {
        padding: 0;
    }

    .nav-right .nav-author__options ul li a:hover {
        background: rgba(95, 99, 242, 0.05);
        padding-left: 35px;
        color: #fa831c;
    }

    .nav-right .nav-author__options ul li a {
        font-size: 14px;
        display: block;
        padding: 9px 25px 9px;
        color: #9299b8;
        transition: all 0.3s ease;
    }

    .nav-right .nav-author__signout {
        font-size: 13px;
        background: #f8f9fb;
        padding: 18px 15px;
        color: #868eae;
        display: block;
        text-align: center;
        font-weight: 500;
    }

    .nav-right .nav-author__signout svg {
        width: 15px;
    }

    .more {
        width: 100%;
        height: 3em;
        border-top: 1px solid #efefef;
        border-bottom: 1px solid #efefef;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .more .nav-right .nav-author .dropdown-wrapper {
        top: 48px;
        right: -50%;
        min-width: 300px;
    }

</style>
