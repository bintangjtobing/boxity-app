<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">new job vacancy <span>- {{job.title}}</span>
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
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
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
                                            <input type="text" v-model="job.location" placeholder="Job Location"
                                                required class="form-control ih-medium ip-gray radius-xs b-ligh px-15">
                                            <small>Such as: Country and location</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" v-model="job.divisi" placeholder="Department of" required
                                                class="form-control ih-medium ip-gray radius-xs b-ligh px-15">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" v-model="job.part" placeholder="Part of" required
                                                class="form-control ih-medium ip-gray radius-xs b-ligh px-15">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <editor
                                        placeholder="Requirements / Decriptions / Qualification / Job descriptions. Press `CTRL + ENTER` to send the comment."
                                        v-model="job.description" @keydown.enter="handleSubmit"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 500,
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
                                                class="btn btn-primary-boxity btn-default btn-squared px-30">submit</button>
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
        methods: {
            async handleSubmit() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/career', {
                    title: this.job.title,
                    location: this.job.location,
                    divisi: this.job.divisi,
                    partof: this.job.part,
                    desc: this.job.description
                }).then(response => {
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New job vacancy.',
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                    this.$router.push('/career');
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
            }
        },
    }

</script>
