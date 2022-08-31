<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">

                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Insight Overview</h2>
                </div>

            </div>
            <div class="col-xxl-3 col-lg-4 col-sm-5">
                <!-- Profile Acoount -->
                <div class="card mb-25">
                    <div class="card-body text-center p-0">
                        <div class="ps-tab p-20 pb-25">
                            <div class="nav flex-column text-left" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active mt-1" id="v-pills-overview-tab" data-toggle="pill"
                                    href="#v-pills-overview" role="tab" aria-controls="v-pills-overview"
                                    aria-selected="true">
                                    Overview</a>
                                <a class="nav-link mt-1" id="v-pills-earnings-tab" data-toggle="pill"
                                    href="#v-pills-earnings" role="tab" aria-controls="v-pills-earnings"
                                    aria-selected="true">
                                    Earnings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9 col-lg-8 col-sm-7">
                <div class="mb-50">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active" id="v-pills-overview" role="tabpanel"
                            aria-labelledby="v-pills-overview-tab">
                            <div class="edit-profile">
                                <div class="card">
                                    <div class="card-header px-sm-25 px-3 py-4">
                                        <div class="edit-profile__title">
                                            <h6>Overview</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card-overview__left">
                                                    <div class="overview-single">
                                                        <div class="overview-content">
                                                            <h1>25,845</h1>
                                                            <p>Engaged Users</p>
                                                            <div>
                                                                <span class="color-success"><i
                                                                        data-feather="trending-up"></i>
                                                                    <strong>25%</strong></span>
                                                                <small>20,641 (prev)</small>
                                                            </div>
                                                        </div>
                                                        <div class="overview-single__chart">
                                                            <div class="parentContainer">
                                                                <div>
                                                                    <canvas id="lineChartOne"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card-overview__left">
                                                    <div class="overview-single">
                                                        <div class="overview-content">
                                                            <h1>25,845</h1>
                                                            <p>Engaged Users</p>
                                                            <div>
                                                                <span class="color-success"><i
                                                                        data-feather="trending-up"></i>
                                                                    <strong>25%</strong></span>
                                                                <small>20,641 (prev)</small>
                                                            </div>
                                                        </div>
                                                        <div class="overview-single__chart">
                                                            <div class="parentContainer">
                                                                <div>
                                                                    <canvas id="lineChartOne"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    export default {
        title() {
            return 'Insight Overview';
        },
        data() {
            return {
                // end datatable
            }
        },
        mounted() {
            this.loadCompany();
        },
        methods: {
            async loadCompany() {
                // this.$Progress.start();
                this.$isLoading(true);
                axios.get('/api/bank').then(resp => {
                    this.bank = resp.data;
                });

                // Load logged user
                const respUser = await axios.get('/getUserLoggedIn');
                this.user = respUser.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
        },
    }

</script>
