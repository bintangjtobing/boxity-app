<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">New Sales Invoice
                                <span>#{{salesInvoiceData.si_number}}</span></h4>
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
                                <div class="col-lg">
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
                                <div class="col-lg-3" v-show="formSO">
                                    <div class="form-group">
                                        <span>Sales Order:</span>
                                        <selectSearch v-model="selected.salesOrder" v-bind="{
                                            datas: salesOrder,
                                            width: '100%',
                                            name: 'so_number',
                                            isDisable: isDisable.SalesOrderSelected,
                                            placeholder: 'Select Warehouse',
                                        }" @dataSelected="onSalesOrderSelected"></selectSearch>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>From warehouse:</span>
                                        <selectSearch v-model="selected.warehouse" v-bind="{
                                            datas: warehouse,
                                            width: '100%',
                                            name: 'warehouse_name',
                                            isDisable: isDisable.warehouseSelected,
                                            placeholder: 'Select Warehouse',
                                        }" @dataSelected="onWarehouseSelected"></selectSearch>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Item name:</span>
                                        <selectSearch v-model="selected.item" v-bind="{
                                            datas: items,
                                            width: '100%' ,
                                            name: 'item_name',
                                            group: 'item_code',
                                            placeholder: 'Select Item',
                                            isDisable: isDisable.select,
                                        }" @dataSelected="onItemSelected" />
                                        <span class="float-right"><abbr title="Add new item">Don't see the item you're
                                                looking for?</abbr>
                                            <router-link :to="'/inventory-item'">
                                                Add new item here</router-link>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox-theme-default custom-checkbox">
                                <input v-model="formSO" class="checkbox" type="checkbox" id="check-1" />
                                <label for="check-1">
                                    <span class="checkbox-text">Need Sales Order?</span>
                                </label>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Weight In:</span>
                                        <input type="number" v-model="itemAdd.weightIn" placeholder="0" id="" min="0"
                                            max="10000" step="1" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Weight Out:</span>
                                        <input type="number" v-model="itemAdd.weightOut" placeholder="0" id="" min="0"
                                            @change="calculateNettWeight" @input="calculateNettWeight" max="10000"
                                            step="1" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <!-- <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Qty Out <i class="far fa-sign-out"></i>:</span>
                                        <span v-show="qtyItem != null"
                                            id="qtyItem">{{ "(Quantity Item = " + qtyItem + ")" }}</span>
                                        <input type="number" :disabled="isWriteForm" v-model="itemAdd.qtyShipped"
                                            @change="onQtyInc" @input="onQtyInc" placeholder="0" id="" min="0"
                                            max="10000" step="1" class="form-control">
                                        <span v-show="isShow.qty" id="qty">Can't be more than quantity items</span>
                                    </div>
                                </div> -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Quantity Shipped/Nett Weight:</span> <br>
                                        <span v-show="qtyItem!= null" id="qtyItem"
                                            style="color: #f06532;">{{ "(Quantity Item = " + qtyItem + ")" }}</span>
                                        <input type="number" v-model="itemAdd.qtyShipped" placeholder="0" id="" min="0"
                                            max="10000" step="1" class="form-control" />
                                        <span v-show="isShow.qty" id="qty">Can't be more than quantity items</span>
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
                                        <input type="number" :disabled="isWriteForm" v-model="itemAdd.currentPrice"
                                            @change="onPriceChange" @input="onPriceChange" class="form-control" min="0"
                                            max="9999999" step="250" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Line total:</span>
                                        <input type="number" v-model="itemAdd.price" :disabled="isWriteForm"
                                            class="form-control" min="0.00" max="10000.00" step="0.01" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
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
                                        <textarea v-model="itemAdd.remarks" :disabled="isWriteForm" class="form-control"
                                            id="" cols="30" rows="2"></textarea>
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
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Customer selected:</span>
                                        <input type="text" v-model="itemModify.customer" id="" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Sales Order:</span>
                                        <input type="text" v-model="itemModify.sales_related" id="" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>From Warehouse:</span>
                                        <input type="text" v-model="itemModify.warehouse" id="" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
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
                                        <span>Weight In:</span>
                                        <input type="number" v-model="itemModify.weightIn" placeholder="0" id="" min="0"
                                            max="10000" step="1" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Weight Out:</span>
                                        <input type="number" v-model="itemModify.weightOut" placeholder="0" id=""
                                            min="0" @change="calculateModifNettWeight" @input="calculateModifNettWeight"
                                            max="10000" step="1" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <!-- <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Qty Out <i class="far fa-sign-out"></i>:</span>
                                        <span v-show="qtyItem != null"
                                            id="qtyItem">{{ "(Quantity Item = " + qtyItem + ")" }}</span>
                                        <input type="number" v-model="itemModify.qtyShipped" @change="onQtyInc"
                                            @input="onQtyInc" placeholder="0" id="" min="0" max="10000" step="1"
                                            class="form-control">
                                        <span v-show="isShow.qty" id="qty">Can't be more than quantity items</span>
                                    </div>
                                </div> -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Quantity Shipped/Nett Weight:</span>
                                        <input type="number" v-model="itemModify.qtyShipped" placeholder="0" id=""
                                            min="0" max="10000" step="1" class="form-control" />
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
                                <v-data-table show-expand :expanded.sync="expanded" :search="search"
                                    loading-text="Data not found..." :headers="headers" :items="itemSalesingData"
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
                                            More info about <strong>{{ item.item.item_name }}</strong> <br>
                                            Delivered by <strong>{{item.driver_name}}</strong> with police number
                                            <strong>{{item.driver_nopol}}</strong>
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
                                    <span>SI number:</span>
                                    <input type="text" v-model="salesInvoiceData.si_number" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span>Customer:</span>
                                    <select v-model="salesInvoiceData.customer"
                                        class="form-control form-control-default">
                                        <option value="" disabled>Select customer:</option>
                                        <option v-for="customer in customer" :key="customer.id" :value="customer.id">
                                            {{customer.company_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Invoice date:</span>
                                    <input type="date" v-model="salesInvoiceData.invoice_date" class="form-control"
                                        placeholder="Brand">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Driver Name:</span>
                                    <input type="text" v-model="salesInvoiceData.drivers" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Vehicle No:</span>
                                    <input type="text" v-model="salesInvoiceData.vehicle_no" class="form-control"
                                        placeholder="ex: BK 0000 ABC">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <span>Remarks:</span>
                                    <textarea class="form-control" v-model="salesInvoiceData.remarks" cols="30"
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
            'selectSearch': SelectSearch,
        },
        title() {
            return `New Sales Invoice`;
        },
        data() {
            return {
                formSO: true,
                expanded: [],
                isWriteForm: false,
                isShow: {
                    qtyItem: false,
                    colapse: true,
                    qty: false
                },
                selected: {
                    item: "",
                    usedBy: "",
                    customer: "",
                    salesOrder: ""
                },
                // Page Info
                titleItemDescription: 'Add some items on Sales Invoices.',
                isVisibleAddForm: false,
                isVisibleModifyForm: true,
                itemModify: {
                    itemid: '',
                    qtyShipped: '0',
                    unit: '',
                    currentPrice: '0',
                    price: '0',
                    remarks: '',
                },
                itemAdd: {
                    customerid: null,
                    warehouseid: null,
                    itemid: '',
                    qtyShipped: '0',
                    unit: '',
                    currentPrice: '0',
                    price: '0',
                    remarks: '',
                },
                salesInvoiceData: {
                    customer: '',
                },

                // data relation
                customer: {},
                warehouse: {},
                items: {},
                users: {},
                logged: {},
                salesOrder: {},

                // Datatable
                itemSalesingData: [],
                search: '',
                key: 1,
                qtyItem: null,
                headers: [{
                        text: 'Item Code',
                        value: 'item.item_code'
                    }, {
                        text: 'Item Name',
                        value: 'item.item_name'
                    },
                    {
                        text: 'Qty Sent',
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
                customersGet: {},
                isDisable: {
                    select: true,
                    input: true,
                    warehouseSelected: true,
                    customerSelected: false,
                    SalesOrderSelected: true
                },
                itemCode: []
            }
        },
        beforeMount() {
            if (!this.$store.getters.getPermissions.includes('CreateSalesInvoice')) {
                this.$router.push('/')
            }
        },
        created() {
            this.loadData();
            this.generatePONumber();
            this.loadLoggedUser();
            this.loadCustomers();
        },
        methods: {
            async onSalesOrderSelected(param) {
                this.selected.salesOrder = param.so_number;
                this.itemAdd.so_number = param.so_number;
                const warehouseId = [];
                param.items.forEach(elm => {
                    if (elm.qtyOrdered > elm.qtyShipped && ((this.itemCode.includes(elm.item_code) ===
                            false) || (arehouseId.includes(elm.warehouseId) === false))) {
                        this.itemCode.push(elm.item_code)
                        warehouseId.push(elm.warehouseId)
                    }
                })
                const getWharehouse = await axios.get(`/api/warehouse?id=${warehouseId}`);
                this.warehouse = getWharehouse.data;
            },
            calculateNettWeight() {
                this.itemAdd.qtyShipped = parseInt(this.itemAdd.weightIn) - parseInt(this.itemAdd.weightOut);
            },
            calculateModifNettWeight() {
                this.itemModify.qtyShipped = parseInt(this.itemModify.weightIn) - parseInt(this.itemModify.weightOut);
            },
            classRotate: function (param) {
                return param ? "rotate" : "";
            },
            isShowing: function () {
                this.isShow.colapse = !this.isShow.colapse;
            },
            generatePONumber() {
                const genPINumber = this.rndStr(5);
                this.salesInvoiceData.si_number = genPINumber;
            },
            async loadCustomers() {
                const respCust = await axios.get("/api/customers");
                this.customersGet = respCust.data;
            },
            rndStr(len) {
                let blank = "";
                let text = "SI.";
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
                console.log(event)
                this.itemAdd = {
                    ...this.itemAdd,
                    unit: event.unit,
                    currentPrice: event.price,
                    itemid: event.id,
                    item_code: event.item_code
                }
                this.selected.item = `[${event.item_code}] - ${event.item_name}`;
                this.qtyItem = event.qty
            },
            async onWarehouseSelected(param) {
                console.log('warehouse param: ', param);
                this.itemAdd.warehouseid = param.id;
                this.itemModify.warehouseid = param.id;
                this.selected.warehouse = param.warehouse_name;
                var url = "/api/inventory-item/w/" + param.id + "/" + this.itemAdd.customerid
                console.log(this.itemCode)
                if (this.itemCode.length > 0) {
                    url = `/api/inventory-item/warehouse/${param.id}?id=${this.itemCode}`
                }
                const itemDataGet = await axios.get(url);
                this.items = itemDataGet.data;
                this.isDisable.select = false;
            },
            async onCustomerSelected(param) {
                const getSalesOrder = await axios.get('/api/sales/order/customer/' + param.id);
                const warehouseData = await axios.get(
                    "/api/warehouse-customers/" + param.id
                );
                this.warehouse = warehouseData.data;
                this.salesOrder = getSalesOrder.data;
                this.itemAdd.customerid = param.id
                this.selected.customer = param.company_name;
                this.salesInvoiceData.customer = param.id;
                this.isDisable.SalesOrderSelected = false;
                this.isDisable.warehouseSelected = false;
            },
            onQtyInc() {
                this.isShow.qty = this.itemAdd.qtyShipped > this.qtyItem ? true : false;
                this.itemAdd.price = parseInt(this.itemAdd.qtyShipped) * parseInt(this.itemAdd.currentPrice);
            },
            onPriceChange() {
                this.itemAdd.price = parseInt(this.itemAdd.qtyShipped) * parseInt(this.itemAdd.currentPrice);
            },
            onModifyQtyInc() {
                this.isShow.qty = this.itemAdd.qtyShipped > this.qtyItem ? true : false;
                this.itemModify.price = parseInt(this.itemModify.qtyShipped) * parseInt(this.itemModify.currentPrice);
            },
            onModifyPriceChange() {
                this.itemModify.price = parseInt(this.itemModify.qtyShipped) * parseInt(this.itemModify.currentPrice);
            },
            async modifyItemList() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/si/item-sales/' + this.itemModify.id, this.itemModify).then(response => {
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success modify item on Sales Invoice table',
                    });
                    this.itemModify = {
                        itemid: '',
                        qtyShipped: '0',
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
                const resp = await axios.get('/api/customers');
                this.customer = resp.data;
                const itemSalesingData = await axios.get('/api/si/item-sales');
                this.itemSalesingData = itemSalesingData.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async modifyItemPurchasing(id) {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/si/item-saless/' + id);
                console.log(resp)
                this.checkedItem = true;
                this.itemModify = resp.data;
                this.itemModify.currentPrice = resp.data.item.price;
                this.itemModify.item_name = `[${resp.data.item.item_code}] - ${resp.data.item.item_name}`;
                this.itemModify.warehouse = resp.data.warehouse.warehouse_name;
                this.itemModify.customer = resp.data.customer.company_name;
                this.itemModify.sales_related = resp.data.sales_related;

                if (this.itemModify.used_by) {
                    this.itemModify.used_by = resp.data.used_by.id;
                }
                this.itemModify.itemid = resp.data.item.id;
                this.titleItemDescription = 'Modify Sales Invoice Items';
                this.isVisibleAddForm = true;
                this.isVisibleModifyForm = false;
                window.scrollTo(0, 0);
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async addToList() {
                this.isWriteForm = true;
                // this.$Progress.start();
                this.$isLoading(true);
                console.log(this.itemAdd)
                await axios.post('/api/si/item-sales', this.itemAdd).then(response => {
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add item on Sales Invoice table',
                    });
                    this.itemAdd = {
                        itemid: '',
                        qtyShipped: '0',
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
                this.selected = {
                    item: "",
                    usedBy: "",
                    customer: "",
                    salesOrder: ""
                }
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async modifyItemPurchase() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/si/item-sales/' + this.itemAdd.id, this.itemAdd).then(response => {
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success modify item on Sales Invoice table',
                    });
                    this.itemAdd = {
                        itemid: '',
                        qtyShipped: '0',
                        unit: '',
                        currentPrice: '0',
                        price: '0',
                        purpose: '',
                        requested_by: '',
                        used_by: '',
                        remarks: '',
                    }
                });
                this.titleItemDescription = 'Add some items on Sales Invoices.';
                this.isVisibleAddForm = false;
                this.isVisibleModifyForm = true;
                this.loadData();
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/sales/invoices', this.salesInvoiceData).then(response => {
                    this.loadData();
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New Sales Invoice',
                    });
                    this.salesInvoiceData = {
                        customer: '',
                        invoice_date: '',
                    };
                    const genPINumber = this.rndStr(5);
                    this.salesInvoiceData.si_number = genPINumber;
                    this.$router.push('/sales/invoices');
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
                // console.log('data click', [this.salesInvoiceData, this.itemSalesingData])
            },
            async deleteItemPurchasing(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete item Sales Invoice?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('/api/si/item-sales/' + id);
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

    #qtyItem {
        color: #ebdc31;
    }

    #qty {
        color: #f44444;
    }

    #qtyItem {
        color: #ebdc31;
    }

    #qty {
        color: #f44444;
    }

    #qtyItem {
        color: #ebdc31;
    }

    #qty {
        color: #f44444;
    }

</style>
