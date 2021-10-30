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
                    item_code: 'B001',
                    item_name: 'Pollar',
                    po_number: 'PO.20211010.817363',
                    supplier: 'Bungasari',
                    date_in: '10/10/2021',
                    location: 'GDG 1 CARGILL',
                    beginning_stock: '60.000 kg (800 bag)',
                    qty_received: '',
                    qty_received_cum: '60.000 kg (800 bag)',
                    qty_delivery: '-',
                    qty_delivery_cum: '-',
                    qty_total: '',
                }, {
                    item_code: 'B001',
                    item_name: 'Pollar',
                    po_number: 'PO.20211013.624534',
                    supplier: 'Bungasari',
                    date_in: '13/10/2021',
                    location: 'GDG 1 CARGILL',
                    beginning_stock: '60.000 kg (800 bag)',
                    qty_received: '30.000 kg (400 bag)',
                    qty_received_cum: '90.000 kg (1.200 bag)',
                    qty_delivery: '-',
                    qty_delivery_cum: '-',
                    qty_total: '',
                }, {
                    item_code: 'B011',
                    item_name: 'Meat Bone Meal',
                    po_number: 'PO.20211009.61451',
                    supplier: 'Bungasari',
                    date_in: '09/10/2021',
                    location: 'GDG 1 CARGILL',
                    beginning_stock: '30.000 kg (400 bag)',
                    qty_received: '',
                    qty_received_cum: '30.000 kg (400 bag)',
                    qty_delivery: '-',
                    qty_delivery_cum: '-',
                    qty_total: '',
                }, {
                    item_code: 'B011',
                    item_name: 'Meat Bone Meal',
                    po_number: 'PO.20211010.123445',
                    supplier: 'Bungasari',
                    date_in: '10/10/2021',
                    location: 'GDG 1 CARGILL',
                    beginning_stock: '30.000 kg (400 bag)',
                    qty_received: '30.000 kg (400 bag)',
                    qty_received_cum: '60.000 kg (800 bag)',
                    qty_delivery: '-',
                    qty_delivery_cum: '-',
                    qty_total: '',
                }, ],
                loading: true,
                headers: [{
                    text: 'Item code',
                    value: 'item_code'
                }, {
                    text: 'Item name',
                    value: 'item_name'
                }, {
                    text: 'PO No.',
                    value: 'po_number'
                }, {
                    text: 'Supplier',
                    value: 'supplier'
                }, {
                    text: 'Date In',
                    value: 'date_in'
                }, {
                    text: 'Location',
                    value: 'location'
                }, {
                    text: 'Beginning Stock',
                    value: 'beginning_stock'
                }, {
                    text: 'Receive Qty',
                    value: 'qty_received'
                }, {
                    text: 'Receive Cum.',
                    value: 'qty_received_cum'
                }, {
                    text: 'Delivery Qty',
                    value: 'qty_delivery'
                }, {
                    text: 'Delivery Cum.',
                    value: 'qty_delivery_cum'
                }, {
                    text: 'Total Stock',
                    value: 'qty_total'
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
