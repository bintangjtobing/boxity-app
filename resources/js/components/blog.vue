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
                                                    <textarea v-model="blog.description" class="form-control" id=""
                                                        cols="30" rows="10"
                                                        placeholder="Blog descriptions..."></textarea>
                                                </div>
                                                <div class="form-group mb-20">
                                                    <select v-model="blog.category"
                                                        class="form-control custom-select px-15"
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
                <div class="userDatatable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <span class="userDatatable-title">
                                            Title</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Categories</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Views</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!blogs.length">
                                    <td colspan="4">
                                        <div class="atbd-empty text-center">
                                            <div class="atbd-empty__image">
                                                <img src="/dashboard/img/folders/1.svg" alt="Admin Empty">
                                            </div>
                                            <div class="atbd-empty__text">
                                                <p class="">No blog.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-for="blog in blogs" :key="blog.id">
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <h6 v-if="blog.title.length < 45">{{blog.title}}
                                                    </h6>
                                                    <h6 v-if="blog.title.length >= 45">
                                                        {{blog.title.substring(0,44)+"..."}}
                                                    </h6>
                                                    <p>Created by {{blog.user.name}} | {{blog.created_at}}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            {{blog.category}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content d-inline-block">
                                            {{blog.views}} views
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                            <li>
                                                <router-link :to="`/detail/blogs/${blog.id}`" class="view">
                                                    <i class="fas fa-eye"></i></router-link>
                                            </li>
                                            <li>
                                                <router-link :to="`/edit/blog/${blog.id}`" class="edit">
                                                    <i class="fas fa-pen"></i></router-link>
                                            </li>
                                            <li>
                                                <a @click="deleteBlog(blog.id)" class="remove">
                                                    <i class="fas fa-trash"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
            return 'Blog';
        },
        data() {
            return {
                blog: {
                    category: '',
                },
                blogs: {},
            }
        },
        created() {
            this.loadBlogs();
        },
        methods: {
            async loadBlogs() {
                const resp = await axios.get('/api/blogs');
                this.blogs = resp.data;
            },
            async deleteBlog(id) {
                const result = await Swal.fire({
                    title: 'Delete blog?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('api/blogs/' + id);
                    this.loadBlogs();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted blog'
                    });
                }
            },
            async handleSubmit() {
                await axios.post('/api/blogs', this.blog);
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
            }
        },
    }

</script>
