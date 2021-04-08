<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title mb-2">Informasi candidate</h4>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header px-30 pt-30 pb-10 border-bottom-0">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-9 text-center">
                                <h6>Application Information</h6>
                                <h2 style="font-size: 28px; font-weight: 700;">{{candidates.nama_lengkap}} -
                                    {{candidates.posisi.title}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-7 text-left">
                                <p>
                                    Nama Lengkap <br>
                                    <b>{{candidates.nama_lengkap}}</b> <br><br>
                                    Gender <br>
                                    <b>
                                        <span v-if="candidates.jenis_kelamin=='Pria'"><i class="fas fa-mars"></i>&nbsp;
                                            {{candidates.jenis_kelamin}}</span>
                                        <span v-if="candidates.jenis_kelamin=='Wanita'"><i
                                                class=" fas fa-venus"></i>&nbsp;
                                            {{candidates.jenis_kelamin}}</span>
                                    </b><br><br>
                                    No. NIK <br>
                                    <b>{{candidates.noktp}}</b> <br><br>
                                    Tempat, Tanggil Lahir <br>
                                    <b>{{candidates.tempat_lahir}},
                                        {{candidates.tanggal_lahir}}</b><br><br>
                                    Alamat Tempat Tinggal <br>
                                    <b><span v-html="candidates.alamat_domisili"></span></b>
                                    Provinsi, Domisili - Kecamatan/Kelurahan <br>
                                    <b>{{candidates.provinsi.province_name}}, {{candidates.domisili.domisili_name}} -
                                        {{candidates.kecamatan.kecamatan_name}}/{{candidates.kelurahan.kelurahan_name}}</b>
                                    <br><br>
                                    Pendidikan Terakhir <br>
                                    <b>{{candidates.pendidikan_akhir}}</b><br><br>
                                    Agama, Suku <br>
                                    <b>{{candidates.agama.agama_name}}, {{candidates.suku.suku_name}}</b><br><br>
                                    Informasi Lowongan <br>
                                    <b>{{candidates.sumber_informasi}}</b><br><br>
                                    Status Perkawinan <br>
                                    <b>{{candidates.status_perkawinan}}</b> <br><br>
                                </p>
                                <h3>Tentang saya</h3> <br><span v-html="candidates.about"></span>
                            </div>
                            <div class="col-lg-3 text-left">
                                <a href="" target="_blank"><img class="pasfoto"
                                        :src="`/storage/file/`+candidates.nama_lengkap+`/`+candidates.picture"></a>
                                <br><br>
                                <p>
                                    Email <br>
                                    <b>{{candidates.email}}</b><br><br>
                                    Nomor HP <br>
                                    <b>{{candidates.nohp}}</b><br><br>
                                    <a :href="`/storage/file/`+candidates.nama_lengkap+`/`+candidates.supported_file"
                                        download class="rounded-pill userDatatable-content-status color-primary
                                                bg-opacity-primary active">
                                        <i class="fas fa-paperclip"></i> &nbsp;Supported Document
                                    </a>
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
    export default {
        title() {
            return `Detail candidate` + candidates.nama_lengkap;
        },
        data() {
            return {
                candidates: {},
            }
        },
        created() {
            this.loadCandidate();
        },
        methods: {
            async loadCandidate() {
                const resp = await axios.get('/api/candidates/' + this.$route.params.id);
                this.candidates = resp.data[0];
            },
        },
    }

</script>
