<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Track delivery system management</h4>
                    <div class="action-btn">
                        <router-link :to="`/track-delivery/new`" class="btn px-15 btn-primary">
                            <i class="las la-plus fs-16"></i>Add new track</router-link>
                    </div>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table loading loading-text="Loading... Please wait" :headers="headers" :items="tracks"
                            :items-per-page="10" class="elevation-1">
                            <template v-slot:item.order_id="{ item }">
                                <div class="userDatatable-inline-title my-3">
                                    <router-link :to="`/track-delivery/${item.id}`" class="text-dark fw-500">
                                        <h6>{{item.order_id}}
                                        </h6>
                                        <p>Created by {{item.created_by.name}}
                                        </p>
                                    </router-link>
                                </div>
                            </template>
                            <template v-slot:item.order_status="{ item }">
                                <div class="userDatatable-content">
                                    <span v-on:click="orderCreatedExp"
                                        class="bg-opacity-success  color-success rounded-pill userDatatable-content-status active"
                                        v-if="item.order_status=='0'">Order
                                        created
                                    </span>
                                    <span v-on:click="manifestedExp"
                                        class="bg-opacity-success  color-success rounded-pill userDatatable-content-status active"
                                        v-if="item.order_status=='1'">Manifested
                                    </span>
                                    <span v-on:click="onTransitExp"
                                        class="bg-opacity-success  color-success rounded-pill userDatatable-content-status active"
                                        v-if="item.order_status=='2'">On Transit
                                    </span>
                                    <span v-on:click="onProcessExp"
                                        class="bg-opacity-success  color-success rounded-pill userDatatable-content-status active"
                                        v-if="item.order_status=='3'">On Process
                                    </span>
                                    <span v-on:click="rodExp"
                                        class="bg-opacity-success  color-success rounded-pill userDatatable-content-status active"
                                        v-if="item.order_status=='4'">Received On Destination
                                    </span>
                                    <span v-on:click="deliveredExp"
                                        class="bg-opacity-success  color-success rounded-pill userDatatable-content-status active"
                                        v-if="item.order_status=='5'">Delivered
                                    </span>
                                    <span v-on:click="terminatedExp"
                                        class="bg-opacity-danger  color-danger rounded-pill userDatatable-content-status active"
                                        v-if="item.order_status=='6'">Terminated
                                    </span>
                                </div>
                            </template>
                            <template v-slot:item.actions="{item}">
                                <a v-on:click="terminateTrack(item.id)" v-if="item.order_status!='6'" class="remove">
                                    <i class="fas fa-times"></i></a>
                            </template>
                        </v-data-table>
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
            return 'Track delivery';
        },
        data() {
            return {
                tracks: [],
                search: '',
                key: 1,
                headers: [{
                    text: 'Track ID',
                    value: 'order_id'
                }, {
                    text: 'Created Date',
                    filterable: false,
                    value: 'created_at'
                }, {
                    text: 'Status',
                    filterable: false,
                    value: 'order_status'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
            }
        },
        created() {
            this.loadDataTrack();
        },
        methods: {
            async loadDataTrack() {
                this.$Progress.start();
                const resp = await axios.get('/api/track-delivery/get');
                this.tracks = resp.data;
                this.$Progress.finish();
            },
            orderCreatedExp() {
                Swal.fire({
                    icon: 'question',
                    title: 'Order Created Explanation Status',
                    text: 'Order telah dibuat terlebih dahulu oleh pihak BTSA LOGISTICS.',
                    showCloseButton: true,
                    showConfirmButton: false,
                });
            },
            manifestedExp() {
                Swal.fire({
                    icon: 'question',
                    title: 'Manifested Explanation Status',
                    text: 'Order telah dibuat dan barang telah diterima dan diverifikasi pihak BTSA LOGISTICS, sudah siap dan menunggu proses pengiriman.',
                    showCloseButton: true,
                    showConfirmButton: false,
                });
            },
            onTransitExp() {
                Swal.fire({
                    icon: 'question',
                    title: 'On Transit Explanation Status',
                    text: 'Paket sedang dalam transit, dan akan diikutkan dengan jadwal pengiriman menuju kota tujuan.',
                    showCloseButton: true,
                    showConfirmButton: false,
                });
            },
            onProcessExp() {
                Swal.fire({
                    icon: 'question',
                    title: 'On Process Explanation Status',
                    text: 'Paket sedang dalam proses pengiriman, dan biasanya jika masih dalam tahap ini, untuk pembaruan update memerlukan waktu yang lama.',
                    showCloseButton: true,
                    showConfirmButton: false,
                });
            },
            rodExp() {
                Swal.fire({
                    icon: 'question',
                    title: 'Received On Destination Explanation Status',
                    text: 'Paket telah sampai pada tim BTSA LOGISTICS kota tujuan pengiriman, dan siap untuk dikirimkan ke alamat tujuan.',
                    showCloseButton: true,
                    showConfirmButton: false,
                });
            },
            deliveredExp() {
                Swal.fire({
                    icon: 'question',
                    title: 'Delivered Explanation Status',
                    text: 'Paket telah diterima di alamat tujuan.',
                    showCloseButton: true,
                    showConfirmButton: false,
                });
            },
            terminatedExp() {
                Swal.fire({
                    icon: 'question',
                    title: 'Terminated Status',
                    html: 'Order paket telah diterminate oleh <b>sistem</b>. <br> Jika ingin membuka order kembali,<br>harap minta approve oleh atasan atau kepada admin.',
                    showCloseButton: true,
                    showConfirmButton: false,
                });
            },
            async terminateTrack(id) {
                const result = await Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure want to terminate track?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    this.$Progress.start();
                    await axios.patch('/api/track-deliverys/' + id);
                    // console.log('200')
                    this.loadDataTrack();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully terminated',
                        text: 'Success terminated current track'
                    });
                    this.$Progress.finish();
                }
            },
        },
    }

</script>
