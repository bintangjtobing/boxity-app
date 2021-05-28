<template>
    <div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="user-info-tab w-100 bg-white global-shadow radius-xl mb-50">
                    <div class="ap-tab-wrapper border-bottom ">
                        <ul class="nav px-30 ap-tab-main text-capitalize" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                    role="tab" aria-controls="v-pills-home" aria-selected="true"><span
                                        data-feather="user"></span>edit profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-security-tab" data-toggle="pill"
                                    href="#v-pills-security" role="tab" aria-controls="v-pills-security"
                                    aria-selected="false"><span data-feather="user"></span>security</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="row justify-content-center ml-4">
                                <div class="col-xl-10 col-sm-9 col-10">
                                    <div class="mt-40 mb-50">
                                        <div class="account-profile d-flex justify-content-center mb-4 ">
                                            <div class="ap-img pro_img_wrapper">
                                                <!-- <input id="file-upload" type="file" name="fileUpload" class="d-none"
                                                        @change="fileUpload"> -->
                                                <label for="file-upload">
                                                    <img class="ap-img__main rounded-circle wh-120 bg-lighter d-flex"
                                                        :src="`/dashboard/img/author/profile/`+user.avatar"
                                                        alt="profile img" v-if="!imagePreview">
                                                    <img class="ap-img__main rounded-circle wh-120 bg-lighter d-flex"
                                                        :src="imagePreview" alt="profile img" v-if="imagePreview">
                                                    <!-- <span class="cross" id="remove_pro_pic">
                                                            <i class="fas fa-camera"></i>
                                                        </span> -->
                                                </label>
                                            </div>
                                        </div>
                                        <div class="edit-profile__body">
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="name1">name</label>
                                                        <input type="text" class="form-control" id="name1"
                                                            v-model="user.name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="name1">username</label>
                                                        <input type="text" class="form-control" v-model="user.username">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="name2">Email</label>
                                                        <input type="email" class="form-control" id="name2"
                                                            v-model="user.email" readonly>
                                                        <span><i>Request to IT for changes an email
                                                                address.</i></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="name2">Mobile phone</label>
                                                        <input type="number" class="form-control" v-model="user.phone">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label for="">Gender</label>
                                                        <select v-model="user.gender" id=""
                                                            class="form-control form-control-default ih-medium ip-gray radius-xs b-light px-15 fa-select">
                                                            <option :value="`M`">Male</option>
                                                            <option :value="`F`">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <div class="cityOption">
                                                            <label>
                                                                Birth
                                                            </label>
                                                            <input type="date" class="form-control"
                                                                v-model="user.birth">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Bio</label>
                                                <textarea v-model="user.bio" id="" cols="30" rows="4"
                                                    class="form-control"
                                                    placeholder="Tell about yourself. Or you can add bio like your instagram account..."></textarea>
                                            </div>
                                            <hr class="my-3">
                                            <div class="my-3">
                                                <h3>Social profile</h3>
                                                <div class="form-row">
                                                    <div class="col-lg-6">
                                                        <div class="my-10">
                                                            <div class="input-group flex-nowrap">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-facebook border-facebook text-white wh-44 radius-xs justify-content-center"
                                                                        id="addon-wrapping1">
                                                                        <i class="lab la-facebook-f fs-18"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="url"
                                                                    class="form-control form-control--social"
                                                                    placeholder="https://facebook.com/username"
                                                                    aria-label="Username"
                                                                    aria-describedby="addon-wrapping1" id="socialUrl"
                                                                    v-model="user.facebook">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="my-10">
                                                            <div class="input-group flex-nowrap">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-instagram border-instagram text-white wh-44 radius-xs justify-content-center"
                                                                        id="addon-wrapping1">
                                                                        <i class="lab la-instagram fs-18"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="url"
                                                                    class="form-control form-control--social"
                                                                    placeholder="https://instagram.com/username"
                                                                    aria-label="Username"
                                                                    aria-describedby="addon-wrapping1" id="socialUrl"
                                                                    v-model="user.instagram">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-group d-flex pt-25 justify-content-start">
                                                <button v-on:click="handleSubmit"
                                                    class="btn btn-primary btn-default btn-squared text-capitalize radius-md shadow2"
                                                    type="submit">Update
                                                    details
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-security" role="tabpanel"
                            aria-labelledby="v-pills-security-tab">
                            <div class="row justify-content-center ml-4">
                                <div class="col-xl-10 col-sm-9 col-10">
                                    <div class="mt-40 mb-50">
                                        <div class="edit-profile__body">
                                            <h3>Change Password</h3>
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="name1">Password</label>
                                                        <input type="password" class="form-control" id="name1"
                                                            v-model="user.password">
                                                        <span class="text-danger error-password">
                                                            {{ errors.password }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="name1">Confirm Password</label>
                                                        <input type="password" class="form-control"
                                                            v-model="user.confirmPassword">
                                                        <span class="text-danger error-password">
                                                            {{ errors.confirmPassword }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-group d-flex pt-25 justify-content-start">
                                                <button v-on:click="updatePassword" v-on:keyup.enter="updatePassword"
                                                    class="btn btn-primary btn-default btn-squared text-capitalize radius-md shadow2"
                                                    type="submit">Update
                                                    password
                                                </button>
                                            </div>

                                        </div>
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
    export default {
        title() {
            return `User Profile`;
        },
        data() {
            return {
                user: {
                    facebook: '',
                    instagram: '',
                },
                imagePreview: '',
                imageLocation: '',
                errors: {
                    password: '',
                    confirmPassword: '',
                },
            }
        },
        created() {
            this.loadDataUser();
        },
        methods: {
            async loadDataUser() {
                const resp = await axios.get('/api/u/' + this.$route.params.username);
                this.user = resp.data;
            },
            fileUpload(e) {
                this.imageLocation = e.target.files[0];
                console.log(this.imageLocation);
                let reader = new FileReader();
                reader.readAsDataURL(this.imageLocation)
                reader.onload = e => {
                    this.imagePreview = e.target.result;
                }
            },
            handleSubmit(e) {
                e.preventDefault();
                // const config = {
                //     headers: {
                //         'Content-Type': 'multipart/form-data',
                //     }
                // };
                // const data = new FormData();
                // data.append('image', this.imageLocation);
                // data.append('name', this.user.name);
                // data.append('username', this.user.username);
                // data.append('email', this.user.email);
                // data.append('phone', this.user.phone);
                // data.append('gender', this.user.gender);
                // data.append('birth', this.user.birth);
                // data.append('bio', this.user.bio);
                // data.append('facebook', this.user.facebook);
                // data.append('instagram', this.user.instagram);
                // console.log(data);
                axios.patch('/api/profile/' + this.user.id, this.user);
                this.loadDataUser();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Update your data succced.',
                });
            },
            gatherFormData() {
                return data;
            },
            validatePassword() {
                const {
                    password,
                    confirmPassword
                } = this.user;

                if (!_.isEmpty(password)) {
                    if (password.length < 8) {
                        this.errors = {
                            ...this.errors,
                            password: 'Min have 8 characters or more.',
                        };
                        return false;
                    }
                    if (_.isNil(confirmPassword) || confirmPassword.length < 8) {
                        this.errors = {
                            ...this.errors,
                            confirmPassword: 'Min have 8 characters or more.',
                        };
                        return false;
                    }
                    if (password !==
                        confirmPassword) {
                        this.errors = {
                            ...this.errors,
                            confirmPassword: 'Password does not match!',
                        };
                        return false;
                    }
                    this.errors = {
                        ...this.errors,
                        password: '',
                        confirmPassword: '',
                    };
                }
                return true;
            },
            updatePassword(e) {
                e.preventDefault();
                const isPasswordValid = this.validatePassword();
                if (!isPasswordValid) return false;
                // const pass = this.user.password;
                axios.patch('/api/profile/password-update/' + this.user.id, this.user);
                this.loadDataUser();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Update your password data.',
                });
                // console.log(pass);
            }
        }
    }

</script>
