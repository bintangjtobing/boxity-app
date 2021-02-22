<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">New Issue</h4>
                </div>
            </div>
        </div>
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <input type="text"
                                                class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                v-model="issue.title" id="formGroupExampleInput" placeholder="Title"
                                                autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea v-model="issue.description" class="form-control"
                                        placeholder="Leave an issue explanation..." id="" cols="30" rows="10"
                                        required></textarea>
                                </div>
                                <div class="form-group">
                                    <vue-dropzone useCustomSlot ref="document-upload" id="dropzone"
                                        :options="dropzoneOptions" class="dropzone"
                                        v-on:vdropzone-success="handleFileUploadCompleted"
                                        v-on:vdropzone-queue-complete="handleFileUploaded"
                                        v-on:vdropzone-removed-file="handleFileRemoved">
                                        <div class="dropzone-custom-content">
                                            <h3 class="dropzone-custom-title">Drag and drop to upload
                                                attachment!</h3>
                                            <div class="subtitle">...or click to select a file from your
                                                computer</div>
                                        </div>
                                    </vue-dropzone>
                                </div>
                                <div class="form-group">
                                    <div class="form-row justify-content-end">
                                        <div class="layout-button mt-25">
                                            <button type="submit"
                                                class="btn btn-success btn-default btn-squared px-30">submit
                                                new issue</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-Vertical card-default card-md">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group reporter">
                                    <label for="">Reporter:</label><br>
                                    <img v-bind:src="'dashboard/img/author/profile/'+imageUser" alt="avatar"
                                        class="rounded-circle reporterImg">
                                    <span>{{username}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="">Assignees:</label>
                                    <select v-model="issue.assignee" id=""
                                        class="form-control custom-select ih-medium ip-gray radius-xs b-light fa-select"
                                        required>
                                        <option disabled value="">Choose user</option>
                                        <option v-for="assignee in users" :key="assignee.id" :value="assignee.id">
                                            {{assignee.name}}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Priority:</label>
                                    <select v-model="issue.priority" id=""
                                        class="form-control custom-select ih-medium ip-gray radius-xs b-light px-15 fa-select"
                                        required>
                                        <option value="" disabled>Set priority</option>
                                        <option v-bind:value="`4`" class="priority-highest">Highest
                                        </option>
                                        <option v-bind:value="`3`" class="priority-high">High </option>
                                        <option v-bind:value="`2`" class="priority-medium">Medium
                                        </option>
                                        <option v-bind:value="`1`" class="priority-low">Low
                                        </option>
                                        <option v-bind:value="`0`" class="priority-lowest">Lowest
                                        </option>
                                    </select>
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
            return 'New issue'
        },
        components: {
            vueDropzone: vue2Dropzone,
        },
        data() {
            return {
                imageUser: '',
                username: '',
                users: {},
                issue: {
                    assignee: '',
                    title: '',
                    priority: '',
                    description: '',
                },
                // TODO: callback to save the ids of the uploaded file
                dropzoneOptions: {
                    url: '/api/documents',
                    thumbnailWidth: 400,
                    addRemoveLinks: true,
                    autoDiscover: false,
                    parallelUploads: 10,
                    autoProcessQueue: false,
                    dictRemoveFile: 'REMOVE'
                },
                isUploading: false,
                documents: {},
            }
        },
        created() {
            this.loadUserLoggedIn();
            this.assigneeGet();
        },
        methods: {
            async loadUserLoggedIn() {
                const res = await axios.get('/getUserLoggedIn');
                this.imageUser = res.data.avatar;
                this.username = res.data.name;
            },
            async assigneeGet() {
                const res = await axios.get('/api/users');
                this.users = res.data;
            },
            handleFileUploaded() {
                this.isUploading = false;
            },

            handleFileUploadCompleted(file, response) {
                this.documents[response.id] = response;
            },

            handleFileRemoved(file) {
                // delete if previously uploaded file
                if (file.id) {
                    delete this.documents[file.id];
                }
            },
            async handleSubmit(event) {
                event.preventDefault();

                const payload = {};
                _.forEach(['title', 'description', 'assignee', 'priority'], (field) => {
                    if (this.issue[field]) {
                        payload[field] = this.issue[field];
                    }
                });
                if (!_.isEmpty(this.$refs['document-upload'].getAcceptedFiles())) {
                    this.isUploading = true;
                    this.$refs['document-upload'].processQueue();

                    // wait for all files uploaded
                    await new Promise(function (resolve) {
                        const interval = setInterval(function () {
                            if (!this.isUploading) {
                                clearTimeout(interval);
                                resolve();
                            }
                        }.bind(this), 100);
                    }.bind(this));
                }
                await axios.post('/api/issue', payload);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success add new issue.',
                });
                this.$router.push('/issues');
            },
        },
    }

</script>
