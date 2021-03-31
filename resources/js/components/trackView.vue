<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main mb-2">
                    <h4 class="text-capitalize breadcrumb-title">Order track detail <span>#{{tracks.order_id}}</span>
                    </h4>
                    Order created at {{tracks.created_at}}
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-lg-7 mb-3" v-if="tracks.order_status!='6'">
                <div class="card card-Vertical card-default card-md">
                    <div class="card-body pb-md-30">
                        <div class="Vertical-form">
                            <h4 v-if="tracks.order_status=='0'">Create track delivery</h4>
                            <h4 v-if="tracks.order_status!='0'">Update track delivery</h4>
                            <div class="form-row" v-if="tracks.order_status=='0'">
                                <div class="col-lg-6">
                                    <div class="form-group my-2">
                                        <div class="form-row">
                                            <div class="col-lg-12">
                                                <input type="text"
                                                    class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                    v-model="track.container_type_system" placeholder="Delivery type"
                                                    autofocus required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group my-2">
                                        <div class="form-row">
                                            <div class="col-lg-12">
                                                <input type="date"
                                                    class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                    v-model="track.estimated_arrival_date"
                                                    placeholder="Estimated Arrival Date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-2" v-if="tracks.order_status!='0'">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <input type="text" v-model="track.status" v-if="tracks.order_status=='1'"
                                            class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                            placeholder="Order status update - On Transit" readonly>
                                        <input type="text" v-model="track.status" v-if="tracks.order_status=='2'"
                                            class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                            placeholder="Order status update - On Process" readonly>
                                        <input type="text" v-model="track.status" v-if="tracks.order_status=='3'"
                                            class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                            placeholder="Order status update - Received on Destination" readonly>
                                        <input type="text" v-model="track.status" v-if="tracks.order_status=='4'"
                                            class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                            placeholder="Order status update - Delivered" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <input type="text" v-model="track.current_location"
                                            class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                            placeholder="Current location" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-2" v-if="tracks.order_status!='0'">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <input type="text" v-model="track.last_location"
                                            class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                            placeholder="Last location">
                                        <span class="muted-text text-danger">Better if you place it like:
                                            <strong>Belawan, Medan</strong> or something like:
                                            <strong>Belawan, Medan,
                                                Indonesia</strong>.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <textarea class="form-control" v-model="track.activity" cols="30" rows="5"
                                            placeholder="Additional description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" v-if="tracks.order_status=='0'">
                                <div class="justify-content-end">
                                    <button v-on:click="createTrack" type="submit"
                                        class="btn btn-success btn-default btn-squared px-30"><i
                                            class="fas fa-check"></i>&nbsp;Submit track delivery</button>
                                </div>
                            </div>
                            <div class="form-group" v-if="tracks.order_status!='0'">
                                <div class="justify-content-end">
                                    <button v-on:click="updateTrack" type="submit"
                                        class="btn btn-success btn-default btn-squared px-30"><i
                                            class="fas fa-check"></i>&nbsp;Update track delivery</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-3">
                <div class="card card-Vertical card-default card-md">
                    <div class="card-body pb-md-30">
                        <div class="Vertical-form">
                            <div class="form-group">
                                <div class="trackorder">
                                    <p>
                                        <span class="bg-opacity-succes color-success rounded-pill p-2"
                                            v-if="tracks.order_status=='0'">Order
                                            created
                                        </span>
                                        <span class="bg-opacity-success color-success rounded-pill p-2"
                                            v-if="tracks.order_status=='1'">Manifested
                                        </span>
                                        <span class="bg-opacity-success color-success rounded-pill p-2"
                                            v-if="tracks.order_status=='2'">On Transit
                                        </span>
                                        <span class="bg-opacity-success color-success rounded-pill p-2"
                                            v-if="tracks.order_status=='3'">On Process
                                        </span>
                                        <span class="bg-opacity-success color-success rounded-pill p-2"
                                            v-if="tracks.order_status=='4'">Received On Destination
                                        </span>
                                        <span class="bg-opacity-danger color-danger rounded-pill p-2"
                                            v-if="tracks.order_status=='6'">Terminated
                                        </span>
                                        <span class="bg-opacity-success color-success rounded-pill p-2"
                                            v-if="tracks.order_status=='5'">Delivered
                                        </span><br><br>
                                        <b>Sender information:</b>
                                        <br>
                                        Sender: {{tracks.sender}}<br>
                                        Sending city: {{tracks.sender_city}}<br>
                                        Sending address: <br>{{tracks.sender_address}}
                                        <br><br>
                                        <b>Recipient information:</b>
                                        <br>
                                        Receiver: {{tracks.receiver}}<br>
                                        Receiving city: {{tracks.receiver_city}}<br>
                                        Recipient's address: <br>{{tracks.receiver_address}} <br>
                                        <br>
                                        Person in charge: {{tracks.created_by.name}} <br>
                                        Information updated at: {{tracks.updated_at}}
                                    </p>
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
    export default {
        title() {
            return 'Track Order Detail'
        },
        data() {
            return {
                track: {},
                tracks: {},
            }
        },
        created() {
            this.loadDataTrack();
        },
        methods: {
            async loadDataTrack() {
                const resp = await axios.get('/api/track-delivery/' + this.$route.params.id);
                this.tracks = resp.data;
            },
            async createTrack() {
                await axios.post('/api/track-delivery/' + this.$route.params.id, this.track);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success create new track delivery.',
                });
                this.$router.push('/track-delivery');
            },
            async updateTrack() {
                await axios.patch('/api/track-delivery/' + this.$route.params.id, this.track).then(response => {
                    this.$router.push('/track-delivery');
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Update track delivery.',
                    });
                }).catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something wrong.',
                        confirmButtonText: `Ok`,
                        html: `There is something wrong on my side. Please refresh and see what is going on. If still like this, you can contact our developer. <br><br>Error message: ` +
                            error,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                });
            }
        }
    }

</script>
