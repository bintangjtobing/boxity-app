<template>
    <div id="app">
        <div class="mobile-search"></div>
        <div class="mobile-author-actions"></div>
        <header class="header-top">
            <nav class="navbar navbar-light">
                <div class="navbar-left">
                    <a @click="sidebarToggle" class="sidebar-toggle">
                        <img class="svg" src="https://btsa.co.id/dashboard/img/svg/bars.svg" alt="img"></a>
                    <a class="navbar-brand" href="/tools">
                        <img class="svg dark" :src="company.logoblack" alt="company-logo">
                        <img class="light" :src="company.logo" alt="company-logo">
                    </a>
                    <div>
                        <span>{{user.customerCity}}</span>
                        <h4>{{user.customerName}}</h4>
                    </div>
                </div>
                <div class="navbar-right">
                    <div v-show="!isMobile">
                        <ul class="nav-right" >
                            <li>
                                <button class="btn" onclick="turnOnDarkMode()"><span>
                                        <div id="sunmoon" class="fas fa-moon"></div>
                                    </span></button>
                            </li>
                            <li class="nav-message" v-if="user.role!='customer'">
                                <div class="dropdown-custom">
                                    <a href="/direct-message" class="nav-item-toggle">
                                        <i data-feather="send"></i></a>
                                </div>
                            </li>
                            <li class="nav-author">
                                <div class="dropdown-custom">
                                    <a href="javascript:;" class="nav-item-toggle"><img
                                            v-bind:src="`https://btsa.co.id/dashboard/img/author/profile/`+user.avatar"
                                            alt="User" class="rounded-circle"> {{user.name}}</a>
                                    <div class="dropdown-wrapper">
                                        <div class="nav-author__info">
                                            <div class="author-img" v-if="user.role!='customer'">
                                                <img :src="`https://btsa.co.id/dashboard/img/author/profile/`+user.avatar"
                                                    alt="User" class="rounded-circle">
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
                                                        <i data-feather="user"></i> Profile</router-link>
                                                </li>
                                                <li>
                                                    <router-link to="/settings">
                                                        <i data-feather="settings"></i> Settings</router-link>
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
                <ul class="nav-right" >
                    <li>
                        <button class="btn" onclick="turnOnDarkMode()"><span>
                                <div id="sunmoon" class="fas fa-moon"></div>
                            </span></button>
                    </li>
                    <li class="nav-message" v-if="user.role!='customer'">
                        <div class="dropdown-custom">
                            <a href="/direct-message" class="nav-item-toggle">
                                <i data-feather="send"></i></a>
                        </div>
                    </li>
                    <li class="nav-author">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle"><img
                                    v-bind:src="`https://btsa.co.id/dashboard/img/author/profile/`+user.avatar"
                                    alt="User" class="rounded-circle"> {{user.name}}</a>
                            <div class="dropdown-wrapper">
                                <div class="nav-author__info">
                                    <div class="author-img" v-if="user.role!='customer'">
                                        <img :src="`https://btsa.co.id/dashboard/img/author/profile/`+user.avatar"
                                            alt="User" class="rounded-circle">
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
                                                <i data-feather="user"></i> Profile</router-link>
                                        </li>
                                        <li>
                                            <router-link to="/settings">
                                                <i data-feather="settings"></i> Settings</router-link>
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
            <aside class="sidebar" :class="sidebar ? `` : `collapsed`">
                <div class="sidebar__menu-group">
                    <ul class="sidebar_nav">
                        <div v-if="user.role!='customer'">
                            <li class="menu-title m-top-15">
                                <span>General Applications</span>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Version control" v-if="user.divisi == 'developer'">
                                <router-link to="/version-control">
                                    <span class="material-icons-outlined nav-icon">
                                        build_circle
                                    </span>
                                    <span class="menu-text">Version control</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Issue center">
                                <router-link to="/issues">
                                    <span class="material-icons-outlined nav-icon">
                                        contact_support
                                    </span>
                                    <span class="menu-text">Issue center</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Contact lists">
                                <router-link to="/contact-list">
                                    <span class="material-icons-outlined nav-icon">
                                        contact_page
                                    </span>
                                    <span class="menu-text">Contact lists</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Notepad">
                                <router-link to="/notepad">
                                    <span class="material-icons-outlined nav-icon">
                                        sticky_note_2
                                    </span>
                                    <span class="menu-text">Notepad</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Goods receipt">
                                <router-link to="/goods-receipt">
                                    <span class="material-icons-outlined nav-icon">
                                        feed
                                    </span>
                                    <span class="menu-text">Goods receipt</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Quote report">
                                <router-link to="/quote">
                                    <span class="material-icons-outlined nav-icon">
                                        book
                                    </span>
                                    <span class="menu-text">Quote report</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Track delivery">
                                <router-link to="/track-delivery">
                                    <span class="material-icons-outlined nav-icon">
                                        where_to_vote
                                    </span>
                                    <span class="menu-text">Track delivery</span>
                                </router-link>
                            </li>
                        </div>
                        <div v-if="user.role=='customer' || user.role=='admin'">
                            <li  class="menu-title m-top-15">
                                <span>Associate</span>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Customers" v-if="user.role=='admin'">
                                <router-link to="/customers">
                                    <span class="material-icons-outlined nav-icon">
                                        groups
                                    </span>
                                    <span class="menu-text">Customers</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Suppliers">
                                <router-link to="/suppliers">
                                    <span class="material-icons-outlined nav-icon">
                                        groups
                                    </span>
                                    <span class="menu-text">Suppliers</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Sales Person">
                                <a href="#">
                                    <span class="material-icons-outlined nav-icon">
                                        groups
                                    </span>
                                    <span class="menu-text">Sales Person</span>
                                    <span class="badge badge-primary menuItem">Soon</span>
                                </a>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Users management" v-if="user.role=='admin'">
                                <router-link to="/users-management">
                                    <span class="material-icons-outlined nav-icon">
                                        manage_accounts
                                    </span>
                                    <span class="menu-text">Users management</span>
                                </router-link>
                            </li>
                        </div>
                        <div v-if="user.role=='admin' || user.role=='hrdga'">
                            <li class="menu-title m-top-15">
                                <span>Human Resources Management</span>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Employee">
                                <a href="#">
                                    <span class="material-icons-outlined nav-icon">
                                        groups
                                    </span>
                                    <span class="menu-text">Employee</span>
                                    <span class="badge badge-primary menuItem">Soon</span>
                                </a>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Job Vacancy">
                                <router-link to="/career">
                                    <span class="material-icons-outlined nav-icon">
                                        work_outline
                                    </span>
                                    <span class="menu-text">Job Vacancy</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Candidate">
                                <router-link to="/candidate">
                                    <span class="material-icons-outlined nav-icon">
                                        travel_explore
                                    </span>
                                    <span class="menu-text">Candidate</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Leave Request">
                                <a href="#">
                                    <span class="material-icons-outlined nav-icon">
                                        local_cafe
                                    </span>
                                    <span class="menu-text">Leave Request</span>
                                    <span class="badge badge-primary menuItem">Soon</span>
                                </a>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Loan">
                                <a href="#">
                                    <span class="material-icons-outlined nav-icon">
                                        credit_score
                                    </span>
                                    <span class="menu-text">Loan</span>
                                    <span class="badge badge-primary menuItem">Soon</span>
                                </a>
                            </li>
                        </div>
                        <div v-if="user.role=='customer' || user.role=='admin'">
                            <li class="menu-title m-top-15">
                                <span>Warehouse</span>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Warehouse List">
                                <router-link :to="'/warehouse-list'">
                                    <span class="material-icons-outlined nav-icon">
                                        home_work
                                    </span>
                                    <span class="menu-text">Warehouse List</span>
                                    <span class="badge badge-secondary text-white menuItem">NEW</span>
                                </router-link>
                            </li>
                            <li  class="menu-title m-top-15">
                                <span>Inventory Control</span>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Stock Group">
                                <router-link :to="'/stock-group'">
                                    <span class="material-icons-outlined nav-icon">
                                        inventory_2
                                    </span>
                                    <span class="menu-text">
                                        Stock Group
                                    </span>
                                    <span class="badge badge-secondary text-white menuItem">NEW</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Item Group">
                                <router-link :to="'/item-group'">
                                    <span class="material-icons-outlined nav-icon">
                                        inventory_2
                                    </span>
                                    <span class="menu-text">Item Group</span>
                                    <span class="badge badge-secondary text-white menuItem">NEW</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Inventory Item">
                                <router-link to="/inventory-item">
                                    <span class="material-icons-outlined nav-icon">
                                        category
                                    </span>
                                    <span class="menu-text">Inventory Item</span>
                                    <span class="badge badge-secondary text-white menuItem">NEW</span>
                                </router-link>
                            </li>
                            <li class="menu-title m-top-15">
                                <span>Receiving & Putaway</span>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Purchase Order">
                                <router-link to="/purchase/order">
                                    <span class="material-icons-outlined nav-icon">
                                        list_alt
                                    </span>
                                    <span class="menu-text">Purchase Order</span>
                                    <span class="badge badge-secondary menuItem">NEW</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Purchase Invoice">
                                <router-link to="/purchase/invoices">
                                    <span class="material-icons-outlined nav-icon">
                                        receipt
                                    </span>
                                    <span class="menu-text">Purchase Invoice</span>
                                    <span class="badge badge-secondary text-white menuItem">NEW</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Purchase Return">
                                <router-link to="/purchase/return">
                                    <span class="material-icons-outlined nav-icon">
                                        assignment_return
                                    </span>
                                    <span class="menu-text">Purchase Return</span>
                                    <span class="badge badge-secondary text-white menuItem">NEW</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Purchase Request">
                                <router-link to="/purchase/request">
                                    <span class="material-icons-outlined nav-icon">
                                        request_page
                                    </span>
                                    <span class="menu-text">Purchase Request</span>
                                    <span class="badge badge-secondary text-white menuItem">NEW</span>
                                </router-link>
                            </li>
                            <li class="menu-title m-top-15">
                                <span>Dispatching</span>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Sales Order">
                                <router-link to="/sales/order">
                                    <span class="material-icons-outlined nav-icon">
                                        list_alt
                                    </span>
                                    <span class="menu-text">Sales Order</span>
                                    <span class="badge badge-primary menuItem">Soon</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Sales Invoice">
                                <router-link to="/sales/invoices">
                                    <span class="material-icons-outlined nav-icon">
                                        receipt
                                    </span>
                                    <span class="menu-text">Sales Invoice</span>
                                    <span class="badge badge-primary menuItem">Soon</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Sales Return">
                                <router-link to="/sales/return">
                                    <span class="material-icons-outlined nav-icon">
                                        assignment_return
                                    </span>
                                    <span class="menu-text">Sales Return</span>
                                    <span class="badge badge-primary menuItem">Soon</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Delivery Receipt">
                                <router-link to="/delivery/receipt">
                                    <span class="material-icons-outlined nav-icon">
                                        request_page
                                    </span>
                                    <span class="menu-text">Delivery Receipt</span>
                                    <span class="badge badge-primary menuItem">Soon</span>
                                </router-link>
                            </li>
                        </div>
                        <div v-if="user.role=='it' || user.role=='admin'">
                            <li class="menu-title m-top-15">
                                <span>Main Web Config</span>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Gallery">
                                <router-link to="/gallery">
                                    <span class="material-icons-outlined nav-icon">
                                        photo_library
                                    </span>
                                    <span class="menu-text">Gallery</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Blog">
                                <router-link to="/blog-management">
                                    <span class="material-icons-outlined nav-icon">
                                        article
                                    </span>
                                    <span class="menu-text">Blog</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Popup Window">
                                <router-link to="/popup-management">
                                    <span class="material-icons-outlined nav-icon">
                                        preview
                                    </span>
                                    <span class="menu-text">Popup Window</span>
                                </router-link>
                            </li>
                            <li  data-bs-toggle="tooltip" data-bs-placement="right" title="User Guide">
                                <router-link to="/user-guide">
                                    <span class="material-icons-outlined nav-icon">
                                        help
                                    </span>
                                    <span class="menu-text">User Guide</span>
                                </router-link>
                            </li>
                        </div>
                        <li class="menu-title m-top-15">
                            <span>Privacy & Others</span>
                        </li>
                        <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Trace logs">
                            <a :href="'/api/logs'" v-if="user.role=='admin'">
                                <span class="material-icons-outlined nav-icon">
                                    bug_report
                                </span>
                                <span class="menu-text">Trace logs</span>
                            </a>
                            <router-link to="/user-logs">
                                <span class="material-icons-outlined nav-icon">
                                    report
                                </span>
                                <span class="menu-text">Activity Log</span>
                            </router-link>
                        </li>
                        <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Sign out">
                            <a v-on:click="signOutConfirm" class="text-danger">
                                <span class="material-icons-outlined nav-icon">
                                    logout
                                </span>
                                <span class="menu-text">Sign out</span>
                            </a>
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
                                <p>&copy; Copyright -<a href="/" target="_blank"><abbr
                                            title="PT BERLIAN TRANSTAR ABADI">{{company.company_name}}</abbr></a> |
                                    Partner with <abbr title="PT BENUA SOLUSI TEKNOLOGI"><a
                                            href="https://infinitysolutions.co.id" target="_blank">Infinity
                                            Solutions</a></abbr>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-menu text-right">
                                <ul>
                                    <li>
                                        <router-link :to="{ name: 'versionView', params: { version:version.version }}">
                                            App
                                            version {{version.version}}</router-link>
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
        data() {
            return {
                publicPath: process.env.BASE_URL,
                user: {},
                version: {},
                company: {},
                countIssues: '0',
                countGoods: '0',
                sidebar: true,
                isMore: false,
                isMobile: false
            }
        },
        mounted() {
            feather.replace();
            this.userGet();
            this.versionGet();
            this.companyGet();
            this.$Progress.finish();
        },
        created() {
            window.addEventListener('resize', this.handleResize);
            this.handleResize();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize);
        },
        methods: {
            more () { 
                this.isMore = !this.isMore 
            },
            handleResize () {
                var w = window.innerWidth;
                this.isMobile = w > 768 ? false : true;
            },
            sidebarToggle() {
                this.sidebar = !this.sidebar;
            },
            async companyGet() {
                const resp = await axios.get('/api/company-details');
                this.company = resp.data[0];
            },
            async userGet() {
                const resp = await axios.get('/getUserLoggedIn');
                this.user = resp.data;
            },
            async versionGet() {
                const resp = await axios.get('/api/version-control');
                this.version = resp.data[0];
                const count = await axios.get('/api/count-goods');
                this.countGoods = count.data;
                const issues = await axios.get('/api/count-issue');
                this.countIssues = issues.data;
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
    header, nav {
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