<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Changelog</h2>
                </div>
            </div>
            <div class="col-8 changelog-24 d-block">
                <div class="changelog mb-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="changelog__title">
                                <span class="v-num">Version {{version.version}} </span>
                                <span class="sign">-</span>
                                <span class="rl-date">{{version.created_at}}</span>
                            </div>
                        </div>
                        <div class="card-body p-30">
                            <span v-html="version.description"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 changelog-5 d-block">
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
                                <li v-for="versions in vControl" :key="versions.id">
                                    <span class="version-name" @click="seeVersion(versions.version)">Version
                                        {{versions.version}}</span><span
                                        class="version-date">{{versions.created_at}}</span>
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
    export default {
        title() {
            return 'Version view';
        },
        data() {
            return {
                version: {},
                vControl: {},
            }
        },
        created() {
            this.loadDataVersion();
        },
        methods: {
            async loadDataVersion() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/version-control/' + this.$route.params.version);
                this.version = resp.data[0];

                // Load version
                const respVersion = await axios.get('/api/version-control');
                this.vControl = respVersion.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async seeVersion(version) {
                const getVer = await axios.get('/api/version-control/' + version);
                this.version = getVer.data[0];
            }
        },
    }

</script>
