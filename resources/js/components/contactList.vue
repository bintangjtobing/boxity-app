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

                            <form action="/" class="d-flex align-items-center add-contact__form my-sm-0 my-2">
                                <input class="form-control mr-sm-2 border-0 box-shadow-none" type="search"
                                    placeholder="Search by Name" aria-label="Search">
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row contact-card-group">
            <div class="col-xl-3 mb-25">
                <div class="card contact-card">
                    <div class="card-body text-center pt-30 px-25 pb-0">
                        <div class="card__more-action dropdown dropdown-click">
                            <button class="btn-link border-0 bg-transparent p-0" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span data-feather="more-horizontal"></span>
                            </button>
                        </div>

                        <div class="contact-profile-card text-center">
                            <div class="cp-img d-flex justify-content-center">
                                <img class="cp-img__main" :src="`/dashboard/img/author/profile/3.jpg`" alt="">
                            </div>
                            <div class="cp-info">
                                <h6 class="cp-info__title">Grant Marshall</h6>
                                <span class="cp-info__designation">User Interface Designer</span>
                            </div>
                        </div>

                        <div class="card-footer mt-20 pt-20 pb-20 px-0">
                            <ul class="c-info-list">

                                <li class="c-info-list__item d-flex">
                                    <div class="c-info-item-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <p class="c-info-item-text">
                                        +1 (861) 550-2796
                                    </p>
                                </li>


                                <li class="c-info-list__item d-flex">
                                    <div class="c-info-item-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <p class="c-info-item-text">
                                        marshall@yahoo.com
                                    </p>
                                </li>


                                <li class="c-info-list__item d-flex">
                                    <div class="c-info-item-icon">
                                        <i class="fas fa-location-arrow"></i>
                                    </div>
                                    <p class="c-info-item-text">
                                        225 Bills Place
                                    </p>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end: card -->
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        title() {
            return 'Contact list';
        },
    }

</script>
