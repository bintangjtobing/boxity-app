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
                                    <editor placeholder="Leave an issue explanation..." v-model="issue.description"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 300,
                                                                menubar: false,
                                                                branding: false,
                                                                toolbar:
                                                                    'undo redo | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
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
                                <div class="form-group my-2">
                                    <label for="">Assignees:</label>
                                    <select v-model="issue.assignee" id=""
                                        class="form-control form-control-default ih-medium ip-gray radius-xs b-light fa-select"
                                        required>
                                        <option disabled value="">Choose user</option>
                                        <option v-for="assignee in users" :key="assignee.id" :value="assignee.id">
                                            {{assignee.name}}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group my-3">
                                    <label for="">Priority:</label>
                                    <select v-model="issue.priority" id=""
                                        class="form-control form-control-default ih-medium ip-gray radius-xs b-light px-15 fa-select"
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
    import Editor from '@tinymce/tinymce-vue';

    export default {
        title() {
            return 'New issue'
        },
        components: {
            vueDropzone: vue2Dropzone,
            'editor': Editor
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
            }
        },
        created() {
            this.$Progress.start();
            this.loadUserLoggedIn();
            this.assigneeGet();
            this.$Progress.finish();
        },
        methods: {
            async loadUserLoggedIn() {
                const res = await axios.get('/getUserLoggedIn');
                this.imageUser = res.data.avatar;
                this.username = res.data.name;
            },
            async assigneeGet() {
                const res = await axios.get('/api/assignees');
                this.users = res.data;
            },
            async handleSubmit(event) {
                event.preventDefault();
                const payload = {};
                _.forEach(['title', 'description', 'assignee', 'priority'], (field) => {
                    if (this.issue[field]) {
                        payload[field] = this.issue[field];
                    }
                });
                this.$Progress.start();
                await axios.post('/api/issue', payload).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add new issue.',
                    });
                    this.$Progress.finish();
                    this.$router.push('/issues');
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
