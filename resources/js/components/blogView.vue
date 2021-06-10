<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title"><span>{{blogs.title}}</span></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="feature-cards">
                    <figure class="feather-cards__figure">
                        <figcaption>
                            <div class="explainblogs">
                                <p>
                                    <span>{{blogs.title}}</span><br>
                                    Category: <span>{{blogs.category}}</span><br>
                                    Views: <span>{{blogs.views}}</span>
                                    <div class="descCareer">
                                        <br><span v-html="blogs.description"></span>
                                    </div>
                                </p>
                                <router-link :to="`/edit/blog/${blogs.id}`" class="
                                btn btn-primary">Edit</router-link>
                            </div>
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
            return 'View blog'
        },
        data() {
            return {
                blogs: {},
            }
        },
        created() {
            this.loadJob();
        },
        methods: {
            async loadJob() {
                this.$Progress.start();
                const resp = await axios.get('/api/blogs/' + this.$route.params.id);
                this.blogs = resp.data;
                this.$Progress.finish();
            },
        },
    }

</script>
