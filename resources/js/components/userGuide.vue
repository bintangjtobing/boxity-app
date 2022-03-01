<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">User Guide</h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <a href="#" data-toggle="modal" data-target="#userguideModal"
                                class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="la la-plus"></i> Add New</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="knowledgebase-details">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="knowledgebase-adv">
                        <div class="row">
                            <div class="col-xxl-4 col-md-5">
                                <div class="card knowledgebase-adv__card  shadow-none radius-xs">
                                    <div class="card-header px-20">
                                        <h6>Menu</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="knowledgebase__list">
                                            <ul>
                                                <li>
                                                    <div class="accordion" id="accordionExample1">
                                                        <div class="d-flex flex-wrap">
                                                            <div id="headingOne">
                                                            </div>
                                                            <div id="collapseOne"
                                                                class="collapse  show collapse-adv__area"
                                                                aria-labelledby="headingOne"
                                                                data-parent="#accordionExample1">
                                                                <div class="nav flex-column nav-pills" id="v-pills-tab"
                                                                    role="tablist" aria-orientation="vertical">
                                                                    <a v-for="bases in base" :key="bases.id"
                                                                        class="nav-link" :id="bases.id"
                                                                        data-toggle="pill" :href="`#`+bases.id"
                                                                        role="tab" :aria-controls="bases.id"
                                                                        aria-selected="false">{{bases.title}}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-8 col-md-7">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div v-for="knowledge in base" :key="knowledge.id" class="tab-pane fade show active"
                                        :id="knowledge.id" role="tabpanel" :aria-labelledby="knowledge.id">
                                        <div class="knowledgebase-adv__right">
                                            <h1>{{knowledge.title}}</h1>
                                            <div class="knowledgebase-adv__content">
                                                <article>
                                                    <span v-html="knowledge.description"></span>
                                                </article>
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
        <div class="modal fade" id="userguideModal" tabindex="-1" aria-labelledby="userguideModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form action="/">
                            <div class="form-group mb-25">
                                <input type="text" v-model="guide.title" class="form-control" placeholder="Title"
                                    id="text">
                            </div>
                            <div class="form-group mb-25">
                                <editor placeholder="Write your guide here..." v-model="guide.description"
                                    api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 500,
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
                                <div class="justify-content-end">
                                    <button v-on:click="submitHandle" v-on:keyup.enter="submitHandle" type="submit"
                                        class="btn btn-secondary-boxity btn-default btn-squared px-30"
                                        data-dismiss="modal">Submit</button>
                                </div>
                            </div>
                        </form>
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
            return 'User Guide';
        },
        data() {
            return {
                guide: {
                    title: '',
                    description: '',
                },
                base: {},
            }
        },
        created() {
            this.loadGuide();
        },
        methods: {
            async loadGuide() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/user-guide');
                this.base = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/user-guide', this.guide).then(response => {
                    this.loadGuide();
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New guide',
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
