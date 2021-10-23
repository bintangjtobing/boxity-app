<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div>
                    <!-- <span>{{moment().format("dddd, MMMM Do YYYY, h:mm:ss a")}}</span> -->
                    <span>{{currentTime}}</span>
                    <h2>Hi <b>{{user.name}}, </b>Welcome Back &#129303;</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-12 col-lg-12 col-md-12 mb-10">
                <div class="feature-cards5 d-flex justify-content-between border-0 radius-xl bg-white p-25">
                    <div class="application-task d-flex align-items-center">
                        <div class="application-task-content">
                            <h4>Getting Started</h4>
                            <span>Welcome to the family, {{user.name}}! Here are some ways you can get started with
                                under your
                                authorization:</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-3 col-lg-3 col-md-6 mb-25">
                <figure class="feature-cards4">
                    <img class="svg"
                        src="https://res.cloudinary.com/boxity-id/image/upload/v1634485447/assets/undraw/issue_e1ffd3.svg">
                    <figcaption>
                        <h2>Issue Center</h2>
                        <p>The place where you can report the bug, error or problem to our developers.</p>
                        <router-link to="/new-issue">Create issue</router-link> |
                        <router-link to="/issues">See issue</router-link>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xxl-3 col-lg-3 col-md-6 mb-25">
                <figure class="feature-cards4">
                    <img class="svg"
                        src="https://res.cloudinary.com/boxity-id/image/upload/v1634485449/assets/undraw/candidate_fdmy2m.svg">
                    <figcaption>
                        <h2>Candidate's Vacancy</h2>
                        <p>See the candidate who applied for your job vacancy.</p>
                        <router-link to="/candidate">See the candidates</router-link>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xxl-3 col-lg-3 col-md-6 mb-25">
                <figure class="feature-cards4">
                    <img class="svg"
                        src="https://res.cloudinary.com/boxity-id/image/upload/v1634485447/assets/undraw/inventory_byzxea.svg">
                    <figcaption>
                        <h2>Inventory Item</h2>
                        <p>Control & manage your inventory item that manages on your warehouses.</p>
                        <router-link to="/inventory-item">See inventory items</router-link>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xxl-3 col-lg-3 col-md-6 mb-25">
                <figure class="feature-cards4">
                    <img class="svg"
                        src="https://res.cloudinary.com/boxity-id/image/upload/v1634485447/assets/undraw/purchasing_x9hmey.svg">
                    <figcaption>
                        <h2>Purchasing</h2>
                        <p>This portal is used for where you can manage the items that purchases into your warehouses.
                        </p>
                        <router-link to="/purchase/invoices/add">Create purchase invoice</router-link>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xxl-3 col-lg-3 col-md-6 mb-25">
                <figure class="feature-cards4">
                    <img class="svg"
                        src="https://res.cloudinary.com/boxity-id/image/upload/v1634485447/assets/undraw/salesing_qrkopp.svg">
                    <figcaption>
                        <h2>Salesing</h2>
                        <p>This portal is used for where you can manage the items that sell from your warehouses.</p>
                        <router-link to="/purchase/invoices/add">Create sales invoice</router-link>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xxl-3 col-lg-3 col-md-6 mb-25">
                <figure class="feature-cards4">
                    <img class="svg"
                        src="https://res.cloudinary.com/boxity-id/image/upload/v1634490234/assets/undraw/goods_receipt_wvutv2.svg">
                    <figcaption>
                        <h2>Goods Receipt</h2>
                        <p>This portal is used for when the courier has arrived to deliver the packet to the employee
                            and received by the receiptionist.</p>
                        <router-link to="/goods-receipt">See goods receipt</router-link>
                    </figcaption>
                </figure>
            </div>
            <div class=" col-xxl-3 col-lg-3 col-md-6 mb-25">
                <figure class="feature-cards4">
                    <img class="svg"
                        src="https://res.cloudinary.com/boxity-id/image/upload/v1634485447/assets/undraw/update_oswplt.svg">
                    <figcaption>
                        <h2>Update your profile</h2>
                        <p>Update your profile for your completes bio, and let other users see your profile
                            in this
                            company.</p>
                        <router-link :to="{ name: 'userProfileEdit', params: { username:user.username }}">Update profile
                        </router-link>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xxl-3 col-lg-3 col-md-6 mb-25">
                <figure class="feature-cards4">
                    <img class="svg"
                        src="https://res.cloudinary.com/boxity-id/image/upload/v1634485447/assets/undraw/notepad_swelj8.svg">
                    <figcaption>
                        <h2>Notepad</h2>
                        <p>Don't let your idea, or your important things out. Note it into this notepad's system.</p>
                        <router-link to="/notepad">See your notepad</router-link>
                    </figcaption>
                </figure>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12 col-lg-12 col-md-12 mb-25">
                <div class="feature-cards5 d-flex justify-content-between border-0 radius-xl bg-white p-25">
                    <div class="application-task d-flex align-items-center">
                        <div class="application-task-content">
                            <span><strong>Need help?</strong> Check out our <a href="https://help.boxity.id"
                                    target="_blank">documentation</a> or our <a href="#">getting
                                    started video series</a> to quickly learn the basics or <router-link
                                    to="/new-issue">reach out to our
                                    team</router-link>, we'd happy to help.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var moment = require('moment');
    export default {
        title() {
            return 'Getting Started';
        },
        data() {
            return {
                user: {},
                moment: moment,
                currentTime: null,
                permissionss: []
            }
        },
        mounted() {
            this.svIssue();
        },
        created() {
            this.currentTime = moment().format("Do MMMM YYYY, h:mm:ss a");
            setInterval(() => this.updateCurrentTime(), 1 * 1000);
        },
        methods: {
            async svIssue() {
                // // this.$Progress.start();
                this.$isLoading(true);
                // Get user logged in
                const userLogged = await axios.get('/getUserLoggedIn');
                this.user = userLogged.data;
                this.$isLoading(false);
            },
            updateCurrentTime() {
                this.currentTime = moment().format("Do MMMM YYYY, h:mm:ss a");
            }
        },
    }

</script>
