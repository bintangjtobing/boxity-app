<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Blog management</h4>
                    <div class="action-btn">
                        <a href="#" class="btn px-15 btn-primary" data-toggle="modal" data-target="#newMember">
                            <i class="las la-plus fs-16"></i>Add new blog</a>

                        <!-- Modal -->
                        <div class="modal fade new-member" id="newMember" role="dialog" tabindex="-1"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content modal-lg radius-xl">
                                    <div class="modal-header">
                                        <h6 class="modal-title fw-500" id="staticBackdropLabel">Add new blog</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="new-member-modal">
                                            <form>
                                                <div class="form-group mb-20">
                                                    <input type="text" v-model="blog.title" class="form-control"
                                                        placeholder="Blog title">
                                                </div>
                                                <div class="form-group mb-20">
                                                    <editor placeholder="Blog descriptions..."
                                                        v-model="blog.description"
                                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om"
                                                        :init="{
                                                                height: 300,
                                                                menubar: false,
                                                                branding: false,
                                                                toolbar:
                                                                    'undo redo | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
                                                </div>
                                                <div class="form-group mb-20">
                                                    <select v-model="blog.category"
                                                        class="form-control form-control-default px-15"
                                                        id="exampleFormControlSelect1">
                                                        <option value="" disabled>Select category:</option>
                                                        <option value="Ekspor">Ekspor</option>
                                                        <option value="Impor">Impor</option>
                                                        <option value="Umum">Umum</option>
                                                    </select>
                                                </div>
                                                <div class="button-group d-flex pt-25">
                                                    <button v-on:click="handleSubmit"
                                                        class="btn btn-primary btn-default btn-squared text-capitalize"
                                                        data-dismiss="modal">submit
                                                    </button>
                                                    <button class="btn btn-light btn-default btn-squared fw-400
                                                        text-capitalize b-light color-light" data-dismiss="modal"
                                                        aria-label="Close">cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->


                    </div>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table loading loading-text="Loading... Please wait" :headers="headers" :items="blogs"
                            :items-per-page="10" class="elevation-1">
                            <template v-slot:item.title="{ item }">
                                <div class="userDatatable-inline-title my-3">
                                    <a href="#" class="text-dark fw-500">
                                        <h6 v-if="item.title.length < 45">{{item.title}}
                                        </h6>
                                        <h6 v-if="item.title.length >= 45">
                                            {{item.title.substring(0,44)+"..."}}
                                        </h6>
                                        <p>Created by {{item.user.name}} | {{item.created_at}}</p>
                                    </a>
                                </div>
                            </template>
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/detail/blogs/${item.id}`" class="view">
                                    <i class="fas fa-eye"></i></router-link>
                                <router-link :to="`/edit/blog/${item.id}`" class="edit">
                                    <i class="fas fa-pen"></i></router-link>
                                <a @click="deleteBlog(item.id)" class="remove">
                                    <i class="fas fa-trash"></i></a>
                            </template>
                        </v-data-table>
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
            return 'Blog';
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
                headers: [{
                    text: 'Title',
                    value: 'title'
                }, {
                    text: 'Category',
                    value: 'category'
                }, {
                    text: 'Views',
                    value: 'views'
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
                this.$Progress.start();
                const resp = await axios.get('/api/blogs');
                this.blogs = resp.data;
                this.$Progress.finish();
            },
            async deleteBlog(id) {
                const result = await Swal.fire({
                    title: 'Delete blog?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    this.$Progress.start();
                    await axios.delete('api/blogs/' + id);
                    this.loadBlogs();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted blog'
                    });
                    this.$Progress.finish();
                }
            },
            async handleSubmit() {
                this.$Progress.start();
                await axios.post('/api/blogs', this.blog).then(response => {
                    this.loadBlogs();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add new blog',
                    });
                    this.blog = {
                        title: '',
                        description: '',
                        category: '',
                    }
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.fail();
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
        },
    }

</script>
