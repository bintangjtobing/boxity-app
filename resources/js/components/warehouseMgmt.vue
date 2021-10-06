<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Warehouse List</h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <a href="#" data-toggle="modal" data-target="#addWarehouse"
                                class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>Add Warehouse</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table :headers="headers" :search="search" multi-sort :items="warehouseData"
                                    :items-per-page="10" class="elevation-1" :expanded.sync="expanded" show-expand>
                                    <template v-slot:expanded-item="{ headers, item }">
                                        <td :colspan="headers.length">
                                            <b>More info about {{item.warehouse_name}}:</b> <br>
                                            Address: <span v-html="item.address"></span> <br>
                                            Remarks: {{item.remarks}} <br>
                                        </td>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <router-link :to="`/detail/warehouse/${item.id}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="deleteWarehouse(item.id)" class="remove">
                                            <i class="fad fa-trash"></i></a>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addWarehouse" tabindex="-1" aria-labelledby="addWarehouse" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title fw-500" id="staticBackdropLabel">Add Warehouse</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fal fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-10">
                                            <span>Warehouse code:</span>
                                            <input type="text" v-model="warehouse.warehouse_code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group mb-10">
                                            <span>Warehouse name:</span>
                                            <input type="text" v-model="warehouse.warehouse_name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-1">
                                    <span>Full address:</span>
                                    <textarea class="form-control" v-model="warehouse.address" cols="30"
                                        rows="5"></textarea>
                                </div>
                                <div class="form-group my-2">
                                    <span>Remarks</span>
                                    <textarea class="form-control" v-model="warehouse.remarks" cols="30"
                                        rows="5"></textarea>
                                </div>
                                <div class="form-group my-2">
                                    <span>Person in charge:</span>
                                    <select v-model="warehouse.pic" id="" class="form-control form-control-default">
                                        <option value="" disabled>Select supervisor:</option>
                                        <option v-for="users in user" :key="users.id" :value="users.id">
                                            {{users.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <div class="justify-content-end">
                                        <button v-on:click="submitHandle" v-on:keyup.enter="submitHandle" type="submit"
                                            class="btn btn-secondary-boxity btn-default btn-squared px-30"
                                            data-dismiss="modal">Submit</button>
                                    </div>
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
    import Editor from '@tinymce/tinymce-vue';

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'Warehouse';
        },
        data() {
            return {
                warehouse: {
                    pic: '',
                },
                // datatable
                search: '',
                expanded: [],
                key: 1,
                warehouseData: [],
                headers: [{
                    text: 'Name',
                    value: 'warehouse_name'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // end datatable
                user: {},
            }
        },
        created() {
            // this.$Progress.start();
            this.$isLoading(true);
            this.loadWarehouse();
            this.loadUser();
            // this.$Progress.finish();
            this.$isLoading(false);
        },
        methods: {
            async loadWarehouse() {
                const resp = await axios.get('/api/warehouse');
                this.warehouseData = resp.data;
                console.log(this.warehouseData)
            },
            async loadUser() {
                const resp = await axios.get('/api/contact-list');
                this.user = resp.data;
            },
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/warehouse', this.warehouse).then(response => {
                    this.loadWarehouse();
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New warehouse',
                    });
                    this.warehouse = {
                        warehouse_code: '',
                        warehouse_name: '',
                        address: '',
                        remarks: '',
                        pic: '',
                    };
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
            async deleteWarehouse(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete data warehouse?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('/api/warehouse/' + id);
                    this.loadWarehouse();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current warehouse.'
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }
            },
        },
    }

</script>
