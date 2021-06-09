<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Goods Transfer<br>
                        <span>Jumlah <router-link :to="'/item-group'"><abbr title="Stock Group Link">item group</abbr>
                            </router-link> anda
                            adalah {{countItems}}, <abbr title="Inventory Item">Inventory Item</abbr> akan berfungsi
                            jika
                            anda memiliki item group minimal sebanyak 1. </span></h4>
                    <div class="breadcrumb-action justify-content-center flex-wrap" v-if="countItems">
                        <div class="action-btn">
                            <a href="#" data-toggle="modal" data-target="#addItemGroup"
                                class="btn btn-sm btn-primary btn-add">
                                <i class="las la-plus fs-16"></i>Add Goods Transfer</a>
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
                                <v-data-table :headers="headers" :items="itemGroupData" :items-per-page="10"
                                    class="elevation-1" :search="search">
                                    <template v-slot:item.remarks="{ item }">
                                        <span v-html="item.remarks"></span>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <router-link :to="`/detail/item-group/${item.id}`" class="edit">
                                            <i class="fas fa-pen"></i></router-link>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addItemGroup" tabindex="-1" aria-labelledby="addItemGroup" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title fw-500" id="staticBackdropLabel">Add Goods Transfer</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" v-model="itemgroup.itemgroup_id"
                                                placeholder="Item Group Code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input type="text" v-model="itemgroup.name" placeholder="Item Group Name"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select v-model="itemgroup.stock_id" id="" class="form-control form-control-default">
                                        <option value="" disabled>Select stock group:</option>
                                        <option v-for="stock in stock" :key="stock.id" :value="stock.id">
                                            {{stock.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <editor placeholder="Remarks..." v-model="itemgroup.remarks"
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
            return 'Goods Transfer';
        },
        data() {
            return {
                itemgroup: {
                    stock_id: '',
                },
                // datatable
                search: '',
                key: 1,
                itemGroupData: [],
                headers: [{
                        text: 'Item Code',
                        value: 'itemgroup_id'
                    }, {
                        text: 'Name',
                        value: 'name'
                    }, {
                        text: 'Stock Group',
                        value: 'stock.name'
                    },
                    {
                        text: 'Remarks',
                        value: 'remarks'
                    }, {
                        text: 'Actions',
                        value: 'actions',
                        filterable: false,
                        sortable: false
                    }
                ],
                // end datatable
                stock: {},
                countItems: '0',
            }
        },
        created() {
            this.loadItemGroup();
            this.loadUser();
        },
        methods: {
            async loadItemGroup() {
                const resp = await axios.get('/api/item-group');
                this.itemGroupData = resp.data;
                const count = await axios.get('/api/count-item-group');
                this.countItems = count.data;
            },
            async loadUser() {
                const resp = await axios.get('/api/stock-group');
                this.stock = resp.data;
            },
            async submitHandle() {
                await axios.post('/api/item-group', this.itemgroup).then(response => {
                    this.loadItemGroup();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add new Goods Transfer',
                    });
                    this.itemgroup = {
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
        },
    }

</script>
