<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Update Stock Group</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-vertical card-default card-md mb-4">
                    <div class="card-body pb-md-30">
                        <div class="vertical-form">
                            <form @submit.prevent="handleSubmit">
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
                                        <option v-for="users in user" :key="users.id" v-bind:value="users.id">
                                            {{users.name}}</option>
                                    </select>
                                </div>
                                <div class="button-group d-flex pt-25">
                                    <button type="submit"
                                        class="btn btn-primary btn-default btn-squared text-capitalize">Update
                                    </button>
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
            return 'Update stock group data';
        },
        data() {
            return {
                warehouse: {},
                user: {},
            }
        },
        created() {
            this.loadDataWarehouse();
            this.loadUser();
        },
        methods: {
            async loadDataWarehouse() {
                const response = await axios.get('/api/warehouse/' + this.$route.params.id);
                this.warehouse = response.data;
            },
            async loadUser() {
                const resp = await axios.get('/api/contact-list');
                this.user = resp.data;
            },
            async handleSubmit() {
                await axios.patch('/api/warehouse/' + this.$route.params.id, this.warehouse);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update warehouse data',
                });
                this.$router.push('/warehouse-list');
            },
        },
    }

</script>
