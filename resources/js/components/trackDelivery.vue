<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Track delivery system management</h4>
                    <div class="action-btn">
                        <a href="#" class="btn px-15 btn-primary" data-toggle="modal" data-target="#new-member">
                            <i class="las la-plus fs-16"></i>Add new track</a>

                        <!-- Modal -->
                        <div class="modal fade new-member" id="new-member" role="dialog" tabindex="-1"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content modal-lg radius-xl">
                                    <div class="modal-header">
                                        <h6 class="modal-title fw-500" id="staticBackdropLabel">Add new order track</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="new-member-modal">
                                            <form>
                                                <div class="form-group mb-20">
                                                    <input type="text" name="order_id" placeholder="Order track ID"
                                                        class="form-control" value="" readonly>
                                                </div>
                                                <div class="form-group mb-20">
                                                    <div class="form-row">
                                                        <div class="col-lg-6">
                                                            <input type="text" name="sender"
                                                                placeholder="Sender name..." class="form-control"
                                                                required>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="text" name="sender_address"
                                                                placeholder="Sender address..." class="form-control"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-20">
                                                    <div class="form-row">
                                                        <div class="col-lg-6">
                                                            <input type="text" name="receiver"
                                                                placeholder="Receiver name..." class="form-control"
                                                                required>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="text" name="receiver_address"
                                                                placeholder="Receiver address..." class="form-control"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-20">
                                                    <div class="form-row">
                                                        <div class="col-lg-6">
                                                            <select name="sender_city" id="sender_city" class="
                                form-control custom-select" required>
                                                                <option>Choose sender city...</option>
                                                                <option value="Medan">Medan</option>
                                                                <option value="Pekanbaru">Pekanbaru</option>
                                                                <option value="Palembang">Palembang</option>
                                                                <option value="Jakarta">Jakarta</option>
                                                                <option value="Semarang">Semarang</option>
                                                                <option value="Surabaya">Surabaya</option>
                                                                <option value="Bali">Bali</option>
                                                                <option value="Lombok">Lombok</option>
                                                                <option value="Makassar">Makassar</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="text" name="receiver_city"
                                                                placeholder="Receiver city..." class="form-control"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-20">
                                                    <div class="form-row">
                                                        <div class="col-lg-6">
                                                            <select name="payload" id=""
                                                                class="form-control custom-select" required>
                                                                <option>Payload</option>
                                                                <option value="Weight (Kg)">Weight (Kg)</option>
                                                                <option value="Volume (M)">Volume (M)</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="text" name="payload_value" class="form-control"
                                                                placeholder="Payload value ex: 25" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="description" id="" cols="30" rows="10"
                                                        class="form-control" required
                                                        placeholder="Order description"></textarea>
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
                                            track id</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">track created</span>
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
                                                    <h6>BTSA202027811026
                                                    </h6>
                                                    <p>Created by Bintang <span
                                                            class="bg-opacity-success  color-success rounded-pill userDatatable-content-status active">Order
                                                            created</span>
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            2020-10-26
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
                                                    <h6>BTSA202041651025
                                                    </h6>
                                                    <p>Created by Bintang <span
                                                            class="bg-opacity-warning  color-warning rounded-pill userDatatable-content-status active">Manifested</span>
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            2020-10-25
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
            return 'Track delivery';
        },
    }

</script>
