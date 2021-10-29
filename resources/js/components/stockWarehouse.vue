<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Report Warehouse Card</h2>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="form-row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <span>Select customer:</span>
                                <select v-model="req.customerid" class="form-control">
                                    <option value="">Select customer</option>
                                    <option v-for="customers in customers" :key="customers.id" :value="customers.id">
                                        {{customers.company_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <span>From:</span>
                                <input type="date" v-model="req.from" class="form-control" placeholder="dd / mm / yyyy">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <span>To:</span>
                                <input type="date" v-model="req.to" class="form-control" placeholder="dd / mm / yyyy">
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <a @click="searchData" class="btn btn-primary-boxity" style="margin-top:22px;"><i
                                        class="far fa-search"></i>
                                    Search
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-1 text-left">
                            <div class="form-group">
                                <a @click="exportData" class="btn btn-secondary-boxity" style="margin-top:22px;"><i
                                        class="far fa-file-export"></i>
                                    Export
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :loading="loading" loading-text="Loading... Please wait" :headers="headers"
                            :items="reports" :items-per-page="10" class="elevation-1">
                        </v-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'Report Stock Card';
        },
        data() {
            return {
                req: {
                    customerid: '',
                },
                // datatable
                customers: {},
                search: '',
                key: 1,
                reports: [],
                loading: true,
                headers: [{
                    text: 'Item code',
                    value: 'title'
                }, {
                    text: 'Item name',
                    value: 'category'
                }, {
                    text: 'PO No.',
                    value: 'views'
                }, {
                    text: 'Supplier',
                    value: 'views'
                }, {
                    text: 'Date In',
                    value: 'views'
                }, {
                    text: 'Location',
                    value: 'views'
                }, {
                    text: 'Beginning Stock',
                    value: 'views'
                }, {
                    text: 'Receive Qty',
                    value: 'views'
                }, {
                    text: 'Receive Cum.',
                    value: 'views'
                }, {
                    text: 'Delivery Qty',
                    value: 'views'
                }, {
                    text: 'Delivery Cum.',
                    value: 'views'
                }, {
                    text: 'Total Stock',
                    value: 'views'
                }],
                // end datatable
            }
        },
        created() {
            this.loadCard();
        },
        methods: {
            async loadCard() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/customers');
                this.customers = resp.data;
                if (resp.data.length) {
                    this.loading = false;
                }
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async exportData() {
                console.log(this.req);
            },
            async searchData() {
                console.log(this.req);
            }
        },
    }

</script>
