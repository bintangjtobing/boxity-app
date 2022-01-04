<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Stock Group <span>- {{countStocks}}
                            Stocks</span></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <a href="#" data-toggle="modal" data-target="#addStockGroup"
                                class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>Add Stock Group</a>
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
                                <v-data-table :headers="headers" multi-sort :items="stockGroupData" :items-per-page="10"
                                    class="elevation-1" :search="search">
                                    <template v-slot:item.remarks="{ item }">
                                        <span v-html="item.remarks"></span>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <router-link :to="`/detail/stock-group/${item.id}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="deleteStockGroup(item.id)" class="remove">
                                            <i class="fad fa-trash"></i></a>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addStockGroup" tabindex="-1" aria-labelledby="addStockGroup" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title fw-500" id="staticBackdropLabel">Add Stock Group</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fal fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" v-model="stockgroup.stockgroup_id"
                                                placeholder="Stock Group Code" autofocus class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input type="text" v-model="stockgroup.name" placeholder="Stock Group Name"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-2">
                                    <editor placeholder="Remarks..." v-model="stockgroup.remarks"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 150,
                                                                menubar: true,
                                                                branding: false,
                                                                plugins: 'code',
                                                                toolbar:
                                                                    'undo redo | fontselect | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
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
    import Editor from '@tinymce/tinymce-vue';

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'Stock Group';
        },
        data() {
            return {
                stockgroup: {
                    customer_id: '',
                },
                // datatable
                search: '',
                key: 1,
                stockGroupData: [],
                headers: [{
                    text: 'Stock Group Code',
                    value: 'stockgroup_id'
                }, {
                    text: 'Name',
                    value: 'name'
                }, {
                    text: 'Remarks',
                    value: 'remarks'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // end datatable
                countStocks: '0',
            }
        },
        created() {
            this.loadStockGroup();
        },
        methods: {
            async loadStockGroup() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/stock-group');
                this.stockGroupData = resp.data;

                // LoadUser
                const count = await axios.get('/api/count-stock-group');
                this.countStocks = count.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/stock-group', this.stockgroup).then(response => {
                    this.loadStockGroup();
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success New Stock Group',
                    });
                    this.stockgroup = {
                        warehouse_code: '',
                        warehouse_name: '',
                        address: '',
                        remarks: '',
                        pic: '',
                        customer_id: '',
                    };
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
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteStockGroup(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete data stock group?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/stock-group/' + id);
                    this.loadStockGroup();
                    document.getElementById('ding').play();

                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current stock group.'
                    });
                }
            },
        },
    }

</script>
