<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Add New Purchase Order</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>PO number:</span>
                                        <input type="text" v-model="purchaseOrderData.item_code" readonly
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <span>Supplier:</span>
                                        <select v-model="purchaseOrderData.supplier"
                                            class="form-control form-control-default">
                                            <option value="" disabled>Select supplier:</option>
                                            <option v-for="supplier in supplier" :key="supplier.id"
                                                :value="supplier.id">
                                                {{supplier.customerName}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <div class="form-row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <span>Order date:</span>
                                            <input type="date" v-model="purchaseOrderData.order_date"
                                                class="form-control" placeholder="Brand">
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
                            </div>
                            <div class="form-group my-2">
                                <div class="justify-content-end">
                                    <button v-on:click="submitHandle" v-on:keyup.enter="submitHandle" type="submit"
                                        class="btn btn-success btn-default btn-squared px-30"
                                        data-dismiss="modal">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <h5>Items</h5>
            <p class="muted-text">Add some items on one Purchase Orders.</p>
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table :search="search" loading loading-text="Loading... Please wait..."
                                    :headers="headers" multi-sort :items="itemPurchasing" :items-per-page="10"
                                    class="elevation-1" group-by="item_group.name">
                                    <template v-slot:item.actions="{item}">
                                        <router-link :to="`/detail/purchase-order/${item.id}`" class="edit">
                                            <i class="fas fa-pen"></i></router-link>
                                        <a v-on:click="deleteItemPurchasing(item.id)" class="remove">
                                            <i class="fas fa-trash"></i></a>
                                    </template>
                                </v-data-table>
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
            return `Add New Purchase Order`;
        },
        data() {
            return {
                purchaseOrderData: {
                    supplier: '',
                    deliver_to: '',
                },

                // data relation
                supplier: {},
                warehouse: {},

                // Datatable
                itemPurchasing: [],
                search: '',
                key: 1,
                headers: [{
                        text: 'PO #',
                        value: 'po_number'
                    }, {
                        text: 'Deliver to',
                        value: 'deliver_to.warehouse_name'
                    }, {
                        text: 'Order Date',
                        value: 'order_date'
                    },
                    {
                        text: 'Supplier',
                        value: 'supplier.customerName'
                    }, {
                        text: 'Actions',
                        value: 'actions',
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
        },
        methods: {
            generatePONumber() {
                const genPONumber = this.rndStr(5);
                this.purchaseOrderData.item_code = genPONumber;
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
            async loadData() {
                this.$Progress.start();
                // Load data relation
                const resp = await axios.get('/api/suppliers');
                this.supplier = resp.data;
                const respWarehouse = await axios.get('/api/warehouse');
                this.warehouse = respWarehouse.data;
                this.$Progress.finish();
            },
            async submitHandle() {
                this.$Progress.start();
                await axios.post('/api/inventory-item', this.purchaseOrderData).then(response => {
                    this.loadItem();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add Inventory Item',
                    });
                    this.purchaseOrderData = {
                        item_name: '',
                        type: '',
                        item_group: '',
                        brand: '',
                        width: '',
                        length: '',
                        thickness: '',
                        nt_weight: '',
                        gr_weight: '',
                        volume: '',
                    };
                    const genPONumber = this.rndStr(5);
                    this.purchaseOrderData.item_code = genPONumber;
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
            },
        },
    }

</script>
