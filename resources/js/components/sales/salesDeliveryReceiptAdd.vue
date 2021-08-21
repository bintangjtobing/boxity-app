<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">New Delivery Receipt
                                <span>#{{deliveryReceiptData.sdr_number}}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 row justify-content-center">
                <button class="btn btn-primary col-6 col-sm-4 m-1" @click="inputOptions('manual')">
                    <i class="fal fa-file-alt"></i> Input Manual
                </button>
                <button class="btn btn-success col-6 col-sm-4 m-1" @click="inputOptions('invoice')">
                    <i class="fal fa-file-invoice-dollar"></i> Select From Invoice
                </button>
            </div>
            <!-- Select Invoice -->
            <div class="col-lg-12" v-show="isSelectInvoice">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center" @click="isShowing()">
                            <div class="col-lg-6">
                                <h5>Sales Invoices</h5>
                                <p class="muted-text">Select to items on Delivery Receipts</p>
                            </div>
                            <div class="col-lg-6 text-right">
                                <span class="material-icons-outlined collapseArea" :class="classRotate(isShow.colapse)"
                                    style="color:#ddd; font-size:2rem !important;">
                                    expand_more
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-12" v-show="isShow.colapse">
                            <template>
                                <v-data-table v-model="selectedSalesInvoice" :headers="headersSalesInvoice"
                                    :items="salesInvoice" item-key="si_number" hide-default-footer show-select
                                    fixed-header :single-expand="true" :expanded.sync="expanded" show-expand
                                    style="max-height: 500px; overflow: auto">
                                    <template v-slot:expanded-item="{ headers, item }">
                                        <td :colspan="headers.length">
                                            <template>
                                                <v-data-table :headers="headersExpanded" :items="item.items"
                                                    :items-per-page="5" hide-default-footer fixed-header
                                                    style="max-height: 350px; overflow: auto"></v-data-table>
                                            </template>
                                        </td>
                                    </template>
                                </v-data-table>
                            </template>
                            <button v-on:click="addSelectedSalesInvoice" v-on:keyup.enter="addSelectedSalesInvoice"
                                class="btn btn-success float-right btn-default btn-squared px-30"
                                :disabled="isAddItemSalesInvoice">Add to lists</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Add -->
            <div class="col-lg-12" :class="{unvisible: isVisibleAddForm}">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center" @click="isShowing()">
                            <div class="col-lg-6">
                                <h5>Items</h5>
                                <p class="muted-text">{{ titleItemDescription }}</p>
                            </div>
                            <div class="col-lg-6 text-right">
                                <span class="material-icons-outlined collapseArea" :class="classRotate(isShow.colapse)"
                                    style="color:#ddd; font-size:2rem !important;">
                                    expand_more
                                </span>
                            </div>
                        </div>
                        <div v-show="isShow.colapse">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Item name:</span>
                                        <select v-model="itemAdd.itemid" @change="onItemSelected($event)"
                                            class="form-control form-control-default">
                                            <option value="" disabled>Select item:</option>
                                            <option v-for="items in items" :key="items.id" :value="items.id">
                                                {{items.item_name}}</option>
                                        </select>
                                        <span class="float-right"><abbr title="Add new item">Don't see the item you're
                                                looking for?</abbr>
                                            <router-link :to="'/inventory-item'">
                                                Add new item here</router-link>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Quantity Shipped:</span>
                                        <input type="number" v-model="itemAdd.qtyShipped" placeholder="0" id="" min="0"
                                            max="10000" step="1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Unit:</span>
                                        <input type="text" v-model="itemAdd.unit" id="" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Remarks:</span>
                                        <textarea v-model="itemAdd.remarks" class="form-control" id="" cols="30"
                                            rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <div class="row">
                                    <div class="col-12">
                                        <button v-on:click="addToList" v-on:keyup.enter="addToList" class="btn btn-success float-right btn-default btn-squared
                                                px-30">Add to lists</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Modify -->
            <div class="col-lg-12" :class="{unvisible: isVisibleModifyForm}">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center" @click="isShowing()">
                            <div class="col-lg-6">
                                <h5>Modify Item</h5>
                                <p class="muted-text">{{ titleItemDescription }}</p>
                            </div>
                            <div class="col-lg-6 text-right">
                                <span class="material-icons-outlined collapseArea" :class="classRotate(isShow.colapse)"
                                    style="color:#ddd; font-size:2rem !important;">
                                    expand_more
                                </span>
                            </div>
                        </div>
                        <div v-show="isShow.colapse">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Item name:</span>
                                        <input type="text" v-model="itemModify.item_name" id="" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Quantity Shipped:</span>
                                        <input type="number" v-model="itemModify.qtyShipped" placeholder="0" id=""
                                            min="0" max="10000" step="1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Unit:</span>
                                        <input type="text" v-model="itemModify.unit" id="" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Remarks:</span>
                                        <textarea v-model="itemModify.remarks" class="form-control" id="" cols="30"
                                            rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <div class="row">
                                    <div class="col-12">
                                        <button v-on:click="modifyItemList" v-on:keyup.enter="modifyItemList" class="btn btn-success float-right btn-default btn-squared
                                                px-30">Update item
                                            list</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class=" col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details>
                                    </v-text-field>
                                </v-card-title>
                                <v-data-table :search="search" :loading="!itemDeliveryData.length"
                                    loading-text="Data not found..." :headers="headers" :items="itemDeliveryData"
                                    :items-per-page="10" class="elevation-1">
                                    <template v-slot:item.item.si_number="{item}">
                                        <section v-if="item.si_number">
                                            <i class="fas fa-file-invoice-dollar text-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" :title="'Sales Invoice: '+item.si_number"></i>
                                        </section>
                                        <section v-else>
                                            <i class="fas fa-file-alt text-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Manual Input"></i>
                                        </section>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <a v-on:click="modifyItemPurchasing(item.id)" class="edit">
                                            <i class="fad fa-edit"></i></a>
                                        <a v-on:click="deleteItemPurchasing(item.id)" class="remove">
                                            <i class="fad fa-trash"></i></a>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>PI number:</span>
                                    <input type="text" v-model="deliveryReceiptData.sdr_number" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span>Customer:</span>
                                    <select v-model="deliveryReceiptData.customer"
                                        class="form-control form-control-default">
                                        <option value="" disabled>Select customer:</option>
                                        <option v-for="customer in customer" :key="customer.id" :value="customer.id">
                                            {{customer.customerName}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Order date:</span>
                                    <input type="date" v-model="deliveryReceiptData.sdr_date" class="form-control"
                                        placeholder="Brand">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Deliver to:</span>
                                    <select v-model="deliveryReceiptData.deliver_to"
                                        class="form-control form-control-default">
                                        <option value="" disabled>Select warehouse:</option>
                                        <option v-for="warehouse in warehouse" :key="warehouse.id"
                                            :value="warehouse.id">
                                            {{warehouse.warehouse_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Driver Name:</span>
                                    <input type="text" v-model="deliveryReceiptData.drivers" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Vehicle No:</span>
                                    <input type="text" v-model="deliveryReceiptData.vehicle_no" class="form-control"
                                        placeholder="ex: BK 0000 ABC">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <span>Remarks:</span>
                                    <textarea class="form-control" v-model="deliveryReceiptData.remarks" cols="30"
                                        rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <div class="row">
                                <div class="col-12">
                                    <button v-on:click="submitHandle" v-on:keyup.enter="submitHandle" class="btn btn-success float-right btn-default btn-squared
                                                px-30">Save</button>
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
    import Editor from '@tinymce/tinymce-vue';
    export default {
        components: {
            'editor': Editor
        },
        title() {
            return `New Delivery Receipt`;
        },
        data() {
            return {
                isShow: {
                    colapse: true,
                },
                // Page Info
                expanded: [],
                titleItemDescription: 'Add some items on Delivery Receipts.',
                isVisibleAddForm: true,
                isVisibleModifyForm: true,
                isSelectInvoice: false,
                selectedSalesInvoice: [],
                itemModify: {
                    itemid: '',
                    unit: '',
                    purpose: '',
                    requested_by: '',
                    used_by: '',
                    remarks: '',
                },
                itemAdd: {
                    itemid: '',
                    unit: '',
                    purpose: '',
                    requested_by: '',
                    used_by: '',
                    remarks: '',
                },
                deliveryReceiptData: {
                    customer: '',
                    deliver_to: '',
                },

                // data relation
                customer: {},
                warehouse: {},
                items: {},
                users: {},
                logged: {},
                salesInvoice: [],

                // Datatable
                itemDeliveryData: [],
                search: '',
                key: 1,
                headersSalesInvoice: [{
                        text: 'Sales Invoice Code',
                        value: 'si_number'
                    }, {
                        text: 'Customer Name',
                        value: 'customer.customerName'
                    }, {
                        text: 'Invoice Date',
                        value: 'invoice_date'
                    },
                    {
                        text: '',
                        value: 'data-table-expand'
                    }
                ],
                headersExpanded: [{
                    text: 'Item Name',
                    value: 'item.item_name'
                }, {
                    text: 'Quantity',
                    value: 'qtyShipped'
                }, {
                    text: 'Unit',
                    value: 'unit'
                }],
                headers: [{
                        text: '',
                        value: 'item.si_number',
                        align: 'center',
                        filterable: false,
                        sortable: false
                    },
                    {
                        text: 'Item Code',
                        value: 'item.item_code'
                    }, {
                        text: 'Item Name',
                        value: 'item.item_name'
                    }, {
                        text: 'Qty Shipped',
                        value: 'qtyShipped'
                    }, {
                        text: 'UOM',
                        value: 'unit'
                    }, {
                        text: 'Actions',
                        value: 'actions',
                        align: 'right',
                        filterable: false,
                        sortable: false
                    }
                ],
                countItems: '0',
            }
        },
        created() {
            this.loadData();
            this.generatePONumber();
            this.loadLoggedUser();
        },
        computed: {
            isAddItemSalesInvoice: function () {
                return (this.selectedSalesInvoice.length == 0);
            }
        },
        methods: {
            inputOptions: async function (param) {
                if (param === 'manual') {
                    this.isVisibleAddForm = false
                    this.isSelectInvoice = false
                } else {
                    this.isSelectInvoice = true
                    this.isVisibleAddForm = true
                }
            },
            classRotate: function (param) {
                return param ? "rotate" : "";
            },
            isShowing: function () {
                this.isShow.colapse = !this.isShow.colapse;
            },
            generatePONumber() {
                const genPINumber = this.rndStr(5);
                this.deliveryReceiptData.sdr_number = genPINumber;
            },
            rndStr(len) {
                let blank = "";
                let text = "SDR.";
                let numbers = "1234567890";
                const current = new Date();
                const date = `${current.getFullYear()}${current.getMonth()+1}${current.getDate()}.`;
                for (let i = 0; i < len; i++) {
                    blank += numbers.charAt(Math.floor(Math.random() * numbers.length));
                }
                const makePO = text + date + blank;
                return makePO;
            },
            // Load loggedin user
            async loadLoggedUser() {
                const resp = await axios.get('/getUserLoggedIn');
                this.logged = resp.data;
                this.itemAdd.requested_by = resp.data.id;
            },
            // on CHange Attribute
            async onItemSelected(event) {
                const getId = event.target.value;
                this.$Progress.start();
                const getItemDataSelected = await axios.get('/api/inventory-item/' + getId);
                this.$Progress.finish();
                this.itemAdd = {
                    unit: getItemDataSelected.data.unit,
                    currentPrice: getItemDataSelected.data.price,
                    itemid: getItemDataSelected.data.id,
                }
            },
            async modifyItemList() {
                this.$Progress.start();
                console.log('Item :', this.itemModify);
                await axios.patch('/api/sdr/item-sales/' + this.itemModify.id, this.itemModify).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success modify item on Delivery Receipt table',
                    });
                    this.itemModify = {
                        itemid: '',
                        unit: '',
                        purpose: '',
                        requested_by: '',
                        used_by: '',
                        remarks: '',
                    }
                });
                this.loadData();
                this.isVisibleAddForm = false,
                    this.isVisibleModifyForm = true,
                    this.$Progress.finish();
            },
            async loadData() {
                this.$Progress.start();
                // Load data relation
                const resp = await axios.get('/api/customers');
                this.customer = resp.data;
                const respWarehouse = await axios.get('/api/warehouse');
                this.warehouse = respWarehouse.data;
                const itemDeliveryData = await axios.get('/api/sdr/item-sales');
                const itemDelivery = []
                itemDeliveryData.data.forEach(elm => {
                    if (elm.sdr_status == 1) {
                        itemDelivery.push(elm);
                    }
                });
                this.itemDeliveryData = itemDelivery;
                const itemsData = await axios.get('/api/inventory-item');
                this.items = itemsData.data;
                // SALES INVOICE
                const siNumber = []
                itemDeliveryData.data.forEach(elm => {
                    if (elm.si_number != "" && !siNumber.includes(elm.si_number)) {
                        siNumber.push(elm.si_number)
                    }
                });
                const salesInvoice = await axios.get('/api/sales/invoices', {
                    params: {
                        feature: 'deliveryReceipt',
                        si_number: siNumber
                    }
                });
                this.salesInvoice = salesInvoice.data;
                this.$Progress.finish();
            },
            async modifyItemPurchasing(id) {
                this.$Progress.start();
                const resp = await axios.get('/api/sdr/item-saless/' + id);
                this.isVisibleAddForm = true;
                this.isVisibleModifyForm = false;
                this.checkedItem = true;
                this.itemModify = resp.data;
                this.itemModify.item_name = resp.data.item.item_name;
                this.itemModify.used_by = resp.data.used_by.id;
                this.itemModify.itemid = resp.data.item.id;
                this.titleItemDescription = 'Modify Delivery Receipt Items';
                window.scrollTo(0, 0);
                this.$Progress.finish();
            },
            async addSelectedSalesInvoice() {
                this.$Progress.start();
                await axios.post('/api/sdr/item-sales/sales-invoice', this.selectedSalesInvoice).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add item on Delivery Receipt table',
                    });
                    this.selectedSalesInvoice = [];
                });
                this.loadData();
                this.$Progress.finish();
            },
            async addToList() {
                this.$Progress.start();
                await axios.post('/api/sdr/item-sales', this.itemAdd).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add item on Delivery Receipt table',
                    });
                    this.itemAdd = {
                        itemid: '',
                        unit: '',
                        purpose: '',
                        requested_by: '',
                        used_by: '',
                        remarks: '',
                    }
                });
                this.loadData();
                this.$Progress.finish();
            },
            async modifyItemPurchase() {
                this.$Progress.start();
                await axios.patch('/api/sdr/item-sales/' + this.itemAdd.id, this.itemAdd).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success modify item on Delivery Receipt table',
                    });
                    this.itemAdd = {
                        itemid: '',
                        unit: '',
                        purpose: '',
                        requested_by: '',
                        used_by: '',
                        remarks: '',
                    }
                });
                this.titleItemDescription = 'Add some items on Delivery Receipts.';
                this.isVisibleAddForm = false;
                this.isVisibleModifyForm = true;
                this.loadData();
                this.$Progress.finish();
            },
            async submitHandle() {
                this.$Progress.start();
                await axios.post('/api/delivery/receipt', this.deliveryReceiptData).then(response => {
                    this.loadData();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New Delivery Receipt',
                    });
                    this.deliveryReceiptData = {
                        customer: '',
                        order_date: '',
                        deliver_to: '',
                    };
                    const genPINumber = this.rndStr(5);
                    this.deliveryReceiptData.sdr_number = genPINumber;
                    this.$router.push('/delivery/receipt');
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.fail();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Something wrong.',
                        confirmButtonText: `Ok`,
                        html: `There is something wrong on my side. Please click ok to refresh this page and see what is it. If
                it still exist, you can contact our developer. <br><br>Error message: ` +
                            error,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                });
                // console.log('data click', [this.deliveryReceiptData, this.itemDeliveryData])
            },
            async deleteItemPurchasing(id) {
                const result = await Swal.fire({
                    title: 'Delete item Delivery Receipt?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    this.$Progress.start();
                    await axios.delete('/api/sdr/item-sales/' + id);
                    this.loadData();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current item.'
                    });
                    this.$Progress.finish();
                }
            },
        },
    }

</script>
<style scoped>
    .rotate {
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }

</style>
