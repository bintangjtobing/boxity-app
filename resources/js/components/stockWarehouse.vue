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
                                <a @click="searchData" class="btn btn-primary-boxity" style="margin-top:22px;"><em
                                        class="far fa-search"></em>
                                    Search
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-1 text-left">
                            <div class="form-group">
                                <a :href="urlPrint+`?customerId=${this.req.customerid}&warehouseId=${this.req.warehouseid}&startDate=${this.req.from}&endDate=${this.req.to}`"
                                    target="_blank" class="btn btn-secondary-boxity" style="margin-top:22px;"><em
                                        class="far fa-file-export"></em>
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
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/detail/inventory-item/${item.data.id}`" class="edit">
                                    <i class="fad fa-eye"></i></router-link>
                            </template>
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
                warehouse: {},
                search: '',
                key: 1,
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
                        value: 'supplier'
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
                urlPrint: "/print/report-warehouse"
                // end datatable
            }
        },
        created() {
            this.loadCard();
        },
        methods: {
            async loadCard() {
                this.$isLoading(true);
                const resp = await axios.get('/api/customers');
                this.customers = resp.data;
                const respWareh = await axios.get('/api/warehouse');
                this.warehouse = respWareh.data;
                if (resp.data.length) {
                    this.loading = false;
                }
                this.$isLoading(false);
            },
            async searchData() {
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

                this.urlPrint = '/print/report-warehouse'
                if (this.req.warehouseid && this.req.customerid) {
                    this.urlPrint = this.urlPrint +
                        `?customerId=${this.req.customerid}&warehouseId=${this.req.warehouseid}&startDate=${this.req.from}&endDate=${this.req.to}`
                }
            }
        },
    }

</script>
