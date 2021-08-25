<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Update customer -
                                {{this.user.company_name}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="user-info-tab w-100 bg-white global-shadow radius-xl mb-50">
                    <div class="ap-tab-wrapper border-bottom ">
                        <ul class="nav px-30 ap-tab-main text-capitalize" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                    role="tab" aria-controls="v-pills-home" aria-selected="true">details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-warehouse-tab" data-toggle="pill"
                                    href="#v-pills-warehouse" role="tab" aria-controls="v-pills-warehouse"
                                    aria-selected="true">Warehouse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-pic-tab" data-toggle="pill" href="#v-pills-pic"
                                    role="tab" aria-controls="v-pills-pic" aria-selected="true">Person in Charge</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-lg-4">
                                                            <span>Company code:</span>
                                                            <input type="text" class="form-control" required
                                                                v-model="user.company_code" autofocus>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <span>Company name:</span>
                                                            <input type="text" v-model="user.company_name"
                                                                class="form-control">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <span>Address:</span>
                                                            <textarea class="form-control" v-model="user.address" id=""
                                                                rows="2"></textarea>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <span>NPWP:</span>
                                                            <input type="text" v-model="user.npwp" class="form-control"
                                                                placeholder="City">
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <span>City:</span>
                                                            <input type="text" v-model="user.city" class="form-control"
                                                                placeholder="City">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <span>Phone number:</span>
                                                            <input type="tel" v-model="user.phone" class="form-control">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <span>Email:</span>
                                                            <input type="email" v-model="user.email"
                                                                class="form-control">
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <span>Site:</span>
                                                            <input type="url" v-model="user.site" class="form-control">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <span>Bank:</span>
                                                            <select class="form-control form-control-default"
                                                                v-model="user.bank_code">
                                                                <option value="">Select bank code:</option>
                                                                <option v-for="bank in bank" :key="bank.id"
                                                                    v-bind:value="bank.code">
                                                                    {{bank.code}} - {{bank.name}}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <span>Bank account:</span>
                                                            <input type="number" v-model="user.bank_account"
                                                                class="form-control">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <span>Bank account holder:</span>
                                                            <input type="text" v-model="user.bank_name"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-group d-flex pt-25">
                                                    <button v-on:click="handleSubmit"
                                                        class="btn btn-primary-boxity btn-default btn-squared text-capitalize">Update
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="v-pills-pic" role="tabpanel"
                            aria-labelledby="v-pills-pic-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card my-3">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <h3>Add user authorization to this company,</h3>
                                                <span>Users can use this warehouse for saving its item. User
                                                    must be registered in here.</span>
                                                <div class="form-row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-10">
                                                            <select v-model="userComp.user_id" id=""
                                                                class="form-control form-control-default">
                                                                <option value="" disabled>Select user:
                                                                </option>
                                                                <option v-for="userList in userList" :key="userList.id"
                                                                    v-bind:value="userList.id">
                                                                    {{userList.name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group my-2">
                                                    <div class="justify-content-end">
                                                        <button v-on:click="addUserToCompany"
                                                            v-on:keyup.enter="addUserToCompany"
                                                            class="btn btn-secondary-boxity btn-default btn-squared px-30">Add
                                                            to list</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Table Customer Listed -->
                                <div class="col-lg-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="userDatatable projectDatatable project-table bg-white border-0">
                                                <div class="table-responsive">
                                                    <v-card-title>
                                                        <v-text-field v-model="search" append-icon="mdi-magnify"
                                                            label="Search here..." single-line hide-details>
                                                        </v-text-field>
                                                    </v-card-title>
                                                    <v-data-table loading loading-text="Loading... Please wait..."
                                                        :search="searchPIC" :headers="headers" multi-sort
                                                        :items="userRelated" :items-per-page="10" class="elevation-1">
                                                        <template v-slot:item.actions="{item}">
                                                            <a v-on:click="deleteUserCompany(item.id)" class="remove">
                                                                <i class="fad fa-trash"></i></a>
                                                        </template>
                                                    </v-data-table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="v-pills-warehouse" role="tabpanel"
                            aria-labelledby="v-pills-pic-tab">
                            <div class="row mx-4 my-2">
                                <!-- Table Customer Listed -->
                                <div class="col-lg-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="userDatatable projectDatatable project-table bg-white border-0">
                                                <div class="table-responsive">
                                                    <v-card-title>
                                                        <v-text-field v-model="search" append-icon="mdi-magnify"
                                                            label="Search here..." single-line hide-details>
                                                        </v-text-field>
                                                    </v-card-title>
                                                    <v-data-table loading loading-text="Loading... Please wait..."
                                                        :search="searchWarehouse" :headers="headersWarehouse" multi-sort
                                                        :items="warehouseRelated" :items-per-page="10"
                                                        class="elevation-1">
                                                        <!-- <template v-slot:item.actions="{item}">
                                                            <a v-on:click="deleteUserCompany(item.id)" class="remove">
                                                                <i class="fad fa-trash"></i></a>
                                                        </template> -->
                                                    </v-data-table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            return 'Update company data';
        },
        data() {
            return {
                bank: {},
                user: {},
                errors: {},
                searchPIC: '',
                searchWarehouse: '',

                // user datatable
                // datatable
                search: '',
                key: 1,
                userRelated: [],
                headers: [{
                    text: 'User Name',
                    value: 'user_detail.name'
                }, {
                    text: 'Data Added',
                    value: 'created_at'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // warehouse
                search: '',
                key: 1,
                warehouseRelated: [],
                headersWarehouse: [{
                    text: 'Warehouse Name',
                    value: 'warehouse_detail.warehouse_name'
                }, {
                    text: 'Data Added',
                    value: 'created_at'
                }],
                // end datatable
                // User Relation Table
                userComp: {
                    userId: '',
                },
                userList: {},
            }
        },
        created() {
            this.loadDataUser();
            this.loadUserCompany();
        },
        methods: {
            async loadDataUser() {
                // this.$Progress.start();
                this.$isLoading(true);
                const response = await axios.get('/api/customers/' + this.$route.params.id);
                axios.get('/api/bank').then(resp => {
                    this.bank = resp.data;
                });
                this.user = response.data;

                // load user
                const resp = await axios.get('/api/contact-list');
                this.userList = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async loadUserCompany() {
                // this.$Progress.start();
                this.$isLoading(true);
                // Load customer warehouse
                const custList = await axios.get('/api/user-customer/' + this.$route.params.id);
                this.userRelated = custList.data;

                const warehouseList = await axios.get('/api/warehouse-customer/' + this.$route.params.id);
                this.warehouseRelated = warehouseList.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async handleSubmit() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/user/' + this.$route.params.id, this.warehouse);
                document.getElementById('ding').play();

                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update warehouse data',
                });
                // this.$Progress.finish();
                this.$isLoading(false);
                this.$router.push('/user-list');
            },
            async addUserToCompany() {
                await axios.post('/api/user-customer/' + this.$route.params.id, this.userComp);
                document.getElementById('ding').play();

                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success add customer on warehouse data',
                });
                this.userComp = {
                    user_id: '',
                }
                this.loadUserCompany();
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async addUserToCompany() {
                await axios.post('/api/user-customer/' + this.$route.params.id, this.userComp);
                document.getElementById('ding').play();

                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success add customer on warehouse data',
                });
                this.userComp = {
                    user_id: '',
                }
                this.loadUserCompany();
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteUserCompany(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete data customer on warehouse?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                this.$isLoading(true);
                    await axios.delete('/api/user-customer/' + id);
                    this.loadUserCompany();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current customer.'
                    });
                    // this.$Progress.finish();
                this.$isLoading(false);
                }
            },
        },
    }

</script>
