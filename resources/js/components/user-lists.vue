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
                        <router-link to="/users-management/add" class="btn btn-sm btn-primary btn-add">
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
                                <router-link :to="`/detail/user/${item.id}`" class="edit">
                                    <i class="fad fa-edit"></i></router-link>
                                <a v-on:click="deleteData(item.id)" class="remove">
                                    <i class="fad fa-trash"></i></a>
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
            };
        },
        mounted() {
            this.loadUsers();
            this.generatePassword();
        },
        methods: {
            hideModal() {
                document.getElementById('closeModal').click();
            },
            async loadUsers() {
                this.$Progress.start();
                const resMember = await axios.get('/api/users');
                this.members = resMember.data;

                // Count users
                const respCount = await axios.get('/api/count-users');
                this.count = respCount.data;
                this.$Progress.finish();
            },
            async deleteData(id) {
                const result = await Swal.fire({
                    title: 'Terminate user?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    this.$Progress.start();
                    await axios.delete('api/users/' + id);
                    this.loadUsers();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Terminated',
                        text: 'Success terminate current user.'
                    });
                    this.$Progress.finish();
                }
            }
        },
    }

</script>
