<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Receiving Confirmation<br></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <router-link to="/receiving-confirmation/add" class="btn btn-sm btn-primary btn-add">
                                <i class="las la-plus fs-16"></i>&nbsp;New Receiving Confirmation</router-link>
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
                                    :headers="headers" multi-sort :items="receivingConfirmationData"
                                    :items-per-page="10" class="elevation-1" group-by="customers.customerName"
                                    group-expanded :expanded.sync="expanded" show-expand>
                                    <template v-slot:item.actions="{item}">
                                        <a :href="`/report/receiving-confirmation/${item.id}`" target="_blank"
                                            class="view">
                                            <i class="fas fa-print"></i></a>
                                        <router-link :to="`/detail/receiving-confirmation/${item.receiving_number}`"
                                            class="edit">
                                            <i class="fas fa-eye"></i></router-link>
                                        <a v-on:click="deleteReceivingConfirmationData(item.id)" class="remove">
                                            <i class="fas fa-trash"></i></a>
                                    </template>
                                    <template v-slot:expanded-item="{ headers, item }">
                                        <td :colspan="headers.length">
                                            Remarks: {{ item.remarks }}
                                        </td>
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
            return 'Receiving Confirmation';
        },
        data() {
            return {
                // datatable
                expanded: [],
                singleExpand: false,
                search: '',
                key: 1,
                receivingConfirmationData: [],
                headers: [{
                        text: 'RC #',
                        value: 'receiving_number'
                    }, {
                        text: 'Deliver to',
                        value: 'warehouse.warehouse_name'
                    }, {
                        text: 'Receiving Date',
                        value: 'receiving_date'
                    },
                    {
                        text: 'Customer',
                        value: 'customers.customerName'
                    }, {
                        text: 'Actions',
                        value: 'actions',
                        align: 'right',
                        filterable: false,
                        sortable: false
                    }
                ],
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
                const resp = await axios.get('/api/receiving-confirmation');
                this.receivingConfirmationData = resp.data;
                const count = await axios.get('/api/count-receiving-confirmation');
                this.countItems = count.data;
                this.$Progress.finish();
            },
            async deleteReceivingConfirmationData(id) {
                const result = await Swal.fire({
                    title: 'Delete data item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/receivings-confirmation/' + id);
                    this.loadItem();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current item.'
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
