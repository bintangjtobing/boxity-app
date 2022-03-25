<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">
                        New Blog
                    </h2>
                </div>
            </div>
        </div>
        <form @submit.prevent="submitHandle(e='publish')">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <input type="text" v-model="blog.title" placeholder="Enter title here"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <editor placeholder="Remarks..." v-model="blog.description"
                                                api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 1600,
                                                                menubar: true,
                                                                branding: false,
                                                                plugins: 'code',
                                                        }" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="Vertical-form">
                        <div class="form-group my-2">
                            <div class="justify-content-end">
                                <a v-on:click="submitHandle(e='draft')"
                                    class="btn btn-secondary-boxity btn-default btn-block btn-squared px-30"
                                    data-dismiss="modal">Save Draft</a>
                            </div>
                        </div>
                    </div>
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group my-2">
                                    <h4>Feature Image</h4>
                                    <vue-dropzone useCustomSlot ref="document-upload" id="dropzone"
                                        :options="dropzoneOptions" class="dropzone mt-2">
                                        <div class="dropzone-custom-content">
                                            <h3 class="dropzone-custom-title">Drag and drop to upload
                                                attachment!</h3>
                                            <div class="subtitle">...or click to select a file from your
                                                computer</div>
                                        </div>
                                    </vue-dropzone>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group my-2">
                                    <h4>Categories</h4>
                                    <div class="categories_list">
                                        <div v-for="categoriesGet in categoriesGet" :key="categoriesGet.id">
                                            <input type="checkbox" :id="categoriesGet.id"
                                                :value="categoriesGet.categories_name" v-model="categoriesArr">
                                            <label :for="categoriesGet.id">{{categoriesGet.categories_name}}</label>
                                        </div>
                                        <span>
                                            categories add: {{categoriesArr}}
                                        </span>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade new-member" id="newCategory" role="dialog" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content modal-lg radius-xl">
                                                <div class="modal-header">
                                                    <h6 class="modal-title fw-500" id="staticBackdropLabel">New category
                                                    </h6>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="fal fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="new-member-modal">
                                                        <form>
                                                            <div class="form-group mb-20">
                                                                <input type="text" v-model="categories.categories_name"
                                                                    class="form-control" placeholder="Categories name">
                                                            </div>
                                                            <div class="form-group mb-20">
                                                                <editor placeholder="Category descriptions..."
                                                                    v-model="categories.description"
                                                                    api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om"
                                                                    :init="{
                                                                height: 300,
                                                                menubar: true,
                                                                branding: false,
                                                                plugins: 'code',
                                                                toolbar:
                                                                    'undo redo | fontselect | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
                                                            </div>
                                                            <div class="button-group d-flex pt-25">
                                                                <button v-on:click="handleSubmitNewCategories"
                                                                    class="btn btn-primary-boxity btn-default btn-squared text-capitalize"
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
                                    <hr style="margin-top: 0; margin-bottom: 10px;">
                                    <a href="#" data-toggle="modal" data-target="#newCategory">+ New Category</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Vertical-form">
                        <div class="form-group my-2">
                            <div class="justify-content-end">
                                <button type="submit"
                                    class="btn btn-primary-boxity btn-default btn-block btn-squared px-30"
                                    data-dismiss="modal">Publish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';
    import vue2Dropzone from 'vue2-dropzone';

    export default {
        components: {
            'editor': Editor,
            vueDropzone: vue2Dropzone,
        },
        title() {
            return 'New Blog';
        },
        data() {
            return {
                blog: {},
                categories: {},
                categoriesArr: [],
                categoriesGet: [],

                // Image
                // TODO: callback to save the ids of the uploaded file
                dropzoneOptions: {
                    url: '/api/blogs/images',
                    thumbnailWidth: 200,
                    maxFilesize: 2, // MB
                    addRemoveLinks: true,
                    autoDiscover: false,
                    dictRemoveFile: 'REMOVE'
                },
            }
        },
        created() {
            this.getCategories();
        },
        methods: {
            async submitHandle(e) {
                // console.log(e);
                this.$isLoading(true);
                await axios.post('/api/blogs', {
                        title: this.blog.title,
                        description: this.blog.description,
                        category: this.categoriesArr,
                        type: e,
                    }).then(response => {
                        document.getElementById('ding').play();
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Success Create New Blog',
                        });
                        this.$router.push('/blog-management');
                        this.blog = {};
                    })
                    .catch(error => {
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
                this.$isLoading(false);
                console.log(this.blog);
            },
            async handleSubmitNewCategories() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/categories', this.categories).then(response => {
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success Create New Category',
                    });
                    this.categories = {};
                    this.getCategories();
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
                    });
                });
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async getCategories() {
                const resp = await axios.get('/api/categories');
                this.categoriesGet = resp.data;
            }
        },
    }

</script>
<style lang="css">
    .form-group {
        margin-bottom: 0;
    }

</style>
