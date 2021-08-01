<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Start: error page -->
                <div class="min-vh-100 content-center">
                    <div class="error-page text-center">
                        <img src="dashboard/img/svg/404.svg" alt="404" class="svg">
                        <div class="error-page__title">404</div>
                        <h5 class="fw-500">Sorry! the page you are looking for doesn't exist.</h5>
                        <div class="content-center mt-30">
                            <router-link to="/tools" class="btn btn-primary btn-default btn-squared px-30">Return Home
                            </router-link>
                        </div>
                    </div>
                </div>
                <!-- End: error page -->
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        title() {
            return '404 error page';
        }
    }

</script>
