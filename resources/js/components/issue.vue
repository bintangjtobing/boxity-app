<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Issue Center</h4>
                </div>
            </div>
        </div>
        <div class="banner-feature--14 card mb-25">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="card-body d-inline-block">
                                <h1 class="d-flex">Hello, We are here to help</h1>
                                <p>Anything we can help? Take it easy, we will help you as much as possible.
                                </p>
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-primary btn-default btn-squared btn-shadow-primary"
                                        type="button">Create
                                        Issue Ticket
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="banner-feature__shape mt-50 d-flex justify-content-end">
                                <img :src="'/dashboard/img/svg/banne-group21.svg'" alt="issue center" class="svg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Issue lists</h4>
                </div>
                <div class="userDatatable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <span class="userDatatable-title"><i class="fas fa-code-branch"></i>
                                            issue</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">priority</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">status</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <h6>Bantu buka HRM</h6>
                                                    <p>Created 2 days ago by Tanty | 2021-02-17</p>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            <span style="color: #d4000b;"><i class="fas fa-arrow-up"></i></span> Highest
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content d-inline-block">
                                            <span
                                                class="bg-opacity-danger  color-danger rounded-pill userDatatable-content-status active">Unapproved</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <h6>Bantu buka otoritas</h6>
                                                    <p>Created 1 days ago by David | 2021-02-18</p>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            <span style="color: #ef7d32;"><i class="fas fa-arrow-up"></i></span> Medium
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content d-inline-block">
                                            <span
                                                class="bg-opacity-success  color-success rounded-pill userDatatable-content-status active">Approved</span>
                                        </div>
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
    export default {
        title() {
            return 'Issue report';
        },
    }

</script>
