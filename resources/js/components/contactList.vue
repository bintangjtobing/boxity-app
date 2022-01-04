<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Contacts
                    </h2>
                </div>
            </div>
        </div>
        <div class="row contact-card-group">
            <div class="col-xl-3 mb-25 my-4" v-for="contact in users" :key="contact.id">
                <div class="card profile-card-3">
                    <div class="background-block">
                        <img :src="`/dashboard/img/author/cover/`+contact.cover" class="background bg-opacity-success">
                    </div>
                    <div class="card-content mt-n25">
                        <div class="card-content__body mt-n40 pt-0">
                            <div class="profile-thumb-block position-relative d-flex justify-content-center">
                                <img :src="`/dashboard/img/author/profile/`+contact.avatar" alt="profile-image"
                                    class="profile wh-120 bg-opacity-primary">
                            </div>
                            <div class="ap-nameAddress pb-3 pt-10">
                                <h6 class="ap-nameAddress__title">{{contact.name}}</h6>
                                <p class="ap-nameAddress__subTitle fs-14 pt-1 m-0">{{contact.bio}}</p>
                            </div>
                            <div
                                class="ap-button account-profile-cards__button button-group d-flex justify-content-center flex-wrap m-n1">
                                <router-link :to="`/u/`+contact.username" type="button"
                                    class="border text-capitalize px-30 color-gray transparent shadow2 follow">
                                    view profile</router-link>
                            </div>
                            <div
                                class="ap-button account-profile-cards__button button-group d-flex justify-content-center flex-wrap m-n1">
                                <a :href="contact.facebook" class="border text-capitalize color-gray shadow2">
                                    <i class="fab fa-facebook-f"></i></a>
                                <a :href="contact.instagram" class="border text-capitalize color-gray shadow2 follow">
                                    <i class="fab fa-instagram"></i></a>
                            </div>
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
    export default {
        title() {
            return 'Contact list';
        },
        data() {
            return {
                users: {},
            }
        },
        created() {
            this.loadContact();
        },
        methods: {
            async loadContact() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/contact-list');
                this.users = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
        },
    }

</script>
