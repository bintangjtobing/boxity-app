<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Update supplier</h4>
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
                                                                v-model="user.supplier_code" autofocus>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <span>Company name:</span>
                                                            <input type="text" v-model="user.supplier_name"
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
                        <div class="tab-pane fade  show" id="v-pills-warehouse" role="tabpanel"
                            aria-labelledby="v-pills-warehouse-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <div class="form-row">
                                                    <!-- Table History Listed -->
                                                    <div class="col-lg-12">
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <div
                                                                    class="userDatatable projectDatatable project-table bg-white border-0">
                                                                    <div class="table-responsive">
                                                                        <v-card-title>
                                                                            <v-text-field v-model="search"
                                                                                append-icon="mdi-magnify"
                                                                                label="Search here..." single-line
                                                                                hide-details>
                                                                            </v-text-field>
                                                                        </v-card-title>
                                                                        <v-data-table loading
                                                                            loading-text="Data not found..."
                                                                            :search="search" :headers="headers"
                                                                            multi-sort :sort-by.sync="
                                                                            sortBy" :sort-desc.sync="sortDesc"
                                                                            :items="warehouseRelated"
                                                                            :items-per-page="10" class="elevation-1">
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
                warehouseRelated: {},
            }
        },
        created() {
            this.loadDataUser();
        },
        methods: {
            async loadDataUser() {
                // this.$Progress.start();
                this.$isLoading(true);
                const response = await axios.get('/api/suppliers/' + this.$route.params.id);
                axios.get('/api/bank').then(resp => {
                    this.bank = resp.data;
                });
                this.user = response.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async handleSubmit() {
                const payload = {};
                _.forEach(['supplier_name', 'supplier_code', 'address', 'city', 'phone', 'email', 'npwp', 'site',
                    'bank_code', 'bank_account', 'bank_name'
                ], (field) => {
                    if (this.user[field]) {
                        payload[field] = this.user[field];
                    }
                });
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/suppliers/' + this.$route.params.id, payload);
                document.getElementById('ding').play();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update company data',
                });
                // this.$Progress.finish();
                this.$isLoading(false);
                this.$router.push('/suppliers');
            },
        },
    }

</script>
