<template>
  <div>
    <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-body">
          <div
            class="row justify-content-between align-items-center"
            @click="isShowing('colapse1')"
          >
            <div class="col-lg-6">
              <h5>Add User</h5>
            </div>
            <div class="col-lg-6 text-right">
              <span
                class="material-icons-outlined collapseArea"
                :class="classRotate(isShow.colapse1)"
                style="color: #ddd; font-size: 2rem !important"
              >
                expand_more
              </span>
            </div>
          </div>
          <div v-show="isShow.colapse1">
            <div class="form-row">
              <div class="col-lg-9">
                <div class="form-group">
                  <span>Fullname:</span>
                  <input
                    v-model="userData.name"
                    type="text"
                    class="form-control"
                  />
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <span>Gender:</span>
                  <input
                    v-model="userData.gender"
                    type="text"
                    class="form-control"
                  />
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-12">
                <div class="form-group">
                  <span>Email:</span>
                  <input
                    v-model="userData.email"
                    type="email"
                    class="form-control"
                  />
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-6">
                <div class="form-group">
                  <span>Password:</span>
                  <input
                    v-model="userData.password"
                    type="password"
                    class="form-control"
                    :disabled="isAutoGenerate"
                  />
                  <input
                    v-model="isAutoGenerate"
                    @click="passwordGenerate"
                    class="checkbox"
                    type="checkbox"
                    id="check-1"
                  />
                  <label for="check-1">
                    <span class="checkbox-text">Auto Generate</span>
                  </label>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <span>Verify Password:</span>
                  <span v-if="isPasswordSame === false" id="massage"
                    >Password not same</span
                  >
                  <input
                    v-model="userData.passwordVerify"
                    type="password"
                    class="form-control"
                    :disabled="isAutoGenerate"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-body">
          <div
            class="row justify-content-between align-items-center"
            @click="isShowing('colapse2')"
          >
            <div class="col-lg-6">
              <h5>Set Permissions</h5>
            </div>
            <div class="col-lg-6 text-right">
              <span
                class="material-icons-outlined collapseArea"
                :class="classRotate(isShow.colapse2)"
                style="color: #ddd; font-size: 2rem !important"
              >
                expand_more
              </span>
            </div>
          </div>
          <div v-show="isShow.colapse2">
            <template>
              <v-card>
                <v-card-title>
                  <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                  ></v-text-field>
                </v-card-title>
                <v-data-table
                  v-model="selected"
                  :search="search"
                  :headers="headers"
                  :items="items.permissions"
                  hide-default-footer
                  group-by="roleName"
                  item-key="name"
                  loading-text="No data available"
                  show-select
                  class="elevation-1"
                />
              </v-card>
            </template>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <button
        class="btn btn-success float-right btn-default btn-squared px-30"
        :disabled="!isSubmit"
      >
        Add New
      </button>
      <br /><br /><br />
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isShow: {
        colapse1: true,
        colapse2: true,
      },
      search: "",
      selected: [],
      items: {
        permissions: [
          {
            permissionsId: "UserManagement.CreateUser",
            name: "create user",
            roleName: "UserManagement",
          },
          {
            permissionsId: "UserManagement.DeleteUser",
            name: "delete user",
            roleName: "UserManagement",
          },
          {
            permissionsId: "UserManagement.EditUser",
            name: "edit user",
            roleName: "UserManagement",
          },
        ],
      },
      headers: [
        {
          text: "Permission ID",
          sortable: false,
          value: "permissionsId",
        },
        { text: "Permission Name", sortable: false, value: "name" },
      ],
      userData: {
        name: "",
        email: "",
        gender: "",
        password: "",
        passwordVerify: "",
      },
      isAutoGenerate: false,
    };
  },
  computed: {
    isPasswordSame: function () {
      return (
        this.userData.password &&
        this.userData.passwordVerify &&
        this.userData.password === this.userData.passwordVerify
      );
    },
    isSubmit: function () {
      return (
        this.userData.name &&
        this.userData.email &&
        this.userData.gemder &&
        this.isPasswordSame
      );
    },
  },
  methods: {
    classRotate: function (param) {
      return param ? "rotate" : "";
    },
    isShowing: function (param) {
      this.isShow[param] = !this.isShow[param];
    },
    passwordGenerate: function () {
      this.isAutoGenerate = !this.isAutoGenerate;
      if (this.isAutoGenerate) {
        const genPass = this.rndStr(8);
        this.userData.password = genPass;
        this.userData.passwordVerify = genPass;
      } else {
        this.userData.password = "";
        this.userData.passwordVerify = "";
      }
    },
    rndStr(len) {
      let text = "";
      let chars = "abcdefghijklmnopqrstuvwxyz1234567890";

      for (let i = 0; i < len; i++) {
        text += chars.charAt(Math.floor(Math.random() * chars.length));
      }
      return text;
    },
    // async handleSubmit() {
    //     const isValid = await this.validateData();
    //     if (!isValid) return false;
    //     this.hideModal();
    //     const payload = {};
    //     _.forEach(['name', 'role', 'department', 'divisi', 'gender', 'email'], (field) => {
    //         if (this.user[field]) {
    //             payload[field] = this.user[field];
    //         }
    //     });
    //     if (!_.isEmpty(this.user.password)) {
    //         payload.password = this.user.password;
    //     }
    //     this.$Progress.start();
    //     await axios.post('/api/users', payload).then(response => {
    //         this.loadUsers();
    //         Swal.fire({
    //             icon: 'success',
    //             title: 'Congratulations',
    //             text: 'Success New user',
    //         });
    //         this.user = {
    //             gender: '',
    //             role: '',
    //             department: '',
    //             divisi: '',
    //             name: '',
    //             email: '',
    //         };
    //         const genPass = this.rndStr(8);
    //         this.user.password = genPass;
    //         this.user.confirmPassword = genPass;
    //         this.$Progress.finish();
    //     }).catch(error => {
    //         this.$Progress.fail();
    //         Swal.fire({
    //             icon: 'warning',
    //             title: 'Something wrong.',
    //             confirmButtonText: `Ok`,
    //             html: `There is something wrong on my side. Please click ok to refresh this page and see what is it. If
    //     it still exist, you can contact our developer. <br><br>Error message: ` +
    //                 error,
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 location.reload();
    //             }
    //         });
    //     });
    // }
  },
};
</script>

<style scoped>
.rotate {
  -ms-transform: rotate(180deg);
  transform: rotate(180deg);
}
.elevation-1 {
  max-height: 30em;
  overflow: auto;
}
#massage {
  color: #f41d2a;
}
</style>