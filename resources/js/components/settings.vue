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
                                <a class="nav-link active mt-1" id="v-pills-home-tab" data-toggle="pill"
                                    href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    Company Information</a>
                                <a class="nav-link mt-1" id="v-pills-meta-tab" data-toggle="pill" href="#v-pills-meta"
                                    role="tab" aria-controls="v-pills-meta" aria-selected="true">
                                    Meta Information</a>
                            </div>
                        </div>
                    </div>
                </div>
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
                                                        <!-- <div class="form-group mb-20">
                                                            <label for="">Company Logo</label>
                                                            <input id="file-upload" type="file" name="fileUpload"
                                                                class="" @change="fileUpload">
                                                            <label for="file-upload">
                                                                <img class="ap-img__main bg-lighter d-flex"
                                                                    :src="imagePreview" alt="profile img"
                                                                    v-if="imagePreview">
                                                            </label>
                                                        </div> -->
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
                        <div class="tab-pane fade  show active" id="v-pills-meta" role="tabpanel"
                            aria-labelledby="v-pills-meta-tab">
                            <div class="edit-profile">
                                <div class="card">
                                    <div class="card-header px-sm-25 px-3 py-4">
                                        <div class="edit-profile__title">
                                            <h6>Meta Information</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="col-xxl-6 col-lg-12 col-sm-12">
                                                <div class="edit-profile__body mx-lg-20">
                                                    <form>
                                                        <div class="form-group mb-20">
                                                            <label for="names">Company Description</label>
                                                            <textarea v-model="company.meta_description"
                                                                class="form-control" :readonly="isReadOnly" cols="30"
                                                                rows="10"></textarea>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <label for="names">Company keywords</label>
                                                            <input type="text" class="form-control"
                                                                v-model="company.meta_keywords" :readonly="isReadOnly"
                                                                required>
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
                isReadOnly: false,
                imagePreview: '',
                imageLocation: '',
            }
        },
        mounted() {
            this.loadCompany();
        },
        methods: {
            async loadCompany() {
                this.$Progress.start();
                const resp = await axios.get('/api/company-details');
                if (resp.data.length < 1) {
                    this.isReadOnly = false;
                    console.log('tidak ada data')
                } else {
                    this.company = resp.data[0];
                    this.isReadOnly = true;
                    console.log(resp.data[0]);
                }

                // Load logged user
                const respUser = await axios.get('/getUserLoggedIn');
                this.user = respUser.data;
                this.$Progress.finish();
            },
            fileUpload(e) {
                this.imageLocation = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(this.imageLocation)
                reader.onload = e => {
                    this.imagePreview = e.target.result;
                }
            },
            async saveCompany(event) {
                event.preventDefault();
                this.$Progress.start();
                await axios.post('/api/company-details', this.company).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success save the company details',
                    });
                    this.$Progress.finish();
                    this.loadCompany();
                }).catch(error => {
                    this.$Progress.fail();
                    Swal.fire({
                        icon: 'warning',
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
