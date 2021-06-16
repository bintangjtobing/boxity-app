<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Add New Sales Order</h4>
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
                                        <input type="text" v-model="inventorydata.item_code" placeholder="Item Code"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <input type="text" v-model="inventorydata.item_name" placeholder="Item Name"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
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
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" v-model="inventorydata.brand" class="form-control"
                                                placeholder="Brand">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <span></span>
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
                                            <span>Unit</span>
                                            <input type="text" v-model="inventorydata.unit" class="form-control"
                                                placeholder="Ex: Kg for weight, Pcs for things or else">
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
                                            <input type="text" v-model="inventorydata.thickness" class="form-control"
                                                placeholder="0.00 mm">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <span>Nett Weight</span>
                                            <input type="text" v-model="inventorydata.nt_weight" class="form-control"
                                                placeholder="0.00 mm">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <span>Gross Weight</span>
                                            <input type="text" v-model="inventorydata.gr_weight" class="form-control"
                                                placeholder="0.00 mm">
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
</template>
<script>
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';
    export default {
        components: {
            'editor': Editor
        },
        title() {
            return `Add New Sales Order`;
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
                    text: 'Success update Sales Order data',
                });
                this.$router.push('/inventory-item');
            },
        },
    }

</script>
