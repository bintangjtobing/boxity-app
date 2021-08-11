n<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">New Document Delivery
                                <span>#{{documentDeliveryData.ddr_number}}</span></h4>
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
                                            <option v-bind:value="`1`">Document</option>
                                            <option v-bind:value="`2`">Packet</option>
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
                                <v-data-table :search="search" :loading="!itemDocumentData.length"
                                    loading-text="Loading... Please wait..." :headers="headers"
                                    :items="itemDocumentData" :items-per-page="10" class="elevation-1">
                                    <template v-slot:item.type="{item}">
                                        <div v-if="item.type==='1'">
                                            <span>Document</span>
                                        </div>
                                        <div v-if="item.type==='2'">
                                            <span>Packet</span>
                                        </div>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <a v-on:click="modifyItemDocumentDelivery(item.id)" class="edit">
                                            <i class="fas fa-pen"></i></a>
                                        <a v-on:click="deleteItemDelivery(item.id)" class="remove">
                                            <i class="fas fa-trash"></i></a>
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
                                    <span>DDR number:</span>
                                    <input type="text" v-model="documentDeliveryData.ddr_number" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span>Expedition: </span>
                                    <select class="form-control" id="n-labels" v-model="documentDeliveryData.courier"
                                        required>
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
            return `New Document Delivery`;
        },
        data() {
            return {
                isShow: {
                    colapse: true,
                },
                isAutoRN: true,
                // Page Info
                titleItemDescription: 'Add some items on Document Deliverys.',
                isVisibleAddForm: false,
                isVisibleModifyForm: true,
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
                itemDocumentData: [],
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
            this.generateDDRNumber();
            this.loadLoggedUser();
        },
        methods: {
            classRotate: function (param) {
                return param ? "rotate" : "";
            },
            isShowing: function () {
                this.isShow.colapse = !this.isShow.colapse;
            },
            generateDDRNumber() {
                const genDDRNumber = this.rndStr(5, "DDR.");
                this.documentDeliveryData.ddr_number = genDDRNumber;

                if (this.itemAdd.typeRN == 1) {
                    const genRNNumber = this.rndStr(5, "RN.");
                    this.itemAdd.receiptNumber = genRNNumber;
                }
            },
            changeTypeRN() {
                if (this.itemAdd.typeRN == 2) {
                    this.itemAdd.receiptNumber = '';
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
                    this.itemModify.receiptNumber = this.itemModify.receiptNumberStatic;
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
                const makePO = text + date + blank;
                return makePO;
            },
            // Load loggedin user
            async loadLoggedUser() {
                const resp = await axios.get('/getUserLoggedIn');
                this.logged = resp.data;
                this.itemAdd.requested_by = resp.data.id;
            },
            async modifyItemList() {
                this.$Progress.start();
                console.log('Item :', this.itemModify);
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
                        }
                    });
                this.loadData();
                this.isVisibleAddForm = false,
                    this.isVisibleModifyForm = true,
                    this.$Progress.finish();
            },
            async loadData() {
                this.$Progress.start();
                // Load data relation
                const itemDocumentData = await axios.get('/api/ddr/item-document');
                this.itemDocumentData = itemDocumentData.data;
                this.$Progress.finish();
            },
            async modifyItemDocumentDelivery(id) {
                this.$Progress.start();
                const resp = await axios.get('/api/ddr/item-documents/' + id);
                this.checkedItem = true;
                this.itemModify = resp.data;
                this.itemModify.receiptNumberStatic = resp.data.receiptNumber;
                this.titleItemDescription = 'Modify Document Delivery Items';
                this.isVisibleAddForm = true;
                this.isVisibleModifyForm = false;
                window.scrollTo(0, 0);
                this.$Progress.finish();
            },
            async addToList() {
                this.$Progress.start();
                console.log(this.itemAdd)
                await axios.post('/api/ddr/item-document', this.itemAdd).then(response => {
                    console.log(response)
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
                this.loadData();
                this.$Progress.finish();
            },
            async modifyItemPurchase() {
                this.$Progress.start();
                await axios.patch('/api/ddr/item-document/' + this.itemAdd.id, this.itemAdd).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success modify item on Document Delivery table',
                    });
                    this.itemAdd = {
                        type: 1,
                        typeRN: 1,
                        receiptNumber: '',
                        destination: '',
                        remarks: '',
                    }
                });
                this.titleItemDescription = 'Add some items on Document Deliverys.';
                this.isVisibleAddForm = false;
                this.isVisibleModifyForm = true;
                this.loadData();
                this.$Progress.finish();
            },
            async submitHandle() {
                this.$Progress.start();
                await axios.post('/api/document/delivery', this.documentDeliveryData).then(response => {
                    this.loadData();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New Document Delivery',
                    });
                    this.documentDeliveryData = {
                        courier: '',
                    };
                    const genDDRNumber = this.rndStr(5);
                    this.documentDeliveryData.ddr_number = genDDRNumber;
                    this.$router.push('/document/delivery');
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
                // console.log('data click', [this.documentDeliveryData, this.itemDocumentData])
            },
            async deleteItemDelivery(id) {
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
