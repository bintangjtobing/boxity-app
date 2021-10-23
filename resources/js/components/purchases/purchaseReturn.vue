<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Purchase Return<br></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap" v-if="permissions.includes('CreatePurchaseReturn')">
                        <div class="action-btn">
                            <router-link to="/purchase/return/add" class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>New Purchase Return</router-link>
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
                                    :headers="headers" multi-sort :items="purchaseReturnItem" :items-per-page="10"
                                    class="elevation-1" group-by="suppliers.customerName" group-expanded>
                                    <template v-slot:[`item.actions`]="{item}">
                                        <a :href="`/report/purchase/return/${item.pr_number}`" target="_blank"
                                            class="view">
                                            <i class="fad fa-print"></i></a>
                                        <router-link :to="`/detail/purchase/return/${item.pr_number}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="deletePurchaseReturnItem(item.id)" class="remove" v-if="permissions.includes('DeletePurchaseReturn')">
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
</template>
<script>
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'Purchase Return';
        },
        data() {
            return {
                // datatable
                search: '',
                key: 1,
                purchaseReturnItem: [],
                headers: [{
                    text: 'PR #',
                    value: 'pr_number'
                }, {
                    text: 'Supplier Name',
                    value: 'suppliers.customerName'
                }, {
                    text: 'Purchase Date',
                    value: 'return_date'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // end datatable
                countItems: '0',
                permissions: []
            }
        },
        beforeMount(){
          this.permissions = this.$store.getters.getPermissions;  
        },
        created() {
            this.loadItem();
        },
        methods: {
            async loadItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/purchase/return');
                this.purchaseReturnItem = resp.data;
                const count = await axios.get('/api/count-purchase-return');
                this.countItems = count.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deletePurchaseReturnItem(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete data item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/purchases-return/' + id);
                    this.loadItem();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current Purchase Return item.'
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
