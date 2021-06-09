<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Suppliers</h4>
                            <span class="sub-title ml-sm-25 pl-sm-25">{{count}} Suppliers</span>
                        </div>
                    </div>
                    <div class="action-btn">
                        <a href="#" class="btn px-15 btn-primary" data-toggle="modal" data-target="#newCustomer">
                            <i class="las la-plus fs-16"></i>Add new Suppliers</a>
                        <!-- Modal -->
                        <div class="modal fade new-member" data-backdrop="static" ref="modalAdd" id="newCustomer"
                            role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content  radius-xl">
                                    <div class="modal-header">
                                        <h6 class="modal-title fw-500" id="staticBackdropLabel">Add new Suppliers</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="new-member-modal">
                                            <form>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-lg-6">
                                                            <input type="text" required v-model="user.customerCode"
                                                                class="form-control" placeholder="Supplier Code ">
                                                            <span class="text-danger error-password">
                                                                {{ errors.customerCode }}</span>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="text" required v-model="user.name"
                                                                class="form-control" placeholder="Person in charge ">
                                                            <span class="text-danger error-password">
                                                                {{ errors.name }}</span>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <input type="text" required v-model="user.customerName"
                                                                class="form-control"
                                                                placeholder="Supplier Name (PT/CV/UD/Ext.)">
                                                            <span class="text-danger error-password">
                                                                {{ errors.customerName }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" required v-model="user.email"
                                                        class="form-control" placeholder="Email">
                                                    <span class="text-danger error-password">
                                                        {{ errors.email }}</span>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-lg-6">
                                                            <input type="password" required v-model="user.password"
                                                                class="form-control" id="password"
                                                                placeholder="Password">
                                                            <span class="text-danger error-password">
                                                                {{ errors.password }}</span>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="password" required
                                                                v-model="user.confirmPassword" id="verifyPassword"
                                                                class="form-control" placeholder="Verify password">
                                                            <span class="text-danger error-password">
                                                                {{ errors.confirmPassword }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <input type="text" v-model="user.customerAddress" id=""
                                                                    class="form-control" placeholder="Full Address">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" v-model="user.customerCity" id=""
                                                                    class="form-control" placeholder="Domisili">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="number" v-model="user.customerPhone" id=""
                                                                    class="form-control" placeholder="Phone">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="url" v-model="user.customerWebsite"
                                                                    class="form-control" id=""
                                                                    placeholder="Website, started from `https://` or `http://`">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="number" v-model="user.customerNPWP" id=""
                                                                    class="form-control" placeholder="NPWP">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-group d-flex pt-25">
                                                    <button v-on:click="handleSubmit"
                                                        class="btn btn-primary btn-default btn-squared text-capitalize"
                                                        data-dismiss="modal">Submit
                                                    </button>
                                                    <button class="btn btn-light btn-default btn-squared fw-400
                                                        text-capitalize b-light color-light" aria-label="Close"
                                                        data-dismiss="modal">cancel
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
        <div class="row">
            <div class="col-lg-12">
                <div class="userDatatable adv-table-table global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table loading loading-text="Loading... Please wait" :headers="headers" :items="members"
                            :items-per-page="10" class="elevation-1" :search="search">
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/detail/supplier/${item.id}`" class="edit">
                                    <i class="fas fa-pen"></i></router-link>
                                <a v-on:click="deleteData(item.id)" class="remove">
                                    <i class="fas fa-trash"></i></a>
                            </template>
                        </v-data-table>
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
            return 'Suppliers';
        },
        data() {
            return {
                members: [],
                search: '',
                key: 1,
                headers: [{
                    text: 'Supplier Code',
                    value: 'customerCode'
                }, {
                    text: 'Supplier Name',
                    value: 'customerName'
                }, {
                    text: 'Billing Address',
                    value: 'customerAddress'
                }, {
                    text: 'Email',
                    value: 'customerEmail'
                }, {
                    text: 'City',
                    value: 'customerCity'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                count: 0,
                user: {},
                errors: {
                    name: '',
                    email: '',
                    password: '',
                    confirmPassword: '',
                },
            };
        },
        mounted() {
            this.$Progress.start();
            this.loadSuppliers();
            this.$Progress.finish();
        },
        created() {
            this.countSuppliers();
        },
        methods: {
            loadSuppliers() {
                axios.get("api/suppliers")
                    .then(res => {
                        this.members = res.data;
                    });
            },
            async deleteData(id) {
                const result = await Swal.fire({
                    title: 'Delete supplier?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    this.$Progress.start();
                    await axios.delete('api/suppliers/' + id);
                    this.loadSuppliers();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current suppliers'
                    });
                    this.$Progress.finish();
                }
            },
            validatePassword() {
                const {
                    password,
                    confirmPassword
                } = this.user;

                if (!_.isEmpty(password)) {
                    if (password.length < 8) {
                        this.errors = {
                            ...this.errors,
                            password: 'Min have 8 characters or more.',
                        };
                        return false;
                    }
                    if (_.isNil(confirmPassword) || confirmPassword.length < 8) {
                        this.errors = {
                            ...this.errors,
                            confirmPassword: 'Min have 8 characters or more.',
                        };
                        return false;
                    }
                    if (password !==
                        confirmPassword) {
                        this.errors = {
                            ...this.errors,
                            confirmPassword: 'Password does not match!',
                        };
                        return false;
                    }
                    this.errors = {
                        ...this.errors,
                        password: '',
                        confirmPassword: '',
                    };
                }
                return true;
            },
            async validateData() {
                const isPasswordValid = this.validatePassword();
                if (!isPasswordValid) return false;

                const {
                    data
                } = await axios.post('/api/users/check-user-data', this.user);
                if (data.existingEmail) {
                    this.errors = {
                        ...this.errors,
                        email: 'Email already exists!',
                    };
                } else {
                    this.errors = {
                        ...this.errors,
                        email: ''
                    };
                }
                if (data.existingName) {
                    this.errors = {
                        ...this.errors,
                        name: 'Name already exists!',
                    };
                } else {
                    this.errors = {
                        ...this.errors,
                        name: ''
                    };
                }
                return !data.existingEmail && !data.existingName;
            },
            async handleSubmit(event) {
                event.preventDefault();

                const isValid = await this.validateData();
                if (!isValid) return false;

                const payload = {};
                _.forEach(['name', 'email', 'customerCode', 'customerName', 'customerAddress',
                        'customerCity', 'customerPhone', 'customerEmail', 'customerWebsite', 'customerNPWP'
                    ],
                    (field) => {
                        if (this.user[field]) {
                            payload[field] = this.user[field];
                        }
                    });
                if (!_.isEmpty(this.user.password)) {
                    payload.password = this.user.password;
                }
                this.$Progress.start();
                await axios.post('/api/suppliers', payload).then(response => {
                    this.loadSuppliers();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add new supplier',
                    });
                    this.$Progress.finish();
                    this.user = {
                        name: '',
                        email: '',
                        password: '',
                        confirmPassword: '',
                        customerCode: '',
                        customerName: '',
                        customerAddress: '',
                        customerCity: '',
                        customerPhone: '',
                        customerEmail: '',
                        customerWebsite: '',
                        customerNPWP: '',
                    };
                }).catch(error => {
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
            async countSuppliers() {
                const data = await axios.get('/api/count-suppliers');
                this.count = data.data;
            },
        },
    }

</script>
