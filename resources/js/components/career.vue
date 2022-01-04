<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main mb-2">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Career</h2>
                    <div class="action-btn">
                        <router-link :to="`/career/new`" class="btn px-15 btn-primary">
                            <i class="las la-plus fs-16"></i>New job vacancy</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table :loading="loading" loading-text="Loading... Please wait..."
                                    :search="search" :headers="headers" multi-sort :items="careers" :items-per-page="10"
                                    show-expand class="elevation-1">
                                    <template v-slot:[`item.actions`]="{item}">
                                        <router-link :to="`/career/${item.id}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="deleteCareer(item.id)" class="remove">
                                            <i class="fad fa-trash"></i></a>
                                    </template>
                                    <template v-slot:expanded-item="{ headers,item }">
                                        <td :colspan="headers.length">
                                            <div v-html="item.description"></div>
                                        </td>
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
            return 'Career';
        },
        data() {
            return {
                search: '',
                key: 1,
                loading: true,
                headers: [{
                    text: 'Job Title',
                    value: 'title'
                }, {
                    text: 'Location',
                    value: 'location'
                }, {
                    text: 'Department',
                    value: 'divisi'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                careers: [],
            }
        },
        mounted() {
            this.loadCareers();
        },
        methods: {
            async loadCareers() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/career');
                this.careers = resp.data;
                if (resp.data.description > 20) {
                    let desc = resp.data.description.substring(0, 17) + '...';
                    this.careers.description = desc;
                }
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteCareer(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete job vacancy?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('api/career/' + id);
                    this.loadCareers();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current job vacancy'
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }
            },
        },
    }

</script>
