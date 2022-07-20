<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">
                        New Sub Category
                    </h2>
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
                                            <h6>Sub Category name</h6>
                                            <input type="text" v-model="subcategories.title"
                                                placeholder="Enter subcategories name here" class="form-control mt-2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <h6>Descriptions</h6>
                                            <textarea class="form-control mt-2" rows="4" cols="8"
                                                v-model="subcategories.description"></textarea>
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
                                    <h4>Featured Image</h4>
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
            return 'New category';
        },
        data() {
            return {
                subcategories: {},

                // Image
                // TODO: callback to save the ids of the uploaded file
                dropzoneOptions: {
                    url: '/api/sub-categories/images',
                    thumbnailWidth: 200,
                    maxFilesize: 2, // MB
                    addRemoveLinks: true,
                    autoDiscover: false,
                    dictRemoveFile: 'REMOVE'
                },
            }
        },
        created() {
            this.getSubCategories();
        },
        methods: {
            async submitHandle(e) {
                // console.log(e);
                this.$isLoading(true);
                await axios.post('/api/sub-categories', {
                        sub_categories_name: this.subcategories.title,
                        description: this.subcategories.description,
                    }).then(response => {
                        document.getElementById('ding').play();
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Success Create New Sub Categories',
                        });
                        this.$router.push('/categories-management');
                        this.subcategories = {};
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
                console.log(this.subcategories);
            },
            async handleSubmitNewCategories() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/sub-categories', this.categories).then(response => {
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success Create New Sub Category',
                    });
                    this.categories = {};
                    this.getSubCategories();
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
            async getSubCategories() {
                const resp = await axios.get('/api/sub-categories');
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
