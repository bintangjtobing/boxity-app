<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title mb-2">Candidate Management</h4>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header px-30 pt-30 pb-10 border-bottom-0">
                        <h4 class="fw-500">See the applied candidate lists</h4>
                    </div>
                    <div class="card-body">
                        <div
                            class="userDatatable adv-table-table global-shadow p-10 border bg-white radius-xl w-100 mb-30">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details>
                                    </v-text-field>
                                </v-card-title>
                                <v-data-table :loading="loading" loading-text="Loading... Please wait"
                                    :headers="headers" :items="candidates" :items-per-page="10" class="elevation-1"
                                    :search="search">
                                    <template v-slot:item.actions="{item}">
                                        <router-link :to="`/candidate/detail/`+item.id" class="view">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="deleteData(item.id)" class="remove">
                                            <i class="fad fa-trash"></i>
                                        </a>
                                    </template>
                                    <template v-slot:item.status="{item}">
                                        <span class="rounded-pill userDatatable-content-status color-success
                                            bg-opacity-success text-capitalize" v-if="item.status ==null">Waiting for
                                            checking...</span>
                                        <span class="rounded-pill userDatatable-content-status color-danger
                                            bg-opacity-danger text-capitalize"
                                            v-if="item.status ==false">Rejected</span>
                                        <span class="rounded-pill userDatatable-content-status color-primary
                                            bg-opacity-primary text-capitalize" v-if="item.status ==true">Requested for
                                            Interview</span>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12 col-lg-12 col-md-12 mb-25">
                <div class="feature-cards5 d-flex justify-content-between border-0 radius-xl bg-white p-25">
                    <div class="application-task d-flex align-items-center">
                        <div class="application-task-content">
                            <span><strong>Need help?</strong> Check out our <a href="https://help.boxity.id"
                                    target="_blank">documentation</a> or our <a href="#">getting
                                    started video series</a> to quickly learn the basics or <router-link
                                    to="/new-issue">reach out to our
                                    team</router-link>, we'd happy to help.</span>
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
            return 'Candidate';
        },
        data() {
            return {
                search: '',
                key: 1,
                loading: true,
                headers: [{
                    text: 'Name',
                    value: 'nama_lengkap'
                }, {
                    text: 'Tanggal',
                    value: 'created_at'
                }, {
                    text: 'Posisi Yang Dilamar',
                    value: 'posisi.title'
                }, {
                    text: 'Pendidikan',
                    value: 'pendidikan_akhir'
                }, {
                    text: 'Status',
                    value: 'status'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                count: 0,
                candidates: [],
            }
        },
        mounted() {
            this.loadCandidates();
        },
        methods: {
            async loadCandidates() {
                // this.$Progress.start();
                this.$isLoading(true);
                const res = await axios.get('/api/candidates');
                this.candidates = res.data;
                if (res.data.length) {
                    this.loading = false;
                }
                axios.get("/api/users")
                    .then(resp => {
                        this.members = resp.data;
                    });
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteData(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete data candidate?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('/api/candidates/' + id);
                    this.loadCandidates();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current candidates'
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }
            },
        },
    }

</script>
