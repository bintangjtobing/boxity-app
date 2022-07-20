<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Edit Category</h2>
                </div>
            </div>
        </div>
        <form @submit.prevent="submitHandle">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <h6>Category name</h6>
                                            <input type="text" v-model="categories.categories_name"
                                                placeholder="Enter title here" class="form-control mt-2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <h6>Descriptions</h6>
                                            <textarea class="form-control mt-2" rows="4" cols="8"
                                                v-model="categories.description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group my-2">
                                    <h4>Update Featured Image</h4>
                                    <vue-dropzone useCustomSlot ref="document-upload" id="dropzone"
                                        :options="dropzoneOptions" class="dropzone mt-2">
                                        <div class="dropzone-custom-content">
                                            <h3 class="dropzone-custom-title">Drag and drop to upload
                                                attachment!</h3>
                                            <div class="subtitle">...or click to select a file from your
                                                computer</div>
                                        </div>
                                    </vue-dropzone>
                                    <small class="form-text text-muted">
                                        File size max is 2MB. By default it will resize for all images based on the
                                        first image.</small>
                                    <h4 class="my-3">Current featured image</h4>
                                    <img :src="categories.image.file" :alt="categories.categories_name"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Vertical-form">
                        <div class="form-group mt-1 mb-3">
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
            return 'Edit Category';
        },
        data() {
            return {
                categories: {},

                dropzoneOptions: {
                    url: '/api/categories/images',
                    thumbnailWidth: 200,
                    maxFilesize: 2, // MB
                    addRemoveLinks: true,
                    autoDiscover: false,
                    dictRemoveFile: 'REMOVE'
                },
            }
        },
        created() {
            this.loadDataCategories();
            this.getCategories();
        },
        methods: {
            async loadDataCategories() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/categories/' + this.$route.params.id);
                this.categories = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/categories/' + this.$route.params.id, this.categories);
                document.getElementById('ding').play();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update categories.',
                });
                // this.$Progress.finish();
                this.$isLoading(false);
                this.$router.push('/categories-management');
            },
            async getCategories() {
                const resp = await axios.get('/api/categories');
                this.categoriesGet = resp.data;
            }
        },
    }

</script>
