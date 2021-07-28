<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Role management</h2>
                    <div class="action-btn">
                        <router-link to="/role-management/add" class="btn px-15 btn-primary">
                            <i class="las la-plus fs-16"></i>New Role</router-link>
                    </div>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table loading loading-text="Loading... Please wait" :headers="headers"
                            :items="rolesData" :items-per-page="10" class="elevation-1">
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/role-management/detail/${item.id}`" class="view">
                                    <i class="fas fa-eye"></i></router-link>
                                <a @click="deleteRole(item.id)" class="remove">
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
    import Editor from '@tinymce/tinymce-vue';

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'Role Management';
        },
        data() {
            return {
                // datatable
                rolesData: [],
                search: '',
                key: 1,
                headers: [{
                        text: 'Role',
                        value: 'name'
                    }, {
                        text: 'Slug',
                        value: 'slug'
                    },
                    // {
                    //     text: 'Permissions',
                    //     value: 'permissions'
                    // },
                    {
                        text: 'Actions',
                        value: 'actions',
                        filterable: false,
                        sortable: false
                    }
                ],
                // end datatable
            }
        },
        created() {
            this.loadRoles();
        },
        methods: {
            async loadRoles() {
                this.$Progress.start();
                const resp = await axios.get('/api/roles');
                this.rolesData = resp.data;
                this.$Progress.finish();
            },
            async deleteRole(id) {
                const result = await Swal.fire({
                    title: 'Delete roles?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    this.$Progress.start();
                    await axios.delete('/api/roles/' + id);
                    this.loadRoles();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success delete the role.'
                    });
                    this.$Progress.finish();
                }
            },
            async handleSubmit() {
                this.$Progress.start();
                await axios.post('/api/roles', this.blog).then(response => {
                    this.loadRoles();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New blog',
                    });
                    this.blog = {
                        title: '',
                        description: '',
                        category: '',
                    }
                    this.$Progress.finish();
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
            },
        },
    }

</script>
