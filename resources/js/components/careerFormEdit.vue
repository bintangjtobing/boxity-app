<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">job vacancy <span>- {{job.title}}</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <span @click="routerBack" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-arrow-left"></i></span>
            <span @click="routerRefresh" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-sync"></i></span>
        </div>
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <span>Job title:</span>
                                            <input type="text"
                                                class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                v-model="job.title" id="formGroupExampleInput"
                                                placeholder="Job vacancy title" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <span>Job location:</span>
                                            <input type="text" v-model="job.location" placeholder="Job Location"
                                                required class="form-control ih-medium ip-gray radius-xs b-ligh px-15">
                                            <small>Such as: Country and location</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <span>Department:</span>
                                            <input type="text" v-model="job.divisi" placeholder="Department of" required
                                                class="form-control ih-medium ip-gray radius-xs b-ligh px-15">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <span>Part of:</span>
                                            <input type="text" v-model="job.part" placeholder="Part of" required
                                                class="form-control ih-medium ip-gray radius-xs b-ligh px-15">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span>Job description:</span>
                                    <editor
                                        placeholder="Requirements / Decriptions / Qualification / Job descriptions. Press `CTRL + ENTER` to send the comment."
                                        v-model="job.description" @keydown.enter="handleSubmit"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 600,
                                                                menubar: true,
                                                                branding: false,
                                                                plugins: 'code',
                                                                toolbar:
                                                                    'undo redo | fontselect | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
                                </div>
                                <div class="form-group">
                                    <div class="form-row justify-content-end">
                                        <div class="layout-button mt-25">
                                            <button type="submit"
                                                class="btn btn-secondary-boxity btn-default btn-squared px-30">submit</button>
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
    import Editor from '@tinymce/tinymce-vue';

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'New job vacancy';
        },
        data() {
            return {
                job: {
                    location: '',
                    divisi: '',
                    part: '',
                },
            }
        },
        created() {
            this.loadDataCareer();
        },
        methods: {
            routerBack() {
                this.$router.go(-1)
            },
            routerRefresh() {
                this.$isLoading(true);
                this.loadDataCareer();
                this.$isLoading(false);
            },
            async loadDataCareer() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/career/' + this.$route.params.id);
                this.job = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async handleSubmit() {
                // this.$Progress.finish();
                this.$isLoading(false);
                await axios.patch('/api/career/' + this.$route.params.id, {
                    title: this.job.title,
                    location: this.job.location,
                    divisi: this.job.divisi,
                    partof: this.job.part,
                    desc: this.job.description
                });
                document.getElementById('ding').play();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update job vacancy.',
                });
                // this.$Progress.finish();
                this.$isLoading(false);
                this.$router.push('/career/' + this.$route.params.id);
            }
        },
    }

</script>
