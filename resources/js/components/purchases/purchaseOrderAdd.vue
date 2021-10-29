<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">New Purchase Order
                                <span>#{{purchaseOrderData.po_number}}</span></h4>
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
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Quantity:</span>
                                        <input type="number" v-model="itemAdd.qtyOrdered" @change="onQtyInc"
                                            @input="onQtyInc" placeholder="0" id="" min="0" max="10000" step="1"
                                            class="form-control">
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
                                            @input="onPriceChange" class="form-control" min="0" max="9999999"
                                            step="250" />
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
                                        <input type="text" v-model="itemAdd.purpose" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Used by:</span>
                                        <select v-model="itemAdd.used_by" class="form-control form-control-default">
                                            <option value="" disabled>Select user:</option>
                                            <option v-for="users in users" :key="users.id" :value="users.id">
                                                {{users.name}}</option>
                                        </select>
                                    </div>
                                </div>
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
                                        <button v-on:click="addToList" v-on:keyup.enter="addToList" class="btn btn-secondary-boxity float-right btn-default btn-squared
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
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Quantity:</span>
                                        <input type="number" v-model="itemModify.qtyOrdered" @change="onModifyQtyInc"
                                            @input="onModifyQtyInc" placeholder="0" id="" min="0" max="10000" step="1"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3">
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
                                            class="form-control" min="0" max="9999999" step="250" />
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
                                        <input type="text" v-model="itemModify.purpose" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Used by:</span>
                                        <select v-model="itemModify.used_by" class="form-control form-control-default">
                                            <option value="" disabled>Select user:</option>
                                            <option v-for="users in users" :key="users.id" :value="users.id">
                                                {{users.name}}</option>
                                        </select>
                                    </div>
                                </div>
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
                                    :items="itemPurchasingData" :items-per-page="10" class="elevation-1">
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
                                    <span>PO number:</span>
                                    <input type="text" v-model="purchaseOrderData.po_number" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span>Supplier:</span>
                                    <select v-model="purchaseOrderData.supplier"
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
                                    <input type="date" v-model="purchaseOrderData.order_date" class="form-control"
                                        placeholder="Brand">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Deliver to:</span>
                                    <select v-model="purchaseOrderData.deliver_to"
                                        class="form-control form-control-default">
                                        <option value="" disabled>Select warehouse:</option>
                                        <option v-for="warehouse in warehouse" :key="warehouse.id"
                                            :value="warehouse.id">
                                            {{warehouse.warehouse_name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <span>Remarks:</span>
                                    <textarea class="form-control" v-model="purchaseOrderData.remarks" cols="30"
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
            'editor': Editor,
            selectSearch: SelectSearch,
        },
        title() {
            return `New Purchase Order`;
        },
        data() {
            return {
                isShow: {
                    colapse: true,
                },
                // Page Info
                titleItemDescription: 'Add some items on Purchase Orders.',
                isVisibleAddForm: false,
                isVisibleModifyForm: true,
                itemModify: {
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
                purchaseOrderData: {
                    supplier: '',
                    deliver_to: '',
                },

                // data relation
                supplier: {},
                customersGet: {},
                warehouse: {},
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
                        text: 'Qty Ordered',
                        value: 'qtyOrdered'
                    },
                    {
                        text: 'Qty Shipped',
                        value: 'qtyShipped'
                    },
                    {
                        text: 'Price per item',
                        value: 'item.price'
                    }, {
                        text: 'Total Price',
                        value: 'price'
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
                    warehouse: '',
                    item: "",
                    usedBy: "",
                    customer: "",
                },
                isDisable: {
                    select: true,
                    input: true,
                    warehouseSelected: true,
                    customerSelected: false,
                },
            }
        },
        beforeMount() {
            if (!this.$store.getters.getPermissions.includes('CreatePurchaseOrder')) {
                this.$router.push('/')
            }
        },
        created() {
            this.loadData();
            this.generatePONumber();
            this.loadLoggedUser();
        },
        methods: {
            classRotate: function (param) {
                return param ? "rotate" : "";
            },
            isShowing: function () {
                this.isShow.colapse = !this.isShow.colapse;
            },
            generatePONumber() {
                const genPONumber = this.rndStr(5);
                this.purchaseOrderData.po_number = genPONumber;
            },
            rndStr(len) {
                let blank = "";
                let text = "PO.";
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
                // this.$Progress.start();
                this.$isLoading(true);
                const getItemDataSelected = await axios.get('/api/inventory-item/' + getId);
                // this.$Progress.finish();
                this.$isLoading(false);
                this.itemAdd = {
                    unit: getItemDataSelected.data.unit,
                    currentPrice: getItemDataSelected.data.price,
                    itemid: getItemDataSelected.data.id,
                }
            },
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
                this.purchaseOrderData.deliver_to = param.id;
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
                this.purchaseOrderData.customer = param.id;
                this.isDisable.warehouseSelected = false;
                const warehouseData = await axios.get('/api/warehouse-customers/' + idCustGet);
                this.warehouse = warehouseData.data;
                // console.log(param);
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
                // this.$Progress.start();
                this.$isLoading(true);
                // console.log('Item :', this.itemModify);
                await axios.patch('/api/po/item-purchase/' + this.itemModify.id, this.itemModify).then(response => {
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success modify item on purchase order table',
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
            },
            async loadData() {
                // this.$Progress.start();
                this.$isLoading(true);
                // Load data relation
                const resp = await axios.get('/api/suppliers');
                this.supplier = resp.data;
                const respCust = await axios.get("/api/customers");
                this.customersGet = respCust.data;
                const respWarehouse = await axios.get('/api/warehouse');
                this.warehouse = respWarehouse.data;
                const itemPurchasingData = await axios.get('/api/po/item-purchase');
                this.itemPurchasingData = itemPurchasingData.data;
                const itemsData = await axios.get('/api/inventory-item');
                this.items = itemsData.data;
                const contactUsers = await axios.get('/api/contact-list');
                this.users = contactUsers.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async modifyItemPurchasing(id) {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/po/item-purchases/' + id);
                this.checkedItem = true;
                this.itemModify = resp.data;
                this.itemModify.currentPrice = resp.data.item.price;
                this.itemModify.item_name = resp.data.item.item_name;
                this.itemModify.used_by = resp.data.used_by.id;
                this.itemModify.itemid = resp.data.item.id;
                this.titleItemDescription = 'Modify Purchase Order Items';
                this.isVisibleAddForm = true;
                this.isVisibleModifyForm = false;
                window.scrollTo(0, 0);
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async addToList() {
                // this.$Progress.start();
                // console.log(this.itemAdd)
                this.$isLoading(true);
                await axios.post('/api/po/item-purchase', this.itemAdd).then(response => {
                    // console.log(response)
                    document.getElementById('ding').play();
                    this.purchaseOrderData.customerid = response.data.customerId;
                    console.log(this.purchaseOrderData.customerid);
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add item on purchase order table',
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
                this.loadData();
                this.$isLoading(false);
                // this.$Progress.finish();
            },
            async modifyItemPurchase() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/po/item-purchase/' + this.itemAdd.id, this.itemAdd).then(response => {
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success modify item on purchase order table',
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
                this.titleItemDescription = 'Add some items on Purchase Orders.';
                this.isVisibleAddForm = false;
                this.isVisibleModifyForm = true;
                this.loadData();
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/purchase/order', this.purchaseOrderData).then(response => {
                    this.loadData();
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New purchase order',
                    });
                    this.purchaseOrderData = {
                        supplier: '',
                        order_date: '',
                        deliver_to: '',
                    };
                    const genPONumber = this.rndStr(5);
                    this.purchaseOrderData.po_number = genPONumber;
                    this.$router.push('/purchase/order');
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
                // console.log('data click', [this.purchaseOrderData, this.itemPurchasingData])
            },
            async deleteItemPurchasing(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete item purchase order?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('/api/po/item-purchase/' + id);
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
