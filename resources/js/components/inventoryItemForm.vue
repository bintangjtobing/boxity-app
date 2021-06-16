<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Inventory item data - <abbr
                                    :title="inventorydata.item_name">{{inventorydata.item_name}}</abbr></h4>
                        </div>
                    </div>
                </div>
            </div>
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
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-others-tab" data-toggle="pill" href="#v-pills-others"
                                    role="tab" aria-controls="v-pills-others" aria-selected="true">Others</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="row ml-4">
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
                                                                    placeholder="Item Code" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <span>Item Name:</span>
                                                                <input type="text" v-model="inventorydata.item_name"
                                                                    placeholder="Item Name" class="form-control">
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
                                                                    <input type="text" v-model="inventorydata.brand"
                                                                        class="form-control" placeholder="Brand">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Current Price:</span>
                                                                    <input type="text" v-model="inventorydata.price"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <span>Item Group:</span>
                                                                    <select v-model="inventorydata.item_group"
                                                                        class="form-control form-control-default">
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
                                                                    <span>Unit:</span>
                                                                    <input type="text" v-model="inventorydata.unit"
                                                                        class="form-control"
                                                                        placeholder="Ex: Kg for weight, Pcs for things or else">
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
                                                                        class="form-control" placeholder="0.00 mm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Length</span>
                                                                    <input type="text" v-model="inventorydata.length"
                                                                        class="form-control" placeholder="0.00 mm">
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
                                                                    <input type="text" v-model="inventorydata.volume"
                                                                        class="form-control" placeholder="0.00 mm">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="button-group d-flex pt-25">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-default btn-squared text-capitalize">Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  show" id="v-pills-others" role="tabpanel"
                            aria-labelledby="v-pills-others-tab">
                            <div class="row ml-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <form @submit.prevent="handleSubmit">
                                                    <!-- Insert Code here -->
                                                    <div class="form-group my-2">
                                                        <div class="justify-content-end">
                                                            <button v-on:click="handleSubmit"
                                                                v-on:keyup.enter="handleSubmit" type="submit"
                                                                class="btn btn-success btn-default btn-squared px-30"
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
            return `Inventory item data`;
        },
        data() {
            return {
                inventorydata: {},
                inventoryOpt: {},
            }
        },
        created() {
            this.loadDataInventoryItem();
        },
        methods: {
            async loadDataInventoryItem() {
                this.$Progress.start();
                const response = await axios.get('/api/inventory-item/' + this.$route.params.id);
                this.inventorydata = response.data;

                // Load data relation
                const resp = await axios.get('/api/item-group');
                this.inventoryOpt = resp.data;
                this.$Progress.finish();
            },
            async handleSubmit() {
                await axios.patch('/api/inventory-item/' + this.$route.params.id, this.inventorydata);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update inventory item data',
                });
                this.$router.push('/inventory-item');
            },
        },
    }

</script>
