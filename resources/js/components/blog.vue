<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Blog management</h4>
                    <div class="action-btn">
                        <a href="#" class="btn px-15 btn-primary" data-toggle="modal" data-target="#new-member">
                            <i class="las la-plus fs-16"></i>Add new blog</a>

                        <!-- Modal -->
                        <div class="modal fade new-member" id="new-member" role="dialog" tabindex="-1"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content modal-lg radius-xl">
                                    <div class="modal-header">
                                        <h6 class="modal-title fw-500" id="staticBackdropLabel">Add new blog</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="new-member-modal">
                                            <form>
                                                <div class="form-group mb-20">
                                                    <input type="text" name="title" class="form-control"
                                                        placeholder="Blog title">
                                                </div>
                                                <div class="form-group mb-20">
                                                    <textarea name="description" class="form-control" id="" cols="30"
                                                        rows="10" placeholder="Blog descriptions..."></textarea>
                                                </div>
                                                <div class="form-group mb-20">
                                                    <select name="categories" class="form-control custom-select px-15"
                                                        id="exampleFormControlSelect1">
                                                        <option>Select category:</option>
                                                        <option value="Ekspor">Ekspor</option>
                                                        <option value="Impor">Impor</option>
                                                        <option value="Umum">Umum</option>
                                                    </select>
                                                </div>
                                                <div class="button-group d-flex pt-25">
                                                    <button
                                                        class="btn btn-primary btn-default btn-squared text-capitalize">submit
                                                    </button>
                                                    <button class="btn btn-light btn-default btn-squared fw-400
                                                        text-capitalize b-light color-light" data-dismiss="modal"
                                                        aria-label="Close">cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->


                    </div>
                </div>
                <div class="userDatatable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <span class="userDatatable-title">
                                            Title</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Categories</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Views</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <h6>Per 1 Feb 2021 pemerintah masih bebaskan pajak PPH 22 Import
                                                    </h6>
                                                    <p>Created by Bintang | 2021-02-17</p>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            Export
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content d-inline-block">
                                            73 views
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                            <li>
                                                <a href="#" class="view">
                                                    <i class="fas fa-eye"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" class="edit">
                                                    <i class="fas fa-pen"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" class="remove">
                                                    <i class="fas fa-trash"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <h6>Materai 3000 dan 6000 masih berlaku selama 2021
                                                    </h6>
                                                    <p>Created by Bintang | 2021-02-16</p>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            Berita
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content d-inline-block">
                                            53 views
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                            <li>
                                                <a href="#" class="view">
                                                    <i class="fas fa-eye"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" class="edit">
                                                    <i class="fas fa-pen"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" class="remove">
                                                    <i class="fas fa-trash"></i></a>
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
    export default {
        title() {
            return 'Blog';
        },
    }

</script>
