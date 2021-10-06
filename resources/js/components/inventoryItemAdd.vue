<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">
                        New Inventory Item
                    </h2>
                </div>
            </div>
        </div>
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
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
                                <hr style="margin-top:10px; margin-bottom:10px;">
                                <h5>Image</h5>
                                <p class="muted-text">This image is used for item that you inputted above.</p>
                                <div class="form-group">
                                    <div class="form-group">
                                        <vue-dropzone useCustomSlot ref="document-upload" id="dropzone"
                                            :options="dropzoneOptions" class="dropzone">
                                            <div class="dropzone-custom-content">
                                                <h3 class="dropzone-custom-title">Drag and drop to upload
                                                    attachment!</h3>
                                                <div class="subtitle">...or click to select a file from your
                                                    computer</div>
                                            </div>
                                        </vue-dropzone>
                                    </div>
                                </div>
                                <div class="form-group my-2">
                                    <div class="justify-content-end">
                                        <button v-on:click="submitHandle" v-on:keyup.enter="submitHandle" type="submit"
                                            class="btn btn-secondary-boxity btn-default btn-squared px-30"
                                            data-dismiss="modal">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';
    import vue2Dropzone from 'vue2-dropzone';

    export default {
        components: {
            'editor': Editor,
            vueDropzone: vue2Dropzone,
        },
        title() {
            return 'New inventory item';
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
                inventoryOpt: {},
                customers: {},
                warehouses: {},
                warehouseSelect: true,

                // Image
                // TODO: callback to save the ids of the uploaded file
                dropzoneOptions: {
                    url: '/api/inventory-item/images',
                    thumbnailWidth: 200,
                    addRemoveLinks: true,
                    autoDiscover: false,
                    dictRemoveFile: 'REMOVE'
                },
            }
        },
        created() {
            this.loadItem();
        },
        methods: {
            async loadItem() {
                // this.$Progress.start();
                this.$isLoading(true);
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
                    this.$router.push('/inventory-item');
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
            async selectCustomer(event) {
                this.warehouseSelect = false;
                const warehouseData = await axios.get('/api/warehouse-customer/' + event.target.value);
                this.warehouses = warehouseData.data;
            },
        },
    }

</script>
<style lang="css">
    .form-group {
        margin-bottom: 0;
    }

</style>
