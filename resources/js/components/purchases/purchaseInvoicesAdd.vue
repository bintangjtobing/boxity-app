<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">New Purchase Invoice
                                <span>#{{purchaseInvoiceData.pi_number}}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
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
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span>Customer:</span>
                                        <selectSearch v-model="selected.customer" v-bind="{
                          datas: customersGet,
                          width: '100%',
                          name: 'company_name',
                          placeholder: 'Select Customer',
                          isDisable: isDisable.customerSelected,
                        }" @dataSelected="onCustomerSelected"></selectSearch>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span>To warehouse:</span>
                                        <selectSearch v-model="selected.warehouse" v-bind="{
                          datas: warehouse,
                          width: '100%',
                          name: 'warehouse_name',
                          isDisable: isDisable.warehouseSelected,
                          placeholder: 'Select Warehouse',
                        }" @dataSelected="onWarehouseSelected"></selectSearch>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span>Item name:</span>
                                        <selectSearch v-model="selected.item" v-bind="{
                          datas: items,
                          width: '100%',
                          name: 'item_name',
                          group: 'warehouse_code',
                          isDisable: isDisable.select,
                          placeholder: 'Select Item',
                        }" @dataSelected="onItemSelected"></selectSearch>
                                        <span class="float-right"><abbr title="Add new item">Don't see the item you're
                                                looking for?</abbr>
                                            <router-link :to="'/inventory-item'">
                                                Add new item here</router-link>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <!-- <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Quantity Ordered:</span>
                                        <input type="number" v-model="itemAdd.qtyOrdered" @change="onQtyInc"
                                            @input="onQtyInc" placeholder="0" id="" min="0" max="10000" step="1"
                                            class="form-control" :disabled="isWriteForm">
                                    </div>
                                </div> -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Quantity Shipped:</span>
                                        <input type="number" v-model="itemAdd.qtyShipped" placeholder="0" id="" min="0"
                                            max="10000" step="1" class="form-control" :disabled="isWriteForm">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Unit:</span>
                                        <input type="text" v-model="itemAdd.unit" id="" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Price:</span>
                                        <input type="number" v-model="itemAdd.currentPrice" @change="onPriceChange"
                                            @input="onPriceChange" class="form-control" min="0" max="9999999" step="250"
                                            :disabled="isWriteForm" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Line total:</span>
                                        <input type="number" v-model="itemAdd.price" class="form-control" min="0.00"
                                            max="10000.00" step="0.01" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Purpose:</span>
                                        <input type="text" v-model="itemAdd.purpose" id="" class="form-control"
                                            :disabled="isWriteForm">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Driver Name:</span>
                                        <input type="text" v-model="itemAdd.driver_name" placeholder="Driver's name"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Vehicle No:</span>
                                        <input type="text" v-model="itemAdd.driver_nopol" class="form-control"
                                            placeholder="ex: BK 0000 ABC">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span>Remarks:</span>
                                        <textarea v-model="itemAdd.remarks" class="form-control" id="" cols="30"
                                            rows="2" :disabled="isWriteForm">
                                            </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <div class="row">
                                    <div class="col-12">
                                        <button v-on:click="addToList" v-on:keyup.enter="addToList" class="btn btn-secondary-boxity float-right btn-default btn-squared
                                                px-30" :disabled="isWriteForm">Add to lists</button>
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
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span>Customer selected:</span>
                                        <input type="text" v-model="itemModify.customer" id="" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span>To Warehouse:</span>
                                        <input type="text" v-model="itemModify.warehouse" id="" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span>Item name:</span>
                                        <input type="text" v-model="itemModify.item_name" id="" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <!-- <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Quantity Ordered:</span>
                                        <input type="number" v-model="itemModify.qtyOrdered" @change="onModifyQtyInc"
                                            @input="onModifyQtyInc" placeholder="0" id="" min="0" max="10000" step="1"
                                            class="form-control" :disabled="isModifyForm">
                                    </div>
                                </div> -->
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Quantity Shipped:</span>
                                        <input type="number" v-model="itemModify.qtyShipped" placeholder="0" id=""
                                            min="0" max="10000" step="1" class="form-control" :disabled="isModifyForm">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Unit:</span>
                                        <input type="text" v-model="itemModify.unit" id="" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Price:</span>
                                        <input type="number" v-model="itemModify.currentPrice"
                                            @change="onModifyPriceChange" @input="onModifyPriceChange"
                                            class="form-control" min="0" max="9999999" step="250"
                                            :disabled="isModifyForm" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Line total:</span>
                                        <input type="number" v-model="itemModify.price" class="form-control" min="0.00"
                                            max="10000.00" step="0.01" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Purpose:</span>
                                        <input type="text" v-model="itemModify.purpose" id="" class="form-control"
                                            :disabled="isModifyForm">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Used by:</span>
                                        <select v-model="itemModify.used_by" class="form-control form-control-default"
                                            :disabled="isModifyForm">
                                            <option value="" disabled>Select user:</option>
                                            <option v-for="users in users" :key="users.id" :value="users.id">
                                                {{users.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Driver Name:</span>
                                        <input type="text" v-model="itemModify.driver_name" placeholder="Driver's name"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Vehicle No:</span>
                                        <input type="text" v-model="itemModify.driver_nopol" class="form-control"
                                            placeholder="ex: BK 0000 ABC">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span>Remarks:</span>
                                        <textarea v-model="itemModify.remarks" class="form-control" id="" cols="30"
                                            rows="2" :disabled="isModifyForm"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <div class="row">
                                    <div class="col-12">
                                        <button v-on:click="modifyItemList" v-on:keyup.enter="modifyItemList" class="btn btn-secondary-boxity float-right btn-default btn-squared
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
                                <v-data-table :search="search" :loading="itemPurchasingData.length"
                                    loading-text="Loading... Please wait..." :headers="headers"
                                    :items="itemPurchasingData" show-expand :expanded.sync="expanded"
                                    :items-per-page="10" class="elevation-1">
                                    <template v-slot:item.qtyShipped="{item}">
                                        {{item.qtyShipped|toDecimal}} / {{item.unit}}
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <a v-on:click="modifyItemPurchasing(item.id)" class="edit">
                                            <i class="fad fa-edit"></i></a>
                                        <a v-on:click="deleteItemPurchasing(item.id)" class="remove">
                                            <i class="fad fa-trash"></i></a>
                                    </template>
                                    <template v-slot:expanded-item="{ headers, item }">
                                        <td :colspan="headers.length">
                                            More info about <b>{{ item.item.item_name }}</b> <br>
                                            Delivered by <b>{{item.driver_name}}</b> with police number
                                            <b>{{item.driver_nopol}}</b>
                                        </td>
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
                                    <input type="text" v-model="purchaseInvoiceData.pi_number" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span>From supplier:</span>
                                    <select v-model="purchaseInvoiceData.supplier"
                                        class="form-control form-control-default">
                                        <option value="" disabled>Select supplier:</option>
                                        <option v-for="supplier in supplier" :key="supplier.id" :value="supplier.id">
                                            {{supplier.supplier_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Order date:</span>
                                    <input type="date" v-model="purchaseInvoiceData.order_date" class="form-control"
                                        placeholder="Brand">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Deliver to:</span>
                                    <select v-model="purchaseInvoiceData.deliver_to"
                                        class="form-control form-control-default">
                                        <option value="" disabled>Select warehouse:</option>
                                        <option v-for="warehouses in warehouses" :key="warehouses.id"
                                            :value="warehouses.id">
                                            {{warehouses.warehouse_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Driver Name:</span>
                                    <input type="text" v-model="purchaseInvoiceData.drivers" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Vehicle No:</span>
                                    <input type="text" v-model="purchaseInvoiceData.vehicle_no" class="form-control"
                                        placeholder="ex: BK 0000 ABC">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <span>Remarks:</span>
                                    <textarea class="form-control" v-model="purchaseInvoiceData.remarks" cols="30"
                                        rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <div class="row">
                                <div class="col-12">
                                    <button v-on:click="submitHandle" v-on:keyup.enter="submitHandle" class="btn btn-secondary-boxity float-right btn-default btn-squared
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
    import SelectSearch from "../item/selectSearch.vue";
    export default {
        components: {
            editor: Editor,
            selectSearch: SelectSearch,
        },
        title() {
            return `New Purchase Invoice`;
        },
        data() {
            return {
                expanded: [],
                isShow: {
                    colapse: true,
                },
                isWriteForm: false,
                isModifyForm: false,
                // Page Info
                titleItemDescription: 'Add some items on Purchase Invoices.',
                isVisibleAddForm: false,
                isVisibleModifyForm: true,
                itemModify: {
                    customerid: null,
                    warehouseid: null,
                    itemid: '',
                    qtyOrdered: '0',
                    unit: '',
                    currentPrice: '0',
                    price: '0',
                    purpose: '',
                    requested_by: '',
                    used_by: '',
                    remarks: '',
                },
                itemAdd: {
                    customerid: null,
                    warehouseid: null,
                    itemid: null,
                    qtyOrdered: '0',
                    unit: '',
                    currentPrice: '0',
                    price: '0',
                    purpose: '',
                    requested_by: '',
                    used_by: '',
                    remarks: '',
                },
                purchaseInvoiceData: {
                    supplier: '',
                    deliver_to: '',
                },

                // data relation
                supplier: {},
                customer: {},
                warehouse: {},
                warehouses: {},
                items: {},
                users: {},
                logged: {},

                // Datatable
                itemPurchasingData: [],
                search: '',
                key: 1,
                headers: [{
                        text: 'Item Code',
                        value: 'item.item_code'
                    }, {
                        text: 'Item Name',
                        value: 'item.item_name'
                    }, {
                        text: 'Warehouse',
                        value: 'warehouse.warehouse_name'
                    }, {
                        text: 'Customer',
                        value: 'customer.company_name'
                    },
                    // {
                    //     text: 'Qty Ordered',
                    //     value: 'qtyOrdered'
                    // },
                    {
                        text: 'Qty Shipped / UOM',
                        value: 'qtyShipped'
                    }, {
                        text: 'Actions',
                        value: 'actions',
                        align: 'right',
                        filterable: false,
                        sortable: false
                    }
                ],
                countItems: '0',
                selected: {
                    item: "",
                    usedBy: "",
                    customer: "",
                },
                customersGet: {},
                isDisable: {
                    select: true,
                    input: true,
                    warehouseSelected: true,
                    customerSelected: false,
                },
            }
        },
        created() {
            this.loadData();
            this.generatePONumber();
            this.loadLoggedUser();
            this.loadCustomers();
        },
        beforeMount(){                                    
            if(!this.$store.getters.getPermissions.includes('CreatePurchaseInvoice')){
                this.$router.push('/') 
            }            
        },
        methods: {
            classRotate: function (param) {
                return param ? "rotate" : "";
            },
            isShowing: function () {
                this.isShow.colapse = !this.isShow.colapse;
            },
            generatePONumber() {
                const genPINumber = this.rndStr(5);
                this.purchaseInvoiceData.pi_number = genPINumber;
            },
            rndStr(len) {
                let blank = "";
                let text = "PI.";
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
            async onItemSelected(value) {
                console.log('item id selected: ', value.id);
                const getId = value.id;
                const getItemDataSelected = await axios.get('/api/inventory-item/' + getId);
                this.itemAdd = {
                    unit: getItemDataSelected.data.unit,
                    currentPrice: getItemDataSelected.data.price,
                    itemid: getItemDataSelected.data.id,
                    ...this.itemAdd
                }
                this.selected.item = `[${value.warehouse_code}][${value.item_code}] - ${value.item_name}`;
            },
            async onWarehouseSelected(param) {
                const idWarehouseGet = param.id;
                const getWarehouseDataSelected = await axios.get('/api/warehouse/' + idWarehouseGet);
                this.itemAdd.warehouseid = getWarehouseDataSelected.data.id;
                console.log('warehouse id selected: ', this.itemAdd.warehouseid);
                this.itemModify.warehouseid = param.id;
                this.selected.warehouse = param.warehouse_name;
                this.purchaseInvoiceData.deliver_to = param.id;
                this.isDisable.select = false;
                const itemDataGet = await axios.get('/api/inventory-item/w/' + param.id + '/' + this.itemAdd
                    .customerid);
                this.items = itemDataGet.data;
            },
            async onCustomerSelected(param) {
                const idCustGet = param.id;
                const getCustDataSelected = await axios.get('/api/customers/' + idCustGet);
                this.itemAdd = {
                    customerid: getCustDataSelected.data.id,
                }
                // console.log('customer id selected: ', this.itemAdd.customerid);
                // console.log(this.itemAdd.customerid);
                this.selected.customer = param.company_name;
                this.purchaseInvoiceData.customer = param.id;
                this.isDisable.warehouseSelected = false;
                const warehouseData = await axios.get('/api/warehouse-customers/' + param.id);
                this.warehouse = warehouseData.data;
                // console.log(param);
            },
            async addToList() {
                // console.log(this.itemAdd);
                this.isWriteForm = true;
                this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/pi/item-purchase', this.itemAdd).then(response => {
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add item on Purchase Invoice table',
                    });
                    this.selected = {
                        warehouse: '',
                        item: '',
                    }
                    // this.isDisable = {
                    //     customerSelected: true,
                    // }
                    this.itemAdd = {
                        itemid: '',
                        qtyOrdered: '0',
                        unit: '',
                        currentPrice: '0',
                        price: '0',
                        purpose: '',
                        requested_by: '',
                        used_by: '',
                        remarks: '',
                    }
                });
                this.loadData();
                this.isWriteForm = false;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            onQtyInc() {
                this.itemAdd.price = parseInt(this.itemAdd.qtyOrdered) * parseInt(this.itemAdd.currentPrice);
            },
            onPriceChange() {
                this.itemAdd.price = parseInt(this.itemAdd.qtyOrdered) * parseInt(this.itemAdd.currentPrice);
            },
            onModifyQtyInc() {
                this.itemModify.price = parseInt(this.itemModify.qtyOrdered) * parseInt(this.itemModify.currentPrice);
            },
            onModifyPriceChange() {
                this.itemModify.price = parseInt(this.itemModify.qtyOrdered) * parseInt(this.itemModify.currentPrice);
            },
            async modifyItemList() {
                this.isModifyForm = true;
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/pi/item-purchase/' + this.itemModify.id, this.itemModify).then(response => {
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success modify item on Purchase Invoice table',
                    });
                    this.itemModify = {
                        itemid: '',
                        qtyOrdered: '0',
                        unit: '',
                        currentPrice: '0',
                        price: '0',
                        purpose: '',
                        requested_by: '',
                        used_by: '',
                        remarks: '',
                    }
                });
                this.loadData();
                this.isVisibleAddForm = false,
                    this.isVisibleModifyForm = true,
                    // this.$Progress.finish();
                    this.$isLoading(false);
                this.isModifyForm = false;
            },
            async loadCustomers() {
                const respCust = await axios.get("/api/customers");
                this.customersGet = respCust.data;
            },
            async loadData() {
                // this.$Progress.start();
                this.$isLoading(true);
                // Load data relation
                const resp = await axios.get('/api/suppliers');
                this.supplier = resp.data;
                const itemPurchasingData = await axios.get('/api/pi/item-purchase');
                this.itemPurchasingData = itemPurchasingData.data;
                const itemsData = await axios.get('/api/inventory-item');
                this.items = itemsData.data;
                const warehouseDatas = await axios.get('/api/warehouse');
                this.warehouses = warehouseDatas.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async modifyItemPurchasing(id) {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/pi/item-purchases/' + id);
                this.$isLoading(false);
                this.checkedItem = true;
                this.itemModify = resp.data;
                this.itemModify.currentPrice = resp.data.item.price;
                this.itemModify.item_name = resp.data.item.item_name;
                this.itemModify.warehouse = resp.data.warehouse.warehouse_name;
                this.itemModify.customer = resp.data.customer.company_name;
                if (this.itemModify.used_by) {
                    this.itemModify.used_by = resp.data.used_by.id;
                }
                this.itemModify.itemid = resp.data.item.id;
                this.titleItemDescription = 'Modify Purchase Invoice Items';
                this.isVisibleAddForm = true;
                this.isVisibleModifyForm = false;
                window.scrollTo(0, 0);
                // this.$Progress.finish();
            },
            async modifyItemPurchase() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/pi/item-purchase/' + this.itemAdd.id, this.itemAdd).then(response => {
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success modify item on Purchase Invoice table',
                    });
                    this.itemAdd = {
                        itemid: '',
                        qtyOrdered: '0',
                        unit: '',
                        currentPrice: '0',
                        price: '0',
                        purpose: '',
                        requested_by: '',
                        used_by: '',
                        remarks: '',
                    }
                });
                this.titleItemDescription = 'Add some items on Purchase Invoices.';
                this.isVisibleAddForm = false;
                this.isVisibleModifyForm = true;
                this.loadData();
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/purchase/invoices', this.purchaseInvoiceData).then(response => {
                    this.loadData();
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New Purchase Invoice',
                    });
                    this.purchaseInvoiceData = {
                        supplier: '',
                        order_date: '',
                        deliver_to: '',
                    };
                    const genPINumber = this.rndStr(5);
                    this.purchaseInvoiceData.pi_number = genPINumber;
                    this.$router.push('/purchase/invoices');
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }).catch(error => {
                    this.$Progress.fail();
                    document.getElementById('failding').play();
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
                // console.log('data click', [this.purchaseInvoiceData, this.itemPurchasingData])
            },
            async deleteItemPurchasing(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete item purchase invoice?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('/api/pi/item-purchase/' + id);
                    this.loadData();
                    document.getElementById('ding').play();

                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current item.'
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
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
