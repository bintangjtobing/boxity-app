<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">

                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Settings</h4>
                </div>

            </div>
            <div class="col-xxl-3 col-lg-4 col-sm-5">
                <!-- Profile Acoount -->
                <div class="card mb-25">
                    <div class="card-body text-center p-0">
                        <div class="ps-tab p-20 pb-25">
                            <div class="nav flex-column text-left" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                    role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    <span data-feather="user"></span>Company Information</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Profile Acoount End -->
            </div>
            <div class="col-xxl-9 col-lg-8 col-sm-7">
                <div class="mb-50">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="edit-profile">
                                <div class="card">
                                    <div class="card-header px-sm-25 px-3 py-4">
                                        <div class="edit-profile__title">
                                            <h6>Company Information</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="col-xxl-6 col-lg-12 col-sm-12">
                                                <div class="edit-profile__body mx-lg-20">
                                                    <form>
                                                        <div class="form-group mb-20">
                                                            <label for="names">Company ID</label>
                                                            <input type="text" class="form-control"
                                                                v-model="company.company_id" :readonly="isReadOnly"
                                                                required>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <label for="names">Company name</label>
                                                            <input type="text" class="form-control"
                                                                v-model="company.company_name" autofocus
                                                                :readonly="isReadOnly" required>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <label for="names">Address</label>
                                                            <textarea class="form-control" v-model="company.address"
                                                                cols="30" rows="3" :readonly="isReadOnly"
                                                                required></textarea>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <label for="names">City</label>
                                                            <input type="text" class="form-control"
                                                                v-model="company.city" :readonly="isReadOnly" required>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <label for="names">State</label>
                                                            <input type="text" class="form-control"
                                                                v-model="company.state" :readonly="isReadOnly" required>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <label for="names">Country</label>
                                                            <input type="text" class="form-control"
                                                                v-model="company.country" :readonly="isReadOnly"
                                                                required>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <label for="names">Tax number</label>
                                                            <input type="text" maxlength="15" class="form-control"
                                                                v-model="company.taxNumber" :readonly="isReadOnly">
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <label for="names">Phone</label>
                                                            <input type="text" maxlength="12" class="form-control"
                                                                v-model="company.phone" :readonly="isReadOnly" required>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <label for="names">E-mail</label>
                                                            <input type="text" class="form-control"
                                                                v-model="company.email" :readonly="isReadOnly" required>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <label for="names">Site</label>
                                                            <input type="text" class="form-control"
                                                                v-model="company.site" :readonly="isReadOnly" required>
                                                        </div>
                                                        <div class="button-group d-flex flex-wrap pt-30 mb-15"
                                                            v-if="user.divisi == 'developer'">
                                                            <button @click="saveCompany"
                                                                class="btn btn-primary btn-default btn-squared mr-15 text-capitalize">save
                                                                information
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    export default {
        title() {
            return 'Settings';
        },
        data() {
            return {
                company: {},
                user: {},
                isReadOnly: true,
            }
        },
        mounted() {
            this.loadCompany();
            this.loggedUser();
        },
        methods: {
            async loggedUser() {
                const resp = await axios.get('/getUserLoggedIn');
                this.user = resp.data;
            },
            async loadCompany() {
                const resp = await axios.get('/api/company-details');
                if (resp.data.length < 1) {
                    this.isReadOnly = false;
                    console.log('tidak ada data')
                } else {
                    this.company = resp.data[0];
                    this.isReadOnly = true;
                    console.log(resp.data[0]);
                }
            },
            async saveCompany(event) {
                event.preventDefault();
                await axios.post('/api/company-details', this.company).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success save the company details',
                    });
                    this.loadCompany();
                }).catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something wrong.',
                        confirmButtonText: `Ok`,
                        html: `There is something wrong on my side. Please click ok to refresh this page and see what is it. If
                it still exist, you can contact our developer. <br><br>Error message: ` +
                            error,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                });
            }
        },
    }

</script>
