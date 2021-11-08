<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">
                        Sales Order<br />
                    </h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap" v-if="permissions.includes('CreateSalesOrder')">
                        <div class="action-btn">
                            <router-link to="/sales/order/add" class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>New Sales Order</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="
                userDatatable
                projectDatatable
                project-table
                bg-white
                border-0
              ">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table :search="search" :headers="headers" multi-sort :items="inventoryItem"
                                    :items-per-page="10" class="elevation-1" group-by="customers.company_name">
                                    <template v-slot:[`item.status`]="{item}">
                                        <div v-if="item.status===2">
                                            <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><em
                                                    class="fal fa-check-circle"></em>
                                                &nbsp;Paid Off</span>
                                        </div>
                                        <div v-else-if="item.status===1">
                                            <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-primary active text-capitalize"><em
                                                    class="fal fa-times-circle"></em>
                                                &nbsp;Not Yet Paid Off</span>
                                        </div>
                                        <div v-if="item.status===0">
                                            <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active text-capitalize"><em
                                                    class="fal fa-exclamation-circle"></em>
                                                &nbsp;Draft</span>
                                        </div>
                                    </template>
                                    <template v-slot:item.actions="{ item }">
                                        <a :href="`/report/sales/order/${item.so_number}`" target="_blank" class="view">
                                            <i class="fad fa-print"></i></a>
                                        <router-link :to="`/detail/sales/order/${item.id}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="deleteInventoryItem(item.id)" class="remove" v-if="permissions.includes('DeleteSalesOrder')">
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
    import Swal from "sweetalert2";
    import Editor from "@tinymce/tinymce-vue";

    export default {
        components: {
            editor: Editor,
        },
        title() {
            return "Sales Order";
        },
        data() {
            return {
                inventorydata: {
                    type: "",
                    addSalesOrder: "",
                    item_group: "",
                },
                // datatable
                search: "",
                key: 1,
                inventoryItem: [],
                headers: [{
                        text: "SO #",
                        value: "so_number",
                    },
                    {
                        text: "Order Date",
                        value: "order_date",
                    },
                    {
                        text: "Status",
                        value: "status",
                    },
                    {
                        text: "Actions",
                        value: "actions",
                        filterable: false,
                        sortable: false,
                    },
                ],
                permissions: []
            };
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
                const resp = await axios.get("/api/sales/order");
                this.inventoryItem = resp.data;

                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteInventoryItem(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: "Delete data item?",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete("/api/inventory-item/" + id);
                    this.loadItem();
                    await Swal.fire({
                        icon: "success",
                        title: "Successfully Deleted",
                        text: "Success deleted current item.",
                    });
                }
            },
        },
    };

</script>
<style lang="css">
    .form-group {
        margin-bottom: 0;
    }

</style>
