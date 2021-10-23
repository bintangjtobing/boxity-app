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
                    <div class="action-btn" v-if="permissions.includes('CreateUsers')">
                        <router-link to="/users-management/add" class="btn btn-sm btn-primary-boxity btn-add">
                            <em class="las la-plus fs-16"></em>New user</router-link>
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
                        <v-data-table :headers="headers" multi-sort :search="search" :items="members"
                            :items-per-page="10" loading loading-text="Loading... Please wait" class="elevation-1">
                            <template v-slot:item.status="{ item }">
                                <div v-if="item.status==1">
                                    <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active"><i class="fal fa-check"></i>
                                        &nbsp;Active</span>
                                </div>
                                <div v-if="item.status==0">
                                    <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active"><i class="fal fa-exclamation"></i>
                                        &nbsp;Locked</span>
                                </div>
                                <div v-if="item.status==2">
                                    <span class="rounded-pill userDatatable-content-status color-danger
                                                bg-opacity-danger active"><i class="fal fa-lock"></i>
                                        &nbsp;Terminated</span>
                                </div>
                            </template>
                            <template v-slot:item.role="{ item }">
                                <span class="rounded-pill userDatatable-content-status color-primary
                                                bg-opacity-primary active text-capitalize">
                                    &nbsp;{{item.role}}</span>
                            </template>
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/detail/user/${item.id}`" class="edit" v-if="permissions.includes('EditUsers')">
                                    <i class="fad fa-edit"></i></router-link>
                                <a v-on:click="deleteData(item.id)" class="remove" v-if="permissions.includes('TerminateUsers')">
                                    <i class="fad fa-trash"></i></a>
                            </template>
                        </v-data-table>
                    </div>
                </div>
            </div>
        </div>
        <span class="my-3"><i class="fad fa-info-circle"></i> Having a trouble? You can see and learn from
            <a href="https://help.boxity.id/associate/users-management" target="_blank">Help and
                Documentation</a>'s page.</span>
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
                        text: 'Role',
                        value: 'role'
                    },
                    {
                        text: 'Status',
                        filterable: false,
                        value: 'status'
                    }, {
                        text: 'Actions',
                        value: 'actions',
                        align: 'right',
                        filterable: false,
                        sortable: false
                    }
                ],
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
                permissions: []
            };
        },
        beforeMount(){                        
            this.permissions = this.$store.getters.getPermissions;
        },
        mounted() {
            this.loadUsers();
            this.generatePassword();
        },
        methods: {
            hideModal() {
                document.getElementById('closeModal').click();
            },
            generatePassword() {
                const genPass = this.rndStr(8);
                // console.log(genPass);
                this.user.password = genPass;
                this.user.confirmPassword = genPass;
            },
            async loadUsers() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resMember = await axios.get('/api/users');
                this.members = resMember.data;

                // Count users
                const respCount = await axios.get('/api/count-users');
                this.count = respCount.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteData(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Terminate user?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('api/users/' + id);
                    this.loadUsers();
                    this.$isLoading(false);
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Terminated',
                        text: 'Success terminate current user.'
                    });
                    // this.$Progress.finish();
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
                const isValid = await this.validateData();
                if (!isValid) return false;
                this.hideModal();
                const payload = {};
                _.forEach(['name', 'role', 'department', 'divisi', 'gender', 'email'], (field) => {
                    if (this.user[field]) {
                        payload[field] = this.user[field];
                    }
                });
                if (!_.isEmpty(this.user.password)) {
                    payload.password = this.user.password;
                }
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/users', payload).then(response => {
                    this.loadUsers();
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New user',
                    });
                    this.user = {
                        gender: '',
                        role: '',
                        department: '',
                        divisi: '',
                        name: '',
                        email: '',
                    };
                    const genPass = this.rndStr(8);
                    this.user.password = genPass;
                    this.user.confirmPassword = genPass;
                    // this.$Progress.finish();
                    this.$isLoading(false);
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
            rndStr(len) {
                let text = ""
                let chars = "abcdefghijklmnopqrstuvwxyz1234567890"

                for (let i = 0; i < len; i++) {
                    text += chars.charAt(Math.floor(Math.random() * chars.length))
                }
                return text
            }
        },
    }

</script>
