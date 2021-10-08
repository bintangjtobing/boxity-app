<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Item Group - <abbr
                                    :title="itemgroup.name">{{itemgroup.name}}</abbr></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <span @click="routerBack" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-arrow-left"></i></span>
            <span @click="routerRefresh" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-sync"></i></span>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="user-info-tab w-100 bg-white global-shadow radius-xl mb-50">
                    <div class="ap-tab-wrapper border-bottom ">
                        <ul class="nav px-30 ap-tab-main text-capitalize" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                    role="tab" aria-controls="v-pills-home" aria-selected="true">details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-image-tab" data-toggle="pill" href="#v-pills-image"
                                    role="tab" aria-controls="v-pills-image" aria-selected="true">Item Images</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <form @submit.prevent="handleSubmit">
                                                    <div class="form-row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <input type="text" v-model="itemgroup.itemgroup_id"
                                                                    placeholder="Item Group Code" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="form-group">
                                                                <input type="text" v-model="itemgroup.name"
                                                                    placeholder="Item Group Name" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <editor placeholder="Remarks..." v-model="itemgroup.remarks"
                                                            api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om"
                                                            :init="{
                                                                height: 150,
                                                                menubar: false,
                                                                branding: false,
                                                                toolbar:
                                                                    'undo redo | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
                                                    </div>
                                                    <div class="button-group d-flex pt-25">
                                                        <button type="submit"
                                                            class="btn btn-primary-boxity btn-default btn-squared text-capitalize">Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  show" id="v-pills-image" role="tabpanel"
                            aria-labelledby="v-pills-image-tab">
                            <div class="row mx-4">
                                <div class="col-lg-4 text-center itemImage" v-for="image in imgs" :key="image.id">
                                    <a :href="image.file" target="_blank"><img :src="image.file"></a>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12 text-center">
                                            <a v-on:click="deleteThisImage(image.id)"
                                                class="btn btn-danger-boxity btn-block"><i
                                                    class="fad fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="this.imgs.length">
                                <div class="col-lg-12 text-center mb-3" v-if="addItemBtn">
                                    <a v-on:click="itemImageAdds"><span class="itemImageAdd"><i
                                                class="fad fa-plus fa-2x"></i></span></a>
                                </div>
                            </div>
                            <div class="row" v-else>
                                <div class="col-lg-12 text-center my-2" v-if="noImageHere">
                                    <!-- Start: error page -->
                                    <div class="min-vh-100 content-center">
                                        <div class="error-page text-center">
                                            <img src="https://res.cloudinary.com/boxity-id/image/upload/v1633661884/404_qggjfd.svg"
                                                alt="404" class="svg">
                                            <h5 class="fw-500">Sorry! This item has no images here...</h5>
                                            <div class="content-center mt-30">
                                                <a @click="itemImageAdds" href="#"
                                                    class="btn btn-primary-boxity btn-default btn-squared px-30">+ Add
                                                    Image</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End: error page -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center" v-if="addItemImages">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <vue-dropzone useCustomSlot ref="itemImageAddOnId" id="dropzone"
                                                :options="dropzoneOptions" @vdropzone-complete="afterComplete"
                                                class="dropzone">
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
    import vue2Dropzone from 'vue2-dropzone';
    export default {
        components: {
            'editor': Editor,
            vueDropzone: vue2Dropzone,
        },
        title() {
            return `Item Group data`;
        },
        data() {
            return {
                addItemBtn: true,
                noImageHere: true,
                addItemImages: false,
                itemgroup: {},
                imgs: {},
                // TODO: callback to save the ids of the uploaded file
                dropzoneOptions: {
                    url: '/api/item-group/images/' + this.$route.params.id,
                    thumbnailWidth: 200,
                    maxFilesize: 2, // MB
                    addRemoveLinks: true,
                    autoDiscover: false,
                    dictRemoveFile: 'REMOVE'
                },
            }
        },
        created() {
            this.loadDataItemGroup();
        },
        methods: {
            routerBack() {
                this.$router.go(-1)
            },
            routerRefresh() {
                this.$isLoading(true);
                this.loadDataItemGroup();
                this.$isLoading(false);
            },
            itemImageAdds() {
                // console.log('jalan');
                this.addItemBtn = false;
                this.noImageHere = false;
                this.addItemImages = true;
            },
            async loadDataItemGroup() {
                // this.$Progress.start();
                this.$isLoading(true);
                const response = await axios.get('/api/item-group/' + this.$route.params.id);
                this.itemgroup = response.data;
                const imgList = await axios.get('/api/item-group/album/' + this.$route.params.id);
                this.imgs = imgList.data;
                // this.$Progress.finish();
                this.$isLoading(false);

            },
            afterComplete() {
                Swal.fire({
                    icon: 'success',
                    title: 'Successfully!',
                    text: 'Success add image on this items.'
                });
                this.addItemBtn = true;
                this.addItemImages = false;
                this.loadDataItemGroup();
                this.$refs.itemImageAddOnId.removeAllFiles()
                // this.$router.go();
            },
            async handleSubmit() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/item-group/' + this.$route.params.id, this.itemgroup);
                document.getElementById('ding').play();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update item group data',
                });
                // this.$Progress.finish();
                this.$isLoading(false);
                this.$router.push('/item-group');
            },
            async deleteThisImage(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    icon: 'info',
                    title: 'Delete',
                    text: 'Delete this item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('/api/item-group/images/' + id);
                    this.$isLoading(false);
                    this.loadDataItemGroup();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Delete',
                        text: 'Success delete current image.'
                    });
                    // this.$Progress.finish();
                }
            }
        },
    }

</script>
