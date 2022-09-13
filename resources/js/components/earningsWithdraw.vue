<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Withdraw Management</h2>
                </div>
            </div>
        </div>
        <form @submit.prevent="submitHandle">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card-progress">
                        <div class="card-progress__summery d-flex justify-content-between">
                            <div>
                                <strong class="color-primary" style="font-size: 24px; font-weight: 600;">Rp.
                                    {{sumEarning|toDecimal}}</strong><br>
                                <span>Available for withdraw</span>
                            </div>
                            <div>
                                <strong class="color-dark" style="font-size: 24px; font-weight: 600;">Rp.
                                    300.000</strong><br>
                                <span>Earnings Limit</span>
                            </div>
                        </div>
                        <div class="card-progress__bar">
                            <div class="progress mt-4 mb-2">
                                <div class="progress-bar bg-success" role="progressbar" :style="{ 'width': percentageEarnings +
                                                        '%'}" :aria-valuenow="this.sumEarning" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                            <div class="progress-excerpt">
                                <p class="progress-upword" style="color: #20c997;"><strong>
                                        {{this.percentageEarnings}}%</strong> Limit available</p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-Vertical card-default card-md">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group">
                                    <div class="form-row">
                                        <h3>Request for a withdraw</h3>
                                        <hr style="margin: 1.5rem;">
                                        <div class="col-lg-12">
                                            <h6>Redeem Points</h6>
                                            <input type="number" v-model="withdraw.price"
                                                class="form-control mt-2 mb-3">
                                            <span class="text-muted" v-if="warningRequiredOver==true"
                                                style="color: red !important;">I'm sorry but your limit requested cannot
                                                more than Rp. {{this.totalEarnings|toDecimal}} that this platform gave
                                                to you.</span>
                                            <span class="text-muted" v-if="warningRequired==true"
                                                style="color: red !important;">Please have attention on
                                                this!</span>
                                        </div>
                                        <h4>Receipient Details</h4>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <span>Bank:</span>
                                                    <select class="form-control form-control-default"
                                                        v-model="withdraw.bank_id">
                                                        <option value="" selected>Select bank code:</option>
                                                        <option v-for="bank in bank" :key="bank.id"
                                                            v-bind:value="bank.id">
                                                            {{bank.name}} - {{bank.code}}
                                                        </option>
                                                    </select>
                                                    <span class="text-muted" v-if="warningRequired==true"
                                                        style="color: red !important;">Please have attention on
                                                        this!</span>
                                                </div>
                                                <div class="col-lg-6">
                                                    <span>Bank account:</span>
                                                    <input type="number" v-model="withdraw.account_no"
                                                        class="form-control">
                                                    <span class="text-muted" v-if="warningRequired==true"
                                                        style="color: red !important;">Please have attention on
                                                        this!</span>
                                                </div>
                                                <div class="col-lg-12">
                                                    <span>Bank account holder:</span>
                                                    <input type="text" v-model="withdraw.account_name"
                                                        class="form-control">
                                                    <span class="text-muted" v-if="warningRequired==true"
                                                        style="color: red !important;">Please have attention on
                                                        this!</span>
                                                </div>
                                            </div>
                                            <div class="Vertical-form">
                                                <div class="form-group my-2">
                                                    <input type="checkbox" id="agree" v-model="TnC"
                                                        v-if="this.TnC == true" disabled class="mt-3">
                                                    <input type="checkbox" id="agree" v-model="TnC" v-else class="mt-3">
                                                    <span for="agree"> Click here that you have the right to take full
                                                        responsibility for this original recipient data.</span>
                                                    <span class="text-muted" v-if="warningRequired==true"
                                                        style="color: red !important;">Please have attention on
                                                        this!</span>
                                                </div>
                                            </div>
                                            <div class="Vertical-form">
                                                <div class="form-group my-2">
                                                    <div class="justify-content-end">
                                                        <button type="submit"
                                                            class="btn btn-primary-boxity btn-default btn-block btn-squared px-30"
                                                            data-dismiss="modal">Request</button>
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
                <div class="col-lg-7">
                    <div class="card card-Vertical card-default card-md mt-1 mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group">
                                    <div class="form-row">
                                        <h3>Activity Withdraw Log</h3>
                                        <hr style="margin: 1.5rem;">
                                        <div class="table-responsive">
                                            <v-data-table :loading="loadingLog" loading-text="Loading... Please wait"
                                                :headers="headersLog" :items="historiesLog" :items-per-page="10"
                                                class="elevation-1">
                                                <template v-slot:[`item.withdraw_id`]="{item}">
                                                    BCI-BLWID-000{{item.withdraw_id}}
                                                </template>
                                            </v-data-table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-warning"
                        style="border-color: #fa8b0c; margin-bottom: 0 !important; padding-bottom: 0px;">
                        <h4><i class="fas fa-info-circle"
                                style="color: #fa8b0c; font-size:2rem; margin-top:6px; margin-right: 1.5rem;"></i>
                        </h4>
                        <p style="color: #000; font-size: 12px;">
                            <ol type="disc">
                                <li>Transaksi nominal <b>di bawah atau sama dengan
                                        Rp. {{this.totalEarnings|toDecimal}}</b>
                                    yang
                                    direquest di bawah 15:00 WIB, akan diproses di hari yang sama. (Real Time)</li>
                                <li>Transaksi nominal <b>di atas Rp. {{this.totalEarnings|toDecimal}}</b> memerlukan
                                    waktu
                                    proses 1
                                    hari kerja.</li>
                            </ol>
                        </p>
                    </div>
                    <div class="card card-Vertical card-default card-md mt-4 mb-2">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group">
                                    <div class="form-row">
                                        <h3>History Withdraw</h3>
                                        <hr style="margin: 1.5rem;">
                                        <div class="table-responsive">
                                            <v-card-title>
                                                <v-text-field v-model="search" append-icon="mdi-magnify"
                                                    label="Search here..." single-line hide-details>
                                                </v-text-field>
                                            </v-card-title>
                                            <v-data-table :loading="loading" loading-text="Loading... Please wait"
                                                :headers="headers" :items="histories"
                                                :footer-props="{'items-per-page-options':[6,10]}" :options="options"
                                                :items-per-page="6" class="elevation-1">
                                                <template v-slot:[`item.status`]="{item}">
                                                    <span
                                                        class="rounded-pill userDatatable-content-status status-approved"
                                                        v-if="item.status == 1">
                                                        Approved</span>
                                                    <span
                                                        class="rounded-pill userDatatable-content-status status-requested"
                                                        v-if="item.status == 0">
                                                        Requested </span>
                                                    <span
                                                        class="rounded-pill userDatatable-content-status status-pending"
                                                        v-if="item.status == 2">
                                                        On Process </span>
                                                    <span
                                                        class="rounded-pill userDatatable-content-status status-selesai"
                                                        v-if="item.status == 3">
                                                        Done </span>
                                                    <span class="rounded-pill userDatatable-content-status status-gagal"
                                                        v-if="item.status == 4">
                                                        Failed! </span>
                                                </template>
                                                <template v-slot:[`item.actions`]="{item}"
                                                    v-if="this.users.role == 'admin'">
                                                    <div class="table-actions">
                                                        <a href="#">
                                                            <span
                                                                class="rounded-pill userDatatable-content-status status-selesai my-1 mx-1"
                                                                v-if="item.status==0"><i class="fas fa-check"></i>&nbsp;
                                                                Approve </span>
                                                        </a>
                                                        <a href="#">
                                                            <span
                                                                class="rounded-pill userDatatable-content-status status-gagal my-1 mx-1"
                                                                v-if="item.status==0"><i class="fas fa-times"></i>&nbsp;
                                                                Decline </span>
                                                        </a>
                                                        <a href="#">
                                                            <span
                                                                class="rounded-pill userDatatable-content-status status-pending my-1 mx-1"
                                                                v-if="item.status==1"><i
                                                                    class="fas fa-arrow-right"></i>&nbsp;
                                                                Process transfer </span>
                                                        </a>
                                                        <a href="#">
                                                            <span
                                                                class="rounded-pill userDatatable-content-status status-selesai my-1 mx-1"
                                                                v-if="item.status==2"><i class="fas fa-check"></i>&nbsp;
                                                                Transfer Done </span>
                                                        </a>
                                                        <a href="#">
                                                            <span
                                                                class="rounded-pill userDatatable-content-status status-gagal my-1 mx-1"
                                                                v-if="item.status==2"><i class="fas fa-times"></i>&nbsp;
                                                                Transfer Failed </span>
                                                        </a>
                                                    </div>
                                                </template>
                                                <template v-slot:[`item.price`]="{item}">
                                                    Rp. {{item.price|toDecimal}}
                                                </template>
                                                <template v-slot:[`item.account_number`]="{item}">
                                                    <b>{{item.banks.name}}</b> - {{item.account_number}} -
                                                    {{item.account_no}}
                                                </template>

                                            </v-data-table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    export default {
        title() {
            return 'Withdraw Management';
        },
        data() {
            return {
                histories: [],
                historiesLog: [],
                TnC: false,
                search: '',
                loading: true,
                loadingLog: true,
                withdraw: {},
                sumViews: 0,
                sumEarning: 0,
                countContent: 0,
                warningRequiredOver: false,
                percentageEarnings: 0,
                totalEarnings: 300000,
                bank: {},
                users: {},
                options: {
                    itemsPerPage: 6
                },
                warningRequired: false,
                headers: [{
                    text: 'Recipient',
                    value: 'account_number',
                    width: '25%'
                }, {
                    text: 'Nominal',
                    value: 'price',
                    width: '15%'
                }, {
                    text: 'Requested by',
                    value: 'requester.name',
                    width: '15%'
                }, {
                    text: 'Requested date',
                    value: 'created_at',
                    width: '15%'
                }, {
                    text: 'Status',
                    value: 'status',
                    width: '10%'
                }, {
                    text: 'Act',
                    value: 'actions',
                    width: '20%'
                }],
                headersLog: [{
                    text: 'Log ID',
                    value: 'withdraw_id'
                }, {
                    text: 'Activity',
                    value: 'remarks'
                }, {
                    text: 'Updated at',
                    value: 'updated_at'
                }],
            }
        },
        mounted() {
            this.loadData();
            this.calculatePercentage();
        },
        methods: {
            async loadData() {
                // this.$Progress.start();
                this.$isLoading(true);
                axios.get('/getUserLoggedIn').then(resp => {
                    this.users = resp.data;
                });
                console.log(this.users);
                axios.get('/api/bank').then(resp => {
                    this.bank = resp.data;
                });
                axios.get('/api/history/withdraw').then(res => {
                    this.histories = res.data;
                });
                axios.get('/api/history/log-withdraw').then(log => {
                    this.historiesLog = log.data;
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
            async submitHandle(e) {
                // console.log(this.withdraw);
                if (this.withdraw.price > this.totalEarnings) {
                    this.warningRequiredOver = true;
                } else if (this.withdraw.price == null || this.TnC == false || this.withdraw.bank_id == null || this
                    .withdraw.account_no == null || this.withdraw.account_name == null) {
                    this.warningRequired = true
                } else {
                    this.$isLoading(true);
                    await axios.post('/api/history/withdraw', this.withdraw).then(response => {
                            document.getElementById('ding').play();
                            Swal.fire({
                                icon: 'success',
                                title: 'Congratulations',
                                text: 'Success send the withdraw request',
                            });
                            this.$router.push('/request/withdraw');
                            this.loadData();
                            this.withdraw = {};
                        })
                        .catch(error => {
                            this.$Progress.fail();
                            document.getElementById('failding').play();
                            Swal.fire({
                                icon: 'warning',
                                title: 'Something wrong.',
                                confirmButtonText: `Ok`,
                                html: `There is something wrong on my side. Please click ok to refresh this page and see what is it.
                    If
                    it still exist, you can contact our developer. <br><br>Error message: ` +
                                    error,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        });
                    this.$isLoading(false);
                }

            },
        },
    }

</script>
