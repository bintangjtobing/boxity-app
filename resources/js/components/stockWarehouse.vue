<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Report Warehouse Card</h2>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="form-row">
                        <div class="col-lg-2">
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
                                <span>Select Warehouse:</span>
                                <select v-model="req.warehouseid" class="form-control">
                                    <option value="">Select warehouse</option>
                                    <option v-for="warehouse in warehouse" :key="warehouse.id" :value="warehouse.id">
                                        {{warehouse.warehouse_name}}</option>
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
                            <template v-slot:item.qtyInFirst="{ item }">
                                {{item.qtyInFirst|toDecimal}} {{item.unit}}
                            </template>
                            <template v-slot:item.qtyIn="{ item }">
                                {{item.qtyIn|toDecimal}} {{item.unit}}
                            </template>
                            <template v-slot:item.qtyOut="{ item }">
                                {{item.qtyOut|toDecimal}} {{item.unit}}
                            </template>
                            <template v-slot:item.qtyTotal="{ item }">
                                {{item.qtyTotal|toDecimal}} {{item.unit}}
                            </template>
                            <!-- <template v-slot:item.actions="reports">
                                <router-link :to="`/detail/inventory-item/${item.id}`" class="edit">
                                    <i class="fad fa-eye"></i></router-link>
                            </template> -->
                        </v-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    // import Swal from 'sweetalert2';
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
                warehouse: {},
                search: '',
                key: 1,
                // reports: [{
                //     item_code: 'B001',
                //     item_name: 'Pollar',
                //     // po_number: 'PO.20211010.817363',
                //     // supplier: 'Bungasari',
                //     // date_in: '10/10/2021',
                //     // location: 'GDG 1 CARGILL',
                //     beginning_stock: '60.000 kg',
                //     qty_received: '',
                //     qty_received_cum: '60.000 kg',
                //     qty_delivery: '-',
                //     qty_delivery_cum: '-',
                //     qty_total: '',
                // }, {
                //     item_code: 'B001',
                //     item_name: 'Pollar',
                //     // po_number: 'PO.20211013.624534',
                //     // supplier: 'Bungasari',
                //     // date_in: '13/10/2021',
                //     // location: 'GDG 1 CARGILL',
                //     beginning_stock: '60.000 kg',
                //     qty_received: '30.000 kg',
                //     qty_received_cum: '90.000 kg',
                //     qty_delivery: '-',
                //     qty_delivery_cum: '-',
                //     qty_total: '',
                // }, {
                //     item_code: 'B011',
                //     item_name: 'Meat Bone Meal',
                //     // po_number: 'PO.20211009.61451',
                //     // supplier: 'Bungasari',
                //     // date_in: '09/10/2021',
                //     // location: 'GDG 1 CARGILL',
                //     beginning_stock: '30.000 kg',
                //     qty_received: '',
                //     qty_received_cum: '30.000 kg',
                //     qty_delivery: '-',
                //     qty_delivery_cum: '-',
                //     qty_total: '',
                // }, {
                //     item_code: 'B011',
                //     item_name: 'Meat Bone Meal',
                //     // po_number: 'PO.20211010.123445',
                //     // supplier: 'Bungasari',
                //     // date_in: '10/10/2021',
                //     // location: 'GDG 1 CARGILL',
                //     beginning_stock: '30.000 kg',
                //     qty_received: '30.000 kg',
                //     qty_received_cum: '60.000 kg',
                //     qty_delivery: '-',
                //     qty_delivery_cum: '-',
                //     qty_total: '',
                // }, ],
                loading: true,
                reports: [],
                headers: [{
                        text: 'Item code',
                        value: 'data.item_code'
                    }, {
                        text: 'Item name',
                        value: 'data.item_name'
                    },
                    {
                        text: 'PO No.',
                        value: 'itemInIds'
                    }, {
                        text: 'First Supplier In',
                        value: 'date_item_out'
                    }, {
                        text: 'First Date In',
                        value: 'date_item_in'
                    },
                    {
                        text: 'Beginning Stock',
                        value: 'qtyInFirst',
                        align: 'right',
                    },
                    {
                        text: 'Receive Qty',
                        value: 'qty_received'
                    },
                    {
                        text: 'Receive Cum.',
                        value: 'qtyIn',
                        align: 'right',
                    },
                    {
                        text: 'Delivery Qty',
                        value: 'qty_delivery'
                    },
                    {
                        text: 'Delivery Cum.',
                        value: 'qtyOut',
                        align: 'right',
                    }, {
                        text: 'Total Stock',
                        value: 'qtyTotal',
                        align: 'right'
                    }, {
                        text: 'Actions',
                        value: 'actions'
                    }
                ],
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
                const respWareh = await axios.get('/api/warehouse');
                this.warehouse = respWareh.data;
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
                        warehouseId: this.req.warehouseid,
                        startDate: this.req.from,
                        endDate: this.req.to,
                        type: 'warehouse'
                    }
                });
                this.reports = resp.data;
            }
        },
    }

</script>
