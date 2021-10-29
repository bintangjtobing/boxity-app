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
                                    <option v-for="customers in customers" :key="customers.id">
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
                reports: [{
                    location: 'GDG 1',
                    date: '01 Oktober 2021',
                    category: 'Bongkar',
                    type: 'Bag',
                    po_number: 'PO.20210110.57869',
                    item_code: 'B001',
                    item_name: 'Pollar',
                    supplier: 'Bungasari',
                    no_pol: 'BK 0019 KK',
                    no_cont: 'HASLIJ0192833',
                    weight_in: '37.550 kg (500 bag)',
                    weight_out: '12.300 kg (164 bag)',
                    nett_weight: '25.200 kg (336 bag)',
                }, {
                    location: 'GDG 1',
                    date: '03 Oktober 2021',
                    category: 'Bongkar',
                    type: 'Bag',
                    po_number: 'PO.20210110.17463',
                    item_code: 'B001',
                    item_name: 'Pollar',
                    supplier: 'Bungasari',
                    no_pol: 'BK 8773 IO',
                    no_cont: 'HASLIJ0174653',
                    weight_in: '77.450 kg (1032 bag)',
                    weight_out: '33.400 kg (445 bag)',
                    nett_weight: '44.050 kg (587 bag)',
                }, {
                    location: 'GDG 2',
                    date: '04 Oktober 2021',
                    category: 'Muat',
                    type: 'Bag',
                    po_number: 'SO.20210110.65473',
                    item_code: 'B011',
                    item_name: 'Meat Bone Meal',
                    supplier: 'Cargill Inc',
                    no_pol: 'BK 7223 DC',
                    no_cont: 'HAJSI98176128',
                    weight_in: '9.375 kg (125 bag)',
                    weight_out: '15.000 kg (2000 bag)',
                    nett_weight: '5.625 kg (75 bag)',
                }],
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
                    value: 'po_number'
                }, {
                    text: 'Code',
                    value: 'item_code'
                }, {
                    text: 'Item',
                    value: 'item_name'
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
            }
        },
    }

</script>
