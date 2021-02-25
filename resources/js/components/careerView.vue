<template>
    <div>

    </div>
</template>
<script>
    export default {
        title() {
            return this.titles;
        },
        data() {
            return {
                titles: '',
                careers: {},
            }
        },
        created() {
            this.loadJob();
        },
        methods: {
            async loadJob() {
                const resp = await axios.get('/api/career/' + this.$route.params.id);
                this.careers = resp.data;
                this.titles = resp.data.title;
            },
        },
    }

</script>
