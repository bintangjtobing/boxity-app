<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">users list</h4>
                            <span class="sub-title ml-sm-25 pl-sm-25">{{count}} Users</span>
                        </div>
                    </div>
                    <div class="action-btn">
                        <a href="#" class="btn px-15 btn-primary" data-toggle="modal" data-target="#newMember">
                            <i class="las la-plus fs-16"></i>Add new user</a>
                        <!-- Modal -->
                        <div class="modal fade new-member" data-backdrop="static" ref="modalAdd" id="newMember"
                            role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content  radius-xl">
                                    <div class="modal-header">
                                        <h6 class="modal-title fw-500" id="staticBackdropLabel">Add new user</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="new-member-modal">
                                            <form>
                                                <div class="form-group mb-20">
                                                    <div class="form-row">
                                                        <div class="col-lg-9">
                                                            <input type="text" required v-model="user.name"
                                                                class="form-control" placeholder="Fullname">
                                                            <span class="text-danger error-password">
                                                                {{ errors.name }}</span>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <select v-model="user.gender" required id="select-tag"
                                                                class="form-control custom-select ih-medium ip-gray radius-xs b-light fa-select">
                                                                <option disabled value="">Select gender:</option>
                                                                <option v-bind:value="`M`">Male</option>
                                                                <option v-bind:value="`F`">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-20">
                                                    <input type="email" required v-model="user.email"
                                                        class="form-control" placeholder="Email">
                                                    <span class="text-danger error-password">
                                                        {{ errors.email }}</span>
                                                </div>
                                                <div class="form-group mb-20">
                                                    <div class="form-row">
                                                        <div class="col-lg-6">
                                                            <input type="password" required v-model="user.password"
                                                                class="form-control" id="password"
                                                                placeholder="Password" readonly>
                                                            <span class="text-danger error-password">
                                                                {{ errors.password }}</span>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="password" required
                                                                v-model="user.confirmPassword" id="verifyPassword"
                                                                class="form-control" placeholder="Verify password"
                                                                readonly>
                                                            <span class="text-danger error-password">
                                                                {{ errors.confirmPassword }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-20">
                                                    <div class="form-row">
                                                        <div class="col-lg-4">
                                                            <select v-model="user.role" required id="select-tag"
                                                                class="form-control custom-select ih-medium ip-gray radius-xs b-light fa-select">
                                                                <option disabled value="">Select role:</option>
                                                                <option v-bind:value="`user`">User</option>
                                                                <option v-bind:value="`head`">Head</option>
                                                                <option v-bind:value="`it`">IT</option>
                                                                <option v-bind:value="`hrdga`">HRD & GA</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <select v-model="user.department" required id="select-tag"
                                                                class="form-control custom-select ih-medium ip-gray radius-xs b-light fa-select">
                                                                <option disabled value="">Select department:</option>
                                                                <option v-bind:value="`ekspor`">Ekspor</option>
                                                                <option v-bind:value="`impor`">Impor</option>
                                                                <option v-bind:value="`trucking`">Trucking</option>
                                                                <option v-bind:value="`antar-pulau`">Antar-Pulau
                                                                </option>
                                                                <option v-bind:value="`sta-logistics`">STA LOGISTICS
                                                                </option>
                                                                <option v-bind:value="`infinity-solutions`">Infinity
                                                                    Solutions
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <select v-model="user.divisi" required id="select-tag"
                                                                class="form-control custom-select ih-medium ip-gray radius-xs b-light fa-select">
                                                                <option disabled value="">Select division:</option>
                                                                <option v-bind:value="`staff`">Staff</option>
                                                                <option v-bind:value="`supervisor`">Supervisor</option>
                                                                <option v-bind:value="`manager`">Manager</option>
                                                            </select>
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
                            <template v-slot:item.status="{ item }">
                                <div v-if="item.status==1">
                                    <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active"><i class="fas fa-check"></i>
                                        &nbsp;Active</span>
                                </div>
                                <div v-if="item.status==0">
                                    <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active"><i class="fas fa-exclamation"></i>
                                        &nbsp;Locked</span>
                                </div>
                                <div v-if="item.status==2">
                                    <span class="rounded-pill userDatatable-content-status color-danger
                                                bg-opacity-danger active"><i class="fas fa-lock"></i>
                                        &nbsp;Terminated</span>
                                </div>
                            </template>
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/detail/user/${item.id}`" class="edit">
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
            return 'Users management';
        },
        data() {
            return {
                members: [],
                search: '',
                key: 1,
                headers: [{
                    text: 'Name',
                    value: 'name'
                }, {
                    text: 'Email',
                    value: 'email'
                }, {
                    text: 'Department',
                    value: 'department'
                }, {
                    text: 'Division',
                    value: 'divisi'
                }, {
                    text: 'Status',
                    filterable: false,
                    value: 'status'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                count: 0,
                user: {
                    gender: '',
                    role: '',
                    department: '',
                    divisi: '',
                    password: '',
                    confirmPassword: '',
                },
                errors: {
                    name: '',
                    email: '',
                    password: '',
                    confirmPassword: '',
                },
            };
        },
        mounted() {
            this.loadUsers();
            this.generatePassword();
        },
        created() {
            this.countUsers();
        },
        methods: {
            generatePassword() {
                const genPass = this.rndStr(8);
                this.user.password = genPass;
                this.user.confirmPassword = genPass;
            },
            loadUsers() {
                axios.get("api/users")
                    .then(res => {
                        this.members = res.data;
                    });
            },
            async deleteData(id) {
                const result = await Swal.fire({
                    title: 'Delete user?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('api/users/' + id);
                    this.loadUsers();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current user'
                    });
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
            async handleSubmit() {
                // event.preventDefault();

                const isValid = await this.validateData();
                if (!isValid) return false;

                const payload = {};
                _.forEach(['name', 'role', 'department', 'divisi', 'gender', 'email'], (field) => {
                    if (this.user[field]) {
                        payload[field] = this.user[field];
                    }
                });
                if (!_.isEmpty(this.user.password)) {
                    payload.password = this.user.password;
                }
                await axios.post('/api/users', payload).then(response => {
                    this.loadUsers();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add new user',
                    });
                    this.user = {
                        gender: '',
                        role: '',
                        department: '',
                        divisi: '',
                        name: '',
                        email: '',
                        password: '',
                        confirmPassword: '',
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
            async countUsers() {
                const data = await axios.get('/api/count-users');
                this.count = data.data;
            },
            rndStr(len) {
                let text = " "
                let chars = "abcdefghijklmnopqrstuvwxyz1234567890"

                for (let i = 0; i < len; i++) {
                    text += chars.charAt(Math.floor(Math.random() * chars.length))
                }
                return text
            }
        },
    }

</script>
