<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">role edit</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-Vertical card-default card-md mb-4">
                    <div class="card-body pb-md-30">
                        <div class="Vertical-form">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-lg-6">
                                        <span>Role name:</span>
                                        <input type="text" @input="replaceStapces"
                                            class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                            v-model="role.name" placeholder="Role name" autofocus required>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <span>Role slug:</span>
                                            <input type="text"
                                                class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                v-model="role.slug" placeholder="Role Slug" readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <tags-input class="ih-medium radius-xs b-light" placeholder="Add permissions"
                                    v-model="role.permissions" required>
                                </tags-input>
                            </div>
                            <div class="form-group">
                                <div class="form-row justify-content-end">
                                    <div class="layout-button mt-25">
                                        <button @click="handleSubmit"
                                            class="btn btn-success btn-default btn-squared px-30">submit</button>
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
    import VoerroTagsInput from '@voerro/vue-tagsinput';

    export default {
        components: {
            'editor': Editor,
            'tags-input': VoerroTagsInput,
        },
        title() {
            return 'Edit role';
        },
        data() {
            return {
                role: {
                    permissions: [],
                },
            }
        },
        created() {
            this.loadDataRole();
        },
        methods: {
            async loadDataRole() {
                this.$Progress.start();
                const resp = await axios.get('/api/roles/' + this.$route.params.id);
                this.role = resp.data;
                for (let i = 0; i <= resp.data.permissions.length; i++) {
                    this.role.permissions = [{
                        key: resp.data.permissions[i].slug,
                        value: resp.data.permissions[i].name
                    }];
                }

                this.$Progress.finish();
            },
            async handleSubmit() {
                // this.$Progress.start();
                await axios.patch('/api/roles/' + this.$route.params.id, this.role);
                // Swal.fire({
                //     icon: 'success',
                //     title: 'Congratulations',
                //     text: 'Success update role.',
                // });
                // this.$Progress.finish();
                // this.$router.push('/role-management');
            },
            replaceStapces() {
                var getValName = this.role.name;
                getValName = getValName.replace(/\s+/g, '-').toLowerCase();
                this.role.slug = getValName;
            },
        },
    }

</script>
