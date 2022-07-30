<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Event edit</h2>
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
                                            <h6>Event Name</h6>
                                            <input type="text" v-model="events.event_name"
                                                placeholder="Enter event name here" class="form-control mt-2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <h6 class="mb-2">Event Content</h6>
                                            <editor placeholder="Event content write here..."
                                                v-model="events.event_content"
                                                api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 600,
                                                                menubar: true,
                                                                branding: false,
                                                                plugins: 'advlist autolink lists link image charmap preview anchor pagebreak code',
                                                                toolbar:
                                                                    'undo redo | fontselect | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | checklist | code | emoticons | media | insertfile'
                                                        }" />
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
                                        By default it will resize for all images based on the first image.</small>
                                    <small class="form-text text-muted">
                                        File size max is 2MB. By default it will resize for all images based on the
                                        first image.</small>
                                    <h4 class="my-3">Current featured image</h4>
                                    <img :src="events.image.file" :alt="events.event_name" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group my-2">
                                    <h6>Start date</h6>
                                    <input type="date" v-model="events.start_date" class="form-control mt-2">
                                </div>
                                <div class="form-group my-2">
                                    <h6>End date</h6>
                                    <input type="date" v-model="events.end_date" class="form-control mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group my-2">
                                    <h4>Published?</h4>
                                    <select class="form-control form-control-default my-1" v-model="events.status">
                                        <option value="draft">
                                            Draft
                                        </option>
                                        <option value="published">
                                            Published
                                        </option>
                                    </select>
                                    <small id="blog_is_published_help" class="form-text text-muted">Should this be
                                        published? If not, then it
                                        won't be
                                        publicly viewable.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group my-2">
                                    <h6>Organized by:</h6>
                                    <input type="text" v-model="events.organized_by" placeholder="Organizer name here"
                                        class="form-control mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group my-2">
                                    <h6>Tipe event:</h6>
                                    <input type="text" v-model="events.type"
                                        placeholder="Type ex: Incubation, Webinar, Seminar, Startup funding day, and etc..."
                                        class="form-control mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Vertical-form">
                        <div class="form-group my-2">
                            <div class="justify-content-end">
                                <button type="submit"
                                    class="btn btn-primary-boxity btn-default btn-block btn-squared px-30"
                                    data-dismiss="modal">Update</button>
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
            return 'Edit event';
        },
        data() {
            return {
                events: {},

                dropzoneOptions: {
                    url: '/api/events/images',
                    thumbnailWidth: 200,
                    maxFilesize: 5, // MB
                    addRemoveLinks: true,
                    autoDiscover: false,
                    dictRemoveFile: 'REMOVE'
                },
            }
        },
        created() {
            this.loadDataEvents();
        },
        methods: {
            async loadDataEvents() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/events/' + this.$route.params.id);
                this.events = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/events/' + this.$route.params.id, this.events);
                document.getElementById('ding').play();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update event.',
                });
                // this.$Progress.finish();
                this.$isLoading(false);
                this.$router.push('/events');
            },
        },
    }

</script>
