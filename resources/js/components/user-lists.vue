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
                        <div id="filter-form-container"></div>
                        <table class="table mb-0 table-borderless adv-table" data-sorting="true"
                            data-filter-container="#filter-form-container" data-paging-current="1"
                            data-paging-position="right" data-paging-size="10">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <span class="userDatatable-title">Name</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">email</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">division</span>
                                    </th>
                                    <th style='text-align:center;'>
                                        <span class="userDatatable-title">status</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title float-right">action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!members.length">
                                    <td colspan="5">
                                        <div class="atbd-empty text-center">
                                            <div class="atbd-empty__image">
                                                <img src="/dashboard/img/folders/1.svg" alt="Admin Empty">
                                            </div>
                                            <div class="atbd-empty__text">
                                                <p class="">No Data</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-for="member in members" :key="member.id">
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <h6>{{member.name}}</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            {{member.email}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            {{member.divisi}}
                                        </div>
                                    </td>
                                    <td style='text-align:center;'>
                                        <div class="userDatatable-content d-inline-block">
                                            <div v-if="member.status==1">
                                                <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active"><i class="fas fa-check"></i>
                                                    &nbsp;Active</span>
                                            </div>
                                            <div v-if="member.status==0">
                                                <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active"><i class="fas fa-exclamation"></i>
                                                    &nbsp;Locked</span>
                                            </div>
                                            <div v-if="member.status==2">
                                                <span class="rounded-pill userDatatable-content-status color-danger
                                                bg-opacity-danger active"><i class="fas fa-lock"></i>
                                                    &nbsp;Terminated</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                            <li>
                                                <router-link :to="`/detail/user/${member.id}`" class="edit">
                                                    <i class="fas fa-pen"></i></router-link>
                                            </li>
                                            <li>
                                                <a v-on:click="deleteData(member.id)" class="remove">
                                                    <i class="fas fa-trash"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
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
                count: 0,
                user: {
                    gender: '',
                    role: '',
                    department: '',
                    divisi: '',
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
        },
        created() {
            this.countUsers();
        },
        methods: {
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
            },
            async countUsers() {
                const data = await axios.get('/api/count-users');
                this.count = data.data;
            }
        },
    }

</script>
