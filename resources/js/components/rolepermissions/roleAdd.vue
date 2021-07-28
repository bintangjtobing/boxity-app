<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">add new role - {{role.name}}</h2>
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
                                <span>Permissions:</span>
                                <tags-input class="ih-medium radius-xs b-light" placeholder="Add permissions"
                                    v-model="role.permissions" required>
                                </tags-input>
                            </div>
                            <div class="form-group">
                                <div class="form-row justify-content-end">
                                    <div class="layout-button mt-25">
                                        <button v-on:click="handleSubmit"
                                            class="btn btn-success btn-default btn-squared px-30">save</button>
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
            return 'Add new role';
        },
        data() {
            return {
                role: {
                    permissions: [],
                },

                // existing data on taginput
                permissions: [],
            }
        },
        created() {
            this.loadPermissions();
        },
        methods: {
            async handleSubmit() {
                this.$Progress.start();
                await axios.post('/api/roles/', this.role);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success add new role.',
                });
                this.$Progress.finish();
                this.$router.push('/role-management');
            },
            async loadPermissions() {
                const resp = await axios.get('/api/permissions');
                console.log(resp.data);
            },
            replaceStapces() {
                var getValName = this.role.name;
                getValName = getValName.replace(/\s+/g, '-').toLowerCase();
                this.role.slug = getValName;
            },
        },
    }

</script>
