<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize fw-500 breadcrumb-title">Employee data - <abbr
                            :title="employeeData.item_name">{{employeeData.item_name}}</abbr></h4>
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
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>Employee code:</span>
                                    <input v-model="employeeData.employee_code" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span>Employee name:</span>
                                    <input v-model="employeeData.employee_name" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>Nickname:</span>
                                    <input v-model="employeeData.employee_nickname" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <span>Sex:</span>
                                    <input v-model="employeeData.sex" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <span>Age:</span>
                                    <input v-model="employeeData.birth_date" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>Working duration:</span>
                                    <input v-model="employeeData.date_join" type="date" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="user-info-tab w-100 bg-white global-shadow radius-xl mb-50">
                    <div class="ap-tab-wrapper border-bottom ">
                        <ul class="nav px-30 ap-tab-main text-capitalize" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-details-photo-tab" data-toggle="pill"
                                    href="#v-pills-details-photo" role="tab" aria-controls="v-pills-details-photo"
                                    aria-selected="true">Details and Photo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-contact-info-medical-tab" data-toggle="pill"
                                    href="#v-pills-contact-info-medical" role="tab"
                                    aria-controls="v-pills-contact-info-medical" aria-selected="true">Contact Info &
                                    Medical</a>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active" id="v-pills-details-photo" role="tabpanel"
                            aria-labelledby="v-pills-details-photo-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <form @submit.prevent="handleSubmit">
                                                    <div class="form-row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <span>Item Code:</span>
                                                                <input type="text" v-model="employeeData.item_code"
                                                                    placeholder="Item Code" class="form-control"
                                                                    :disabled="!permissions.includes('EditInventoryItem') ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <span>Item Name:</span>
                                                                <input type="text" v-model="employeeData.item_name"
                                                                    placeholder="Item Name" class="form-control"
                                                                    :disabled="!permissions.includes('EditInventoryItem')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <span>Type:</span>
                                                                <select v-model="employeeData.type" id=""
                                                                    class="form-control form-control-default"
                                                                    :disabled="!permissions.includes('EditInventoryItem')">
                                                                    <option value="" disabled>Type item</option>
                                                                    <option value="1">Stock</option>
                                                                    <option value="2">Non Stock</option>
                                                                    <option value="3">Assembly</option>
                                                                    <option value="4">Bundle</option>
                                                                    <option value="5">Service</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <div class="form-row">
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Brand:</span>
                                                                    <input type="text" v-model="employeeData.brand"
                                                                        class="form-control" placeholder="Brand"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Current Price:</span>
                                                                    <vue-numeric class="form-control" readonly
                                                                        v-bind:precision="0"
                                                                        v-model="employeeData.price"></vue-numeric>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Ending Balance:</span>
                                                                    <vue-numeric class="form-control" readonly
                                                                        v-bind:precision="0" v-model="countQty">
                                                                    </vue-numeric>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Unit:</span>
                                                                    <input type="text" v-model="employeeData.unit"
                                                                        class="form-control"
                                                                        placeholder="Ex: Kg for weight, Pcs for things or else"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Item Group:</span>
                                                                    <select v-model="employeeData.item_group"
                                                                        class="form-control form-control-default"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                        <option value="" disabled>Select category item
                                                                        </option>
                                                                        <option v-for="departmentOpt in departmentOpt"
                                                                            :key="departmentOpt.id"
                                                                            :value="departmentOpt.id">
                                                                            {{departmentOpt.name}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Stock Group:</span>
                                                                    <select v-model="employeeData.stock_group"
                                                                        class="form-control form-control-default"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                        <option value="" disabled>Select stock item
                                                                        </option>
                                                                        <option
                                                                            v-for="subDepartmentOpt in subDepartmentOpt"
                                                                            :key="subDepartmentOpt.id"
                                                                            :value="subDepartmentOpt.id">
                                                                            {{subDepartmentOpt.name}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <div class="form-row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <span>Description:</span>
                                                                        <textarea v-model="employeeData.descriptions"
                                                                            id="" class="form-control" cols="30"
                                                                            rows="6"
                                                                            placeholder="Your item descriptions..."></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom:10px;">
                                                    <h5>Dimension and Weight</h5>
                                                    <p class="muted-text">You can use mm/unit/kg/ or anything else as a
                                                        unit</p>
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Width</span>
                                                                    <input type="text" v-model="employeeData.width"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Length</span>
                                                                    <input type="text" v-model="employeeData.length"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Thickness</span>
                                                                    <input type="text" v-model="employeeData.thickness"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Nett Weight</span>
                                                                    <input type="text" v-model="employeeData.nt_weight"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Gross Weight</span>
                                                                    <input type="text" v-model="employeeData.gr_weight"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <span>Volume</span>
                                                                    <input type="text" v-model="employeeData.volume"
                                                                        class="form-control" placeholder="0.00 mm"
                                                                        :disabled="!permissions.includes('EditInventoryItem')">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="button-group d-flex pt-25"
                                                        v-if="permissions.includes('EditInventoryItem')">
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
                        <div class="tab-pane fade  show" id="v-pills-contact-info-medical" role="tabpanel"
                            aria-labelledby="v-pills-contact-info-medical-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <div class="form-row">
                                                    <div class="col-lg-5">
                                                        <div class="form-group mb-10">
                                                            <span>From:</span>
                                                            <input type="date" v-model="range.fromDate" id=""
                                                                class="form-control">
                                                            <span style="color:red" v-show="notSuitable">From date
                                                                cannot be latest than Until date</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group mb-10">
                                                            <span>Until:</span>
                                                            <input type="date" v-model="range.toDate" id=""
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 align-self-center mt-2">
                                                        <button v-on:click="searchData" v-on:keyup.enter="searchData"
                                                            class="btn btn-secondary-boxity btn-sm">Search</button>
                                                    </div>
                                                    <div class="col-lg-1 align-self-center mt-2">
                                                        <a :href="`/api/report/item-history/${$route.params.id}?from=${range.fromDate}&until=${range.toDate}`"
                                                            class="btn btn-warning btn-sm" target="_blank">Print</a>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <span>Beginning:</span>
                                                            <vue-numeric class="form-control" readonly
                                                                v-bind:precision="0" v-model="beginningQty">
                                                            </vue-numeric>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <span>Quantity In:</span>
                                                            <vue-numeric class="form-control" readonly
                                                                v-bind:precision="0" v-model="sumQtyIn">
                                                            </vue-numeric>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <span>Quantity Out:</span>
                                                            <vue-numeric class="form-control" readonly
                                                                v-bind:precision="0" v-model="sumQtyOut">
                                                            </vue-numeric>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <span>Ending Balance:</span>
                                                            <vue-numeric class="form-control" readonly
                                                                v-bind:precision="0" v-model="countQty">
                                                            </vue-numeric>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
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
                                                                        <v-data-table :loading="loading"
                                                                            loading-text="Data not found..."
                                                                            :search="search" :headers="headers"
                                                                            multi-sort :sort-by.sync="
                                                                            sortBy" :sort-desc.sync="sortDesc"
                                                                            :items="historyItem" :items-per-page="10"
                                                                            class="elevation-1">
                                                                            <template
                                                                                v-slot:[`item.itemNumber`]="{item}">
                                                                                <div v-if="item.type===1">
                                                                                    <router-link
                                                                                        :to="`/detail/purchase/invoices/${item.itemNumber}`">
                                                                                        <i
                                                                                            class="fal fa-link"></i>&nbsp;{{item.itemNumber}}
                                                                                    </router-link>
                                                                                </div>
                                                                                <div v-if="item.type===2">
                                                                                    <router-link
                                                                                        :to="`/detail/sales/invoices/${item.itemNumber}`">
                                                                                        <i
                                                                                            class="fal
                                                                                            fa-link"></i>&nbsp;{{item.itemNumber}}
                                                                                    </router-link>
                                                                                </div>
                                                                            </template>
                                                                            <template v-slot:[`item.type`]="{item}">
                                                                                <div v-if="item.type===1">
                                                                                    <span>Purchase Invoice</span>
                                                                                </div>
                                                                                <div v-if="item.type===2">
                                                                                    <span>Sales Invoice</span>
                                                                                </div>
                                                                            </template>
                                                                            <template v-slot:[`item.qtyIn`]="{item}">
                                                                                {{item.qtyIn|toDecimal}}
                                                                            </template>
                                                                            <template v-slot:[`item.qtyOut`]="{item}">
                                                                                {{item.qtyOut|toDecimal}}
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
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';
    import vue2Dropzone from 'vue2-dropzone';
    import VueNumeric from 'vue-numeric'
    export default {
        components: {
            'editor': Editor,
            vueDropzone: vue2Dropzone,
            VueNumeric
        },
        title() {
            return `Employee data`;
        },
        data() {
            return {
                employeeData: {
                    sex: '',
                },
                departmentOpt: {},
                subDepartmentOpt: {},

                permissions: []
            }
        },
        created() {
            this.loadEmployeeData();
        },
        beforeMount() {
            this.permissions = this.$store.getters.getPermissions;
        },
        methods: {
            routerBack() {
                this.$router.go(-1)
            },
            routerRefresh() {
                this.$isLoading(true);
                this.loadEmployeeData();
                this.$isLoading(false);
            },
            async loadEmployeeData() {
                // this.$Progress.start();
                this.$isLoading(true);
                const response = await axios.get('/api/employee/' + this.$route.params.id);
                if (response.data.employee_sex === 0) {
                    this.employeeData.employee_sex === 'Female'
                } else {
                    this.employeeData.employee_sex === 'Male'
                }
                this.employeeData = response.data;

                // Load data relation
                const resp = await axios.get('/api/department');
                this.departmentOpt = resp.data;
                const respSub = await axios.get('/api/department/sub');
                this.subDepartmentOpt = respSub.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async handleSubmit() {
                await axios.patch('/api/employee/' + this.$route.params.id, this.employeeData);
                document.getElementById('ding').play();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update employee data',
                });
                this.$router.push('/employee/detail/' + this.$route.params.id);
            },
        },
    }

</script>
