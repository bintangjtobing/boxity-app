<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">

                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Notepad <span>{{title}}</span></h2>
                </div>

            </div>
            <div class="col-lg-12">
                <div class="note-contents">
                    <div class="note-sibebar-wrapper mb-30">

                        <div class="note-sidebar">
                            <div class="card border-0">
                                <div class="card-body px-15 pt-30">
                                    <div class="px-3">
                                        <a href="#" class="btn btn-primary-boxity btn-default btn-rounded btn-block"
                                            data-toggle="modal" data-target="#noteModal"> <span
                                                data-feather="plus"></span>
                                            Add Note</a>
                                    </div>
                                    <div class="note-types">
                                        <ul class="list-unstyled">
                                            <li><a v-on:click="loadNote"><span data-feather="edit"></span>
                                                    All</a></li>
                                            <li><a v-on:click="favoriteData"><i
                                                        class="far fa-star"></i>&nbsp;&nbsp;Favorite</a></li>
                                        </ul>
                                    </div>

                                    <div class="note-labels">
                                        <p><span data-feather="tag"></span> Labels</p>
                                        <ul class="list-unstyled">
                                            <li><a class="label-personal" v-on:click="personalData"><span></span>
                                                    Personal</a></li>
                                            <li><a class="label-work" v-on:click="workData"><span></span> Work</a></li>
                                            <li><a class="label-social" v-on:click="socialData"><span></span> Social</a>
                                            </li>
                                            <li><a class="label-important" v-on:click="importantData"><span></span>
                                                    Important</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="note-grid-wrapper mb-30">
                        <div class="notes-wrapper">
                            <div class="note-grid align-content-center">
                                <div class="note-single" v-if="notes.length < 1">
                                    <div class="note-card note-default">
                                        <div class="card border-0">
                                            <div class="card-body">
                                                <p class="note-excerpt text-center">
                                                    No notepad found on your database.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="note-grid">
                                <div class="note-single" v-for="pad in notes" :key="pad.id">
                                    <div class="note-card note-social" v-if="pad.label==1">
                                        <div class="card border-0">
                                            <div class="card-body">
                                                <h4 class="note-title">{{pad.title}} <span class="note-status"></span>
                                                </h4>
                                                <p class="note-excerpt" v-html="pad.desc">
                                                </p>
                                                <div class="note-action">
                                                    <div class="note-action__left">
                                                        <a v-on:click="favoriteNotepad(pad.id)"
                                                            v-if="pad.favorite==0"><span><i
                                                                    class="far fa-star"></i></span></a>
                                                        <a v-on:click="unFavoriteNotepad(pad.id)"
                                                            v-if="pad.favorite==1">
                                                            <span style="color:#fa8b0c;"><i class="fal fa-star"></i>
                                                            </span>
                                                        </a>
                                                        <a v-on:click="deleteNotepad(pad.id)"><span><i
                                                                    class="far fa-trash-alt"></i></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="note-card note-work" v-if="pad.label==2">
                                        <div class="card border-0">
                                            <div class="card-body">
                                                <h4 class="note-title">{{pad.title}} <span class="note-status"></span>
                                                </h4>
                                                <p class="note-excerpt" v-html="pad.desc">
                                                </p>
                                                <div class="note-action">
                                                    <div class="note-action__left">
                                                        <a v-on:click="favoriteNotepad(pad.id)"
                                                            v-if="pad.favorite==0"><span><i
                                                                    class="far fa-star"></i></span></a>
                                                        <a v-on:click="unFavoriteNotepad(pad.id)"
                                                            v-if="pad.favorite==1">
                                                            <span style="color:#fa8b0c;"><i class="fal fa-star"></i>
                                                            </span>
                                                        </a>
                                                        <a v-on:click="deleteNotepad(pad.id)"><span><i
                                                                    class="far fa-trash-alt"></i></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="note-card note-personal" v-if="pad.label==3">
                                        <div class="card border-0">
                                            <div class="card-body">
                                                <h4 class="note-title">{{pad.title}} <span class="note-status"></span>
                                                </h4>
                                                <p class="note-excerpt" v-html="pad.desc">
                                                </p>
                                                <div class="note-action">
                                                    <div class="note-action__left">
                                                        <a v-on:click="favoriteNotepad(pad.id)"
                                                            v-if="pad.favorite==0"><span><i
                                                                    class="far fa-star"></i></span></a>
                                                        <a v-on:click="unFavoriteNotepad(pad.id)"
                                                            v-if="pad.favorite==1">
                                                            <span style="color:#fa8b0c;"><i class="fal fa-star"></i>
                                                            </span>
                                                        </a>
                                                        <a v-on:click="deleteNotepad(pad.id)"><span><i
                                                                    class="far fa-trash-alt"></i></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="note-card note-important" v-if="pad.label==4">
                                        <div class="card border-0">
                                            <div class="card-body">
                                                <h4 class="note-title">{{pad.title}} <span class="note-status"></span>
                                                </h4>
                                                <p class="note-excerpt" v-html="pad.desc">
                                                </p>
                                                <div class="note-action">
                                                    <div class="note-action__left">
                                                        <a v-on:click="favoriteNotepad(pad.id)"
                                                            v-if="pad.favorite==0"><span><i
                                                                    class="far fa-star"></i></span></a>
                                                        <a v-on:click="unFavoriteNotepad(pad.id)"
                                                            v-if="pad.favorite==1">
                                                            <span style="color:#fa8b0c;"><i class="fal fa-star"></i>
                                                            </span>
                                                        </a>
                                                        <a v-on:click="deleteNotepad(pad.id)"><span><i
                                                                    class="far fa-trash-alt"></i></span></a>
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
            </div>

            <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <form action="/">
                                <div class="form-group my-2">
                                    <input type="text" v-model="note.title" class="form-control" placeholder="Title"
                                        id="text">
                                </div>
                                <div class="form-group my-2">
                                    <editor placeholder="Write your note here..." v-model="note.description"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 300,
                                                                menubar: true,
                                                                branding: false,
                                                                plugins: 'code',
                                                                toolbar:
                                                                    'undo redo | fontselect | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />

                                </div>
                                <div class="form-group my-2">
                                    <select
                                        class="form-control form-control-default ih-medium ip-gray radius-xs b-light fa-select"
                                        id="n-labels" v-model="note.label">
                                        <option value="" disabled>Select label:</option>
                                        <option :value="`1`">Social</option>
                                        <option :value="`2`">Work</option>
                                        <option :value="`3`">Personal</option>
                                        <option :value="`4`">Important</option>
                                    </select>
                                </div>
                                <div class="form-group my-2">
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
        title() {
            return 'Notepad';
        },
        components: {
            'editor': Editor
        },
        data() {
            return {
                note: {
                    label: '',
                },
                notes: {},
                title: '',
            }
        },
        created() {
            this.loadNote();
        },
        methods: {
            async loadNote() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/notepad');
                this.notes = resp.data;
                this.title = '- all data';
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async favoriteData() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/notepad/favorite');
                this.notes = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
                this.title = '- favorite data';
            },
            async personalData() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/notepad/personal');
                this.notes = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
                this.title = '- personal data';
            },
            async workData() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/notepad/work');
                this.notes = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
                this.title = '- work data';
            },
            async socialData() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/notepad/social');
                this.notes = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
                this.title = '- social data';
            },
            async importantData() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/notepad/important');
                this.notes = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
                this.title = '- important data';
            },
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/notepad', this.note).then(response => {
                    this.loadNote();
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New notepad',
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
            },
            async deleteNotepad(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure want to delete this notepad?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('/api/notepad/' + id);
                    // this.$Progress.finish();
                    this.$isLoading(false);
                    this.loadNote();
                }
            },
            async favoriteNotepad(id) {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/notepad/favorite/' + id);
                // this.$Progress.finish();
                this.$isLoading(false);
                // console.log('200')
                this.loadNote();
            },
            async unFavoriteNotepad(id) {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/notepad/unfavorite/' + id);
                // this.$Progress.finish();
                this.$isLoading(false);
                // console.log('200')
                this.loadNote();
            },

        },
    }

</script>
