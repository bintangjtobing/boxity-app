<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title mb-2">Informasi candidate</h4>
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
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header px-30 pt-30 pb-10 border-bottom-0">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-9 text-center bg-danger" v-if="candidates.status==false">
                                <h6>Already rejected on {{candidates.updated_at}} by {{candidates.updated_by}}</h6>
                            </div>
                            <div class="col-lg-9 text-center bg-success" v-if="candidates.status==true">
                                <h6>Already invited to interview on {{candidates.updated_at}} by
                                    {{candidates.updated_by}}</h6>
                            </div>
                            <div class="col-lg-9 text-center">
                                <h6>Application Information</h6>
                                <h2 style="font-size: 28px; font-weight: 700;">{{candidates.nama_lengkap}} -
                                    {{candidates.posisi.title}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-6 text-left">
                                <p>
                                    Nama Lengkap <br>
                                    <b>{{candidates.nama_lengkap}}</b> <br><br>
                                    <div v-if="candidates.jenis_kelamin">
                                        Gender <br>
                                        <b>
                                            <span v-if="candidates.jenis_kelamin=='Pria'"><i
                                                    class="fal fa-mars"></i>&nbsp;
                                                {{candidates.jenis_kelamin}}</span>
                                            <span v-if="candidates.jenis_kelamin=='Wanita'"><i
                                                    class=" fal fa-venus"></i>&nbsp;
                                                {{candidates.jenis_kelamin}}</span>
                                        </b>
                                        <br><br>
                                    </div>
                                    <div v-if="candidates.noktp">
                                        No. NIK <br>
                                        <b>{{candidates.noktp}}</b> <br><br>
                                    </div>
                                    <div v-if="candidates.nonpwp">
                                        No. NPWP <br>
                                        <b v-if="candidates.nonpwp=='NULL'">-</b>
                                        <b>{{candidates.nonpwp}}</b> <br><br>
                                    </div>
                                    <div v-if="candidates.nobpjs">
                                        No. BPJS <br>
                                        <b v-if="candidates.nobpjs=='NULL'">-</b>
                                        <b>{{candidates.nobpjs}}</b> <br><br>
                                    </div>
                                    <div v-if="candidates.tempat_lahir || candidates.tanggal_lahir">
                                        Tempat, Tanggil Lahir <br>
                                        <b>{{candidates.tempat_lahir}},
                                            {{candidates.tanggal_lahir}}</b><br><br>
                                    </div>
                                    <div v-if="candidates.alamat_domisili">
                                        Alamat Tempat Tinggal <br>
                                        <b><span v-html="candidates.alamat_domisili"></span></b>
                                        <div v-if="candidates.provinsi && candidates.domisili && candidates.kecamatan">
                                            Provinsi, Domisili - Kecamatan/Kelurahan <br>
                                            <b>{{candidates.provinsi.province_name}},
                                                {{candidates.domisili.domisili_name}} -
                                                {{candidates.kecamatan.kecamatan_name}}/{{candidates.kelurahan.kelurahan_name}}</b>
                                        </div>
                                        <br><br>
                                    </div>
                                    <div v-if="candidates.pendidikan_akhir">
                                        Pendidikan Terakhir <br>
                                        <b>{{candidates.pendidikan_akhir}}</b><br><br>
                                    </div>
                                    <div v-if="candidates.agama && candidates.suku">
                                        Agama, Suku <br>
                                        <b>{{candidates.agama.agama_name}},
                                            {{candidates.suku.suku_name}}</b><br><br>
                                    </div>
                                    <div v-if="candidates.sumber_informasi">
                                        Informasi Lowongan <br>
                                        <b>{{candidates.sumber_informasi}}</b><br><br>
                                    </div>
                                    <div v-if="candidates.status_perkawinan">
                                        Status Perkawinan <br>
                                        <b>{{candidates.status_perkawinan}}</b> <br><br>
                                    </div>
                                    <div v-if="candidates.expected_sallary">
                                        Gaji yang diharapkan <br>
                                        <b>{{candidates.expected_sallary}}</b> <br><br>
                                    </div>
                                    Tentang saya <br><span v-html="candidates.about"></span>
                                </p>
                            </div>
                            <div class="col-lg-4 text-left">
                                <img v-if="candidates.picture" class="pasfoto" :src="candidates.picture"
                                    style="width: 113.3px; height: 151.1px; object-fit:cover;">
                                <br><br>
                                <p>
                                    Email <br>
                                    <b>{{candidates.email}}</b><br><br>
                                    Nomor HP <br>
                                    <b>{{candidates.nohp}}</b><br><br>
                                    <div class="atbd-button-list d-flex flex-wrap align-items-end">
                                        <a @click="rejectCandidate"
                                            class="btn btn-primary-boxity btn-default btn-rounded mr-1"
                                            :class="{disabled: isDisabled}">Reject
                                        </a>
                                        <a @click="interviewCandidate"
                                            class="btn btn-success btn-default btn-rounded mr-1"
                                            :class="{disabled: isDisabledInvite}">Invite to Interview
                                        </a>
                                        <a v-if="candidates.supported_file" :href="candidates.supported_file" download
                                            target="_blank"
                                            class="btn btn-default btn-rounded btn-outline-primary-boxity mr-1">Download
                                        </a>
                                        <a v-if="candidates.noktp" :href="`/generate/pdf/`+candidates.id"
                                            target="_blank"
                                            class="btn btn-default btn-rounded btn-outline-primary-boxity">Export
                                        </a>
                                    </div>
                                    <!-- ends: .atbd-button-list" -->
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
            return `Detail candidate`;
        },
        data() {
            return {
                candidates: {},
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
                const resp = await axios.get('/api/candidates/' + this.$route.params.id);
                this.candidates = resp.data;
                if (this.candidates.status == false || this.candidates.status == true) {
                    this.isDisabled = true;
                    this.isDisabledInvite = true;
                }
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            rejectCandidate() {
                // alert(this.candidates.id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'rgba(243, 118, 73)',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reject it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$isLoading(true);
                        axios.patch('/api/candidates/' + this.$route.params.id);
                        this.$isLoading(false);
                        Swal.fire(
                            'Rejected!',
                            'Your candidate has been rejected.',
                            'success'
                        )
                        this.loadCandidate();
                        this.isDisabled = true;
                    }
                })
            },
            interviewCandidate() {
                // alert(this.candidates.id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'rgba(243, 118, 73)',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, invite this person!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$isLoading(true);
                        axios.patch('/api/candidates/a/' + this.$route.params.id);
                        this.$isLoading(false);
                        Swal.fire(
                            'Invited!',
                            'Your candidate has been invited to interview.',
                            'success'
                        )
                        this.loadCandidate();
                        this.isDisabledInvite = true;
                    }
                })
            }
        },
    }

</script>
