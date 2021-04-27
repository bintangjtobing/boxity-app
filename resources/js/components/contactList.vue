<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="contact-breadcrumb">

                    <div class="breadcrumb-main add-contact justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="d-flex align-items-center add-contact__title justify-content-center mr-sm-25">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">Contacts</h4>
                                <span class="sub-title ml-sm-25 pl-sm-25"></span>
                            </div>

                            <!-- <form action="/" class="d-flex align-items-center add-contact__form my-sm-0 my-2">
                                <i class="fas fa-search"></i>
                                <input class="form-control mr-sm-2 border-0 box-shadow-none" type="search"
                                    placeholder="Search by Name" aria-label="Search">
                            </form> -->

                        </div>
                    </div>

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
                                <button type="button"
                                    class="border text-capitalize px-20 color-white bg-gradient-primary disabled">
                                    <i class="far fa-paper-plane"></i>&nbsp; direct chat</button>
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
                const resp = await axios.get('/api/users');
                this.users = resp.data;
            },
        },
    }

</script>
