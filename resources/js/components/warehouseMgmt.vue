<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Warehouse List</h4>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <a href="#" data-toggle="modal" data-target="#addWarehouse"
                                class="btn btn-sm btn-primary btn-add">
                                <i class="las la-plus fs-16"></i>Add Warehouse</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table :headers="headers" :items="warehouseData" :items-per-page="10"
                                    class="elevation-1" :search="search">
                                    <template v-slot:item.address="{ item }">
                                        <span v-html="item.address"></span>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <router-link :to="`/detail/warehouse/${item.id}`" class="edit">
                                            <i class="fas fa-pen"></i></router-link>
                                        <a v-on:click="deleteWarehouse(item.id)" class="remove">
                                            <i class="fas fa-trash"></i></a>
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
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-10">
                                            <input type="text" v-model="warehouse.warehouse_code"
                                                placeholder="Warehouse Code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group mb-10">
                                            <input type="text" v-model="warehouse.warehouse_name"
                                                placeholder="Warehouse Name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-1">
                                    <editor placeholder="Warehouse address here..." v-model="warehouse.address"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 300,
                                                                menubar: false,
                                                                branding: false,
                                                                toolbar:
                                                                    'undo redo | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
                                </div>
                                <div class="form-group my-2">
                                    <editor placeholder="Remarks..." v-model="warehouse.remarks"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 150,
                                                                menubar: false,
                                                                branding: false,
                                                                toolbar:
                                                                    'undo redo | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
                                </div>
                                <div class="form-group my-2">
                                    <select v-model="warehouse.pic" id="" class="form-control form-control-default">
                                        <option value="" disabled>Select supervisor:</option>
                                        <option v-for="users in user" :key="users.id" :value="users.id">
                                            {{users.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <div class="justify-content-end">
                                        <button v-on:click="submitHandle" type="submit"
                                            class="btn btn-success btn-default btn-squared px-30"
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
                key: 1,
                warehouseData: [],
                headers: [{
                        text: 'Warehouse Code',
                        value: 'warehouse_code'
                    }, {
                        text: 'Name',
                        value: 'warehouse_name'
                    }, {
                        text: 'Address',
                        filterable: false,
                        value: 'address'
                    },
                    {
                        text: 'Person in Charge (PIC)',
                        value: 'user.name'
                    }, {
                        text: 'Actions',
                        value: 'actions',
                        filterable: false,
                        sortable: false
                    }
                ],
                // end datatable
                user: {},
            }
        },
        created() {
            this.loadWarehouse();
            this.loadUser();
        },
        methods: {
            async loadWarehouse() {
                const resp = await axios.get('/api/warehouse');
                this.warehouseData = resp.data;
            },
            async loadUser() {
                const resp = await axios.get('/api/contact-list');
                this.user = resp.data;
            },
            async submitHandle() {
                await axios.post('/api/warehouse', this.warehouse).then(response => {
                    this.loadWarehouse();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add new warehouse',
                    });
                    this.warehouse = {
                        warehouse_code: '',
                        warehouse_name: '',
                        address: '',
                        remarks: '',
                        pic: '',
                    };
                }).catch(error => {
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
                const result = await Swal.fire({
                    title: 'Delete data warehouse?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/warehouse/' + id);
                    this.loadWarehouse();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current warehouse.'
                    });
                }
            },
        },
    }

</script>
