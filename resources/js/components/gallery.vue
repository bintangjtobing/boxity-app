<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">

                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">gallery</h4>
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
            <div class="col-md-12">
                <div class="col-xl-3 col-lg-4 col-md-6 mb-25">
                    <div class="feature-cards">
                        <figure class="feather-cards__figure">
                            <img :src="`/dashboard/img/author/cover/1.jpg`" alt="">
                            <figcaption>
                                <h4>Technology Change the World</h4>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        title() {
            return 'Gallery';
        },
    }

</script>
