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
                                    <template v-slot:[`item.views`]="{item}">
                                        <span>{{item.views}} Clicks</span>
                                    </template>
                                    <template v-slot:[`item.actions`]="{item}">
                                        <router-link :to="`/career/${item.id}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="closeCareer(item.id)" class="remove">
                                            <i class="fad fa-times"></i></a>
                                        <a v-on:click="deleteCareer(item.id)" class="remove">
                                            <i class="fad fa-trash"></i></a>
                                    </template>
                                    <template v-slot:item.status="{item}">
                                        <span class="rounded-pill userDatatable-content-status color-success
                                            bg-opacity-success text-capitalize" v-if="item.status ==0">Open</span>
                                        <span class="rounded-pill userDatatable-content-status color-danger
                                            bg-opacity-danger text-capitalize" v-if="item.status ==2">Closed</span>
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
        <span class="my-3"><i class="fad fa-info-circle"></i> Having a trouble? You can see and learn from
            <a href="https://help.boxity.id/human-resources-management/job-vacancy" target="_blank">Help and
                Documentation</a>'s page.</span>
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
                    }, {}, {
                        text: 'Status',
                        value: 'status'
                    }, {
                        text: 'Department',
                        value: 'divisi'
                    },
                    {
                        text: 'Views',
                        value: 'views',
                    }, {
                        text: 'Actions',
                        value: 'actions',
                        filterable: false,
                        sortable: false
                    }
                ],
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
            async closeCareer(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Close job vacancy?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Close`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.patch('api/career/c/' + id);
                    this.loadCareers();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Closed',
                        text: 'Success closed current job vacancy'
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }
            },
        },
    }

</script>
