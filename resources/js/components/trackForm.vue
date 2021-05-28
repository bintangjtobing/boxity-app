<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">new order - <span>#{{order.orderid}}</span></h4>
                </div>
            </div>
        </div>
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group mb-20">
                                    <input type="text" v-model="order.orderid" placeholder="Order track ID"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group mb-20">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                            <input type="text" v-model="order.sender" placeholder="Sender name"
                                                class="form-control" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" v-model="order.sender_address"
                                                placeholder="Sender address" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-20">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                            <input type="text" v-model="order.receiver" placeholder="Receiver name"
                                                class="form-control" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" v-model="order.receiver_address"
                                                placeholder="Receiver address" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-20">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                            <select v-model="order.sender_city" id="sender_city"
                                                class="form-control form-control-default ih-medium ip-gray radius-xs b-light fa-select"
                                                required>
                                                <option value="" disabled>Choose sender city</option>
                                                <option value="Medan">Medan</option>
                                                <option value="Pekanbaru">Pekanbaru</option>
                                                <option value="Palembang">Palembang</option>
                                                <option value="Jakarta">Jakarta</option>
                                                <option value="Semarang">Semarang</option>
                                                <option value="Surabaya">Surabaya</option>
                                                <option value="Bali">Bali</option>
                                                <option value="Lombok">Lombok</option>
                                                <option value="Makassar">Makassar</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" v-model="order.receiver_city" placeholder="Receiver city"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-20">
                                    <div class="form-row">
                                        <div class="col-lg-4">
                                            <select v-model="order.payload" id=""
                                                class="form-control form-control-default ih-medium ip-gray radius-xs b-light fa-select"
                                                required>
                                                <option value="" disabled>Choose payload:</option>
                                                <option value="Kg">Weight (Kg)</option>
                                                <option value="M">Volume (M)</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" v-model="order.payload_value" class="form-control"
                                                placeholder="Payload value ex: 25" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <editor placeholder="Order description..." v-model="order.description"
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
                                <div class="form-group">
                                    <div class="form-row justify-content-end">
                                        <div class="layout-button mt-25">
                                            <button type="submit"
                                                class="btn btn-success btn-default btn-squared px-30">submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
            return 'New track delivery';
        },
        data() {
            return {
                order: {
                    sender_city: '',
                    payload: '',
                },
            }
        },
        created() {
            this.loadOrderId();
        },
        methods: {
            async handleSubmit() {
                await axios.post('/api/track-delivery', this.order).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add new order track.',
                    });
                    this.$router.push('/track-delivery');
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
            loadOrderId() {
                var currentTime = new Date();
                let btsa = 'BTSA';
                let year = currentTime.getFullYear();
                let randomid = Math.floor(Math.random() * 999999);
                let month = currentTime.getMonth();
                let compact = btsa + year + month + randomid;
                this.order.orderid = compact;
            }
        },
    }

</script>
