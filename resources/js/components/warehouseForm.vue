<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h2 class="text-capitalize fw-700 breadcrumb-title">Update Warehouse</h2>
                            <span></span>
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
                <div class="user-info-tab w-100 bg-white global-shadow radius-xl mb-50">
                    <div class="ap-tab-wrapper border-bottom ">
                        <ul class="nav px-30 ap-tab-main text-capitalize" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                    role="tab" aria-controls="v-pills-home" aria-selected="true">details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-customerListed-tab" data-toggle="pill"
                                    href="#v-pills-customerListed" role="tab" aria-controls="v-pills-customerListed"
                                    aria-selected="true">Customer Listed</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <form @submit.prevent="handleSubmit">
                                                    <div class="form-row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group mb-10">
                                                                <span>Warehouse code:</span>
                                                                <input type="text" v-model="warehouse.warehouse_code"
                                                                    class="form-control"
                                                                    :disabled="!permissions.includes('EditWarehouse')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="form-group mb-10">
                                                                <span>Warehouse name:</span>
                                                                <input type="text" v-model="warehouse.warehouse_name"
                                                                    class="form-control" :disabled="!permissions.includes('EditWarehouse')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-1">
                                                        <span>Full address:</span>
                                                        <textarea class="form-control" v-model="warehouse.address"
                                                            cols="30" rows="5" :disabled="!permissions.includes('EditWarehouse')"></textarea>
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <span>Remarks</span>
                                                        <textarea class="form-control" v-model="warehouse.remarks"
                                                            cols="30" rows="5" :disabled="!permissions.includes('EditWarehouse')"></textarea>
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <span>Person in charge:</span>
                                                        <select v-model="warehouse.pic" id=""
                                                            class="form-control form-control-default" :disabled="!permissions.includes('EditWarehouse')">
                                                            <option value="" disabled>Select supervisor:</option>
                                                            <option v-for="users in user" :key="users.id"
                                                                v-bind:value="users.id">
                                                                {{users.name}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="button-group d-flex pt-25" v-if="permissions.includes('EditWarehouse')">
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
                        <div class="tab-pane fade show" id="v-pills-customerListed" role="tabpanel"
                            aria-labelledby="v-pills-customerListed-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12" v-if="permissions.includes('AddPICCustomersOnWarehouse')">
                                    <div class="card my-3">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <h3>Add customer authorization to this warehouse</h3>
                                                <span>Customers can use this warehouse for saving its item. Customers
                                                    must be registered in here.</span>
                                                <div class="form-row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-10">
                                                            <select v-model="warehouseCust.customerId" id=""
                                                                class="form-control form-control-default" :disabled="!permissions.includes('AddPICCustomersOnWarehouse')">
                                                                <option value="" disabled>Select customer:
                                                                </option>
                                                                <option v-for="customerList in customerList"
                                                                    :key="customerList.id"
                                                                    v-bind:value="customerList.id">
                                                                    {{customerList.company_name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group my-2" v-if="permissions.includes('AddPICCustomersOnWarehouse')">
                                                    <div class="justify-content-end">
                                                        <button v-on:click="addCustomerToWarehouse"
                                                            v-on:keyup.enter="addCustomerToWarehouse"
                                                            class="btn btn-secondary-boxity btn-default btn-squared px-30">Add
                                                            to list</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Table Customer Listed -->
                                <div class="col-lg-12 mt-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="userDatatable projectDatatable project-table bg-white border-0">
                                                <div class="table-responsive">
                                                    <v-card-title>
                                                        <v-text-field v-model="search" append-icon="mdi-magnify"
                                                            label="Search here..." single-line hide-details>
                                                        </v-text-field>
                                                    </v-card-title>
                                                    <v-data-table :loading="loading"
                                                        loading-text="Loading... Please wait..." :search="search"
                                                        :headers="headers" multi-sort :items="warehouseCustomerList"
                                                        :items-per-page="10" class="elevation-1">                                                        
                                                        <template v-slot:item.actions="{item}">                                                            
                                                            <a v-on:click="deleteWarehouseCustomerList(item.id)"
                                                                class="remove" v-if="permissions.includes('DeletePICCustomersOnWarehouse')">
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
            return 'Update warehouse data';
        },
        data() {
            return {
                // datatable
                search: '',
                key: 1,
                loading: true,
                warehouseCustomerList: [],
                headers: [{
                    text: 'Customer Name',
                    value: 'customer_detail.company_name'
                }, {
                    text: 'Data Added',
                    value: 'created_at'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // end datatable

                warehouse: {},
                user: {},

                // Customer Relation Table
                warehouseCust: {
                    customerId: '',
                },
                customerList: {},
                permissions: []
            }
        },
        created() {
            this.loadDataWarehouse();
            this.loadCustomerWarehouse();
        },
        beforeMount(){                                    
            this.permissions = this.$store.getters.getPermissions;
        },
        methods: {
            routerBack() {
                this.$router.go(-1)
            },
            routerRefresh() {
                this.$isLoading(true);
                this.loadDataWarehouse();
                this.loadCustomerWarehouse();
                this.$isLoading(false);
            },
            async loadDataWarehouse() {
                // this.$Progress.start();
                this.$isLoading(true);
                const response = await axios.get('/api/warehouse/' + this.$route.params.id);
                this.warehouse = response.data;

                // load user
                const resp = await axios.get('/api/contact-list');
                this.user = resp.data;

                // Load customer
                const respCust = await axios.get('/api/customers');
                this.customerList = respCust.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async loadCustomerWarehouse() {
                // this.$Progress.start();
                this.$isLoading(true);
                // Load customer warehouse
                const custList = await axios.get('/api/customer-warehouse/' + this.$route.params.id);
                this.warehouseCustomerList = custList.data;
                if (custList.data.length) {
                    this.loading = false
                }
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async handleSubmit() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.patch('/api/warehouse/' + this.$route.params.id, this.warehouse);
                document.getElementById('ding').play();

                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update warehouse data',
                });
                // this.$Progress.finish();
                this.$isLoading(false);
                this.$router.push('/warehouse-list');
            },
            async addCustomerToWarehouse() {
                await axios.post('/api/warehouse-customer/' + this.$route.params.id, this.warehouseCust);
                document.getElementById('ding').play();

                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success add customer on warehouse data',
                });
                this.warehouseCust = {
                    customerId: '',
                }
                this.loadCustomerWarehouse();
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteWarehouseCustomerList(id) {
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
                    await axios.delete('/api/warehouse-customer/' + id);
                    this.loadCustomerWarehouse();
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
