<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">new album - <span>{{album.title}}</span></h4>
                </div>
            </div>
        </div>
        <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group">
                                    <input type="text" required v-model="album.title" class="form-control"
                                        placeholder="Album title">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <vue-dropzone useCustomSlot ref="document-upload" id="dropzone"
                                            :options="dropzoneOptions" class="dropzone">
                                            <div class="dropzone-custom-content">
                                                <h3 class="dropzone-custom-title">Drag and drop to upload
                                                    attachment!</h3>
                                                <div class="subtitle">...or click to select a file from your
                                                    computer</div>
                                            </div>
                                        </vue-dropzone>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row justify-content-end">
                                        <div class="layout-button mt-25">
                                            <button type="submit"
                                                class="btn btn-success btn-default btn-squared px-30">submit</button>
                                        </div>
                                    </div>
                                </div>
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
    import vue2Dropzone from 'vue2-dropzone';

    export default {
        title() {
            return 'New album';
        },
        components: {
            vueDropzone: vue2Dropzone,
        },
        data() {
            return {
                album: {},
                // TODO: callback to save the ids of the uploaded file
                dropzoneOptions: {
                    url: '/api/documents',
                    thumbnailWidth: 150,
                    addRemoveLinks: true,
                    autoDiscover: false,
                    parallelUploads: 10,
                    autoProcessQueue: false,
                    dictRemoveFile: 'REMOVE'
                },
            }
        },
        methods: {
            async handleSubmit() {
                this.$refs['document-upload'].processQueue();
                await axios.post('/api/album', this.album).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add new album.',
                    });
                    this.$router.push('/gallery');
                }).catch(error => {
                    Swal.fire({
                        icon: 'error',
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
            }
        },
    }

</script>
