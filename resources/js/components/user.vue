<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">

                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">users list</h4>
                            <span class="sub-title ml-sm-25 pl-sm-25">2 Users</span>
                        </div>
                    </div>
                    <div class="action-btn">
                        <a href="#" class="btn px-15 btn-primary" data-toggle="modal" data-target="#new-member">
                            <i class="las la-plus fs-16"></i>Add new user</a>

                        <!-- Modal -->
                        <div class="modal fade new-member" id="new-member" role="dialog" tabindex="-1"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content  radius-xl">
                                    <div class="modal-header">
                                        <h6 class="modal-title fw-500" id="staticBackdropLabel">Add new user</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="new-member-modal">
                                            <form>
                                                <div class="form-group mb-20">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Fullname">
                                                </div>
                                                <div class="form-group mb-20">
                                                    <input type="email" name="email" class="form-control"
                                                        placeholder="Email">
                                                </div>
                                                <div class="form-group mb-20">
                                                    <div class="form-row">
                                                        <div class="col-lg-6">
                                                            <input type="password" name="password" class="form-control"
                                                                id="password" placeholder="Password">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="password" name="verifyPassword"
                                                                id="verifyPassword" class="form-control"
                                                                placeholder="Verify password">
                                                            <span id="resultPassword" style="font-size: 12px;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-20">
                                                    <div class="form-row">
                                                        <div class="col-lg-4">
                                                            <select name="role" id="select-tag"
                                                                class="form-control custom-select">
                                                                <option>Select role:</option>
                                                                <option value="user">User</option>
                                                                <option value="head">Head</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <select name="role" id="select-tag"
                                                                class="form-control custom-select">
                                                                <option>Select department:</option>
                                                                <option value="ekspor">Ekspor</option>
                                                                <option value="impor">Impor</option>
                                                                <option value="trucking">Trucking</option>
                                                                <option value="antar-pulau">Antar-Pulau</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <select name="role" id="select-tag"
                                                                class="form-control custom-select">
                                                                <option>Select division:</option>
                                                                <option value="supervisor">Supervisor</option>
                                                                <option value="manager">Manager</option>
                                                                <option value="finance">Finance</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-group d-flex pt-25">
                                                    <button
                                                        class="btn btn-primary btn-default btn-squared text-capitalize">Submit
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

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="userDatatable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-checkbox  check-all">
                                                <input class="checkbox" type="checkbox" id="check-3">
                                                <label for="check-3">
                                                    <span class="checkbox-text userDatatable-title">user</span>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">emaill</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">division</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">status</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title float-right">action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable__imgWrapper d-flex align-items-center">
                                                <div class="checkbox-group-wrapper">
                                                    <div class="checkbox-group d-flex">
                                                        <div
                                                            class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                            <input class="checkbox" type="checkbox" id="check-grp-12">
                                                            <label for="check-grp-12"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <h6>Kellie Marquot</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            john-keller@gmail.com
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            Web Developer
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content d-inline-block">
                                            <span
                                                class="bg-opacity-success  color-success rounded-pill userDatatable-content-status active">active</span>
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
                                            <div class="userDatatable__imgWrapper d-flex align-items-center">
                                                <div class="checkbox-group-wrapper">
                                                    <div class="checkbox-group d-flex">
                                                        <div
                                                            class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                            <input class="checkbox" type="checkbox" id="check-grp-13">
                                                            <label for="check-grp-13"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <h6>Kellie Marquot</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            john-keller@gmail.com
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            Web Developer
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content d-inline-block">
                                            <span
                                                class="bg-opacity-warning  color-warning rounded-pill userDatatable-content-status active">deactivete</span>
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
            return 'Users management';
        },
    }

</script>
<script type="text/javascript">
    function checkPasswordMatch() {
        var password = $('#password').val();
        var verifyPassword = $('#verifyPassword').val();
        if (password != verifyPassword)
            $('#resultPassword').html('Password do not match!');
        else
            $('#resultPassword').html('Password match!');
    }
    $(document).ready(function () {
        $("#verifyPassword").keyup(checkPasswordMatch);
    })

</script>
