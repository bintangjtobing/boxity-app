<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize fw-500 breadcrumb-title">Employee data - <abbr
                            :title="employeeData.employee_name">{{employeeData.employee_name}}</abbr></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <span @click="routerBack" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-arrow-left"></i></span>
            <span @click="routerRefresh" class="btn btn-circle-light-boxity fa-center"><i
                    class="fad fa-sync"></i></span>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>Employee code:</span>
                                    <input v-model="employeeData.employee_code" type="text" readonly
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Employee name:</span>
                                    <input v-model="employeeData.employee_name" type="text" readonly
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>Nickname:</span>
                                    <input v-model="employeeData.employee_nickname" readonly type="text"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>Sex:</span>
                                    <input v-model="employeeData.employee_sex" readonly type="text"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <span>Age:</span>
                                    <input v-model="employeeData.employee_age" readonly type="text"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>Working duration:</span>
                                    <input v-model="employeeData.employee_working_duration" type="text"
                                        class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="user-info-tab w-100 bg-white global-shadow radius-xl mb-50">
                    <div class="ap-tab-wrapper border-bottom ">
                        <ul class="nav px-30 ap-tab-main text-capitalize" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-details-photo-tab" data-toggle="pill"
                                    href="#v-pills-details-photo" role="tab" aria-controls="v-pills-details-photo"
                                    aria-selected="true">Details and Photo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-contact-info-medical-tab" data-toggle="pill"
                                    href="#v-pills-contact-info-medical" role="tab"
                                    aria-controls="v-pills-contact-info-medical" aria-selected="true">Contact Info &
                                    Medical</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-advanced-tab" data-toggle="pill"
                                    href="#v-pills-advanced" role="tab" aria-controls="v-pills-advanced"
                                    aria-selected="true">Advanced</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active" id="v-pills-details-photo" role="tabpanel"
                            aria-labelledby="v-pills-details-photo-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <form @submit.prevent="handleSubmit" enctype="multipart/form-data"
                                                    method="POST">
                                                    <h5>Details</h5>
                                                    <div class="form-row">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <span>Birth place:</span>
                                                                <input type="text" v-model="employeeData.birth_place"
                                                                    placeholder="Birth place" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee') ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <span>Birth date:</span>
                                                                <input type="date" v-model="employeeData.birth_date"
                                                                    placeholder="Birth date" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <span>Join of Date:</span>
                                                                <input type="date" v-model="employeeData.date_join"
                                                                    placeholder="Join of Date" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <span>Status:</span>
                                                                <select v-model="employeeData.status"
                                                                    class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select"
                                                                    id="">
                                                                    <option value="1">Active</option>
                                                                    <option value="2">Not Active</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-lg-4 px-5">
                                                            <div class="account-profile justify-content-center ">
                                                                <div class="ap-img pro_img_wrapper">
                                                                    <input id="file-upload" type="file"
                                                                        name="fileUpload" class="d-none"
                                                                        @change="fileUpload">
                                                                    <label for="file-upload">
                                                                        <img class="ap-img__main rounded-circle wh-120 bg-lighter d-flex"
                                                                            :src="`/dashboard/img/author/profile/`+employeeData.employee_pic"
                                                                            v-if="!imagePreview" alt="employee picture">
                                                                        <img class="ap-img__main rounded-circle wh-120 bg-lighter d-flex"
                                                                            :src="imagePreview" alt="profile img"
                                                                            v-if="imagePreview">
                                                                        <span class="cross" id="remove_pro_pic">
                                                                            <i class="fal fa-camera"></i>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <span>Nationality:</span>
                                                                <input type="text" v-model="employeeData.nationality"
                                                                    placeholder="Nationality" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <div class="form-group">
                                                                <span>Identity No:</span>
                                                                <input type="number" v-model="employeeData.identity_no"
                                                                    placeholder="Identity number" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <span>Weight:</span>
                                                                <input type="number" v-model="employeeData.weight"
                                                                    placeholder="Weight" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <span>Height:</span>
                                                                <input type="number" v-model="employeeData.height"
                                                                    placeholder="Height" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <span>Religion:</span>
                                                                <select v-model="employeeData.religion"
                                                                    class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select"
                                                                    id="">
                                                                    <option value="Islam">Islam</option>
                                                                    <option value="Protestan">Protestan</option>
                                                                    <option value="Katolik">Katolik</option>
                                                                    <option value="Hindu">Hindu</option>
                                                                    <option value="Buddha">Buddha</option>
                                                                    <option value="Konghucu">Konghucu</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <span>Blood Type:</span>
                                                                <select v-model="employeeData.blood_type"
                                                                    class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select"
                                                                    id="">
                                                                    <option value="O">O</option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="AB">AB</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom:10px;">
                                                    <h5>Misscellaneous</h5>
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <span>Tax ID</span>
                                                                    <input type="number" v-model="employeeData.tax_id"
                                                                        class="form-control"
                                                                        :disabled="!permissions.includes('EditEmployee')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <span>BPJS/Kesehatan</span>
                                                                    <input type="number" v-model="employeeData.bpjskes"
                                                                        class="form-control"
                                                                        :disabled="!permissions.includes('EditEmployee')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <span>BPJS/Tenaga Kerja</span>
                                                                    <input type="text" v-model="employeeData.bpjstk"
                                                                        class="form-control"
                                                                        :disabled="!permissions.includes('EditEmployee')">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom:10px;">
                                                    <h5>Bank Account</h5>
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-xxl-6 col-lg-12 col-sm-12">
                                                                <div
                                                                    class="userDatatable projectDatatable project-table bg-white border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <v-data-table :headers="headers" multi-sort
                                                                            :items="bankData" :items-per-page="5"
                                                                            class="elevation-1">
                                                                            <template v-slot:item.actions="{item}">
                                                                                <a v-on:click="deleteBankAccount(item.id)"
                                                                                    class="remove">
                                                                                    <i class="fad fa-trash"></i></a>
                                                                            </template>
                                                                        </v-data-table>
                                                                    </div>
                                                                </div>
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#addBankAccount"
                                                                    class="btn btn-secondary-boxity btn-block btn-sm">Add
                                                                    bank
                                                                    account</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="button-group d-flex pt-25"
                                                        v-if="permissions.includes('EditEmployee')">
                                                        <button type="submit"
                                                            class="btn btn-primary-boxity btn-default btn-squared text-capitalize">Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  show" id="v-pills-contact-info-medical" role="tabpanel"
                            aria-labelledby="v-pills-contact-info-medical-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <h5>Contact</h5>
                                                <div class="form-row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Phone:</span>
                                                            <input type="number" v-model="employeeData.phone" id=""
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Email:</span>
                                                            <input type="text" v-model="employeeData.email" id=""
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-group d-flex pt-25"
                                                v-if="permissions.includes('EditEmployee')">
                                                <button @click="handleSubmit"
                                                    class="btn btn-primary-boxity btn-default btn-squared text-capitalize">Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  show" id="v-pills-advanced" role="tabpanel"
                            aria-labelledby="v-pills-contact-info-medical-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <h5>Job</h5>
                                                <div class="form-row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Job type:</span>
                                                            <!-- <input type="text" v-model="employeeData.job_type" id=""
                                                                class="form-control"> -->
                                                            <select v-model="employeeData.job_type"
                                                                class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select"
                                                                id="">
                                                                <option value="Probation">Probation</option>
                                                                <option value="Internship">Internship</option>
                                                                <option value="Contract">Contract</option>
                                                                <option value="Full-time">Full-time</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Department:</span>
                                                            <select v-model="employeeData.departments_name"
                                                                class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select"
                                                                id="">
                                                                <option v-for="department in departmentOpt"
                                                                    v-bind:key="department.id" :value="department.id">
                                                                    {{department.departments_name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Job title:</span>
                                                            <input type="text" v-model="employeeData.job_title" id=""
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Sub Department:</span>
                                                            <select v-model="employeeData.subdepartments_name"
                                                                class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select"
                                                                id="">
                                                                <option v-for="subdepartment in subDepartmentOpt"
                                                                    v-bind:key="subdepartment.id"
                                                                    :value="subdepartment.id">
                                                                    {{subdepartment.subdepartments_name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-group d-flex pt-25"
                                                v-if="permissions.includes('EditEmployee')">
                                                <button @click="handleSubmit"
                                                    class="btn btn-primary-boxity btn-default btn-squared text-capitalize">Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="addBankAccount" tabindex="-1" role="dialog"
                            aria-labelledby="addBankAccount" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content" v-on:keyup.enter="submitBankAccount">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add bank account</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <span>Bank:</span>
                                                        <select class="form-control form-control-default"
                                                            v-model="banks.bank_id">
                                                            <option value="">Select bank code:</option>
                                                            <option v-for="bank in bank" :key="bank.id"
                                                                v-bind:value="bank.id">
                                                                {{bank.name}} - {{bank.code}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span>Bank account:</span>
                                                        <input type="number" v-model="banks.account_no"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span>Bank account holder:</span>
                                                        <input type="text" v-model="banks.account_name"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" @click="submitBankAccount"
                                            class="btn btn-primary-boxity">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="user-info-tab w-100 bg-white global-shadow radius-xl mb-50">
                    <div class="ap-tab-wrapper border-bottom ">
                        <ul class="nav px-30 ap-tab-main text-capitalize" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-details-photo-tab" data-toggle="pill"
                                    href="#v-pills-details-photo" role="tab" aria-controls="v-pills-details-photo"
                                    aria-selected="true">Details and Photo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-contact-info-medical-tab" data-toggle="pill"
                                    href="#v-pills-contact-info-medical" role="tab"
                                    aria-controls="v-pills-contact-info-medical" aria-selected="true">Contact Info &
                                    Medical</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active" id="v-pills-details-photo" role="tabpanel"
                            aria-labelledby="v-pills-details-photo-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <form @submit.prevent="handleSubmit" enctype="multipart/form-data"
                                                    method="POST">
                                                    <h5>Details</h5>
                                                    <div class="form-row">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <span>Birth place:</span>
                                                                <input type="text" v-model="employeeData.birth_place"
                                                                    placeholder="Birth place" class="form-control"
                                                                    :disabled="!permissions.includes('EditInventoryItem') ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <span>Birth date:</span>
                                                                <input type="date" v-model="employeeData.birth_date"
                                                                    placeholder="Birth date" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <span>Join of Date:</span>
                                                                <input type="date" v-model="employeeData.date_join"
                                                                    placeholder="Join of Date" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-lg-4 px-5">
                                                            <div class="account-profile justify-content-center ">
                                                                <div class="ap-img pro_img_wrapper">
                                                                    <input id="file-upload" type="file"
                                                                        name="fileUpload" class="d-none"
                                                                        @change="fileUpload">
                                                                    <label for="file-upload">
                                                                        <img class="ap-img__main rounded-circle wh-120 bg-lighter d-flex"
                                                                            :src="`/dashboard/img/author/profile/`+employeeData.employee_pic"
                                                                            v-if="!imagePreview" alt="employee picture">
                                                                        <img class="ap-img__main rounded-circle wh-120 bg-lighter d-flex"
                                                                            :src="imagePreview" alt="profile img"
                                                                            v-if="imagePreview">
                                                                        <span class="cross" id="remove_pro_pic">
                                                                            <i class="fal fa-camera"></i>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <span>Nationality:</span>
                                                                <input type="text" v-model="employeeData.nationality"
                                                                    placeholder="Nationality" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <div class="form-group">
                                                                <span>Identity No:</span>
                                                                <input type="number" v-model="employeeData.identity_no"
                                                                    placeholder="Identity number" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <span>Weight:</span>
                                                                <input type="number" v-model="employeeData.weight"
                                                                    placeholder="Weight" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <span>Height:</span>
                                                                <input type="number" v-model="employeeData.height"
                                                                    placeholder="Height" class="form-control"
                                                                    :disabled="!permissions.includes('EditEmployee')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <span>Religion:</span>
                                                                <select v-model="employeeData.religion"
                                                                    class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select"
                                                                    id="">
                                                                    <option value="Islam">Islam</option>
                                                                    <option value="Protestan">Protestan</option>
                                                                    <option value="Katolik">Katolik</option>
                                                                    <option value="Hindu">Hindu</option>
                                                                    <option value="Buddha">Buddha</option>
                                                                    <option value="Konghucu">Konghucu</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <span>Blood Type:</span>
                                                                <select v-model="employeeData.blood_type"
                                                                    class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select"
                                                                    id="">
                                                                    <option value="O">O</option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="AB">AB</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom:10px;">
                                                    <h5>Misscellaneous</h5>
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <span>Tax ID</span>
                                                                    <input type="number" v-model="employeeData.tax_id"
                                                                        class="form-control"
                                                                        :disabled="!permissions.includes('EditEmployee')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <span>BPJS/Kesehatan</span>
                                                                    <input type="number" v-model="employeeData.bpjskes"
                                                                        class="form-control"
                                                                        :disabled="!permissions.includes('EditEmployee')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <span>BPJS/Tenaga Kerja</span>
                                                                    <input type="text" v-model="employeeData.bpjstk"
                                                                        class="form-control"
                                                                        :disabled="!permissions.includes('EditEmployee')">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom:10px;">
                                                    <h5>Bank Account</h5>
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-xxl-6 col-lg-12 col-sm-12">
                                                                <div
                                                                    class="userDatatable projectDatatable project-table bg-white border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <v-data-table :headers="headers" multi-sort
                                                                            :items="bankData" :items-per-page="5"
                                                                            class="elevation-1">
                                                                            <template v-slot:item.actions="{item}">
                                                                                <a v-on:click="deleteBankAccount(item.id)"
                                                                                    class="remove">
                                                                                    <i class="fad fa-trash"></i></a>
                                                                            </template>
                                                                        </v-data-table>
                                                                    </div>
                                                                </div>
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#addBankAccount"
                                                                    class="btn btn-secondary-boxity btn-block btn-sm">Add
                                                                    bank
                                                                    account</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="button-group d-flex pt-25"
                                                        v-if="permissions.includes('EditEmployee')">
                                                        <button type="submit"
                                                            class="btn btn-primary-boxity btn-default btn-squared text-capitalize">Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  show" id="v-pills-contact-info-medical" role="tabpanel"
                            aria-labelledby="v-pills-contact-info-medical-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <h5>Contact</h5>
                                                <div class="form-row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Phone:</span>
                                                            <input type="number" v-model="employeeData.phone" id=""
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Email:</span>
                                                            <input type="text" v-model="employeeData.email" id=""
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-group d-flex pt-25"
                                                v-if="permissions.includes('EditEmployee')">
                                                <button @click="handleSubmit"
                                                    class="btn btn-primary-boxity btn-default btn-squared text-capitalize">Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  show" id="v-pills-advanced" role="tabpanel"
                            aria-labelledby="v-pills-contact-info-medical-tab">
                            <div class="row mx-4">
                                <div class="col-lg-12">
                                    <div class="card card-vertical card-default card-md mb-4">
                                        <div class="card-body pb-md-30">
                                            <div class="vertical-form">
                                                <h5>Job</h5>
                                                <div class="form-row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Job type:</span>
                                                            <!-- <input type="text" v-model="employeeData.job_type" id=""
                                                                class="form-control"> -->
                                                            <select v-model="employeeData.job_type"
                                                                class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select"
                                                                id="">
                                                                <option value="Probation">Probation</option>
                                                                <option value="Internship">Internship</option>
                                                                <option value="Contract">Contract</option>
                                                                <option value="Full-time">Full-time</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Department:</span>
                                                            <select v-model="employeeData.departments_name"
                                                                class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select"
                                                                id="">
                                                                <option v-for="department in departmentOpt"
                                                                    v-bind:key="department.id" :value="department.id">
                                                                    {{department.departments_name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Job title:</span>
                                                            <input type="text" v-model="employeeData.job_title" id=""
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-10">
                                                            <span>Sub Department:</span>
                                                            <select v-model="employeeData.subdepartments_name"
                                                                class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select"
                                                                id="">
                                                                <option v-for="subdepartment in subDepartmentOpt"
                                                                    v-bind:key="subdepartment.id"
                                                                    :value="subdepartment.id">
                                                                    {{subdepartment.subdepartments_name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-group d-flex pt-25"
                                                v-if="permissions.includes('EditEmployee')">
                                                <button @click="handleSubmit"
                                                    class="btn btn-primary-boxity btn-default btn-squared text-capitalize">Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="addBankAccount" tabindex="-1" role="dialog"
                            aria-labelledby="addBankAccount" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content" v-on:keyup.enter="submitBankAccount">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add bank account</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <span>Bank:</span>
                                                        <select class="form-control form-control-default"
                                                            v-model="banks.bank_id">
                                                            <option value="">Select bank code:</option>
                                                            <option v-for="bank in bank" :key="bank.id"
                                                                v-bind:value="bank.id">
                                                                {{bank.name}} - {{bank.code}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span>Bank account:</span>
                                                        <input type="number" v-model="banks.account_no"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span>Bank account holder:</span>
                                                        <input type="text" v-model="banks.account_name"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" @click="submitBankAccount"
                                            class="btn btn-primary-boxity">Save</button>
                                    </div>
                                </div>
                            </div>
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
    import vue2Dropzone from 'vue2-dropzone';
    import VueNumeric from 'vue-numeric'
    export default {
        components: {
            'editor': Editor,
            vueDropzone: vue2Dropzone,
            VueNumeric
        },
        title() {
            return `Employee data`;
        },
        data() {
            return {
                banks: {
                    bank_id: '',
                },
                bankData: [],
                headers: [{
                    text: 'Bank',
                    value: 'bank.name'
                }, {
                    text: 'Account No.',
                    value: 'account_no'
                }, {}, {
                    text: 'Account Holder',
                    value: 'account_name'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                employeeData: {},
                imagePreview: null,
                departmentOpt: {},
                subDepartmentOpt: {},

                permissions: []
            }
        },
        created() {
            this.loadEmployeeData();
        },
        beforeMount() {
            this.permissions = this.$store.getters.getPermissions;
        },
        methods: {
            routerBack() {
                this.$router.go(-1)
            },
            routerRefresh() {
                this.$isLoading(true);
                this.loadEmployeeData();
                this.$isLoading(false);
            },
            fileUpload(e) {
                this.employeeData.employee_pic = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(this.employeeData.employee_pic)
                reader.onload = e => {
                    this.imagePreview = e.target.result;
                }
            },
            async loadEmployeeData() {
                // this.$Progress.start();
                this.$isLoading(true);
                axios.get('/api/bank').then(resp => {
                    this.bank = resp.data;
                });
                const respBank = await axios.get('/api/employee-details/bank/' + this.$route.params.id);
                this.bankData = respBank.data;
                const response = await axios.get('/api/employee/' + this.$route.params.id);
                this.employeeData = response.data;

                // Load data relation
                const resp = await axios.get('/api/department');
                this.departmentOpt = resp.data;
                const respSub = await axios.get('/api/department/sub');
                this.subDepartmentOpt = respSub.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteBankAccount(id) {
                document.getElementById('failding').play();
                await axios.delete('/api/employee-details/bank/' + id);
                this.loadEmployeeData();
                this.$isLoading(false);
                document.getElementById('ding').play();
                await Swal.fire({
                    icon: 'success',
                    title: 'Successfully deleted.',
                    text: 'Success delete the account number.'
                });
                // this.$Progress.finish();
            },
            async submitBankAccount() {
                this.$isLoading(true);
                $('#addBankAccount').modal('hide');
                $(".modal-backdrop").remove();
                await axios.post('/api/employee-details/bank/' + this.$route.params.id, this.banks).then((
                    response) => {
                    document.getElementById('ding').play();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Bank account has been added.'
                    })
                    this.banks = {};
                    this.loadEmployeeData();
                });
                this.$isLoading(false);
            },
            async handleSubmit() {
                // const data = new FormData();
                // data.append('birth_date', this.employeeData.birth_date);
                // data.append('birth_place', this.employeeData.birth_place);
                // data.append('blood_type', this.employeeData.blood_type);
                // data.append('bpjskes', this.employeeData.bpjskes);
                // data.append('bpjstk', this.employeeData.bpjstk);
                // data.append('date_join', this.employeeData.date_join);
                // data.append('departments', this.employeeData.departments);
                // data.append('email', this.employeeData.email);
                // data.append('employee_age', this.employeeData.employee_age);
                // data.append('employee_code', this.employeeData.employee_code);
                // data.append('employee_name', this.employeeData.employee_name);
                // data.append('employee_nickname', this.employeeData.employee_nickname);
                // data.append('employee_pic', this.employeeData.employee_pic);
                // data.append('employee_sex', this.employeeData.employee_sex);
                // data.append('height', this.employeeData.height);
                // data.append('identity_no', this.employeeData.identity_no);
                // data.append('job_title', this.employeeData.job_title);
                // data.append('job_type', this.employeeData.job_type);
                // data.append('nationality', this.employeeData.nationality);
                // data.append('phone', this.employeeData.phone);
                // data.append('religion', this.employeeData.religion);
                // data.append('status', this.employeeData.status);
                // data.append('sub_departments', this.employeeData.sub_departments);
                // data.append('tax_id', this.employeeData.tax_id);
                // data.append('weight', this.employeeData.weight);
                // console.log('Data submit: ', data);
                await axios.patch('/api/employee/' + this.$route.params.id, this.employeeData).then(response => {
                    document.getElementById('ding').play();
                    this.routerRefresh();
                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success update employee data',
                    });
                    // this.$router.push('/employee/detail/' + this.$route.params.id);
                }).catch(err => {
                    this.routerRefresh();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: err.response.data.message,
                    });
                });
            },
        },
    }

</script>
