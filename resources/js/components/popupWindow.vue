<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Popup Window</h2>
                </div>
            </div>
            <div class="col-8 changelog-19 d-block">
                <div class="changelog mb-30">
                    <div class="card">
                        <div class="card-body p-30">
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
                                                                    class="form-control ih-medium ip-gray radius-xs b-light px-15 my-1"
                                                                    v-model="popup.title" id="formGroupExampleInput"
                                                                    placeholder="Title" required autofocus>
                                                                <input type="text"
                                                                    class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                                    v-model="popup.url" id="formGroupExampleInput"
                                                                    placeholder="Paste your url link" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-row justify-content-end">
                                                            <div class="layout-button mt-25">
                                                                <button type="submit"
                                                                    class="btn btn-secondary-boxity btn-default btn-squared px-30">Save
                                                                    popup</button>
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
                    </div>
                </div>
            </div>
            <div class="col-4 changelog-5 d-block">
                <div class="changeLog-history mb-30">
                    <div class="card">
                        <div class="card-header py-20 px-20">
                            <div class="changelog-history__title">
                                <span style="color: red;"><i class="fal fa-circle-notch fa-spin"></i></span> Current
                                Live Popup
                            </div>
                        </div>
                        <img class="card-img-top mt-2" :src="popupCurrent.url">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12 col-lg-12 col-md-12 mb-25">
                <div class="feature-cards5 d-flex justify-content-between border-0 radius-xl bg-white p-25">
                    <div class="application-task d-flex align-items-center">
                        <div class="application-task-content">
                            <span><strong>Need help?</strong> Check out our <a href="https://help.boxity.id"
                                    target="_blank">documentation</a> or our <a href="#">getting
                                    started video series</a> to quickly learn the basics or <router-link
                                    to="/new-issue">reach out to our
                                    team</router-link>, we'd happy to help.</span>
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

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'Popup management';
        },
        data() {
            return {
                popup: {
                    title: '',
                    url: '',
                },
                popupCurrent: {},
            }
        },
        mounted() {
            this.loadPopup();
        },
        methods: {
            async loadPopup() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/popup-management');
                this.popupCurrent = resp.data[0];
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async handleSubmit() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/popup-management', this.popup).then(response => {
                    this.popup = {
                        url: '',
                        title: ''
                    }
                    this.loadPopup();
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New popup.',
                    });
                    // this.$Progress.finish();
                this.$isLoading(false);
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
