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
                                            <div class="col-lg-4">
                                                <div class="card-overview__left">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-12 col-md-6">
                                                            <div class="overview-single">
                                                                <div class="overview-content">
                                                                    <h1>Rp. {{sumEarning|toDecimal}}</h1>
                                                                    <p>Earnings</p>
                                                                    <div>
                                                                        <span class="color-success"><i
                                                                                data-feather="trending-up"></i>
                                                                            <strong>{{this.percentageEarnings}}%</strong></span>
                                                                        <small>Rp. 0 (prev)</small>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="overview-single__chart">
                                                                    <div class="parentContainer">
                                                                        <div>
                                                                            <canvas id="lineChartOne"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="card-overview__right">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-12 col-md-6">
                                                            <div class="overview-single">





                                                                <div class="overview-content">
                                                                    <h1>{{sumViews|toDecimal}}</h1>
                                                                    <p>Total Views</p>
                                                                    <div>
                                                                        <span class="color-success"><i
                                                                                data-feather="trending-up"></i>
                                                                            <strong>100%</strong></span>
                                                                        <small>0 (prev)</small>
                                                                    </div>
                                                                </div>

                                                                <!-- <div class="overview-single__chart">
                                                                    <div class="parentContainer">


                                                                        <div>
                                                                            <canvas id="lineChartThree"></canvas>
                                                                        </div>


                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-4">
                                                <div class="card-overview__right">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-12 col-md-6">
                                                            <div class="overview-single">





                                                                <div class="overview-content">
                                                                    <h1>{{countContent|toDecimal}}</h1>
                                                                    <p>Total Content Published</p>
                                                                    <div>
                                                                        <span class="color-success"><i
                                                                                data-feather="trending-up"></i>
                                                                            <strong>100%</strong></span>
                                                                        <small>0 (prev)</small>
                                                                    </div>
                                                                </div>

                                                                <!-- <div class="overview-single__chart">
                                                                    <div class="parentContainer">


                                                                        <div>
                                                                            <canvas id="lineChartThree"></canvas>
                                                                        </div>


                                                                    </div>
                                                                </div> -->
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
                        <div class="tab-pane fade" id="v-pills-earnings" role="tabpanel"
                            aria-labelledby="v-pills-overview-tab">
                            <div class="edit-profile">
                                <div class="card">
                                    <div class="card-header px-sm-25 px-3 py-4">
                                        <div class="edit-profile__title">
                                            <h6>Earnings</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-progress">
                                            <div class="card-progress__summery d-flex justify-content-between">
                                                <div>
                                                    <strong class="color-primary"
                                                        style="font-size: 24px; font-weight: 600;">Rp.
                                                        {{sumEarning|toDecimal}}</strong><br>
                                                    <span>Cash collected</span>
                                                </div>
                                                <div>
                                                    <strong class="color-dark"
                                                        style="font-size: 24px; font-weight: 600;">Rp.
                                                        300.000</strong><br>
                                                    <span>Expected Cash Earnings</span>
                                                </div>
                                            </div>
                                            <div class="card-progress__bar">
                                                <div class="progress mt-4 mb-2">
                                                    <div class="progress-bar bg-success" role="progressbar" :style="{ 'width': percentageEarnings +
                                                        '%'}" :aria-valuenow="this.sumEarning" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress-excerpt">
                                                    <p class="progress-upword" style="color: #20c997;"><strong><span
                                                                class="la la-arrow-up"></span>
                                                            {{this.percentageEarnings}}%</strong> Since
                                                        Yesterday</p>
                                                </div>
                                            </div>
                                        </div><!-- ends: .card-progress -->
                                        <hr style="
    margin: 0;
    border: 1px solid rgba(0,0,0,.1);
    /* width: 20%; */
    /* align-items: center; */
