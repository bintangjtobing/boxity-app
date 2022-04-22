<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Goods Receipt</h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap"
                        v-if="member.role == 'hrdga' || member.role=='admin'">
                        <div class="action-btn">
                            <a href="#" data-toggle="modal" data-target="#goodsReceiptModal"
                                class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>Add goods receipt</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header color-dark fw-500">
                        Goods receipt list
                    </div>
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                                        hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table :loading="loading" loading-text="Loading... Please wait"
                                    :headers="headers" :items="goodsData" :search="search" :items-per-page="10"
                                    class="elevation-1">
                                    <template v-slot:[`item.type`]="{ item }">
                                        <span class="media-badge color-white bg-success" v-if="item.type=='incoming'"><i
                                                class="fad fa-inbox-in"></i> Incoming Goods</span>
                                        <span class="media-badge color-white bg-danger" v-if="item.type=='outgoing'"><i
                                                class="fad fa-inbox-out"></i> Outgoing
                                            Goods</span>
                                    </template>
                                    <template v-slot:[`item.receiptNumber`]="{item}">
                                        <div class="userDatatable-inline-title my-3">
                                            <h6>#{{item.receiptNumber}}</h6>
                                            <p class="pt-1 d-block mb-0">
                                                <i class="far fa-dolly"></i> via {{item.courier}} • <span
                                                    v-if="item.type=='incoming'">Received at
                                                    {{item.created_at}}</span><span
                                                    v-if="item.type=='outgoing'">Sent at
                                                    {{item.created_at}}</span>
                                            </p>
                                        </div>
                                    </template>
                                    <template v-slot:[`item.status`]="{ item }">
                                        <span class="media-badge color-white bg-primary" v-if="item.status==0">Available
                                            at
                                            receiptionist</span>
                                        <span class="media-badge color-white bg-success" v-if="item.status==1">Well
                                            received</span>
                                        <span class="media-badge color-white bg-danger"
                                            v-if="item.status==2">Terminated</span>
                                        <span class="media-badge color-white bg-success" v-if="item.status==3">Already
                                            sent by courier</span>
                                    </template>
                                    <template v-slot:[`item.actions`]="{item}">
                                        <a href="#" v-on:click="receivedAction(item.id)" v-if="item.status==0"><span
                                                style="color:blue;"><i class="far fa-check-circle"></i> Update
                                                status</span></a>
                                        <a v-if="item.status==1"><span style="color:green;"><i
                                                    class="fal fa-check-circle"></i>
                                                Done</span></a>
                                        <a v-if="item.status==3"><span style="color:green;">
                                                Sent</span></a>
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
                                <i class="fal fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <span>Company Receiver: </span>
                                            <input type="text" v-model="goods.companies_receiver" class="form-control"
                                                id="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <span>User Sender/Receiver: </span>
                                            <selectSearch v-model="selected.receiverid" v-bind="{
                        datas: user,
                        width: '100%',
                        name: 'name',
                      }" @dataSelected="onUserSelected"></selectSearch>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <span>Courier: </span>
                                            <select
                                                class="form-control form-control-default ih-medium ip-gray radius-xs b-light fa-select"
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
                                                <option :value="`Shopee`">
                                                    Shopee</option>
                                                <option :value="`Tokopedia`">
                                                    Tokopedia</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span>Type: </span>
                                    <select
                                        class="form-control form-control-default ih-medium ip-gray radius-xs b-light fa-select"
                                        id="n-labels" v-model="goods.typeOfGoods" required>
                                        <option value="" disabled>Select type document:</option>
                                        <option :value="`1`">Document</option>
                                        <option :value="`2`">Packet</option>
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <span>Receipt Details: </span>
                                    <input type="text" v-model="goods.receiptNumber" class="form-control"
                                        placeholder="Receipt number, sender name, etc..." id="text">
                                </div>
                                <div class="form-group my-2">
                                    <span>Remarks: </span>
                                    <editor placeholder="Document/packet descriptions..." v-model="goods.description"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 300,
                                                                menubar: true,
                                                                branding: false,
                                                                plugins: 'code',
                                                                toolbar:
                                                                    'undo redo | fontselect | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
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
    import SelectSearch from './item/selectSearch.vue';

    export default {
        components: {
            'editor': Editor,
            selectSearch: SelectSearch,
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
                    type: 'incoming',
                },
                // datatable
                search: '',
                loading: true,
                goodsData: [],
                headers: [{
                    text: 'Created at',
                    value: 'created_at',
                    align: 'left',
                }, {
                    text: 'Type',
                    value: 'type',
                    align: 'center',
                }, {
                    text: 'Receipt No.',
                    value: 'receiptNumber'
                }, {
                    text: 'Recipient/Sender',
                    value: 'receiver.name'
                }, {
                    text: 'Status',
                    value: 'status'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // end datatable
                user: {},
                member: {},
                selected: {
                    receiverid: '',
                }
            }
        },
        created() {
            this.loadGoods();
        },
        methods: {
            onUserSelected(param) {
                this.goods.receiverid = param.id;
                this.selected.receiverid = param.name;
            },
            async loadGoods() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/goods-receipt');
                this.goodsData = resp.data;
                if (resp.data.length) {
                    this.loading = false
                }
                const respMember = await axios.get('/getUserLoggedIn');
                this.member = respMember.data;
                const respUser = await axios.get('/api/contact-list');
                this.user = respUser.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async submitHandle() {
                // this.$Progress.start();
                // this.$isLoading(true);
                if (this.goods.companies_receiver) {
                    this.goods.type = 'outgoing';
                    console.log('outgoing:', this.goods.type);
                } else {
                    this.goods.type = 'incoming';
                    console.log('incoming: ', this.goods.type);
                }
                // console.log(this.goods);
                await axios.post('/api/goods-receipt', this.goods).then(response => {
                    this.loadGoods();
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success create new good receipt.',
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                    this.goods = {
                        courier: '',
                        typeOfGoods: '',
                        companies_receiver: '',
                        type: 'incoming',
                        receiverid: '',
                        receiptNumber: '',
                        description: '',
                    };
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
            async receivedAction(id) {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/goods-receipt/' + id);
                document.getElementById('ding').play();

                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Enjoy your packet/document!',
                });
                // this.$Progress.finish();
                this.$isLoading(false);
                this.loadGoods();
            },
        },
    }

</script>
