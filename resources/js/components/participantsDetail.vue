<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title mb-2">Participant Informations</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <span @click="routerBack" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-arrow-left"></i></span>
            <span @click="routerRefresh" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-sync"></i></span>
        </div>
        <div class="row mb-3">
            <div class="col-md-7">
                <div class="card mb-3">
                    <div class="card-header px-30 pt-30 pb-10 border-bottom-0">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-8 text-left">
                                <h6>Participant Information</h6>
                                <h2 style="font-size: 28px; font-weight: 700;">{{participants.name}} -
                                    {{participants.event.event_name}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-8 text-left">
                                <p>
                                    Nama Lengkap <br>
                                    <b>{{participants.name}}</b> <br><br>
                                    <div v-if="participants.email">
                                        Email <br>
                                        <b>{{participants.email}}</b> <br><br>
                                    </div>
                                    <div v-if="participants.nohp">
                                        No. Handphone <br>
                                        <b v-if="participants.nohp=='NULL'">-</b>
                                        <b>{{participants.nohp}}</b> <br><br>
                                    </div>
                                    <div v-if="participants.type">
                                        Tipe Peserta <br>
                                        <b v-if="participants.type=='NULL'">-</b>
                                        <b>{{participants.type}}</b> <br><br>
                                    </div>
                                    <div v-if="participants.sector">
                                        Sektor perusahaan/usaha/asal <br>
                                        <b>{{participants.sector}}</b><br><br>
                                    </div>
                                    Tentang saya <br><b>{{participants.description}}</b>
                                </p>
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
            return `Participant Informations`;
        },
        data() {
            return {
                participants: {},
                isDisabled: true,
                isDisabledInvite: true,
            }
        },
        created() {
            this.loadCandidate();
        },
        methods: {
            routerBack() {
                this.$router.go(-1);
            },
            routerRefresh() {
                this.loadCandidate();
            },
            async loadCandidate() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/participant/' + this.$route.params.id);
                this.participants = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
        },
    }

</script>
