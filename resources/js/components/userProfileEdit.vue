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
                                        <form @submit.prevent="submitHandle" method="POST"
                                            enctype="multipart/form-data">
                                            <div class="account-profile d-flex justify-content-center mb-4 ">
                                                <div class="ap-img pro_img_wrapper">
                                                    <input id="file-upload" type="file" name="fileUpload" class="d-none"
                                                        @change="fileUpload">
                                                    <label for="file-upload">
                                                        <img class="ap-img__main rounded-circle wh-120 bg-lighter d-flex"
                                                            :src="user.avatar" :alt="user.name+` picture`"
                                                            v-if="!imagePreview">
                                                        <img class="ap-img__main rounded-circle wh-120 bg-lighter d-flex"
                                                            :src="imagePreview" alt="profile img" v-if="imagePreview">
                                                        <span class="cross" id="remove_pro_pic">
                                                            <i class="fal fa-camera"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="edit-profile__body">
                                                <div class="form-row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <span for="name1">name</span>
                                                            <input type="text" class="form-control" id="name1"
                                                                v-model="user.name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <span for="name1">username</span>
                                                            <input type="text" class="form-control"
                                                                v-model="user.username">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <span for="name2">Email</span>
                                                            <input type="email" class="form-control" id="name2"
                                                                v-model="user.email" readonly>
                                                            <span><i>Request to IT for changes an email
                                                                    address.</i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <span for="name2">Mobile phone</span>
                                                            <input type="number" class="form-control"
                                                                v-model="user.phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <span for="">Gender</span>
                                                            <select v-model="user.gender" id=""
                                                                class="form-control form-control-default ip-gray radius-xs b-light px-15 fa-select">
                                                                <option :value="`M`">Male</option>
                                                                <option :value="`F`">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <div class="cityOption">
                                                                <span>
                                                                    Birth
                                                                </span>
                                                                <input type="date" class="form-control"
                                                                    v-model="user.birth">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <span for="">Bio</span>
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
                                                                        aria-describedby="addon-wrapping1"
                                                                        id="socialUrl" v-model="user.facebook">
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
                                                                        aria-describedby="addon-wrapping1"
                                                                        id="socialUrl" v-model="user.instagram">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h3>Notifier:</h3>
                                                    <div class="form-row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <span for="name1">Telegram ID:</span>
                                                                <input type="text" class="form-control" id="name1"
                                                                    v-model="user.telegram_id">
                                                                <span><a href="https://help.boxity.id/notifier/telegram-notificaion"
                                                                        target="_blank"><i
                                                                            class="fad fa-info-circle"></i> How can
                                                                        you get your ID's telegram?</a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-group d-flex pt-25 justify-content-start">
                                                    <button type="submit"
                                                        class="btn btn-primary-boxity btn-default btn-squared text-capitalize radius-md shadow2">Update
                                                        details
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
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
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span for="name1">Old Password</span>
                                                        <input type="password" class="form-control" id="oldPassword"
                                                            v-model="user.oldPassword">
                                                        <span class="text-danger error-password">
                                                            {{ errors.oldPassword }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span for="name1">Password</span>
                                                        <input type="password" class="form-control" id="name1"
                                                            v-model="user.password">
                                                        <span class="text-danger error-password">
                                                            {{ errors.password }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span for="name1">Confirm Password</span>
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
                                                    class="btn btn-primary-boxity btn-default btn-squared text-capitalize radius-md shadow2"
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
                imagePreview: null,
                imageLocation: null,
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
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/u/' + this.$route.params.username);
                this.user = resp.data;
                this.user.facebook = '';
                this.user.instagram = '';
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            fileUpload(e) {
                this.imageLocation = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(this.imageLocation)
                reader.onload = e => {
                    this.imagePreview = e.target.result;
                }
            },
            submitHandle() {
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                };
                const data = new FormData();
                data.append('image', this.imageLocation);
                data.append('name', this.user.name);
                data.append('username', this.user.username);
                data.append('email', this.user.email);
                data.append('phone', this.user.phone);
                data.append('gender', this.user.gender);
                data.append('birth', this.user.birth);
                data.append('bio', this.user.bio);
                data.append('facebook', this.user.facebook);
                data.append('instagram', this.user.instagram);
                data.append('telegram_id', this.user.telegram_id);

                // this.$Progress.start();
                this.$isLoading(true);
                axios.post('/api/profile/' + this.user.id, data, config).then(response => {
                    // console.log(response);
                });
                this.loadDataUser();
                document.getElementById('ding').play();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Update your data succced.',
                });
                // this.$Progress.finish();
                this.$isLoading(false);
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
            async validateData() {
                const isPasswordValid = this.validatePassword();
                if (!isPasswordValid) return false;

                const {
                    data
                } = await axios.post('/api/users/check-users-data', this.user);
                if (data.existingPassword) {
                    this.errors = {
                        ...this.errors,
                        oldPassword: 'Password is not match with the old one!',
                    };
                } else {
                    this.errors = {
                        ...this.errors,
                        oldPassword: '',
                    };
                }
                return !data.existingPassword;
            },
            async updatePassword(e) {
                e.preventDefault();
                const isValid = await this.validateData();
                if (!isValid) return false;
                // const pass = this.user.password;
                // this.$Progress.start();
                this.$isLoading(true);
                axios.patch('/api/profile/password-update/' + this.user.id, this.user);
                this.loadDataUser();
                // this.$Progress.finish();
                this.$isLoading(false);
                document.getElementById('ding').play();
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
