<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Payroll Management</h4>
                            <span class="sub-title ml-sm-25 pl-sm-25">{{payrollCount}} Transaction</span>
                        </div>
                    </div>
                    <div class="action-btn">
                        <router-link to="/payroll/new" class="btn btn-sm btn-primary-boxity btn-add">
                            <em class="las la-plus fs-16"></em>New transaction</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :loading="loading" :search="search" loading-text="Loading... Please wait"
                            :headers="headers" :items="payrollData" :items-per-page="10" class="elevation-1">
                            <template v-slot:[`item.status`]="{ item }">
                                <span class="rounded-pill userDatatable-content-status color-success
                                            bg-opacity-success text-capitalize" v-if="item.status ==1"> Active</span>
                                <span class="rounded-pill userDatatable-content-status color-danger
                                            bg-opacity-danger text-capitalize" v-if="item.status ==0"> Resigned</span>
                            </template>
                            <template v-slot:[`item.actions`]="{item}">
                                <router-link :to="`/payroll/detail/${item.id}`" class="edit">
                                    <i class="fad fa-eye"></i></router-link>
                            </template>
                        </v-data-table>
                    </div>
                </div>
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
    export default {
        title() {
            return 'Employee';
        },
        data() {
            return {
                // datatable
                search: '',
                payrollData: [],
                key: 1,
                loading: true,
                headers: [{
                    text: 'Transaction Name',
                    value: 'transaction_name'
                }, {
                    text: 'Batch File',
                    value: 'batch_file'
                }, {
                    text: 'Upload Date',
                    value: 'created_at'
                }, {
                    text: 'Transaction Status',
                    value: 'status'
                }, {
                    text: 'Action',
                    align: 'center',
                    value: 'actions'
                }],
                // end datatable
            }
        },
        computed: {
            payrollCount() {
                return this.payrollData.length
            }
        },
        created() {
            this.loadPayrollData();
        },
        methods: {
            async loadPayrollData() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/employee');
                if (resp.data.length) {
                    this.loading = false;
                }
                this.payrollData = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
        },
    }

</script>
