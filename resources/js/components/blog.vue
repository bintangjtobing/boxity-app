<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Content management</h2>
                    <div class="action-btn">
                        <router-link to="/blog-management/create" class="btn btn-sm btn-primary-boxity btn-add">
                            <i class="las la-plus fs-16"></i> Create Content</router-link>
                    </div>
                </div>
                <div class="row mt-4">
                    <span @click="routerBack" class="btn btn-circle-light-boxity fa-center"><i
                            class="fad fa-arrow-left"></i></span>
                    <span @click="routerRefresh" class="btn btn-circle-light-boxity fa-center"><i
                            class="fad fa-sync"></i></span>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :loading="loading" loading-text="Loading... Please wait" :headers="headers"
                            :items="blogs" :items-per-page="10" class="elevation-1">
                            <template v-slot:[`item.status`]="{item}">
                                <span class="rounded-pill userDatatable-content-status color-success
                                            bg-opacity-success active" v-if="item.status == 1"><i
                                        class="fas fa-check"></i>&nbsp; Approved & Published</span>
                                <span class="rounded-pill userDatatable-content-status color-primary
                                            bg-opacity-primary active" v-if="item.status == 0"><i
                                        class="fas fa-file"></i>&nbsp; Draft / Waiting for approval</span>
                            </template>
                            <template v-slot:item.title="{ item }">
                                <div class="userDatatable-inline-title my-3">
                                    <router-link :to="`/edit/blog/`+item.id" class="text-dark fw-500">
                                        <h6 v-if="item.title.length < 45">{{item.title}}
                                        </h6>
                                        <h6 v-if="item.title.length >= 45">
                                            {{item.title.substring(0,44)+"..."}}
                                        </h6>
                                    </router-link>
                                </div>
                            </template>
                            <template v-slot:[`item.views`]="{item}">
                                <span>{{item.views}} Views</span>
                            </template>
                            <template v-slot:[`item.earnings.earning`]="{item}">
                                <span v-if="item.earnings !== null">Rp. {{item.earnings.earning|toDecimal}}</span>
                                <span v-else>Rp. 0</span>
                            </template>
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/edit/blog/${item.id}`" class="edit">
                                    <i class="fad fa-eye"></i></router-link>
                                <a @click="deleteBlog(item.id)" class="remove">
                                    <i class="fad fa-trash"></i></a>
                            </template>
                        </v-data-table>
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
    import Editor from '@tinymce/tinymce-vue';

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'Content';
        },
        data() {
            return {
                blog: {
                    category: '',
                },
                // datatable
                blogs: [],
                search: '',
                key: 1,
                loading: true,
                headers: [{
                    text: 'Title',
                    value: 'title'
                }, {
                    text: 'Author',
                    value: 'user.name'
                }, {
                    text: 'Status',
                    value: 'status'
                }, {
                    text: 'Uploaded date',
                    value: 'created_at'
                }, {
                    text: 'Views',
                    value: 'views'
                }, {
                    text: 'Earnings',
                    value: 'earnings.earning'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // end datatable
            }
        },
        created() {
            this.loadBlogs();
        },
        methods: {
            async loadBlogs() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/blogs');
                this.blogs = resp.data;
                if (resp.data.length) {
                    this.loading = false;
                }
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteBlog(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete blog?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('api/blogs/' + id);
                    this.loadBlogs();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted blog'
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }
            },
            async handleSubmit() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/blogs', this.blog).then(response => {
                    this.loadBlogs();
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New blog',
                    });
                    this.blog = {
                        title: '',
                        description: '',
                        category: '',
                    }
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }).catch(error => {
                    this.$Progress.fail();
                    document.getElementById('failding').play();
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
            routerBack() {
                this.$router.go(-1);
            },
            routerRefresh() {
                this.loadBlogs();
            },
        },
    }

</script>
