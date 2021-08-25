<template>
    <div>
        <div class="row mt-4">
            <div class="cos-lg-12 col-md-12">
                <aside class="profile-sider">
                    <!-- Profile Acoount -->
                    <div class="card mb-25">
                        <div class="card-body text-center pt-sm-30 pb-sm-0  px-25 pb-0">
                            <div class="account-profile">
                                <div class="ap-img w-100 d-flex justify-content-center">
                                    <!-- Profile picture image-->
                                    <img class="ap-img__main rounded-circle mb-3  wh-120 d-flex bg-opacity-primary"
                                        :src="`/dashboard/img/author/profile/`+users.avatar" alt="profile image">
                                </div>
                                <div class="ap-nameAddress pb-3 pt-1">
                                    <h5 class="ap-nameAddress__title">{{users.name}}</h5>
                                    <p class="ap-nameAddress__subTitle fs-14 m-0">{{users.divisi}}</p>
                                </div>
                                <div class="ap-button button-group mb-3 d-flex justify-content-center flex-wrap">
                                    <button type="button"
                                        class="border text-capitalize px-25 color-gray transparent shadow2 radius-md">
                                        <i class="far fa-paper-plane"></i>&nbsp;direct chat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Profile Acoount End -->

                    <!-- Profile User Bio -->
                    <div class="card mb-25">
                        <div class="user-bio border-bottom">
                            <div class="card-header border-bottom-0 pt-sm-30 pb-sm-0  px-md-25 px-3">
                                <div class="profile-header-title">
                                    User Bio
                                </div>
                            </div>
                            <div class="card-body pt-md-1 pt-0">
                                <div class="user-bio__content">
                                    <p class="m-0">{{users.bio}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="user-info border-bottom">
                            <div class="card-header border-bottom-0 pt-sm-25 pb-sm-0  px-md-25 px-3">
                                <div class="profile-header-title">
                                    Contact info
                                </div>
                            </div>
                            <div class="card-body pt-md-1 pt-0">
                                <div class="user-content-info">
                                    <p class="user-content-info__item">
                                        <i class="far fa-envelope"></i>&nbsp;{{users.email}}
                                    </p>
                                    <p class="user-content-info__item">
                                        <i class="fal fa-phone-alt"></i>&nbsp;+62{{users.phone}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="db-social border-bottom">
                            <div class="card-header border-bottom-0 pt-sm-25 pb-sm-0  px-md-25 px-3">
                                <div class="profile-header-title">
                                    Social Profiles
                                </div>
                            </div>
                            <div class="card-body pt-md-1 pt-0">
                                <ul class="db-social-parent mb-0">
                                    <li class="db-social-parent__item">
                                        <a class="color-facebook hover-facebook wh-44 fs-22" :href="users.facebook">
                                            <i class="lab la-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="db-social-parent__item">
                                        <a class="color-instagram hover-instagram wh-44 fs-22" :href="users.instagram">
                                            <i class="lab la-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                title: {
                    name: 'Profile',
                },
                users: {},
            }
        },
        title() {
            return '' + this.title.name;
        },
        created() {
            this.loadDataUser();
        },
        methods: {
            async loadDataUser() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/u/' + this.$route.params.username);
                this.title.name = resp.data.name;
                this.users = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            }
        },
    }

</script>
