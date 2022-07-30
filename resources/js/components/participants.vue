<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Event Participants management</h2>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :loading="loading" loading-text="Loading... Please wait" :headers="headers"
                            :items="participants" :items-per-page="10" class="elevation-1" group-by="event.event_name">
                            <template v-slot:item.event_id="{ item }">
                                {{item.event.event_name}}
                            </template>
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/detail/participant/${item.id}`" class="view">
                                    <i class="fad fa-eye"></i></router-link>
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
            return 'Participant List';
        },
        data() {
            return {
                // datatable
                participants: [],
                search: '',
                key: 1,
                loading: true,
                headers: [{
                    text: 'Event Name',
                    value: 'event_id'
                }, {
                    text: 'Name',
                    value: 'name'
                }, {
                    text: 'Email',
                    value: 'email'
                }, {
                    text: 'Sector',
                    value: 'sector'
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
            this.loadParticipants();
        },
        methods: {
            async loadParticipants() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/participant');
                this.participants = resp.data;
                if (resp.data.length) {
                    this.loading = false;
                }
                // this.$Progress.finish();
                this.$isLoading(false);
            },
        },
    }

</script>
