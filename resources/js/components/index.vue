<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div>
                    <span>{{moment().format('LLLL')}}</span>
                    <h2><b>Hi {{user.name}}, </b>Welcome Back &#129303;</h2>
                </div>
            </div>
        </div>

        <div class="row" v-if="user.role!='customer'">
            <div class="col-xxl-3 col-lg-6 col-md-12 mb-25">
                <div class="feature-cards5 d-flex justify-content-between border-0 radius-xl bg-white p-25">
                    <div class="application-task d-flex align-items-center">
                        <div class="application-task-icon wh-60 bg-primary content-center">
                            <img class="svg" src="dashboard/img/svg/feature-cards9.svg" alt="">
                        </div>
                        <div class="application-task-content">
                            <h4>{{solvedIssue}}</h4>
                            <span class="text-light fs-14 mt-1 text-capitalize">total issue resolved </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-6 col-md-12 mb-25">
                <div class="feature-cards5 d-flex justify-content-between border-0 radius-xl bg-white p-25">
                    <div class="application-task d-flex align-items-center">
                        <div class="application-task-icon wh-60 bg-secondary content-center">
                            <img class="svg" src="dashboard/img/svg/feature-cards10.svg" alt="">
                        </div>
                        <div class="application-task-content">
                            <h4>{{pendingIssue}}</h4>
                            <span class="text-light fs-14 mt-1 text-capitalize">total issue pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div>
                    <h2>Now, What would you do? &#129300;</h2>
                </div>
            </div>

            <!-- Role not Customer -->
            <div class="col-xxl-3 col-lg-4 col-md-6 mb-25" v-if="user.role!='customer'">
                <figure class="feature-cards6">
                    <div class="card-short">
                        <h4 class="card-short__title align-items-center">
                            <img src="dashboard/img/svg/lifebuoy.svg" alt="">
                            <span>Issue Center</span>
                        </h4>
                        <div class="card-short__content">
                            <p>Anything we can help? Take it easy, we will help you as much as possible.</p>
                        </div>
                        <div class="card-short__bottom installed">
                            <div class="card-short-checkbox">
                                <div class="checkbox-theme-default custom-checkbox ">
                                    <label for="check-563">
                                        <span class="checkbox-text">
                                            installed
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-short-actions">
                                <div class="content-installed content-action">
                                    <router-link :to="'/issues'" type="button" class="btn btn-secondary-outline-boxity">
                                        <span>Open</span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            </div>
            <div class="col-xxl-3 col-lg-4 col-md-6 mb-25" v-if="user.role!='customer'">
                <figure class="feature-cards6">
                    <div class="card-short">
                        <h4 class="card-short__title align-items-center">
                            <img src="dashboard/img/svg/correct.svg" alt="">
                            <span>Goods Receipt</span>
                        </h4>
                        <div class="card-short__content">
                            <p>Wanna try to check the documents or packages that the receptionist has received?</p>
                        </div>
                        <div class="card-short__bottom installed">
                            <div class="card-short-checkbox">
                                <div class="checkbox-theme-default custom-checkbox ">
                                    <label for="check-563">
                                        <span class="checkbox-text">
                                            installed
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-short-actions">
                                <div class="content-installed content-action">
                                    <router-link :to="'/goods-receipt'" type="button"
                                        class="btn btn-secondary-outline-boxity">
                                        <span>Open</span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            </div>
            <div class="col-xxl-3 col-lg-4 col-md-6 mb-25" v-if="user.role!='customer'">
                <figure class="feature-cards6">
                    <div class="card-short">
                        <h4 class="card-short__title align-items-center">
                            <img src="dashboard/img/svg/post-it.svg" alt="">
                            <span>Notepad</span>
                        </h4>
                        <div class="card-short__content">
                            <p>Don't forget important notes while you are working on
                                this tool.</p>
                        </div>
                        <div class="card-short__bottom installed">
                            <div class="card-short-checkbox">
                                <div class="checkbox-theme-default custom-checkbox ">
                                    <label for="check-563">
                                        <span class="checkbox-text">
                                            installed
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-short-actions">
                                <div class="content-installed content-action">
                                    <router-link :to="'/notepad'" type="button"
                                        class="btn btn-secondary-outline-boxity">
                                        <span>Open</span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            </div>
            <!-- Role end not customer -->

            <!-- Role Customer -->
            <div class="col-xxl-3 col-lg-4 col-md-6 mb-25" v-if="user.role=='customer'">
                <figure class="feature-cards6">
                    <div class="card-short">
                        <h4 class="card-short__title align-items-center">
                            <img src="dashboard/img/svg/lifebuoy.svg" alt="">
                            <span>Issue Center</span>
                        </h4>
                        <div class="card-short__content">
                            <p>Anything we can help? Take it easy, we will help you as much as possible.</p>
                        </div>
                        <div class="card-short__bottom installed">
                            <div class="card-short-checkbox">
                                <div class="checkbox-theme-default custom-checkbox ">
                                    <label for="check-563">
                                        <span class="checkbox-text">
                                            installed
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-short-actions">
                                <div class="content-installed content-action">
                                    <router-link :to="'/issues'" type="button" class="btn btn-outline-primary">
                                        <span>Open</span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            </div>
            <div class="col-xxl-3 col-lg-4 col-md-6 mb-25" v-if="user.role=='customer'">
                <figure class="feature-cards6">
                    <div class="card-short">
                        <h4 class="card-short__title align-items-center">
                            <img src="dashboard/img/svg/correct.svg" alt="">
                            <span>Goods Receipt</span>
                        </h4>
                        <div class="card-short__content">
                            <p>Wanna try to check the documents or packages that the receptionist has received?</p>
                        </div>
                        <div class="card-short__bottom installed">
                            <div class="card-short-checkbox">
                                <div class="checkbox-theme-default custom-checkbox ">
                                    <label for="check-563">
                                        <span class="checkbox-text">
                                            installed
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-short-actions">
                                <div class="content-installed content-action">
                                    <router-link :to="'/goods-receipt'" type="button" class="btn btn-outline-primary">
                                        <span>Open</span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            </div>
            <div class="col-xxl-3 col-lg-4 col-md-6 mb-25" v-if="user.role=='customer'">
                <figure class="feature-cards6">
                    <div class="card-short">
                        <h4 class="card-short__title align-items-center">
                            <img src="dashboard/img/svg/post-it.svg" alt="">
                            <span>Notepad</span>
                        </h4>
                        <div class="card-short__content">
                            <p>Don't forget important notes while you are working on
                                this tool.</p>
                        </div>
                        <div class="card-short__bottom installed">
                            <div class="card-short-checkbox">
                                <div class="checkbox-theme-default custom-checkbox ">
                                    <label for="check-563">
                                        <span class="checkbox-text">
                                            installed
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-short-actions">
                                <div class="content-installed content-action">
                                    <router-link :to="'/notepad'" type="button" class="btn btn-outline-primary">
                                        <span>Open</span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            </div>
            <!-- Role end customer -->
        </div>
    </div>
</template>

<script>
    var moment = require('moment');
    export default {
        title() {
            return 'Dashboard';
        },
        data() {
            return {
                user: {},
                solvedIssue: 0,
                pendingIssue: 0,
                moment: moment,
            }
        },
        mounted() {
            this.svIssue();
        },
        methods: {
            async svIssue() {
                // // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/count-solved-issue');
                this.solvedIssue = resp.data;

                // Get user logged in
                const userLogged = await axios.get('/getUserLoggedIn');
                this.user = userLogged.data;

                // Pending Issue
                const pending = await axios.get('/api/count-pending-issue');
                this.pendingIssue = pending.data;
                // // this.$Progress.finish();
                this.$isLoading(false);
            },
        },
    }

</script>
