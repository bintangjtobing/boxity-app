<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">

                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Goods Receipt</h4>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <a href="#" data-toggle="modal" data-target="#goodsReceiptModal"
                                class="btn btn-sm btn-primary btn-add">
                                <i class="las la-plus fs-16"></i>Add goods receipt</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header color-dark fw-500">
                        Goods receipt list
                    </div>
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table loading loading-text="Loading... Please wait" :headers="headers"
                                    :items="goodsData" :items-per-page="10" class="elevation-1" :search="search">
                                    <template v-slot:item.typeOfGoods="{ item }">
                                        <div class="userDatatable-inline-title my-3">
                                            <a href="#" class="text-dark fw-500">
                                                <h6 v-if="item.typeOfGoods == 1">Document
                                                    #{{item.receiptNumber}}</h6>
                                                <h6 v-if="item.typeOfGoods == 2">Packet
                                                    #{{item.receiptNumber}}</h6>
                                            </a>
                                            <p class="pt-1 d-block mb-0">
                                                <i class="fas fa-dolly"></i> via {{item.courier}}
                                            </p>
                                        </div>
                                    </template>
                                    <template v-slot:item.receiver="{ item }">
                                        <img class="rounded-circle wh-34"
                                            :src="`/dashboard/img/author/profile/`+item.receiver.avatar"
                                            alt="author">&nbsp;
                                        {{item.receiver.name}}
                                    </template>
                                    <template v-slot:item.status="{ item }">
                                        <span class="media-badge color-white bg-primary" v-if="item.status==0">Received
                                            on
                                            receiptionist</span>
                                        <span class="media-badge color-white bg-success" v-if="item.status==1">Taken by
                                            receiver</span>
                                        <span class="media-badge color-white bg-danger"
                                            v-if="item.status==2">Terminated</span>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <a href="#" v-on:click="receivedAction(item.id)" v-if="item.status==0"><span><i
                                                    class="far fa-check-circle fa-2x"></i></span></a>
                                        <a v-if="item.status==1"><span><i
                                                    class="fas fa-check-circle fa-2x"></i></span></a>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="goodsReceiptModal" tabindex="-1" aria-labelledby="goodsReceiptModal"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title fw-500" id="staticBackdropLabel">Add Goods Receipt</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-row">
                                    <div class="col-lg-8">
                                        <div class="form-group mb-25">
                                            <select
                                                class="form-control custom-select ih-medium ip-gray radius-xs b-light fa-select"
                                                id="n-labels" v-model="goods.receiverid" required>
                                                <option value="" disabled>Select receiver:</option>
                                                <option v-for="users in user" :key="users.id" :value="users.id">
                                                    {{users.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-25">
                                            <select
                                                class="form-control custom-select ih-medium ip-gray radius-xs b-light fa-select"
                                                id="n-labels" v-model="goods.courier" required>
                                                <option value="" disabled>Select courier:</option>
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
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-2">
                                    <select
                                        class="form-control custom-select ih-medium ip-gray radius-xs b-light fa-select"
                                        id="n-labels" v-model="goods.typeOfGoods" required>
                                        <option value="" disabled>Select type document:</option>
                                        <option :value="`1`">Document</option>
                                        <option :value="`2`">Packet</option>
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <input type="text" v-model="goods.receiptNumber" class="form-control"
                                        placeholder="Nama Pengirim (PT,DLL) and Receipt number (No resi dokumen / pengiriman)"
                                        id="text" required>
                                </div>
                                <div class="form-group my-2">
                                    <editor placeholder="Document/packet descriptions..." v-model="goods.description"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 300,
                                                                menubar: false,
                                                                branding: false,
                                                                toolbar:
                                                                    'undo redo | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
                                </div>
                                <div class="form-group my-2">
                                    <div class="justify-content-end">
                                        <button v-on:click="submitHandle" type="submit"
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
</template>
<script>
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'Goods Receipt';
        },
        data() {
            return {
                goods: {
                    courier: '',
                    typeOfGoods: '',
                    receiverid: '',
                },
                // datatable
                goodsData: [],
                search: '',
                key: 1,
                headers: [{
                    text: 'Goods Type',
                    value: 'typeOfGoods'
                }, {
                    text: 'Received At',
                    filterable: false,
                    value: 'created_at'
                }, {
                    text: 'Receiver',
                    filterable: false,
                    value: 'receiver'
                }, {
                    text: 'Status',
                    filterable: false,
                    value: 'status'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // end datatable
                user: {},
            }
        },
        created() {
            this.loadGoods();
            this.loadUser();
        },
        methods: {
            async loadGoods() {
                const resp = await axios.get('/api/goods-receipt');
                this.goodsData = resp.data;
            },
            async loadUser() {
                const resp = await axios.get('/api/contact-list');
                this.user = resp.data;
            },
            async submitHandle() {
                await axios.post('/api/goods-receipt', this.goods).then(response => {
                    this.loadGoods();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add new good receipt',
                    });
                    this.goods = {
                        courier: '',
                        typeOfGoods: '',
                        receiverid: '',
                        receiptNumber: '',
                        description: '',
                    };
                }).catch(error => {
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
            async receivedAction(id) {
                await axios.patch('/api/goods-receipt/' + id);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Enjoy your packet/document!',
                });
                this.loadGoods();
            },
        },
    }

</script>
