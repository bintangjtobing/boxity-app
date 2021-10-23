<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">
                        New Item Group
                    </h2>
                </div>
            </div>
        </div>
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" v-model="itemgroup.itemgroup_id"
                                                placeholder="Item Group Code" class="form-control" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input type="text" v-model="itemgroup.name" placeholder="Item Group Name"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-2">
                                    <editor placeholder="Remarks..." v-model="itemgroup.remarks"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 150,
                                                                menubar: false,
                                                                branding: false,
                                                                toolbar:
                                                                    'undo redo | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
                                </div>
                                <hr style="margin-top:10px; margin-bottom:10px;">
                                <h5>Image</h5>
                                <p class="muted-text">This image is used for item that you inputted above.</p>
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
                                <div class="form-group my-2">
                                    <div class="justify-content-end">
                                        <button v-on:click="submitHandle" v-on:keyup.enter="submitHandle" type="submit"
                                            class="btn btn-secondary-boxity btn-default btn-squared px-30"
                                            data-dismiss="modal">Submit</button>
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
    import Editor from '@tinymce/tinymce-vue';
    import vue2Dropzone from 'vue2-dropzone';

    export default {
        components: {
            'editor': Editor,
            vueDropzone: vue2Dropzone,
        },
        title() {
            return 'New Item Group';
        },
        data() {
            return {
                itemgroup: {
                    stock_id: '',
                },

                // Image
                // TODO: callback to save the ids of the uploaded file
                dropzoneOptions: {
                    url: '/api/item-group/images',
                    thumbnailWidth: 200,
                    maxFilesize: 2, // MB
                    addRemoveLinks: true,
                    autoDiscover: false,
                    dictRemoveFile: 'REMOVE'
                },
            }
        },
        methods: {
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/item-group', this.itemgroup).then(response => {
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New Item Group',
                    });
                    this.$router.push('/item-group');
                    this.itemgroup = {
                        warehouse_code: '',
                        warehouse_name: '',
                        address: '',
                        remarks: '',
                        pic: '',
                        stock_id: '',
                    };
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
                // this.$Progress.finish();
                this.$isLoading(false);
            },
        },
    }

</script>
<style lang="css">
    .form-group {
        margin-bottom: 0;
    }

</style>
