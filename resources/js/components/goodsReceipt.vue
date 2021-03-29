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
                                <table class="table mb-0">
                                    <thead>
                                        <tr class="userDatatable-header">
                                            <th>
                                                <span class="projectDatatable-title">Goods Type</span>
                                            </th>
                                            <th>
                                                <span class="projectDatatable-title">Received at</span>
                                            </th>
                                            <th>
                                                <span class="projectDatatable-title">Receiver</span>
                                            </th>
                                            <th>
                                                <span class="projectDatatable-title">Status</span>
                                            </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="!goodsData.length">
                                            <td colspan="5">
                                                <div class="atbd-empty text-center">
                                                    <div class="atbd-empty__image">
                                                        <img src="/dashboard/img/folders/1.svg" alt="Admin Empty">
                                                    </div>
                                                    <div class="atbd-empty__text">
                                                        <p class="">No Data</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr v-for="good in goodsData" :key="good.id">
                                            <td>
                                                <div class="d-flex">
                                                    <div class="userDatatable-inline-title">
                                                        <a href="#" class="text-dark fw-500">
                                                            <h6 v-if="good.typeOfGoods == 1">Document
                                                                #{{good.receiptNumber}}</h6>
                                                            <h6 v-if="good.typeOfGoods == 2">Packet
                                                                #{{good.receiptNumber}}</h6>
                                                        </a>
                                                        <p class="pt-1 d-block mb-0">
                                                            <i class="fas fa-dolly"></i> via {{good.courier}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{good.created_at}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    <ul class="d-flex user-group-people__parent align-content-center">
                                                        <li>
                                                            <img class="rounded-circle wh-34"
                                                                :src="`/dashboard/img/author/profile/`+good.receiver.avatar"
                                                                alt="author">&nbsp; {{good.receiver.name}}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>

                                                <div class="d-inline-block">
                                                    <span class="media-badge color-white bg-primary"
                                                        v-if="good.status==0">Received on
                                                        receiptionist</span>
                                                    <span class="media-badge color-white bg-success"
                                                        v-if="good.status==1">Taken by receiver</span>
                                                    <span class="media-badge color-white bg-danger"
                                                        v-if="good.status==2">Terminated</span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" v-on:click="receivedAction(good.id)"
                                                    v-if="good.status==0"><span><i
                                                            class="far fa-check-circle fa-2x"></i></span></a>
                                                <a v-if="good.status==1"><span><i
                                                            class="fas fa-check-circle fa-2x"></i></span></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                <div class="form-group mb-25">
                                    <select
                                        class="form-control custom-select ih-medium ip-gray radius-xs b-light fa-select"
                                        id="n-labels" v-model="goods.typeOfGoods" required>
                                        <option value="" disabled>Select type document:</option>
                                        <option :value="`1`">Document</option>
                                        <option :value="`2`">Packet</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" v-model="goods.receiptNumber" class="form-control"
                                        placeholder="Receipt number (No resi dokumen / pengiriman)" id="text" required>
                                </div>
                                <div class="form-group">
                                    <textarea v-model="goods.description" class="form-control" cols="30" rows="10"
                                        placeholder="Document/packet descriptions"></textarea>
                                </div>
                                <div class="form-group">
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

    export default {
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
                goodsData: {},
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
                const resp = await axios.get('/api/users');
                this.user = resp.data;
            },
            async submitHandle() {
                await axios.post('/api/goods-receipt', this.goods);
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
            },
            async receivedAction(id) {
                await axios.patch('/api/goods-receipt/' + id);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Enjoy your packet/document!',
                });
                this.loadGoods();
            }
        },
    }

</script>
