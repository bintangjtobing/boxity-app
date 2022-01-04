<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">

                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">gallery</h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <router-link :to="`/gallery/new`" class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="la la-plus"></i> New album</router-link>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-25" v-if="!album.length">
                <div class="feature-cards">
                    <div class="atbd-empty text-center py-3">
                        <div class="atbd-empty__image">
                            <img src="/dashboard/img/folders/1.svg" style="width: 10%;" alt="Admin Empty">
                        </div>
                        <div class="atbd-empty__text">
                            <p class="">No gallery.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 mb-25" v-for="gal in album" :key="gal.id">
                <div class="feature-cards">
                    <figure class="feather-cards__figure">
                        <img :src="`/imagePublic/`+gal.file" alt="">
                        <figcaption>
                            <h4>{{gal.nama_album}}</h4>
                            <span>Total photo in this album: {{gal.totalFile}}</span>
                        </figcaption>
                    </figure>
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
    export default {
        title() {
            return 'Album Gallery';
        },
        data() {
            return {
                album: {},
            }
        },
        created() {
            this.loadAlbum();
        },
        methods: {
            async loadAlbum() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/album');
                this.album = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
        },
    }

</script>