">
                                        <p>
                                            <h1>How you can withdraw your earnings?</h1><br>
                                            <h2>1. Provide your tax information</h2>
                                            Depending on your location, we may be required to collect tax-related
                                            information. For more information, see how to submit your tax information to
                                            This Platform.
                                            <br><br>
                                            Note: All monetizing creators on This Platform, regardless of their location
                                            in
                                            the world, are required to provide tax information.
                                            <br><br>
                                            <h2>2. Confirm your personal information</h2>
                                            Because Personal Identification Numbers (PINs), which are described below,
                                            are sent to the mailing address in your account, it's important to confirm
                                            the accuracy of your payment address and payee name. If you need to correct
                                            any information, you can follow these instructions to change your payee name
                                            or change your payment address.
                                            <br><br>
                                            <h4>Verify your identity (not required in all locations)</h4>
                                            Depending on your location, we might need to verify your identity using
                                            information like your name, address, or date of birth. If you are required
                                            to do this, you typically won't be asked to verify your address until after
                                            you've successfully verified your identity.
                                            <br><br>
                                            <h4>Verify your address</h4>
                                            When your earnings reach the address verification threshold, we'll mail a
                                            PIN to the payee address in your This Platform account. You must enter this
                                            PIN
                                            into your This Platform account before we can issue any payments. Your PIN
                                            will be
                                            sent by standard post and may take up to 2-3 weeks to arrive. For more
                                            information about PINs, see the Address (PIN) verification overview.
                                            <br><br>
                                            Note: If you have separate payments accounts for This Platform, you
                                            verify your address when either of your payments accounts reaches the
                                            threshold. You only need to verify your address once.
                                            <br><br>
                                            <h2>3. Select your form of payment</h2>
                                            When your earnings reach the payment method selection threshold, you can
                                            select your form of payment. Depending on your payment address, there may be
                                            several forms of payment available to you, including Electronic Funds
                                            Transfer (EFT), EFT via Single Euro Payments Area (SEPA), wire transfer,
                                            etc. Learn how to set up your form of payment.
                                            <br><br>
                                            Note: If you have separate payments accounts for This Platform, you
                                            select a form of payment for each payments account when it reaches the
                                            threshold.
                                            <br><br>
                                            <h2>4. Meet the payment threshold</h2>
                                            If your current balance reaches the payment threshold by the end of the
                                            month, a 21 day payment processing period begins. After the processing
                                            period ends, we'll issue you a payment. Learn more about payment timelines.
                                            <br><br>
                                            Note: If you have separate payments accounts for This Platform, each
                                            payments account needs to reach the payment threshold to be paid out.
                                            Example
                                            For example, let's say the payment threshold for your account is $100. If
                                            your current balance reached $100 during January and you've completed all
                                            the steps above, then we would issue you a payment at the end of February.
                                            <br><br>
                                            If your current balance hasn’t yet reached the payment threshold, your
                                            finalized earnings will roll over to the next month and your balance will
                                            accrue until the threshold is met.
                                        </p>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <a href="/request/withdraw" class="btn btn-primary-boxity btn-block"
                                                    :class="{disabled : enoughCoins}">Request for a
                                                    withdraw</a>
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
                enoughCoins: true,
                sumViews: 0,
                sumEarning: 0,
                countContent: 0,
                percentageEarnings: 0,
                totalEarnings: 300000,
                // end datatable
            }
        },
        mounted() {
            this.loadCompany();
            this.calculatePercentage();
        },
        methods: {
            async loadCompany() {
                // this.$Progress.start();
                this.$isLoading(true);
                axios.get('/api/bank').then(resp => {
                    this.bank = resp.data;
                });
                const respSumViews = await axios.get('/api/blogs/sum-view');
                this.sumViews = respSumViews.data;
                const respSumEarn = await axios.get('/api/blogs/sum-earnings');
                this.sumEarning = respSumEarn.data;
                const respCountContent = await axios.get('/api/blogs/count');
                this.countContent = respCountContent.data;
                // Load logged user
                const respUser = await axios.get('/getUserLoggedIn');
                this.user = respUser.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async calculatePercentage() {
                const respSumEarnX = await axios.get('/api/blogs/sum-earnings');
                const awal = parseInt(respSumEarnX.data);
                const total = this.totalEarnings;
                const getPercentage = (awal / total) * 100;
                this.percentageEarnings = Math.round(getPercentage);
                console.log('Total Get Earnings: ', awal);
                console.log('Total Earnings: ', total);
                console.log('hasil persentase: ', getPercentage);
                if (awal >= 300000) {
                    this.enoughCoins = false;
                }
            },
        },
    }

</script>
