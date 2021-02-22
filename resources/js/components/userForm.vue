<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Update user</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-vertical card-default card-md mb-4">
                    <div class="card-body pb-md-30">
                        <div class="vertical-form">
                            <form @submit.prevent="handleSubmit">
                                <div class="form-group mb-20">
                                    <div class="form-row">
                                        <div class="col-lg-9">
                                            <input type="text" required v-model="user.name" class="form-control"
                                                placeholder="Fullname">
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
                                    <input type="email" required v-model="user.email" class="form-control"
                                        placeholder="Email">
                                </div>
                                <div class="form-group mb-20">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                            <input type="password" v-model="user.password" class="form-control"
                                                id="password" placeholder="Password">
                                            <span class="text-danger error-password">
                                                {{ errors.password }}</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="password" v-model="user.confirmPassword" id="verifyPassword"
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
                                    <button type="submit"
                                        class="btn btn-primary btn-default btn-squared text-capitalize">Update
                                    </button>
                                </div>
                            </form>
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
            return 'Update user data';
        },
        data() {
            return {
                user: {},
                errors: {},
            }
        },
        created() {
            this.loadDataUser();
        },
        methods: {
            async loadDataUser() {
                const response = await axios.get('/api/user/' + this.$route.params.id);
                this.user = response.data;
            },
            async handleSubmit() {
                const payload = {};
                _.forEach(['name', 'role', 'department', 'divisi', 'gender', 'email'], (field) => {
                    if (this.user[field]) {
                        payload[field] = this.user[field];
                    }
                });
                if (!_.isEmpty(this.user.password)) {
                    payload.password = this.user.password;
                }
                await axios.patch('/api/users/' + this.$route.params.id, payload);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update user data',
                });
                this.$router.push('/users-management');
            },
        },
    }

</script>
