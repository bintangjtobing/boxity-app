<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Report Stock Card</h2>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="form-row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <span>Select customer:</span>
                                <select v-model="req.customerid" class="form-control">
                                    <option value="">Select customer</option>
                                    <option v-for="customers in customers" :key="customers.id"
                                    :value="customers.id">
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
                        <div class="col-lg-1 mx-2">
                            <div class="form-group">
                                <a @click="searchData" class="btn btn-primary-boxity" style="margin-top:22px;"><em class="far fa-search"></em>
                                    Search
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-1 text-left">
                            <div class="form-group">
                                <a @click="exportData" class="btn btn-secondary-boxity" style="margin-top:22px;"><em class="far fa-file-export"></em>
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
                            :items="reports" :items-per-page="10" class="elevation-1" group-by="warehouse">
                        </v-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
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
                    text: 'Location',
                    value: 'location'
                }, {
                    text: 'Date',
                    value: 'date'
                }, {
                    text: 'Category',
                    value: 'category'
                }, {
                    text: 'Type',
                    value: 'type'
                }, {
                    text: 'PO No.',
                    value: 'itemInIds'
                }, {
                    text: 'Item code',
                    value: 'data.item.item_code'
                }, {
                    text: 'Item name',
                    value: 'data.item.item_name'
                }, {
                    text: 'Supplier',
                    value: 'supplier'
                }, {
                    text: 'No Pol.',
                    value: 'no_pol'
                }, {
                    text: 'No Cont.',
                    value: 'no_cont'
                }, {
                    text: 'Weight In',
                    value: 'weight_in',
                    align: 'right',
                }, {
                    text: 'Weight Out',
                    value: 'weight_out',
                    align: 'right',
                }, {
                    text: 'Nett Weight',
                    value: 'nett_weight',
                    align: 'right',
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
                const resp = await axios.get('/api/report-card', {
                    params: {
                        customerId: this.req.customerid,
                        startDate: this.req.from,
                        endDate: this.req.to,
                        type: 'stock'
                    }
                });
                this.reports = resp.data;
            }
        },
    }

</script>
