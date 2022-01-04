<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main mb-2">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Quote report</h2>
                    <div class="action-btn">
                        <router-link :to="`/quote/new`" class="btn px-15 btn-primary">
                            <i class="las la-plus fs-16"></i>New quote</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <span class="userDatatable-title">Created by</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Quote</span>
                                    </th>
                                    <th style='text-align:center;'>
                                        <span class="userDatatable-title">status</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title float-right">action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!quotes.length">
                                    <td colspan="4">
                                        <div class="atbd-empty text-center">
                                            <div class="atbd-empty__image">
                                                <img src="/dashboard/img/folders/1.svg" alt="Admin Empty">
                                            </div>
                                            <div class="atbd-empty__text">
                                                <p class="">No Data</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-for="quote in quotes" :key="quote.id">
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <h6>{{quote.created_by.name}}</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content" v-if="quote.quoteid.length < 125">
                                            {{quote.quoteid}}
                                        </div>
                                        <div class="userDatatable-content" v-if="quote.quoteid.length >= 125">
                                            {{quote.quoteid.substring(0,20)+"..."}}
                                        </div>
                                    </td>
                                    <td style='text-align:center;'>
                                        <div class="userDatatable-content d-inline-block">
                                            <div v-if="quote.status==0">
                                                <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active"><i class="fal fa-exclamation"></i>
                                                    &nbsp;Pending</span>
                                            </div>
                                            <div v-if="quote.status==1">
                                                <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active"><i class="fal fa-exclamation"></i>
                                                    &nbsp;Done</span>
                                            </div>
                                            <div v-if="quote.status==2">
                                                <span class="rounded-pill userDatatable-content-status color-danger
                                                bg-opacity-danger active"><i class="fal fa-lock"></i>
                                                    &nbsp;Terminated</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td v-if="quote.status!='1'">
                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                            <li>
                                                <router-link :to="`/edit/quote/${quote.id}`" class="edit">
                                                    <i class="fad fa-edit"></i></router-link>
                                            </li>
                                            <li>
                                                <a v-on:click="deletequote(quote.id)" class="remove">
                                                    <i class="fad fa-trash"></i></a>
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

    export default {
        title() {
            return 'Quote report';
        },
        data() {
            return {
                quotes: {},
            }
        },
        mounted() {
            this.loadQuotes();
        },
        methods: {
            async loadQuotes() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/quote/get');
                this.quotes = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deletequote(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete quote?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete('api/quote/' + id);
                    this.loadQuotes();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current quote'
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }
            },
        },
    }

</script>
