<template>
    <div>
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row justify-content-between align-items-center" @click="isShowing('colapse1')">
                        <div class="col-lg-6">
                            <h5>Add User</h5>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="material-icons-outlined collapseArea" :class="classRotate(isShow.colapse1)"
                                style="color: #ddd; font-size: 2rem !important">
                                expand_more
                            </span>
                        </div>
                    </div>
                    <div v-show="isShow.colapse1">
                        <div class="form-row">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <span>Fullname:</span>
                                    <input v-model="userData.name" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Gender:</span>
                                    <select v-model="userData.gender" required id="select-tag"
                                        class="form-control form-control-default ih-medium ip-gray radius-xs b-light fa-select">
                                        <option disabled value="">Select gender:</option>
                                        <option v-bind:value="`M`">Male</option>
                                        <option v-bind:value="`F`">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <span>Email:</span>
                                    <input v-model="userData.email" type="email" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <span>Password:</span>
                                    <input v-model="userData.password" type="password" class="form-control"
                                        :disabled="isAutoGenerate" />
                                    <input v-model="isAutoGenerate" @click="passwordGenerate" class="checkbox"
                                        type="checkbox" id="check-1" />
                                    <label for="check-1">
                                        <span class="checkbox-text">Auto Generate</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <span>Verify Password:</span>
                                    <span v-if="isPasswordSame === false" id="massage">Password not same</span>
                                    <input v-model="userData.passwordVerify" type="password" class="form-control"
                                        :disabled="isAutoGenerate" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row justify-content-between align-items-center" @click="isShowing('colapse2')">
                        <div class="col-lg-6">
                            <h5>Set Permissions</h5>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="material-icons-outlined collapseArea" :class="classRotate(isShow.colapse2)"
                                style="color: #ddd; font-size: 2rem !important">
                                expand_more
                            </span>
                        </div>
                    </div>
                    <div v-show="isShow.colapse2">
                        <template>
                            <v-card>
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                                        hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table v-model="userData.selected" :search="search" :headers="headers"
                                    :items="items.permissions" group-by="roleName" item-key="permissionId"
                                    loading-text="No data available" show-select />
                            </v-card>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <button @click="createUser" class="btn btn-secondary-boxity float-right btn-default btn-squared px-30"
                :disabled="!isSubmit">
                Add New
            </button>
            <br /><br /><br />
        </div>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    export default {
        data() {
            return {
                isShow: {
                    colapse1: true,
                    colapse2: true,
                },
                search: "",
                items: {
                    permissions: [{
                        IDpermission: "",
                        permissionName: "",
                        roleName: "",
                    }],
                },
                headers: [{
                        text: "Permission ID",
                        sortable: false,
                        value: "IDpermission",
                    },
                    {
                        text: "Permission Name",
                        sortable: false,
                        value: "permissionName"
                    },
                ],
                userData: {
                    name: "",
                    email: "",
                    gender: "",
                    password: "",
                    passwordVerify: "",
                    selected: []
                },
                isAutoGenerate: false,
            };
        },
        beforeMount(){                                    
            if(!this.$store.getters.getPermissions.includes('CreateUsers')){
                this.$router.push('/') 
            }
        },
        created() {
            this.getRolePermission();
        },
        computed: {
            isPasswordSame: function () {
                return (
                    this.userData.password &&
                    this.userData.passwordVerify &&
                    this.userData.password === this.userData.passwordVerify
                );
            },
            isSubmit: function () {
                return (
                    this.userData.name &&
                    this.userData.email &&
                    this.userData.gender &&
                    this.isPasswordSame &&
                    this.userData.selected.length > 0
                );
            },
        },
        methods: {
            classRotate: function (param) {
                return param ? "rotate" : "";
            },
            isShowing: function (param) {
                this.isShow[param] = !this.isShow[param];
            },
            passwordGenerate: function () {
                this.isAutoGenerate = !this.isAutoGenerate;
                if (this.isAutoGenerate) {
                    const genPass = this.rndStr(8);
                    this.userData.password = genPass;
                    this.userData.passwordVerify = genPass;
                } else {
                    this.userData.password = "";
                    this.userData.passwordVerify = "";
                }
            },
            rndStr(len) {
                let text = "";
                let chars = "abcdefghijklmnopqrstuvwxyz1234567890";

                for (let i = 0; i < len; i++) {
                    text += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                return text;
            },
            async getRolePermission() {
                const rolePermission = await axios.get('/api/role-permissions');
                this.items.permissions = rolePermission.data;
            },
            async createUser() {
                this.userData.role = this.userData.selected[0].roleName;

                // DUMMY
                this.userData.department = "developer"
                this.userData.divisi = "developer"
                // END-DUMMY

                this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/users', this.userData)
                    .then((response) => {
                        document.getElementById('ding').play();
                        Swal.fire({
                            icon: "success",
                            title: "Congratulations",
                            text: "Success add new user.",
                        });
                        this.$router.push('/users-management');
                        this.$Progress.finish();
                        this.$isLoading(false);
                    }).catch(error => {
                        this.$Progress.fail();
                        this.$isLoading(false);
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
    };

</script>

<style scoped>
    .rotate {
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .elevation-1 {
        max-height: 30em;
        overflow: auto;
    }

    #massage {
        color: #f41d2a;
    }

</style>
