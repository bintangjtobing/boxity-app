<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Inventory Item<br>
                        <span>Jumlah <router-link :to="'/item-group'"><abbr title="Stock Group Link">item group</abbr>
                            </router-link> anda
                            adalah {{countItems}}, <abbr title="Inventory Item">Inventory Item</abbr> akan berfungsi
                            jika
                            anda memiliki item group minimal sebanyak 1. </span></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <a href="#" data-toggle="modal" data-target="#addInventoryItem"
                                class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>Add Inventory Item</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table loading loading-text="Loading... Please wait..." :search="search"
                                    :headers="headers" multi-sort :items="inventoryItem" :items-per-page="10"
                                    class="elevation-1" group-by="warehouse.warehouse_name">
                                    <template v-slot:item.qty="{ item }">
                                        {{item.qty|toDecimal}}
                                    </template>
                                    <template v-slot:item.type="{ item }">
                                        <span v-if="item.type=='1'">Stock</span>
                                        <span v-if="item.type=='2'">Non Stock</span>
                                        <span v-if="item.type=='3'">Assembly</span>
                                        <span v-if="item.type=='4'">Bundle</span>
                                        <span v-if="item.type=='5'">Service</span>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <router-link :to="`/detail/inventory-item/${item.id}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="deleteInventoryItem(item.id)" class="remove">
                                            <i class="fad fa-trash"></i></a>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addInventoryItem" tabindex="-1" aria-labelledby="addInventoryItem"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title fw-500" id="staticBackdropLabel">Add Inventory Item</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fal fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <span>For Customer:</span>
                                            <select v-model="inventorydata.customerId"
                                                class="form-control form-control-default"
                                                v-on:change="selectCustomer($event)">
                                                <option value="" disabled>Select Customer Connected</option>
                                                <option v-for="customers in customers" :key="customers.id"
                                                    :value="customers.id">
                                                    {{customers.company_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <span>In Warehouse:</span>
                                            <select v-model="inventorydata.warehouseid"
                                                class="form-control form-control-default"
                                                @change="selectWarehouse($event)" :disabled="warehouseSelect">
                                                <option value="" disabled>Select Warehouse</option>
                                                <option v-for="warehouses in warehouses"
                                                    :key="warehouses.warehouse_detail.id"
                                                    :value="warehouses.warehouse_detail.id">
                                                    {{warehouses.warehouse_detail.warehouse_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <span>Item Code:</span>
                                            <input type="text" v-model="inventorydata.item_code" placeholder="Item Code"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <span>Item Name:</span>
                                            <input type="text" v-model="inventorydata.item_name" placeholder="Item Name"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <span>Type:</span>
                                            <select v-model="inventorydata.type" id=""
                                                class="form-control form-control-default">
                                                <option value="" disabled>Type item</option>
                                                <option value="1">Stock</option>
                                                <option value="2">Non Stock</option>
                                                <option value="3">Assembly</option>
                                                <option value="4">Bundle</option>
                                                <option value="5">Service</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <div class="form-row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <span>Brand:</span>
                                                <input type="text" v-model="inventorydata.brand" class="form-control"
                                                    placeholder="Brand">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <span>Category:</span>
                                                <select v-model="inventorydata.item_group"
                                                    class="form-control form-control-default">
                                                    <option value="" disabled>Select category item</option>
                                                    <option v-for="inventoryOpt in inventoryOpt" :key="inventoryOpt.id"
                                                        :value="inventoryOpt.id">
                                                        {{inventoryOpt.name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <span>Unit:</span>
                                                <input type="text" v-model="inventorydata.unit" class="form-control"
                                                    placeholder="Ex: Kg for weight, Pcs for things or else">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <span>Quantity:</span>
                                                <input type="text" readonly class="form-control" :value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin-top:10px; margin-bottom:10px;">
                                <h5>Dimension and Weight</h5>
                                <p class="muted-text">You can use mm/unit/kg/ or anything else as a unit</p>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <span>Width</span>
                                                <input type="text" v-model="inventorydata.width" class="form-control"
                                                    placeholder="0.00 mm">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <span>Length</span>
                                                <input type="text" v-model="inventorydata.length" class="form-control"
                                                    placeholder="0.00 mm">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <span>Thickness</span>
                                                <input type="text" v-model="inventorydata.thickness"
                                                    class="form-control" placeholder="0.00 mm">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <span>Nett Weight</span>
                                                <input type="text" v-model="inventorydata.nt_weight"
                                                    class="form-control" placeholder="0.00 mm">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <span>Gross Weight</span>
                                                <input type="text" v-model="inventorydata.gr_weight"
                                                    class="form-control" placeholder="0.00 mm">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <span>Volume</span>
                                                <input type="text" v-model="inventorydata.volume" class="form-control"
                                                    placeholder="0.00 mm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-2">
                                    <div class="justify-content-end">
                                        <button v-on:click="submitHandle" v-on:keyup.enter="submitHandle" type="submit"
                                            class="btn btn-secondary-boxity btn-default btn-squared px-30"
                                            data-dismiss="modal">Submit</button>
                                    </div>
                                </div>
                            </form>
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
            return 'Inventory Item';
        },
        data() {
            return {
                inventorydata: {
                    type: '',
                    addInventoryItem: '',
                    item_group: '',
                    customerId: '',
                    warehouseid: '',
                },
                // datatable
                search: '',
                key: 1,
                inventoryItem: [],
                headers: [{
                    text: 'Customer',
                    value: 'customer.company_name'
                }, {
                    text: 'Item Code',
                    value: 'item_code'
                }, {
                    text: 'Name',
                    value: 'item_name'
                }, {
                    text: 'Item Group',
                    value: 'item_group.name'
                }, {
                    text: 'Ending Balance',
                    filterable: false,
                    align: 'center',
                    value: 'qty'
                }, {
                    text: 'Unit Type',
                    filterable: false,
                    value: 'unit',
                }, {
                    text: 'Tipe Item',
                    value: 'type'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // end datatable
                inventoryOpt: {},
                customers: {},
                warehouses: {},
                countItems: '0',
                warehouseSelect: true,
            }
        },
        created() {
            this.loadItem();
        },
        methods: {
            async loadItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/inventory-item');
                this.inventoryItem = resp.data;

                const count = await axios.get('/api/count-item-group');
                this.countItems = count.data;

                // Load item group
                const respItemGroup = await axios.get('/api/item-group');
                this.inventoryOpt = respItemGroup.data;

                const respCust = await axios.get('/api/customers');
                this.customers = respCust.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/inventory-item', this.inventorydata).then(response => {
                    this.loadItem();
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add Inventory Item',
                    });
                    this.inventorydata = {
                        item_code: '',
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
            },
            async deleteInventoryItem(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete data item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/inventory-item/' + id);
                    this.loadItem();
                    document.getElementById('ding').play();

                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current item.'
                    });
                }
            },
            async selectCustomer(event) {
                this.warehouseSelect = false;
                const warehouseData = await axios.get('/api/warehouse-customer/' + event.target.value);
                this.warehouses = warehouseData.data;
            },
            selectWarehouse(event) {
                console.log(event.target.value)
            }
        },
    }

</script>
<style lang="css">
    .form-group {
        margin-bottom: 0;
    }

</style>
