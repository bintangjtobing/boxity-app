<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">

                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">gallery</h4>
                    <p>If data was not shown,
                        you can <a @click="refreshPage">refresh</a>this page for a several times. If still happens,
                        you can contact the developer to fix this bugs.</p>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <router-link :to="`/gallery/new`" class="btn btn-sm btn-primary btn-add">
                                <i class="la la-plus"></i> Add new album</router-link>
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
                const resp = await axios.get('/api/album');
                console.log(resp.data);
                this.album = resp.data;
            },
            refreshPage() {
                location.reload();
            }
        },
    }

</script>
