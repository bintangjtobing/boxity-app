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
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Item name:</span>
                                        <select v-model="itemAdd.itemid" @change="onItemSelected($event)"
                                            class="form-control form-control-default" :disabled="isWriteForm">
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
                                        <span>Quantity Ordered:</span>
                                        <input type="number" v-model="itemAdd.qtyOrdered" @change="onQtyInc"
                                            @input="onQtyInc" placeholder="0" id="" min="0" max="10000" step="1"
                                            class="form-control" :disabled="isWriteForm">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Quantity Shipped:</span>
                                        <input type="number" v-model="itemAdd.qtyShipped" placeholder="0" id="" min="0"
                                            max="10000" step="1" class="form-control" :disabled="isWriteForm">
                                    </div>
                                </div>
                                <div class="col-lg-2">
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
                                <div class="col-lg-12">
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
                                        <button v-on:click="addToList" v-on:keyup.enter="addToList" class="btn btn-success float-right btn-default btn-squared
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
                                        <span>Quantity Ordered:</span>
                                        <input type="number" v-model="itemModify.qtyOrdered" @change="onModifyQtyInc"
                                            @input="onModifyQtyInc" placeholder="0" id="" min="0" max="10000" step="1"
                                            class="form-control" :disabled="isModifyForm">
                                    </div>
                                </div>
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
                                <div class="col-lg-12">
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
                                    <span>PI number:</span>
                                    <input type="text" v-model="purchaseInvoiceData.pi_number" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span>Supplier:</span>
                                    <select v-model="purchaseInvoiceData.supplier"
                                        class="form-control form-control-default">
                                        <option value="" disabled>Select supplier:</option>
                                        <option v-for="supplier in supplier" :key="supplier.id" :value="supplier.id">
                                            {{supplier.customerName}}</option>
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
                                        <option v-for="warehouse in warehouse" :key="warehouse.id"
                                            :value="warehouse.id">
                                            {{warehouse.warehouse_name}}</option>
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
            return `New Purchase Invoice`;
        },
        data() {
            return {
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
                purchaseInvoiceData: {
                    supplier: '',
                    deliver_to: '',
                },

                // data relation
                supplier: {},
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
                this.$Progress.start();
                await axios.patch('/api/pi/item-purchase/' + this.itemModify.id, this.itemModify).then(response => {
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
                    this.$Progress.finish();
                this.isModifyForm = false;
            },
            async loadData() {
                this.$Progress.start();
                // Load data relation
                const resp = await axios.get('/api/suppliers');
                this.supplier = resp.data;
                const respWarehouse = await axios.get('/api/warehouse');
                this.warehouse = respWarehouse.data;
                const itemPurchasingData = await axios.get('/api/pi/item-purchase');
                this.itemPurchasingData = itemPurchasingData.data;
                const itemsData = await axios.get('/api/inventory-item');
                this.items = itemsData.data;
                this.$Progress.finish();
            },
            async modifyItemPurchasing(id) {
                this.$Progress.start();
                const resp = await axios.get('/api/pi/item-purchases/' + id);
                this.checkedItem = true;
                this.itemModify = resp.data;
                this.itemModify.currentPrice = resp.data.item.price;
                this.itemModify.item_name = resp.data.item.item_name;
                this.itemModify.used_by = resp.data.used_by.id;
                this.itemModify.itemid = resp.data.item.id;
                this.titleItemDescription = 'Modify Purchase Invoice Items';
                this.isVisibleAddForm = true;
                this.isVisibleModifyForm = false;
                window.scrollTo(0, 0);
                this.$Progress.finish();
            },
            async addToList() {
                this.isWriteForm = true;
                this.$Progress.start();
                await axios.post('/api/pi/item-purchase', this.itemAdd).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add item on Purchase Invoice table',
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
                this.isWriteForm = false;
                this.$Progress.finish();
            },
            async modifyItemPurchase() {
                this.$Progress.start();
                await axios.patch('/api/pi/item-purchase/' + this.itemAdd.id, this.itemAdd).then(response => {
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
                this.$Progress.finish();
            },
            async submitHandle() {
                this.$Progress.start();
                await axios.post('/api/purchase/invoices', this.purchaseInvoiceData).then(response => {
                    this.loadData();
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
                // console.log('data click', [this.purchaseInvoiceData, this.itemPurchasingData])
            },
            async deleteItemPurchasing(id) {
                const result = await Swal.fire({
                    title: 'Delete item purchase invoice?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    this.$Progress.start();
                    await axios.delete('/api/pi/item-purchase/' + id);
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
