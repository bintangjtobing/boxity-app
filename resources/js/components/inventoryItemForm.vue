<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize fw-500 breadcrumb-title">Inventory item data - <abbr
                            :title="inventorydata.item_name">{{inventorydata.item_name}}</abbr></h4>
                    <div class="breadcrumb-action justify-content-end flex-wrap">
                        <div class="action-btn">
                            <a class="btn btn-sm btn-primary-boxity btn-add">
                                Item ID : &nbsp;
                                <b>{{inventorydata.id}}</b></a>
                        </div>
                        <div class="action-btn">
                            <a class="btn btn-sm btn-primary-boxity btn-add">
                                Warehouse name : &nbsp; <b>{{inventorydata.warehouse.warehouse_name}}</b>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <span @click="routerBack" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-arrow-left"></i></span>
            <span @click="routerRefresh" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-sync"></i></span>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="user-info-tab w-100 bg-white global-shadow radius-xl mb-50">
                    <div class="ap-tab-wrapper border-bottom ">
                        <ul class="nav px-30 ap-tab-main text-capitalize" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                    role="tab" aria-controls="v-pills-home" aria-selected="true">details</a>
                            </li>
                            <!-- <li class="nav-item" v-if="permissions.includes('ViewActivitiesInventoryItem')"> -->
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history"
                                    role="tab" aria-controls="v-pills-history" aria-selected="true">Activites &
                                    History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-image-tab" data-toggle="pill" href="#v-pills-image"
                                    role="tab" aria-controls="v-pills-image" aria-selected="true">Item Images</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <form @submit.prevent="handleSubmit">
                                                    <div class="form-row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <span>Item Code:</span>
                                                                <input type="text" v-model="inventorydata.item_code"
                                                                    placeholder="Item Code" class="form-control"
                                                                    :disabled="!permissions.includes('EditInventoryItem') ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <span>Item Name:</span>
                                                                <input type="text" v-model="inventorydata.item_name"
                                                                    placeholder="Item Name" class="form-control"
                                                                    :disabled="!permissions.includes('EditInventoryItem')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <span>Type:</span>
                                                                <select v-model="inventorydata.type" id=""
                                                                    class="form-control form-control-default"
                                                                    :disabled="!permissions.includes('EditInventoryItem')">
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
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Brand:</span>
                                                                    <input type="text" v-model="inventorydata.brand"
                                                                        class="form-control" placeholder="Brand"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Current Price:</span>
                                                                    <!-- <input type="text" v-model="inventorydata.price"
                                                                        class="form-control" readonly> -->
                                                                    <vue-numeric class="form-control" readonly
                                                                        v-bind:precision="0"
                                                                        v-model="inventorydata.price"></vue-numeric>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Ending Balance:</span>
                                                                    <vue-numeric class="form-control" readonly
                                                                        v-bind:precision="0" v-model="countQty">
                                                                    </vue-numeric>
                                                                    <!-- <input type="text" v-model="countQty"
                                                                        class="form-control" readonly> -->
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Unit:</span>
                                                                    <input type="text" v-model="inventorydata.unit"
                                                                        class="form-control"
                                                                        placeholder="Ex: Kg for weight, Pcs for things or else"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Item Group:</span>
                                                                    <select v-model="inventorydata.item_group"
                                                                        class="form-control form-control-default"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                        <option value="" disabled>Select category item
                                                                        </option>
                                                                        <option v-for="inventoryOpt in inventoryOpt"
                                                                            :key="inventoryOpt.id"
                                                                            :value="inventoryOpt.id">
                                                                            {{inventoryOpt.name}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Stock Group:</span>
                                                                    <select v-model="inventorydata.stock_group"
                                                                        class="form-control form-control-default"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                        <option value="" disabled>Select stock item
                                                                        </option>
                                                                        <option v-for="inventoryGroup in inventoryGroup"
                                                                            :key="inventoryGroup.id"
                                                                            :value="inventoryGroup.id">
                                                                            {{inventoryGroup.name}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <div class="form-row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <span>Description:</span>
                                                                        <textarea v-model="inventorydata.descriptions"
                                                                            id="" class="form-control" cols="30"
                                                                            rows="6"
                                                                            placeholder="Your item descriptions..."></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom:10px;">
                                                    <h5>Dimension and Weight</h5>
                                                    <p class="muted-text">You can use mm/unit/kg/ or anything else as a
                                                        unit</p>
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Width</span>
                                                                    <input type="text" v-model="inventorydata.width"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Length</span>
                                                                    <input type="text" v-model="inventorydata.length"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Thickness</span>
                                                                    <input type="text" v-model="inventorydata.thickness"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Nett Weight</span>
                                                                    <input type="text" v-model="inventorydata.nt_weight"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Gross Weight</span>
                                                                    <input type="text" v-model="inventorydata.gr_weight"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Volume</span>
                                                                    <input type="text" v-model="inventorydata.volume"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="button-group d-flex pt-25"
                                                        v-if="permissions.includes('EditInventoryItem')">
                                                        <button type="submit"
                                                            class="btn btn-primary-boxity btn-default btn-squared text-capitalize">Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  show" id="v-pills-history" role="tabpanel"
                            aria-labelledby="v-pills-history-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <div class="form-row">
                                                    <div class="col-lg-5">
                                                        <div class="form-group mb-10">
                                                            <span>From:</span>
                                                            <input type="date" v-model="range.fromDate" id=""
                                                                class="form-control">
                                                            <span style="color:red" v-show="notSuitable">From date
                                                                cannot be latest than Until date</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group mb-10">
                                                            <span>Until:</span>
                                                            <input type="date" v-model="range.toDate" id=""
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 align-self-center mt-2">
                                                        <button v-on:click="searchData" v-on:keyup.enter="searchData"
                                                            class="btn btn-secondary-boxity btn-sm">Search</button>
                                                    </div>
                                                    <div class="col-lg-1 align-self-center mt-2">
                                                        <a :href="`/api/report/item-history/${$route.params.id}?from=${range.fromDate}&until=${range.toDate}`"
                                                            class="btn btn-warning btn-sm" target="_blank">Print</a>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <span>Beginning:</span>
                                                            <vue-numeric class="form-control" readonly
                                                                v-bind:precision="0" v-model="beginningQty">
                                                            </vue-numeric>
                                                            <!-- <input type="text" v-model="beginningQty" id=""
                                                                class="form-control" readonly> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <span>Quantity In:</span>
                                                            <!-- <input type="text" v-model="sumQtyIn" id=""
                                                                class="form-control" readonly> -->
                                                            <vue-numeric class="form-control" readonly
                                                                v-bind:precision="0" v-model="sumQtyIn">
                                                            </vue-numeric>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <span>Quantity Out:</span>
                                                            <!-- <input type="text" v-model="sumQtyOut" id=""
                                                                class="form-control" readonly> -->
                                                            <vue-numeric class="form-control" readonly
                                                                v-bind:precision="0" v-model="sumQtyOut">
                                                            </vue-numeric>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <span>Ending Balance:</span>
                                                            <!-- <input type="text" v-model="countQty" id=""
                                                                class="form-control" readonly> -->
                                                            <vue-numeric class="form-control" readonly
                                                                v-bind:precision="0" v-model="countQty">
                                                            </vue-numeric>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <!-- Table History Listed -->
                                                    <div class="col-lg-12">
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <div
                                                                    class="userDatatable projectDatatable project-table bg-white border-0">
                                                                    <div class="table-responsive">
                                                                        <v-card-title>
                                                                            <v-text-field v-model="search"
                                                                                append-icon="mdi-magnify"
                                                                                label="Search here..." single-line
                                                                                hide-details>
                                                                            </v-text-field>
                                                                        </v-card-title>
                                                                        <v-data-table :loading="loading"
                                                                            loading-text="Data not found..."
                                                                            :search="search" :headers="headers"
                                                                            multi-sort :sort-by.sync="
                                                                            sortBy" :sort-desc.sync="sortDesc"
                                                                            :items="historyItem" :items-per-page="10"
                                                                            class="elevation-1">
                                                                            <template
                                                                                v-slot:[`item.itemNumber`]="{item}">
                                                                                <div v-if="item.type===1">
                                                                                    <router-link
                                                                                        :to="`/detail/purchase/invoices/${item.itemNumber}`">
                                                                                        <i
                                                                                            class="fal fa-link"></i>&nbsp;{{item.itemNumber}}
                                                                                    </router-link>
                                                                                </div>
                                                                                <div v-if="item.type===2">
                                                                                    <router-link
                                                                                        :to="`/detail/sales/invoices/${item.itemNumber}`">
                                                                                        <i
                                                                                            class="fal
                                                                                            fa-link"></i>&nbsp;{{item.itemNumber}}
                                                                                    </router-link>
                                                                                </div>
                                                                            </template>
                                                                            <template v-slot:[`item.type`]="{item}">
                                                                                <div v-if="item.type===1">
                                                                                    <span>Purchase Invoice</span>
                                                                                </div>
                                                                                <div v-if="item.type===2">
                                                                                    <span>Sales Invoice</span>
                                                                                </div>
                                                                            </template>
                                                                            <template v-slot:[`item.qtyIn`]="{item}">
                                                                                {{item.qtyIn|toDecimal}}
                                                                            </template>
                                                                            <template v-slot:[`item.qtyOut`]="{item}">
                                                                                {{item.qtyOut|toDecimal}}
                                                                            </template>
                                                                        </v-data-table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  show" id="v-pills-image" role="tabpanel"
                            aria-labelledby="v-pills-image-tab">
                            <div class="row mx-4">
                                <div class="col-lg-4 text-center itemImage" v-for="image in imgs" :key="image.id">
                                    <a :href="image.file" target="_blank"><img :src="image.file"></a>
                                    <div class="row justify-content-center"
                                        v-if="permissions.includes('EditInventoryItem')">
                                        <div class="col-lg-12 text-center">
                                            <a v-on:click="deleteThisImage(image.id)"
                                                class="btn btn-danger-boxity btn-block"><i
                                                    class="fad fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="this.imgs.length">
                                <div class="col-lg-12 text-center mb-3" v-if="addItemBtn">
                                    <a v-on:click="itemImageAdds"><span class="itemImageAdd"><i
                                                class="fad fa-plus fa-2x"></i></span></a>
                                </div>
                            </div>
                            <div class="row" v-else>
                                <div class="col-lg-12 text-center my-2" v-if="noImageHere">
                                    <!-- Start: error page -->
                                    <div class="min-vh-100 content-center">
                                        <div class="error-page text-center">
                                            <img src="https://res.cloudinary.com/boxity-id/image/upload/v1633661884/404_qggjfd.svg"
                                                alt="404" class="svg">
                                            <h5 class="fw-500">Sorry! This item has no images here...</h5>
                                            <div class="content-center mt-30"
                                                v-if="permissions.includes('EditInventoryItem')">
                                                <a @click="itemImageAdds" href="#"
                                                    class="btn btn-primary-boxity btn-default btn-squared px-30">+ Add
                                                    Image</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End: error page -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center" v-if="addItemImages">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <vue-dropzone useCustomSlot ref="itemImageAddOnId" id="dropzone"
                                                :options="dropzoneOptions" @vdropzone-complete="afterComplete"
                                                class="dropzone">
                                                <div class="dropzone-custom-content">
                                                    <h3 class="dropzone-custom-title">Drag and drop to upload
                                                        attachment!</h3>
                                                    <div class="subtitle">...or click to select a file from your
                                                        computer</div>
                                                </div>
                                            </vue-dropzone>
                                        </div>
                                    </div>
                                </div>
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
    import vue2Dropzone from 'vue2-dropzone';
    import VueNumeric from 'vue-numeric'
    export default {
        components: {
            'editor': Editor,
            vueDropzone: vue2Dropzone,
            VueNumeric
        },
        title() {
            return `Inventory item data`;
        },
        data() {
            return {
                addItemBtn: true,
                noImageHere: true,
                addItemImages: false,
                inventorydata: {},
                inventoryOpt: {},
                inventoryGroup: {},
                range: {},

                // datatable
                search: '',
                loading: true,
                sortBy: ['invoiceDate', 'created_at'],
                sortDesc: ['false', 'true'],
                key: 1,
                historyItem: [],
                imgs: {},
                headers: [{
                    text: 'Document #',
                    value: 'itemNumber'
                }, {
                    text: 'Document Type',
                    value: 'type'
                }, {
                    text: 'Invoice Date',
                    value: 'invoiceDate'
                }, {
                    text: 'Created Date',
                    value: 'created_at'
                }, {
                    text: 'Qty In',
                    value: 'qtyIn'
                }, {
                    text: 'Qty Out',
                    value: 'qtyOut'
                }, {
                    text: 'Unit',
                    value: 'item.unit'
                }, {
                    text: 'Remarks',
                    value: 'remarks'
                }],
                // end datatable

                sumQtyIn: 0,
                sumQtyOut: 0,
                countQty: '-',
                beginningQty: 0,
                // TODO: callback to save the ids of the uploaded file
                dropzoneOptions: {
                    url: '/api/inventory-item/images/' + this.$route.params.id,
                    thumbnailWidth: 200,
                    maxFilesize: 2, // MB
                    addRemoveLinks: true,
                    autoDiscover: false,
                    dictRemoveFile: 'REMOVE'
                },
                permissions: []
            }
        },
        created() {
            this.loadDataInventoryItem();
            this.loadHistoryItem();
        },
        beforeMount() {
            this.permissions = this.$store.getters.getPermissions;
        },
        computed: {
            notSuitable() {
                return (this.range.fromDate > this.range.toDate) || false
            },
            isDisableSubmit() {
                return (this.range.fromDate < this.range.toDate) || false
            }
        },
        methods: {
            routerBack() {
                this.$router.go(-1)
            },
            routerRefresh() {
                this.$isLoading(true);
                this.loadDataInventoryItem();
                this.loadHistoryItem();
                this.$isLoading(false);
            },
            async loadImageItem() {
                const imgLists = await axios.get('/api/inventory-item/album/' + this.$route.params.id);
                this.imgs = imgLists.data;
            },
            async loadDataInventoryItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                const response = await axios.get('/api/inventory-item/' + this.$route.params.id);
                this.inventorydata = response.data;

                const beginning = await axios.get('/api/beginning/item-history/' + this.$route.params.id);
                this.beginningQty = beginning.data;

                // Load data relation
                const resp = await axios.get('/api/item-group');
                this.inventoryOpt = resp.data;
                const respGroup = await axios.get('/api/stock-group');
                this.inventoryGroup = respGroup.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async loadHistoryItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                // Load customer warehouse
                const imgList = await axios.get('/api/inventory-item/album/' + this.$route.params.id);
                this.imgs = imgList.data;
                const historyList = await axios.get('/api/item-history/' + this.$route.params.id);
                this.historyItem = historyList.data;
                if (historyList.data.length) {
                    this.loading = false
                }
                const qtyInSum = await axios.get('/api/sum/in/item-history/' + this.$route.params.id);
                this.sumQtyIn = qtyInSum.data;
                this.inventorydata.qty = qtyInSum.data;
                const qtyOutSum = await axios.get('/api/sum/out/item-history/' + this.$route.params.id);
                this.sumQtyOut = qtyOutSum.data;
                this.countQty = this.sumQtyIn - this.sumQtyOut;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async handleSubmit() {
                await axios.patch('/api/inventory-item/' + this.$route.params.id, this.inventorydata);
                document.getElementById('ding').play();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update inventory item data',
                });
                this.$router.push('/inventory-item');
            },
            async searchData() {
                // console.log(this.range.fromDate, ">", this.range.toDate)
                // console.log(this.range.fromDate > this.range.toDate)
                // console.log(this.range.fromDate, "<", this.range.toDate)
                // console.log(this.range.fromDate < this.range.toDate)
                const historyList = await axios.get('/api/item-history/' + this.$route.params.id, {
                    params: {
                        fromDate: this.range.fromDate,
                        toDate: this.range.toDate
                    }
                });
                this.historyItem = historyList.data;
            },
            itemImageAdds() {
                // console.log('jalan');
                this.addItemBtn = false;
                this.noImageHere = false;
                this.addItemImages = true;
            },
            afterComplete() {
                Swal.fire({
                    icon: 'success',
                    title: 'Successfully!',
                    text: 'Success add image on this items.'
                });
                this.addItemBtn = true;
                this.addItemImages = false;
                this.loadImageItem();
                this.$refs.itemImageAddOnId.removeAllFiles()
                // this.$router.go();
            },
            async deleteThisImage(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    icon: 'info',
                    title: 'Delete',
                    text: 'Delete this item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('/api/inventory-item/images/' + id);
                    this.$isLoading(false);
                    this.loadImageItem();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Delete',
                        text: 'Success delete current image.'
                    });
                    // this.$Progress.finish();
                }
            }
        },
    }

</script>
