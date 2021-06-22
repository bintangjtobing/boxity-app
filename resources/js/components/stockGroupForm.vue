<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">Stock Group - <abbr
                                    :title="stockgroup.name">{{stockgroup.name}}</abbr>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="user-info-tab w-100 bg-white global-shadow radius-xl mb-50">
                    <div class="ap-tab-wrapper border-bottom ">
                        <ul class="nav px-30 ap-tab-main text-capitalize" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                    role="tab" aria-controls="v-pills-home" aria-selected="true">details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-others-tab" data-toggle="pill" href="#v-pills-others"
                                    role="tab" aria-controls="v-pills-others" aria-selected="true">Others</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <form @submit.prevent="handleSubmit">
                                                    <div class="form-row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <input type="text" v-model="stockgroup.stockgroup_id"
                                                                    placeholder="Stock Group Code" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="form-group">
                                                                <input type="text" v-model="stockgroup.name"
                                                                    placeholder="Stock Group Name" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <editor placeholder="Remarks..." v-model="stockgroup.remarks"
                                                            api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om"
                                                            :init="{
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
                                                            <button v-on:click="handleSubmit" v-on:keyup.enter="handleSubmit" type="submit"
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
                        <div class="tab-pane fade  show" id="v-pills-others" role="tabpanel"
                            aria-labelledby="v-pills-others-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <form @submit.prevent="handleSubmit">
                                                    <!-- Insert Code here -->
                                                    <div class="form-group my-2">
                                                        <div class="justify-content-end">
                                                            <button v-on:click="handleSubmit" v-on:keyup.enter="handleSubmit" type="submit"
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
            return `Stock Group data`;
        },
        data() {
            return {
                stockgroup: {},
            }
        },
        created() {
            this.loadDataWarehouse();
        },
        methods: {
            async loadDataWarehouse() {
                this.$Progress.start();
                const response = await axios.get('/api/stock-group/' + this.$route.params.id);
                this.stockgroup = response.data;
                this.$Progress.finish();
            },
            async handleSubmit() {
                this.$Progress.start();
                await axios.patch('/api/stock-group/' + this.$route.params.id, this.stockgroup);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update stock group data',
                });
                this.$Progress.finish();
                this.$router.push('/stock-group');
            },
        },
    }

</script>
