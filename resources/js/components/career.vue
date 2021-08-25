<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main mb-2">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Career</h2>
                    <div class="action-btn">
                        <router-link :to="`/career/new`" class="btn px-15 btn-primary">
                            <i class="las la-plus fs-16"></i>New job vacancy</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div v-if="!careers.length">
                    <div class="card card-default card-md mb-4">
                        <div class="card-body">
                            <div class="atbd-empty text-center">
                                <div class="atbd-empty__image">

                                    <img src="/dashboard/img/folders/1.svg" alt="Admin Empty">

                                </div>
                                <div class="atbd-empty__text">

                                    <p class="">No job vacancy available here</p>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-25" v-for="career in careers" :key="career.id">
                <div class="feature-cards">
                    <figure class="feather-cards__figure">
                        <figcaption>
                            <router-link :to="`/career/${career.id}`">
                                <h4>{{career.title}}</h4>
                            </router-link>
                            <p v-if="career.description.length < 125" v-html="career.description"></p>
                            <p v-if="career.description.length >= 125" v-html="career.description.substring(0,125)+`
                                ...`">
                            </p>
                            <div class="btn-group atbd-button-group btn-group-normal my-2" role="group">
                                <a @click="deleteCareer(career.id)" class="remove">
                                    <i class="fal fa-times"></i>
                                </a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
        <span class="my-3"><i class="fad fa-info-circle"></i> Having a trouble? You can see and learn from
            <a href="https://help.boxity.id/human-resources-management/job-vacancy" target="_blank">Help and
                Documentation</a>'s page.</span>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';

    export default {
        title() {
            return 'Career';
        },
        data() {
            return {
                careers: {},
            }
        },
        mounted() {
            this.loadCareers();
        },
        methods: {
            async loadCareers() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/career');
                this.careers = resp.data;
                if (resp.data.description > 20) {
                    let desc = resp.data.description.substring(0, 17) + '...';
                    this.careers.description = desc;
                }
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteCareer(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete job vacancy?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                this.$isLoading(true);
                    await axios.delete('api/career/' + id);
                    this.loadCareers();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current job vacancy'
                    });
                    // this.$Progress.finish();
                this.$isLoading(false);
                }
            },
        },
    }

</script>
