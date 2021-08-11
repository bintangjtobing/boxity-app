<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Document Delivery
                                #{{documentDeliveryData.ddr_number}}</h4>
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
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Type:</span>
                                        <select v-model="itemAdd.type" class="form-control form-control-default">
                                            <option value="" disabled>Type:</option>
                                            <option :value="1">Document</option>
                                            <option :value="2">Packet</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Receipt Number Type:</span>
                                        <select v-model="itemAdd.typeRN" @change="changeTypeRN"
                                            class="form-control form-control-default">
                                            <option :value="1">Auto</option>
                                            <option :value="2">Manual</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Receipt Number:</span>
                                        <input type="text" v-model="itemAdd.receiptNumber" id="" class="form-control"
                                            :readonly="isAutoRN">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Destination:</span>
                                        <input type="text" v-model="itemAdd.destination" class="form-control" />
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
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Type:</span>
                                        <select v-model="itemModify.type" class="form-control form-control-default">
                                            <option value="" disabled>Type:</option>
                                            <option v-bind:value="'1'">Document</option>
                                            <option v-bind:value="'2'">Packet</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span>Receipt Number Type:</span>
                                        <select v-model="itemModify.typeRN" @change="changeModifyTypeRN"
                                            class="form-control form-control-default">
                                            <option :value="1">Auto</option>
                                            <option :value="2">Manual</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span>Receipt Number:</span>
                                        <input type="text" v-model="itemModify.receiptNumber" id="" class="form-control"
                                            :readonly="isAutoRN">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span>Destination:</span>
                                        <input type="text" v-model="itemModify.destination" class="form-control" />
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
                                    class="fas fa-plus-circle"></i></span>&nbsp; Add item</button>
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details>
                                    </v-text-field>
                                </v-card-title>
                                <v-data-table :search="search" :loading="!itemOnDeliveryData.length"
                                    loading-text="Loading... Please wait..." :headers="headers"
                                    :items="itemOnDeliveryData" :items-per-page="10" class="elevation-1">
                                    <template v-slot:item.type="{item}">
                                        <div v-if="item.type==='1'">
                                            <span>Document</span>
                                        </div>
                                        <div v-if="item.type==='2'">
                                            <span>Packet</span>
                                        </div>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <a v-on:click="modifyItemPurchasing(item.id)" class="edit">
                                            <i class="fas fa-pen"></i></a>
                                        <a v-on:click="deleteItemPurchasing(item.id)" class="remove">
                                            <i class="fas fa-trash"></i></a>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form add -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>DDR number:</span>
                                    <input type="text" v-model="documentDeliveryData.ddr_number" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span>Courier: </span>
                                    <select class="form-control" id="n-labels" v-model="documentDeliveryData.courier"
                                        v-bind:disabled="checkedDDR
                                        === false" required>
                                        <option value="" disabled>Select Expedition:</option>
                                        <option :value="`lain`">Lain lain</option>
                                        <option :value="`jne express`">JNE Express</option>
                                        <option :value="`pos indonesia`">Pos Indonesia</option>
                                        <option :value="`jet express`">J&T Express</option>
                                        <option :value="`tiki`">
                                            TIKI</option>
                                        <option :value="`sicepat`">
                                            Sicepat
                                        </option>
                                        <option :value="`wahana`">
                                            Wahana</option>
                                        <option :value="`ninja express`">Ninja Express</option>
                                        <option :value="`go-send`">
                                            Go-Send</option>
                                        <option :value="`grab express`">
                                            Grab Express
                                        </option>
                                        <option :value="`dhl`">
                                            DHL</option>
                                        <option :value="`fedex`">
                                            FedEx</option>
                                        <option :value="`Shopee`">
                                            Shopee</option>
                                        <option :value="`Tokopedia`">
                                            Tokopedia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span>Status: </span>
                                    <select class="form-control" id="n-labels" v-model="documentDeliveryData.status"
                                        v-bind:disabled="checkedDDR
                                        === false" required>
                                        <option v-bind:value="`1`">Draft</option>
                                        <option v-bind:value="`2`">Taken by expedition</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <div class="row">
                                <div class="col-5 text-left">
                                    <div class="checkbox-theme-default custom-checkbox ">
                                        <input v-model="checkedDDR" class="checkbox" type="checkbox" id="check-1">
                                        <label for="check-1">
                                            <span class="checkbox-text">Edit mode</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-7 text-right">
                                    <button v-bind:disabled="checkedDDR === false" v-on:click="submitHandle"
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
            return `Update Document Delivery`;
        },
        data() {
            return {
                isShow: {
                    colapse: true,
                },
                isAutoRN: true,
                updateOnly: true,
                checkedDDR: false,
                checkedItem: false,
                // Page Info
                titleItemDescription: 'Items on this Document Delivery',
                isVisibleAddForm: true,
                isVisibleModifyForm: false,

                itemModify: {
                    type: null,
                    typeRN: null,
                    receiptNumber: '',
                    destination: '',
                    remarks: '',
                    receiptNumberStatic: '',
                },
                itemAdd: {
                    type: 1,
                    typeRN: 1,
                    receiptNumber: '',
                    destination: '',
                    remarks: '',
                },
                documentDeliveryData: {
                    courier: '',
                },

                // data relation
                users: {},
                logged: {},

                // Datatable
                itemOnDeliveryData: [],
                search: '',
                key: 1,
                headers: [{
                    text: 'Type',
                    value: 'type'
                }, {
                    text: 'Receipt Number',
                    value: 'receiptNumber'
                }, {
                    text: 'Destination',
                    value: 'destination'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    align: 'right',
                    filterable: false,
                    sortable: false
                }],
                countItems: '0',
            }
        },
        created() {
            this.loadData();
            this.loadLoggedUser();
        },
        methods: {
            changeTypeRN() {
                if (this.itemModify.typeRN == 2) {
                    this.itemModify.receiptNumber = '';
                    this.isAutoRN = false;
                } else {
                    this.isAutoRN = true;
                }
            },
            changeModifyTypeRN() {
                if (this.itemModify.typeRN == 2) {
                    this.itemModify.receiptNumber = '';
                    this.isAutoRN = false;
                } else {
                    this.isAutoRN = true;
                    if (this.itemModify.receiptNumber) {
                        this.itemModify.receiptNumber = this.itemModify.receiptNumberStatic;
                    } else {
                        const genDDRNumber = this.rndStr(5, "DDR.");
                        this.itemModify.receiptNumber = genDDRNumber;
                    }
                }
            },
            rndStr(len, text) {
                let blank = "";
                // let text = "DDR.";
                let numbers = "1234567890";
                const current = new Date();
                const date = `${current.getFullYear()}${current.getMonth()+1}${current.getDate()}.`;
                for (let i = 0; i < len; i++) {
                    blank += numbers.charAt(Math.floor(Math.random() * numbers.length));
                }
                const
                    makePO = text + date + blank;
                return makePO;
            },
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
            activeAddForm() {
                window.scrollTo(0, 0);
                this.titleItemDescription = 'Add Document Delivery Items';
                this.isVisibleAddForm = false;
                this.isVisibleModifyForm = true;
            },
            async loadData() {
                this.$Progress.start();
                // Load data relation
                const itemOnDeliveryData = await axios.get('/api/ddr/item-document/' + this.$route.params
                    .ddr_number);
                this.itemOnDeliveryData = itemOnDeliveryData.data;
                const deliveryData = await axios.get('/api/document/delivery/' + this.$route.params
                    .ddr_number);
                this.documentDeliveryData = deliveryData.data;
                const contactUsers = await axios.get('/api/contact-list');
                this.users = contactUsers.data;
                this.$Progress.finish();
            },
            async modifyItemPurchasing(id) {
                this.$Progress.start();
                const resp = await axios.get('/api/ddr/item-documents/' + id);
                this.checkedItem = true;
                this.itemModify = resp.data;
                this.titleItemDescription = 'Modify Document Delivery Items';
                window.scrollTo(0, 0);
                this.$Progress.finish();
            },
            async modifyItemList() {
                this.$Progress.start();
                await axios.patch('/api/ddr/item-document/' + this.itemModify.id, this.itemModify).then(
                    response => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Success modify item on Document Delivery table',
                        });
                        this.itemModify = {
                                type: null,
                                typeRN: null,
                                receiptNumber: '',
                                destination: '',
                                remarks: '',
                            },
                            this.checkedItem = false;
                    });
                this.loadData();
                this.$Progress.finish();
            },
            async addToList() {
                this.$Progress.start();
                // console.log(this.itemAdd);
                await axios.post('/api/ddr/item-document/' + this.$route.params.ddr_number, this.itemAdd).then(
                    response => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Success add item on Document Delivery table',
                        });
                        this.itemAdd = {
                            type: 1,
                            typeRN: 1,
                            receiptNumber: '',
                            destination: '',
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
                await axios.patch('/api/document/delivery/' + this.$route.params.ddr_number, this
                        .documentDeliveryData)
                    .then(response => {
                        this.loadData();
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Success update Document Delivery information.',
                        });
                        this.checkedDDR = false;
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
                // console.log('data click', [this.documentDeliveryData, this.itemOnDeliveryData])
            },
            async deleteItemPurchasing(id) {
                const result = await Swal.fire({
                    title: 'Delete item Document Delivery?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    this.$Progress.start();
                    await axios.delete('/api/ddr/item-document/' + id);
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
