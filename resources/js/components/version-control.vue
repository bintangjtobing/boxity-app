<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">

                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Version control</h4>
                </div>

            </div>
            <div class="col-12 changelog-19 d-block">
                <div class="changelog mb-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="changelog__title">
                                <span class="v-num">Version </span>
                                <span class="sign">-</span>
                                <span class="rl-date">{{version.title}}</span>
                            </div>
                            <div class="changelog__titleExtra"></div>
                        </div>
                        <div class="card-body p-30">
                            <form @submit.prevent="handleSubmit">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-Vertical card-default card-md mb-4">
                                            <div class="card-body pb-md-30">
                                                <div class="Vertical-form">
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-lg-12">
                                                                <input type="text"
                                                                    class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                                    v-model="version.title" id="formGroupExampleInput"
                                                                    placeholder="Version Control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <editor placeholder="Version control description here..."
                                                            v-model="version.description"
                                                            api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om"
                                                            :init="{
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
                                                                    class="btn btn-success btn-default btn-squared px-30">submit
                                                                    new changelog</button>
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
                    </div>
                </div>
            </div>
            <div class="col-12 changelog-5 d-block">
                <div class="changeLog-history mb-30">
                    <div class="card">
                        <div class="card-header py-20 px-20">
                            <div class="changelog-history__title text-uppercase">
                                CHANGELOG
                            </div>
                            <div class="changelog-history__titleExtra">

                            </div>
                        </div>
                        <div class="card-body p-25">
                            <h4 class="history-title">VERSION HISTORY</h4>
                            <ul class="v-history-list">
                                <li v-for="version in vControl" :key="version.id">
                                    <router-link :to="`/v/${version.version}`"><span class="version-name">Version
                                            {{version.version}}</span><span
                                            class="version-date">{{version.created_at}}</span></router-link>
                                </li>
                            </ul>
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
            return 'Version control';
        },
        data() {
            return {
                version: {
                    title: '',
                    description: '',
                },
                vControl: {},
            }
        },
        created() {
            this.loadVerControl();
        },
        methods: {
            async loadVerControl() {
                const resp = await axios.get('/api/version-control');
                if (resp.length < 1) {
                    this.version.title = '1.0.0';
                } else {
                    this.vControl = resp.data;
                }
            },
            async handleSubmit() {
                await axios.post('/api/version-control', this.version);
                this.version = {
                    title: '',
                    description: '',
                };
                this.loadVerControl();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success add new change log.',
                });
            }
        },
    }

</script>
