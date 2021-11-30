<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Job vacancy - <span>{{careers.title}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="feature-cards">
                    <figure class="feather-cards__figure">
                        <figcaption>
                            <div class="explainCareers">
                                <p>
                                    Job title: <span>{{careers.title}}</span>
                                    Job location: <span>{{careers.location}}</span>
                                    Department - Part of: <span>{{careers.divisi}} - {{careers.part}}</span>
                                    <div class="descCareer">
                                        Job description: <br><span v-html="careers.description"></span>
                                    </div>
                                </p>
                                <router-link :to="`/edit/career/${careers.id}`" class="
                                btn btn-primary-boxity">Edit</router-link>
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
            return 'Job vacancy'
        },
        data() {
            return {
                titles: '',
                careers: {},
            }
        },
        created() {
            this.loadJob();
        },
        methods: {
            async loadJob() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/career/' + this.$route.params.id);
                this.careers = resp.data;
                this.titles = resp.data.title;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
        },
    }

</script>
