<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Suppliers
                    </h2>
                    <div class="action-btn">
                        <a href="#" class="btn px-15 btn-primary" data-toggle="modal" data-target="#newSupplier"
                            v-if="permissions.includes('CreateUsers')">
                            <i class="las la-plus fs-16"></i>New supplier</a>
                        <!-- Modal -->
                        <div class="modal fade new-member" data-backdrop="static" ref="modalAdd" id="newSupplier"
                            role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content  radius-xl">
                                    <div class="modal-header">
                                        <h6 class="modal-title fw-500" id="staticBackdropLabel">New supplier</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fal fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="new-member-modal">
                                            <div class="form-row">
                                                <div class="col-lg-4">
                                                    <span>Supplier code:</span>
                                                    <input type="text" class="form-control" required
                                                        v-model="user.supplier_code" autofocus>
                                                </div>
                                                <div class="col-lg-8">
                                                    <span>Supplier name:</span>
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
                                                    <input type="text" v-model="user.npwp" class="form-control">
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
                                                    <input type="email" v-model="user.email" class="form-control">
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
                                                    <input type="text" v-model="user.bank_name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="button-group d-flex pt-25">
                                                <button v-on:click="handleSubmit"
                                                    class="btn btn-primary-boxity btn-default btn-squared text-capitalize"
                                                    data-dismiss="modal">Add new
                                                </button>
                                                <button class="btn btn-light btn-default btn-squared fw-400
                                                        text-capitalize b-light color-light" aria-label="Close"
                                                    data-dismiss="modal">cancel
                                                </button>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="userDatatable adv-table-table global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :loading="loading" loading-text="Loading... Please wait" :headers="headers"
                            :items="members" :items-per-page="10" class="elevation-1" :search="search"
                            :expanded.sync="expanded" show-expand>
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/detail/supplier/${item.id}`" class="edit"
                                    v-if="permissions.includes('EditUsers')">
                                    <i class="fad fa-eye"></i></router-link>
                                <a v-on:click="deleteData(item.id)" class="remove"
                                    v-if="permissions.includes('TerminateUsers')">
                                    <i class="fad fa-trash"></i></a>
                            </template>
                            <template v-slot:item.email="{item}">
                                <a :href="`mailto:`+item.email">{{item.email}}</a>
                            </template>
                            <template v-slot:expanded-item="{ headers, item }">
                                <td :colspan="headers.length">
                                    <b>More info about {{item.supplier_name}}:</b> <br>
                                    Address: {{item.address}} <br>
                                    City: {{item.city}} <br>
                                    Phone number: {{item.phone}} <br>
                                    NPWP: {{item.npwp}} <br>
                                    Site: <a :href="item.site">{{item.site}}</a>
                                </td>
                            </template>
                        </v-data-table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12 col-lg-12 col-md-12 mb-25">
                <div class="feature-cards5 d-flex justify-content-between border-0 radius-xl bg-white p-25">
                    <div class="application-task d-flex align-items-center">
                        <div class="application-task-content">
                            <span><strong>Need help?</strong> Check out our <a href="https://help.boxity.id"
                                    target="_blank">documentation</a> or our <a href="#">getting
                                    started video series</a> to quickly learn the basics or <router-link
                                    to="/new-issue">reach out to our
                                    team</router-link>, we'd happy to help.</span>
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
            return 'Suppliers';
        },
        data() {
            return {
                bank: {},
                expanded: [],
                members: [],
                loading: true,
                search: '',
                key: 1,
                headers: [{
                    text: 'Company Name',
                    value: 'supplier_name'
                }, {
                    text: 'Email',
                    value: 'email'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                count: 0,
                user: {
                    bank_code: '',
                },
                permissions: []
            };
        },
        beforeMount() {
            this.permissions = this.$store.getters.getPermissions;
        },
        mounted() {
            this.loadSuppliers();
        },
        created() {
            this.countSuppliers();
        },
        methods: {
            loadSuppliers() {
                // this.$Progress.start();
                this.$isLoading(true);
                axios.get("api/suppliers")
                    .then(res => {
                        this.members = res.data;
                        this.loading = false;
                    });
                axios.get('/api/bank').then(resp => {
                    this.bank = resp.data;
                });
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteData(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete company?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('/api/suppliers/' + id);
                    this.loadSuppliers();
                    this.countSuppliers();
                    document.getElementById('ding').play();

                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current company'
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }
            },
            async handleSubmit(event) {
                // this.$Progress.start();
                this.$isLoading(true);
                event.preventDefault();

                const payload = {};
                _.forEach(['supplier_name', 'supplier_code', 'address', 'city', 'phone', 'email', 'npwp', 'site',
                        'bank_code', 'bank_account', 'bank_name'
                    ],
                    (field) => {
                        if (this.user[field]) {
                            payload[field] = this.user[field];
                        }
                    });
                // console.log(this.user);
                await axios.post('/api/suppliers', payload).then(response => {
                    this.loadSuppliers();
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success new company.',
                    });
                    this.user = {
                        supplier_name: '',
                        supplier_name: '',
                        address: '',
                        city: '',
                        phone: '',
                        email: '',
                        npwp: '',
                        site: '',
                        bank_code: '',
                        bank_account: '',
                        bank_name: '',
                    };
                    this.countSuppliers();
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
            async countSuppliers() {
                const data = await axios.get('/api/count-suppliers');
                this.count = data.data;
            },
        },
    }

</script>
