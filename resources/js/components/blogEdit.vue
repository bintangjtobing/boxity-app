<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">blog edit</h2>
                </div>
            </div>
        </div>
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <input type="text"
                                                class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                v-model="blog.title" id="formGroupExampleInput"
                                                placeholder="blog vacancy title" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <select v-model="blog.category"
                                                class="form-control form-control-default ih-medium ip-gray radius-xs b-light fa-select">
                                                <option value="" disabled>category</option>
                                                <option v-bind:value="`Ekspor`">Ekspor</option>
                                                <option v-bind:value="`Impor`">Impor</option>
                                                <option v-bind:value="`News`">News
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <editor v-model="blog.description"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om"
                                        @keydown.enter="handleSubmit" :init="{
                                                                height: 300,
                                                                menubar: false,
                                                                branding: false,
                                                                toolbar:
                                                                    'undo redo | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
                                </div>
                                <div class="form-group">
                                    <div class="form-row justify-content-end">
                                        <div class="layout-button mt-25">
                                            <button type="submit"
                                                class="btn btn-success btn-default btn-squared px-30">submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
            return 'Edit blog';
        },
        data() {
            return {
                blog: {},
            }
        },
        created() {
            this.loadDataBlog();
        },
        methods: {
            async loadDataBlog() {
                this.$Progress.start();
                const resp = await axios.get('/api/blogs/' + this.$route.params.id);
                this.blog = resp.data;
                this.$Progress.finish();
            },
            async handleSubmit() {
                this.$Progress.start();
                await axios.patch('/api/blogs/' + this.$route.params.id, this.blog);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update blog.',
                });
                this.$Progress.finish();
                this.$router.push('/blog-management');
            }
        },
    }

</script>
