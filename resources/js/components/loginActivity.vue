<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Public login activity</h4>
                    <div class="action-btn">
                        <div class="atbd-button-list d-flex flex-wrap">
                            <a href="#" v-on:click="removeAll" class="btn px-15 mx-10 btn-danger">
                                <i class="las la-eject fs-16"></i> Remove all devices</a>
                            <a href="#" v-on:click="refresh" class="btn px-15 btn-primary">
                                <i class="las la-sync-alt fs-16"></i> Refresh activity</a>
                        </div>
                    </div>
                </div>
                <div class="userDatatable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <span class="userDatatable-title">
                                            Device</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">IP Address</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Last activity</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="act in activities" :key="act.id">
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <h6>{{act.user_agent}}</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            {{act.ip_address}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content d-inline-block">
                                            {{act.last_activity}}
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="mb-0 d-flex flex-wrap">
                                            <li>
                                                <a href="#" @click="removeAct(act.id)" class="remove btn btn-danger">
                                                    <i class="fas fa-trash"></i>&nbsp; Remove device</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    export default {
        title() {
            return 'Public login activity';
        },
        data() {
            return {
                activities: {},
            }
        },
        created() {
            this.loadActivities();
        },
        methods: {
            async loadActivities() {
                const resp = await axios.get('/api/login-activities');
                this.activities = resp.data;
            },
            async refresh() {
                this.loadActivities();
                await Swal.fire({
                    icon: 'success',
                    title: 'Successfully refreshed!'
                });
            },
            async removeAct(id) {
                await axios.delete('/api/login-activities/' + id);
                this.loadActivities();
                await Swal.fire({
                    icon: 'success',
                    title: 'Successfully Deleted',
                    text: 'Success deleted current activities.'
                });
            },
            async removeAll() {
                await axios.delete('/api/login-activities/removeAll');
                this.loadActivities();
                await Swal.fire({
                    icon: 'success',
                    title: 'Successfully removed!',
                    text: 'Success remove all activities'
                });
            }
        },
    }

</script>
