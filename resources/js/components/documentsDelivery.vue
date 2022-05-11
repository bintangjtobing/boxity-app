<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Document Delivery<br></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <router-link to="/document/delivery/add" class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>New Document Delivery</router-link>
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
                                    :headers="headers" multi-sort :items="documentDeliveryItem" :items-per-page="10"
                                    class="elevation-1">
                                    <template v-slot:[`item.status`]="{item}">
                                        <div v-if="item.status===1">
                                            <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active text-capitalize"><i
                                                    class="fas fa-exclamation-circle"></i>
                                                &nbsp;Draft</span>
                                        </div>
                                        <div v-if="item.status===2">
                                            <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><i
                                                    class="fas fa-check-circle"></i>
                                                &nbsp;Taken by expedition</span>
                                        </div>
                                        <div v-if="item.status===3">
                                            <span class="rounded-pill userDatatable-content-status color-danger
                                                bg-opacity-danger active text-capitalize"><i
                                                    class="fas fa-times-circle"></i>
                                                &nbsp;Canceled</span>
                                        </div>
                                    </template>
                                    <template v-slot:[`item.ddr_number`]="{item}">
                                        <span>#{{item.ddr_number}}</span>
                                    </template>
                                    <template v-slot:[`item.sender.name`]="{item}">
                                        <img class="rounded-circle wh-34"
                                            :src="item.sender.avatar"
                                            alt="author">&nbsp;
                                        {{item.sender.name}}
                                    </template>
                                    <template v-slot:[`item.actions`]="{item}">
                                        <a v-on:click="takenDDR(item.ddr_number)" class="create"
                                            v-if="item.status=='0' && user.role=='admin' || user.role=='head'">
                                            <i class="far fa-thumbs-up"></i> Take to Courier</a>
                                        <router-link :to="`/detail/document/delivery/${item.ddr_number}`" class="edit">
                                            <i class="fas fa-eye"></i></router-link>
                                        <a v-on:click="deletedocumentDeliveryItem(item.id)" class="remove">
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
            return 'Document Delivery';
        },
        data() {
            return {
                // datatable
                search: '',
                key: 1,
                documentDeliveryItem: [],
                headers: [{
                        text: 'DDR #',
                        value: 'ddr_number'
                    }, {
                        text: 'Requested By',
                        value: 'sender.name'
                    },
                    {
                        text: 'Status',
                        value: 'status'
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
                user: {},
            }
        },
        created() {
            this.loadItem();
            this.getUser();
        },
        methods: {
            async loadItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/document/delivery');
                this.documentDeliveryItem = resp.data;
                const count = await axios.get('/api/count-document-delivery');
                this.countItems = count.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async getUser() {
                // Load user logged in
                const res = await axios.get('/getUserLoggedIn');
                this.user = res.data;
            },
            async deletedocumentDeliveryItem(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete data item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/documents-delivery' + id);
                    this.loadItem();
                    document.getElementById('ding').play();

                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current Document Delivery item.'
                    });
                }
                // console.log(id);
            },
            async takenDDR(ddr_number) {
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: 'Are you sure want to taken this Document Delivery to courier?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, take this!',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get('/api/taken/document/delivery/' + ddr_number);
                        document.getElementById('ding').play();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success taken!',
                            text: 'You have been successfully taken this Document.',
                        });
                        this.loadItem();
                    }
                });
            }
        },
    }

</script>
<style lang="css">
    .form-group {
        margin-bottom: 0;
    }

</style>
