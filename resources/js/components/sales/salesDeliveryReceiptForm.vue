<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Delivery Receipt
                                #{{deliveryReceiptData.sdr_number}}</h4>
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
                                            class="form-control form-control-default">
                                            <option value="" disabled>Select item:</option>
                                            <option v-for="items in items" :key="items.id" :value="items.id">
                                                {{items.item_name}}</option>
                                        </select>
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
                                        <input v-bind:disabled="checkedItem === false" type="text"
                                            v-model="itemModify.item_name" id="" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Quantity Shipped:</span>
                                        <input v-bind:disabled="checkedItem === false" type="number"
                                            v-model="itemModify.qtyShipped" placeholder="0" id="" min="0" max="10000"
                                            step="1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Unit:</span>
                                        <input v-bind:disabled="checkedItem === false" type="text"
                                            v-model="itemModify.unit" id="" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Remarks:</span>
                                        <textarea v-bind:disabled="checkedItem === false" v-model="itemModify.remarks"
                                            class="form-control" id="" cols="30" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <div class="row">
                                    <div class="col-12">
                                        <button v-on:click="modifyItemList" v-on:keyup.enter="modifyItemList" class="btn btn-success float-right btn-default btn-squared
                                                px-30" v-bind:disabled="checkedItem === false">Update item
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
                        <button @click="activeAddForm"
                            class="btn btn-success float-left btn-default btn-squared"><span><i
                                    class="fal fa-plus-circle"></i></span>&nbsp; Add item</button>
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details>
                                    </v-text-field>
                                </v-card-title>
                                <v-data-table :search="search" :loading="itemDeliveryData.length"
                                    loading-text="Loading... Please wait..." :headers="headers"
                                    :items="itemDeliveryData" :items-per-page="10" class="elevation-1">
                                    <template  v-slot:item.item.si_number="{item}">
                                        <section v-if="item.si_number">
                                            <i class="fas fa-file-invoice-dollar text-primary" data-bs-toggle="tooltip" data-bs-placement="top" :title="'Sales Invoice: '+item.si_number" ></i>  
                                        </section>
                                        <section v-else>
                                            <i class="fas fa-file-alt text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Manual Input"></i>
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
            <!-- Form add PO -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>PI number:</span>
                                    <input type="text" v-model="deliveryReceiptData.sdr_number" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Customer:</span>
                                    <select v-bind:disabled="checkedPI === false" v-model="deliveryReceiptData.customer"
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
                                    <input v-bind:disabled="checkedPI === false" type="date"
                                        v-model="deliveryReceiptData.sdr_date" class="form-control" placeholder="Brand">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Deliver to:</span>
                                    <select v-bind:disabled="checkedPI === false"
                                        v-model="deliveryReceiptData.deliver_to"
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
                                    <input type="text" v-bind:disabled="checkedPI === false"
                                        v-model="deliveryReceiptData.drivers" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Vehicle No:</span>
                                    <input type="text" v-bind:disabled="checkedPI === false"
                                        v-model="deliveryReceiptData.vehicle_no" class="form-control"
                                        placeholder="ex: BK 0000 ABC">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <span>Remarks:</span>
                                    <textarea v-bind:disabled="checkedPI === false" class="form-control"
                                        v-model="deliveryReceiptData.remarks" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <div class="row">
                                <div class="col-5 text-left">
                                    <div class="checkbox-theme-default custom-checkbox ">
                                        <input v-model="checkedPI" class="checkbox" type="checkbox" id="check-1">
                                        <label for="check-1">
                                            <span class="checkbox-text">Edit mode</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-7 text-right">
                                    <a :href="`/report/delivery/receipt/${deliveryReceiptData.id}`" class="btn btn-secondary float-right btn-warning btn-squared
                                                px-30 mx-2"><i class="fad fa-print"></i>&nbsp;Print</a>
                                    <button v-bind:disabled="checkedPI === false" v-on:click="submitHandle"
                                        v-on:keyup.enter="submitHandle" class="btn btn-primary float-right btn-default btn-squared
                                                px-30">Update</button>
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
            return `Delivery Receipt`;
        },
        data() {
            return {
                isShow: {
                    colapse: true,
                },
                updateOnly: true,
                checkedPI: false,
                checkedItem: false,
                // Page Info
                titleItemDescription: 'Items on this Delivery Receipt',
                isVisibleAddForm: true,
                isVisibleModifyForm: false,

                itemModify: {
                    itemid: '',
                    qtyShipped: '0',
                    unit: '',
                    requested_by: '',
                    used_by: '',
                    remarks: '',
                },
                itemAdd: {
                    itemid: '',
                    qtyShipped: '0',
                    unit: '',
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

                // Datatable
                itemDeliveryData: [],
                search: '',
                key: 1,
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
                        text: 'Qty Ordered',
                        value: 'qtyShipped'
                    },
                    {
                        text: 'Qty Shipped',
                        value: 'qtyShipped'
                    },
                    {
                        text: 'Unit',
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
            this.loadLoggedUser();
        },
        methods: {
            classRotate: function (param) {
                return param ? "rotate" : "";
            },
            isShowing: function () {
                this.isShow.colapse = !this.isShow.colapse;
            },
            // Load loggedin user
            async loadLoggedUser() {
                const resp = await axios.get('/getUserLoggedIn');
                this.logged = resp.data;
            },
            // on CHange Attribute
            async onItemSelected(event) {
                const getId = event.target.value;
                this.$Progress.start();
                const getItemDataSelected = await axios.get('/api/inventory-item/' + getId);
                this.itemAdd.itemid = getItemDataSelected.data.id;
                this.$Progress.finish();
                this.itemAdd = {
                    unit: getItemDataSelected.data.unit,
                    currentPrice: getItemDataSelected.data.price,
                    itemid: getItemDataSelected.data.id,
                }
            },
            activeAddForm() {
                window.scrollTo(0, 0);
                this.titleItemDescription = 'Add Delivery Receipt Items';
                this.isVisibleAddForm = false;
                this.isVisibleModifyForm = true;
            },
            async loadData() {
                this.$Progress.start();
                // Load data relation
                const resp = await axios.get('/api/customers');
                this.customer = resp.data;
                const respWarehouse = await axios.get('/api/warehouse');
                this.warehouse = respWarehouse.data;
                const itemDeliveryData = await axios.get('/api/sdr/item-sales/' + this.$route.params.sdr_number);
                this.itemDeliveryData = itemDeliveryData.data;
                const purchasingOrderData = await axios.get('/api/delivery/receipt/' + this.$route.params
                    .sdr_number);
                this.deliveryReceiptData = purchasingOrderData.data;
                const itemsData = await axios.get('/api/inventory-item');
                this.items = itemsData.data;
                const contactUsers = await axios.get('/api/contact-list');
                this.users = contactUsers.data;
                this.$Progress.finish();
            },
            async modifyItemPurchasing(id) {
                this.$Progress.start();
                const resp = await axios.get('/api/sdr/item-saless/' + id);
                this.checkedItem = true;
                this.itemModify = resp.data;
                this.itemModify.currentPrice = resp.data.item.price;
                this.itemModify.item_name = resp.data.item.item_name;
                this.itemModify.used_by = resp.data.used_by.id;
                this.itemModify.itemid = resp.data.item.id;
                this.titleItemDescription = 'Modify Delivery Receipt Items';
                window.scrollTo(0, 0);
                this.$Progress.finish();
            },
            async modifyItemList() {
                this.$Progress.start();
                await axios.patch('/api/sdr/item-sales/' + this.itemModify.id, this.itemModify).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success modify item on Delivery Receipt table',
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
                    this.checkedItem = false;
                });
                this.loadData();
                this.$Progress.finish();
            },
            async addToList() {
                this.$Progress.start();
                // console.log(this.itemAdd);
                await axios.post('/api/sdr/item-sales/' + this.$route.params.sdr_number, this.itemAdd).then(
                    response => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Success add item on Delivery Receipt table',
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
                this.checkedItem = false;
                this.isVisibleAddForm = true;
                this.isVisibleModifyForm = false;
                this.loadData();
                this.$Progress.finish();
            },
            async submitHandle() {
                this.$Progress.start();
                await axios.patch('/api/delivery/receipt/' + this.$route.params.sdr_number, this
                        .deliveryReceiptData)
                    .then(response => {
                        this.loadData();
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Success update Delivery Receipt information.',
                        });
                        this.checkedPI = false;
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
