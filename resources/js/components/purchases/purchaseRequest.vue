<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Purchase Request<br></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <router-link to="/purchase/request/add" class="btn btn-sm btn-primary btn-add">
                                <i class="las la-plus fs-16"></i>New Purchase Request</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table :search="search" loading loading-text="Loading... Please wait..."
                                    :headers="headers" multi-sort :items="purchaseRequestItem" :items-per-page="10"
                                    class="elevation-1" group-by="suppliers.customerName" group-expanded>
                                    <template v-slot:item.priority="{item}">
                                        <div v-if="item.priority===0">
                                            <span class="priority-lowest"><i class="fas fa-arrow-up"></i>
                                                Lowest</span>
                                        </div>
                                        <div v-if="item.priority===1">
                                            <span class="priority-low"><i class="fas fa-arrow-up"></i> Low</span>
                                        </div>
                                        <div v-if="item.priority===2">
                                            <span class="priority-medium"><i class="fas fa-arrow-up"></i>
                                                Medium</span>
                                        </div>
                                        <div v-if="item.priority===3">
                                            <span class="priority-high"><i class="fas fa-arrow-up"></i>
                                                High</span>
                                        </div>
                                        <div v-if="item.priority===4">
                                            <span class="priority-highest"><i class="fas fa-arrow-up"></i>
                                                Highest</span>
                                        </div>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <a :href="`/report/purchase/request/${item.id}`" target="_blank" class="view">
                                            <i class="fas fa-print"></i></a>
                                        <router-link :to="`/detail/purchase/request/${item.pre_number}`" class="edit">
                                            <i class="fas fa-eye"></i></router-link>
                                        <a v-on:click="deletePurchaseRequestItem(item.id)" class="remove">
                                            <i class="fas fa-trash"></i></a>
                                    </template>
                                </v-data-table>
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
            return 'Purchase Request';
        },
        data() {
            return {
                // datatable
                search: '',
                key: 1,
                purchaseRequestItem: [],
                headers: [{
                    text: 'PRE #',
                    value: 'pre_number'
                }, {
                    text: 'Deliver to',
                    value: 'warehouse.warehouse_name'
                }, {
                    text: 'Requested Date',
                    value: 'pr_date'
                }, {
                    text: 'Priority',
                    value: 'priority'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // end datatable
                countItems: '0',
            }
        },
        created() {
            this.loadItem();
        },
        methods: {
            async loadItem() {
                this.$Progress.start();
                const resp = await axios.get('/api/purchase/request');
                this.purchaseRequestItem = resp.data;
                const count = await axios.get('/api/count-purchase-request');
                this.countItems = count.data;
                this.$Progress.finish();
            },
            async deletePurchaseRequestItem(id) {
                const result = await Swal.fire({
                    title: 'Delete data item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/purchases/request/' + id);
                    this.loadItem();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current Purchase Request item.'
                    });
                }
                // console.log(id);
            },
        },
    }

</script>
<style lang="css">
    .form-group {
        margin-bottom: 0;
    }

</style>
