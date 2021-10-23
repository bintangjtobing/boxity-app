<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">

                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Settings</h2>
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
                                <a class="nav-link mt-1" id="v-pills-bank-tab" data-toggle="pill" href="#v-pills-bank"
                                    role="tab" aria-controls="v-pills-bank" aria-selected="true">
                                    Bank Information</a>
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
                                                    <div class="form-group mb-20">
                                                        <label for="names">Company ID</label>
                                                        <input type="text" class="form-control"
                                                            v-model="company.company_id" :readonly="isReadOnly"
                                                            required>
                                                    </div>
                                                    <div class="form-group mb-20">
                                                        <label for="names">Company Icon</label>
                                                        <input type="text" class="form-control" v-model="company.icon"
                                                            :readonly="isReadOnly" required>
                                                    </div>
                                                    <div class="form-group mb-20">
                                                        <label for="names">Company Logo White</label>
                                                        <input type="text" class="form-control" v-model="company.logo"
                                                            :readonly="isReadOnly" required>
                                                    </div>
                                                    <div class="form-group mb-20">
                                                        <label for="names">Company Logo Black</label>
                                                        <input type="text" class="form-control"
                                                            v-model="company.logoblack" :readonly="isReadOnly" required>
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
                                                        <input type="text" class="form-control" v-model="company.city"
                                                            :readonly="isReadOnly" required>
                                                    </div>
                                                    <div class="form-group mb-20">
                                                        <label for="names">State</label>
                                                        <input type="text" class="form-control" v-model="company.state"
                                                            :readonly="isReadOnly" required>
                                                    </div>
                                                    <div class="form-group mb-20">
                                                        <label for="names">Country</label>
                                                        <input type="text" class="form-control"
                                                            v-model="company.country" :readonly="isReadOnly" required>
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
                                                        <input type="text" class="form-control" v-model="company.email"
                                                            :readonly="isReadOnly" required>
                                                    </div>
                                                    <div class="form-group mb-20">
                                                        <label for="names">Site</label>
                                                        <input type="text" class="form-control" v-model="company.site"
                                                            :readonly="isReadOnly" required>
                                                    </div>
                                                    <div class="button-group d-flex flex-wrap pt-30 mb-15">
                                                        <button @click="saveCompany"
                                                            class="btn btn-primary-boxity btn-default btn-squared mr-15 text-capitalize"
                                                            :disabled="isCompanyInformation">save
                                                            information
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  show" id="v-pills-meta" role="tabpanel"
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
                                                    <div class="form-group mb-20">
                                                        <label for="names">Company Description</label>
                                                        <textarea :readonly="isReadOnly"
                                                            v-model="company.meta_description" class="form-control"
                                                            cols="30" rows="10"></textarea>
                                                    </div>
                                                    <div class="form-group mb-20">
                                                        <label for="names">Company keywords</label>
                                                        <input :readonly="isReadOnly" type="text" class="form-control"
                                                            v-model="company.meta_keywords" required>
                                                    </div>
                                                    <div class="button-group d-flex flex-wrap pt-30 mb-15">
                                                        <button @click="saveMetaCompany(company.id)"
                                                            class="btn btn-primary-boxity btn-default btn-squared mr-15 text-capitalize"
                                                            :disabled="isMetaInformation">save
                                                            meta information
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  show" id="v-pills-bank" role="tabpanel"
                            aria-labelledby="v-pills-bank-tab">
                            <div class="edit-profile">
                                <div class="card">
                                    <div class="card-header px-sm-25 px-3 py-4">
                                        <div class="edit-profile__title">
                                            <h6>Bank Information</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="col-xxl-6 col-lg-12 col-sm-12">
                                                <div
                                                    class="userDatatable projectDatatable project-table bg-white border-0 mb-3">
                                                    <div class="table-responsive">
                                                        <v-data-table :headers="headers" multi-sort :items="bankData"
                                                            :items-per-page="5" class="elevation-1">
                                                            <template v-slot:item.actions="{item}">
                                                                <a v-on:click="deleteBankAccount(item.id)"
                                                                    class="remove">
                                                                    <i class="fad fa-trash"></i></a>
                                                            </template>
                                                        </v-data-table>
                                                    </div>
                                                </div>
                                                <a href="#" data-toggle="modal" data-target="#addBankAccount"
                                                    class="btn btn-secondary-boxity btn-block btn-sm">Add bank
                                                    account</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addBankAccount" tabindex="-1" role="dialog" aria-labelledby="addBankAccount"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content" v-on:keyup.enter="submitBankAccount">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add bank account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <span>Bank:</span>
                                            <select class="form-control form-control-default" v-model="banks.bank_id">
                                                <option value="">Select bank code:</option>
                                                <option v-for="bank in bank" :key="bank.id" v-bind:value="bank.id">
                                                    {{bank.name}} - {{bank.code}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <span>Bank account:</span>
                                            <input type="number" v-model="banks.account_no" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <span>Bank account holder:</span>
                                            <input type="text" v-model="banks.account_name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" @click="submitBankAccount"
                                class="btn btn-primary-boxity">Save</button>
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
                banks: {
                    bank_id: '',
                },
                company: {},
                user: {},
                isReadOnly: false,
                isReadMetaOnly: false,
                imagePreview: '',
                imageLocation: '',
                isCompanyInformation: false,
                isMetaInformation: false,

                // datatable
                search: '',
                expanded: [],
                key: 1,
                bankData: [],
                headers: [{
                    text: 'Bank',
                    value: 'bank.name'
                }, {
                    text: 'Account No.',
                    value: 'account_no'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // end datatable
            }
        },
        mounted() {
            this.loadCompany();
        },
        methods: {
            async loadCompany() {
                // this.$Progress.start();
                this.$isLoading(true);
                axios.get('/api/bank').then(resp => {
                    this.bank = resp.data;
                });
                const resp = await axios.get('/api/company-details/1');
                const respBank = await axios.get('/api/company-details/bank');
                this.bankData = respBank.data;
                if (resp.data.length < 1) {
                    this.isReadOnly = false;
                    // console.log('tidak ada data')
                } else {
                    this.company = resp.data;
                    this.isReadOnly = true;
                    this.isCompanyInformation = true;
                    this.isMetaInformation = true;
                    // console.log(resp.data[0]);
                }

                // Load logged user
                const respUser = await axios.get('/getUserLoggedIn');
                this.user = respUser.data;
                // this.$Progress.finish();
                this.$isLoading(false);
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
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/company-details', this.company).then(response => {
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success save the company details',
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                    this.loadCompany();
                }).catch(error => {
                    this.$Progress.fail();
                    document.getElementById('failding').play();
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
            },
            async saveMetaCompany() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/meta/company-details/1', this.company).then(response => {
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success save the company meta information',
                    });
                    this.loadCompany();
                }).catch(error => {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Something wrong.',
                        confirmButtonText: `Ok`,
                        html: `There is something wrong on my side. Please click ok to refresh this page and see what is it. If
                it still exist, you can contact our developer. <br><br>Error message: ` +
                            error,
                    });
                });
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteBankAccount(id) {
                document.getElementById('failding').play();
                await axios.delete('/api/company-details/bank/' + id);
                this.loadCompany();
                this.$isLoading(false);
                document.getElementById('ding').play();
                await Swal.fire({
                    icon: 'success',
                    title: 'Successfully deleted.',
                    text: 'Success delete the account number.'
                });
                // this.$Progress.finish();
            },
            async submitBankAccount() {
                this.$isLoading(true);
                $('#addBankAccount').modal('hide');
                $(".modal-backdrop").remove();
                await axios.post('/api/company-details/bank', this.banks).then((response) => {
                    document.getElementById('ding').play();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Bank account has been added.'
                    })
                    this.banks = {};
                    this.loadCompany();
                });
                this.$isLoading(false);
            }
        },
    }

</script>
