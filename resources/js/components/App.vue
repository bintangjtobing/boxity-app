<template>
    <div id="app">
        <div class="mobile-search"></div>
        <div class="mobile-author-actions"></div>
        <header class="header-top">
            <nav class="navbar navbar-light">
                <div class="navbar-left">
                    <a href="" class="sidebar-toggle">
                        <img class="svg" :src="'./dashboard/img/svg/bars.svg'" alt="img"></a>
                    <a class="navbar-brand" href="/tools"><img class="svg dark" :src="'./dashboard/img/logo_Dark.png'"
                            alt="logo BTSA Logistics"><img class="light" :src="'./dashboard/img/Logo_white.png'"
                            alt="logo BTSA Logistics"></a>
                </div>
                <!-- ends: navbar-left -->
                <div class="navbar-right">
                    <ul class="navbar-right__menu">
                        <li>
                            <button class="btn" onclick="turnOnDarkMode()"><span>
                                    <div id="sunmoon" class="fas fa-moon"></div>
                                </span></button>
                        </li>
                        <li class="nav-message">
                            <div class="dropdown-custom">
                                <a href="/direct-message" class="nav-item-toggle">
                                    <i data-feather="send"></i></a>
                            </div>
                        </li>
                        <li class="nav-author">
                            <div class="dropdown-custom">
                                <a href="javascript:;" class="nav-item-toggle"><img
                                        :src="'./dashboard/img/author/profile/1.jpg'" alt="User avatar"
                                        class="rounded-circle"> Bintang</a>
                                <div class="dropdown-wrapper">
                                    <div class="nav-author__info">
                                        <div class="author-img">
                                            <img :src="'./dashboard/img/author/profile/1.jpg'" alt="User avatar"
                                                class="rounded-circle">
                                        </div>
                                        <div>
                                            <h6>Bintang</h6>
                                            <span>Developer</span>
                                        </div>
                                    </div>
                                    <div class="nav-author__options">
                                        <ul>
                                            <li>
                                                <router-link to="/u/bintangjtobing/edit">
                                                    <i data-feather="user"></i> Profile</router-link>
                                            </li>
                                            <li>
                                                <router-link to="/settings">
                                                    <i data-feather="settings"></i> Settings</router-link>
                                            </li>
                                        </ul>
                                        <router-link to="/sign-out" class="nav-author__signout">
                                            <i data-feather="log-out"></i> Sign Out</router-link>
                                    </div>
                                </div>
                                <!-- ends: .dropdown-wrapper -->
                            </div>
                        </li>
                    </ul>
                    <div class="navbar-right__mobileAction d-md-none">
                        <a href="#" class="btn-author-action">
                            <span data-feather="more-vertical"></span></a>
                    </div>
                </div>
            </nav>
        </header>
        <main class="main-content">
            <aside class="sidebar">
                <div class="sidebar__menu-group">
                    <ul class="sidebar_nav">
                        <li>
                            <router-link to="/tools">
                                <i data-feather="home" class="nav-icon"></i>
                                <span class="menu-text">Dashboard</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/version-control">
                                <i data-feather="activity" class="nav-icon"></i>
                                <span class="menu-text">Version control</span>
                            </router-link>
                        </li>
                        <li class="menu-title m-top-30">
                            <span>General Applications</span>
                        </li>
                        <li>
                            <router-link to="/issues">
                                <i data-feather="headphones" class="nav-icon"></i>
                                <span class="menu-text">Issue center</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/contact-list">
                                <i data-feather="list" class="nav-icon"></i>
                                <span class="menu-text">Contact lists</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/notepad">
                                <i data-feather="file-text" class="nav-icon"></i>
                                <span class="menu-text">Notepad</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/users-management">
                                <i data-feather="users" class="nav-icon"></i>
                                <span class="menu-text">Users management</span>
                            </router-link>
                        </li>
                        <li class="has-child">
                            <router-link to="#" class="">
                                <i data-feather="rss" class="nav-icon"></i>
                                <span class="menu-text">Human resources</span>
                                <span class="toggle-icon"></span>
                            </router-link>
                            <ul>
                                <li>
                                    <router-link to="/career">Career</router-link>
                                </li>
                                <li>
                                    <router-link to="/candidate">Candidate</router-link>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <router-link to="/goods-receipt">
                                <i data-feather="shopping-bag" class="nav-icon"></i>
                                <span class="menu-text">Goods receipt</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/quote">
                                <i data-feather="star" class="nav-icon"></i>
                                <span class="menu-text">Quote report</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/track-delivery">
                                <i data-feather="map" class="nav-icon"></i>
                                <span class="menu-text">Track delivery</span>
                            </router-link>
                        </li>
                        <li class="menu-title m-top-30">
                            <span>Main Web Config</span>
                        </li>
                        <li>
                            <router-link to="/gallery">
                                <i data-feather="image" class="nav-icon"></i>
                                <span class="menu-text">Gallery</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/blog-management">
                                <i data-feather="package" class="nav-icon"></i>
                                <span class="menu-text">Blog</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/user-guide">
                                <i data-feather="book-open" class="nav-icon"></i>
                                <span class="menu-text">User Guide</span>
                            </router-link>
                        </li>
                        <li>
                            <a href="/sign-out" class="text-danger">
                                <i data-feather="log-out" class="nav-icon text-danger"></i>
                                <span class="menu-text">Sign out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
            <div class="contents">
                <div class="container-fluid">
                    <router-view />
                </div>
            </div>
            <footer class="footer-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="footer-copyright">
                                <p>&copy; Copyright -<a href="/" target="_blank"><abbr
                                            title="PT BERLIAN TRANSTAR ABADI">BTSA
                                            LOGISTICS</abbr></a> | All
                                    reserved
                                    by<a href="#">Boxity App</a> | Partner with <abbr
                                        title="PT BENUA SOLUSI TEKNOLOGI"><a href="https://infinitysolutions.co.id"
                                            target="_blank">Infinity
                                            Solutions</a></abbr>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-menu text-right">
                                <ul>
                                    <li>
                                        <a href="/v/1.0.2">App version 1.0.2</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- ends: .Footer Menu -->
                        </div>
                    </div>
                </div>
            </footer>
        </main>
    </div>
</template>
<script>
    import feather from 'feather-icons'
    export default {
        mounted() {
            feather.replace();
        }
    }

</script>
