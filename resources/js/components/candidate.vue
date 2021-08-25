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
                                <v-data-table loading loading-text="Loading... Please wait" :headers="headers"
                                    :items="candidates" :items-per-page="10" class="elevation-1" :search="search">
                                    <template v-slot:item.details="{ item }">
                                        <div>
                                            <router-link :to="`/candidate/detail/`+item.id" class="rounded-pill userDatatable-content-status color-primary
                                                bg-opacity-primary active">
                                                <i class="fal fa-exclamation-circle"></i> &nbsp;Data lengkap
                                            </router-link>
                                        </div>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <a v-on:click="deleteData(item.id)" class="remove">
                                            <i class="fad fa-trash"></i></a>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <span class="my-3"><i class="fad fa-info-circle"></i> Having a trouble? You can see and learn from
            <a href="https://help.boxity.id/human-resources-management/candidate" target="_blank">Help and
                Documentation</a>'s page.</span>
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
                    text: 'Details',
                    filterable: false,
                    value: 'details'
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
