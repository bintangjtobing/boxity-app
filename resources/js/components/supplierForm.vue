<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Update Supplier</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <span @click="routerBack" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-arrow-left"></i></span>
            <span @click="routerRefresh" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-sync"></i></span>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-vertical card-default card-md mb-4">
                    <div class="card-body pb-md-30">
                        <div class="vertical-form">
                            <form @submit.prevent="handleSubmit">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                            <input type="text" required v-model="user.customerCode" class="form-control"
                                                placeholder="Supplier Code ">
                                            <span class="text-danger error-password">
                                                {{ errors.customerCode }}</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text" required v-model="user.name" class="form-control"
                                                placeholder="Person in charge ">
                                            <span class="text-danger error-password">
                                                {{ errors.name }}</span>
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="text" required v-model="user.customerName" class="form-control"
                                                placeholder="Supplier Name (PT/CV/UD/Ext.)">
                                            <span class="text-danger error-password">
                                                {{ errors.customerName }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" required v-model="user.email" class="form-control"
                                        placeholder="Email">
                                    <span class="text-danger error-password">
                                        {{ errors.email }}</span>
                                </div>
                                <div class="form-group">
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
                                                <input type="url" v-model="user.customerWebsite" class="form-control"
                                                    id="" placeholder="Website, started from `https://` or `http://`">
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
                                    <button type="submit"
                                        class="btn btn-primary-boxity btn-default btn-squared text-capitalize">Update
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
            return 'Update supplier data';
        },
        data() {
            return {
                user: {},
                errors: {},
                permissions: []
            }
        },
        beforeMount(){                        
            this.permissions = this.$store.getters.getPermissions;
        },        
        created() {
            this.loadDataUser();
        },
        methods: {
            routerBack() {
                this.$router.go(-1)
            },
            routerRefresh() {
                this.$isLoading(true);
                this.loadDataUser();
                this.$isLoading(false);
            },
            async loadDataUser() {
                // this.$Progress.start();
                this.$isLoading(true);
                const response = await axios.get('/api/suppliers/' + this.$route.params.id);
                this.user = response.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async handleSubmit() {
                const payload = {};
                _.forEach(['name', 'email', 'customerCode', 'customerName', 'customerAddress',
                    'customerCity', 'customerPhone', 'customerEmail', 'customerWebsite', 'customerNPWP'
                ], (field) => {
                    if (this.user[field]) {
                        payload[field] = this.user[field];
                    }
                });
                if (!_.isEmpty(this.user.password)) {
                    payload.password = this.user.password;
                }
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/suppliers/' + this.$route.params.id, payload);
                document.getElementById('ding').play();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update customer data',
                });
                // this.$Progress.finish();
                this.$isLoading(false);
                this.$router.push('/suppliers');
            },
        },
    }

</script>
