<template>
    <div>
        <div class="row mt-4">
            <div class="col-6">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Categories management</h2>
                    <div class="action-btn">
                        <router-link to="/categories-management/create" class="btn btn-sm btn-primary-boxity btn-add">
                            <i class="las la-plus fs-16"></i> Create categories</router-link>
                    </div>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :loading="loading" loading-text="Loading... Please wait" :headers="headers"
                            :items="categories" :items-per-page="10" class="elevation-1">
                            <template v-slot:item.title="{ item }">
                                <div class="userDatatable-inline-title my-3">
                                    <router-link :to="`/edit/categories/`+item.id" class="text-dark fw-500">
                                        <h6 v-if="item.title.length < 45">{{item.title}}
                                        </h6>
                                        <h6 v-if="item.title.length >= 45">
                                            {{item.title.substring(0,44)+"..."}}
                                        </h6>
                                    </router-link>
                                </div>
                            </template>
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/edit/categories/${item.id}`" class="edit">
                                    <i class="fad fa-eye"></i></router-link>
                                <a @click="deleteCategories(item.id)" class="remove">
                                    <i class="fad fa-trash"></i></a>
                            </template>
                        </v-data-table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Sub Categories management</h2>
                    <div class="action-btn">
                        <router-link to="/sub-categories-management/create"
                            class="btn btn-sm btn-primary-boxity btn-add">
                            <i class="las la-plus fs-16"></i> Create sub categories</router-link>
                    </div>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="searchSub" append-icon="mdi-magnify" label="Search here..."
                                single-line hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :loading="loadingSub" loading-text="Loading... Please wait" :headers="headersSub"
                            :items="subcategories" :items-per-page="10" class="elevation-1">
                            <template v-slot:item.title="{ item }">
                                <div class="userDatatable-inline-title my-3">
                                    <router-link :to="`/edit/sub-categories/`+item.id" class="text-dark fw-500">
                                        <h6 v-if="item.title.length < 45">{{item.title}}
                                        </h6>
                                        <h6 v-if="item.title.length >= 45">
                                            {{item.title.substring(0,44)+"..."}}
                                        </h6>
                                    </router-link>
                                </div>
                            </template>
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/edit/sub-categories/${item.id}`" class="edit">
                                    <i class="fad fa-eye"></i></router-link>
                                <a @click="deleteSubCategories(item.id)" class="remove">
                                    <i class="fad fa-trash"></i></a>
                            </template>
                        </v-data-table>
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
            return 'Categories | Sub Categories';
        },
        data() {
            return {
                // datatable
                categories: [],
                subcategories: [],
                search: '',
                searchSub: '',
                key: 1,
                loading: true,
                loadingSub: true,
                headers: [{
                    text: 'Category name',
                    value: 'categories_name'
                }, {
                    text: 'Slug',
                    value: 'slug'
                }, {
                    text: 'Descriptions',
                    value: 'description'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                headersSub: [{
                    text: 'Sub Category name',
                    value: 'sub_categories_name'
                }, {
                    text: 'Slug',
                    value: 'slug'
                }, {
                    text: 'Descriptions',
                    value: 'description'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                // end datatable
            }
        },
        created() {
            this.loadCategories();
        },
        methods: {
            async loadCategories() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/categories');
                this.categories = resp.data;
                if (resp.data.length) {
                    this.loading = false;
                }
                const respSub = await axios.get('/api/sub-categories');
                this.subcategories = respSub.data;
                if (respSub.data.length) {
                    this.loadingSub = false;
                }
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteCategories(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete categories?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('api/categories/' + id);
                    this.loadCategories();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted categories'
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }
            },
            async deleteSubCategories(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete sub categories?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('api/sub-categories/' + id);
                    this.loadCategories();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted sub categories'
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }
            },
        },
    }

</script>
