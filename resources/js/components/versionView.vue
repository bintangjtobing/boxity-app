<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Changelog</h4>
                </div>
            </div>
            <div class="col-12 changelog-24 d-block">
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
            }
        },
        created() {
            this.loadDataVersion();
        },
        methods: {
            async loadDataVersion() {
                const resp = await axios.get('/api/version-control/' + this.$route.params.version);
                this.version = resp.data[0];
            }
        },
    }

</script>
