<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Event management</h2>
                    <div class="action-btn">
                        <router-link to="/events/create" class="btn btn-sm btn-primary-boxity btn-add">
                            <i class="las la-plus fs-16"></i>Create Event</router-link>
                    </div>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :loading="loading" loading-text="Loading... Please wait" :headers="headers"
                            :items="events" :items-per-page="10" class="elevation-1">
                            <template v-slot:[`item.status`]="{item}">
                                <span class="rounded-pill userDatatable-content-status color-success
                                            bg-opacity-success active" v-if="item.status == 1"><i
                                        class="fas fa-rss"></i>&nbsp; Published</span>
                                <span class="rounded-pill userDatatable-content-status color-primary
                                            bg-opacity-primary active" v-if="item.status == 0"><i
                                        class="fas fa-file-lines"></i>&nbsp; Draft</span>
                            </template>
                            <template v-slot:item.event_name="{ item }">
                                <div class="userDatatable-inline-title my-3">
                                    <router-link :to="`/edit/events/`+item.id" class="text-dark fw-500">
                                        <h6 v-if="item.event_name.length < 45">{{item.event_name}}
                                        </h6>
                                        <h6 v-if="item.event_name.length >= 45">
                                            {{item.event_name.substring(0,44)+"..."}}
                                        </h6>
                                    </router-link>
                                </div>
                            </template>
                            <template v-slot:item.actions="{item}">
                                <router-link :to="`/edit/events/${item.id}`" class="edit">
                                    <i class="fad fa-eye"></i></router-link>
                                <a @click="deleteEvents(item.id)" class="remove">
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
            return 'Events';
        },
        data() {
            return {
                // datatable
                events: [],
                search: '',
                key: 1,
                loading: true,
                headers: [{
                    text: 'Event name',
                    value: 'event_name'
                }, {
                    text: 'Start Date',
                    value: 'start_date'
                }, {
                    text: 'End Date',
                    value: 'end_date'
                }, {
                    text: 'Organized By',
                    value: 'organized_by'
                }, {
                    text: 'Type',
                    value: 'type'
                }, {
                    text: 'Status',
                    value: 'status'
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
            this.loadEvents();
        },
        methods: {
            async loadEvents() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/events');
                this.events = resp.data;
                if (resp.data.length) {
                    this.loading = false;
                }
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteEvents(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete this event?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('api/events/' + id);
                    this.loadEvents();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success delete event.'
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }
            },
            async handleSubmit() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/events', this.events).then(response => {
                    this.loadEvents();
                    document.getElementById('ding').play();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success create new event',
                    });
                    this.event = {
                        event_name: '',
                        start_date: '',
                        end_date: '',
                        event_content: '',
                        organized_by: '',
                        type: '',
                    }
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }).catch(error => {
                    this.$Progress.fail();
                    document.getElementById('failding').play();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Something wrong.',
                        confirmButtonText: `Ok`,
                        html: `There is something wrong on my side. Please click ok to refresh this page and see what is it. If
                it still exist, you can contact our developer. <br><br>Error message: ` +
                            error,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                });
            },
        },
    }

</script>
