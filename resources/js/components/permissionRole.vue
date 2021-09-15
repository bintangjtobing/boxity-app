<template>
  <div>
    <div>
      <div class="row mt-4">
        <div class="col-lg-12">
          <div class="breadcrumb-main user-member justify-content-sm-between ">
            <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
              <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                <h4 class="text-capitalize fw-500 breadcrumb-title">Roles</h4>
              </div>
            </div>
            <div class="action-btn">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <em class="las la-plus fs-16"></em> New Roles</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="userDatatable adv-table-table global-shadow border p-30 bg-white radius-xl w-100 mb-30">
            <div class="table-responsive">
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
                :headers="headerArray"
                :items="items"
                :search="search"
                hide-default-footer
                item-key="name"
                class="elevation-1"
              >
                <template
                  v-slot:body="{ items }">
                  <tbody v-for="item in items" :key="item.role">
                    <tr
                      v-for="(permission, index) in item.permissions"
                      :key="index"
                    >
                      <td v-if="index == 0" :rowspan="item.permissions.length" style="text-align:center">{{ item.role }}</td>
                      <td>{{ permission.permission }}</td>
                      <td v-if="index == 0" :rowspan="item.permissions.length" style="text-align:center">
                        <a @click="fillRoleEditData(item)" data-toggle="modal" data-target="#updateModal" class="edit">
                          <em class="fas fa-pencil"></em></a>
                        <a @click="deleteRolePermission(item, false)" data-toggle="modal" data-target="#deleteModal" class="remove">
                          <em class="fas fa-trash"></em></a>
                      </td>
                    </tr>
                  </tbody>
                </template>
              </v-data-table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div>
              <h5 class="modal-title" id="exampleModalLabel">Add Role & Permissions</h5>
              <p class="muted-text">On User Management Role</p>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <span>Role name:</span>
                        <input v-model="roleData.role" type="text" class="form-control" placeholder="e.g: Admin" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <span>Permissions Name:</span>
                        <div v-for="i in permissionInput" :key="i">
                          <input v-model="roleData.permissions[i-1]"  type="text" class="form-control" placeholder="e.g: Create User"/>
                          <br/>
                        </div>
                        <div style="color: #c0c0c0" class="font-weight-light">
                          <a @click="permissionInputAction(true, true)"><em class="fas fa-plus-circle text-primary"></em> Tambah Permission</a>
                          <a v-show="(permissionInput != 1)" @click="permissionInputAction(false, true)" class="float-right"><em style="font-size: 16px !important" class="fas fa-minus-circle text-danger"></em> Kurangi Permission</a>
                        </div>
                    </div>
                </div>
            </div>
            </form>
          </div>
          <div class="modal-footer">
            <button @click="createRolePermission" type="button" class="btn btn-success" data-dismiss="modal">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div>
              <h5 class="modal-title" id="exampleModalLabel">Edit Role & Permissions</h5>
              <p class="muted-text">On User Management Role</p>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <span>Role name:</span>
                        <input v-model="roleEditData.role" type="text" class="form-control" placeholder="e.g: Admin" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <span>Permissions Name:</span>
                        <div v-for="i in permissionInputEdit" :key="i">
                          <input v-model="roleEditData.permissions[i-1].permission"  type="text" class="form-control" placeholder="e.g: Create User"/>
                          <br/>
                        </div>
                        <div style="color: #c0c0c0" class="font-weight-light">
                          <a @click="permissionInputAction(true, false)"><em class="fas fa-plus-circle text-primary"></em> Tambah Permission</a>
                          <a v-show="(permissionInputEdit != 1)" @click="permissionInputAction(false, false)" class="float-right"><em style="font-size: 16px !important" class="fas fa-minus-circle text-danger"></em> Kurangi Permission</a>
                        </div>
                    </div>
                </div>
            </div>
            </form>
          </div>
          <div class="modal-footer">
            <button @click="updateRolePermission" type="button" class="btn btn-success">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div>
              <!-- <h5 class="modal-title" id="exampleModalLabel">Add Permissions</h5>
              <p class="muted-text">On User Management Role</p> -->
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div style="text-align:center" class="modal-body">
            <h5>Are you sure to delet this data?</h5>
            <br>
            <div class="row justify-content-center">
              <button @click="deleteRolePermission(null, true)" class="btn btn-danger">Yes</button>
              <button class="btn btn-light" data-dismiss="modal">No</button>
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
  data() {
    return {
      search: "",
      headerArray: [
        {
          text: 'Role',
          align: 'center',
          value: 'role',
        },
        { text: 'Permissions', value: 'permission', sortable: false, align: 'center'},
        { text: 'Actions', value: 'actions', sortable: false, align: 'center'},
      ],
      items: [
        {
          role: '',
          permissions: [ 
            {
              permissionId: 0,
              permission: ''
            }
          ]
        }
      ],
      roleData: {
        role: "",
        permissions: []
      },
      roleEditData: {
        role: "",
        permissions: []
      },
      permissionInput: 1,
      permissionInputEdit: 0,
      tempDelete: {}
    };
  },
  created() {
    this.getRolePermission();
  },
  computed: {
    
  },
  methods: {
    permissionInputAction: function (param, create) {
      if (create) {
        if (param) { 
          this.permissionInput = this.permissionInput + 1
        } 
        else { 
          this.permissionInput = this.permissionInput - 1 
          this.roleData.permissions.pop()
        }
      }
      else {
        if(param) {
          this.permissionInputEdit = this.permissionInputEdit + 1 
          this.roleEditData.permissions[this.permissionInputEdit - 1] = {
            permission: '',
            permissionId: 0
          };
        }
        else {
          this.permissionInputEdit = this.permissionInputEdit - 1
          this.roleEditData.permissions.pop()
        }
      }
    },
    fillRoleEditData: function (param) { 
      this.roleEditData = param;
      this.permissionInputEdit = param.permissions.length;
    },
    async getRolePermission() {
      const rolePermission = await axios.get('/api/role-permissions?isFormat=true');
      this.items = rolePermission.data;
    },
    async createRolePermission() {
      this.$Progress.start();
      await axios.post("/api/role-permissions", this.roleData)
        .then((response) => {
          Swal.fire({
            icon: "success",
                title: "Congratulations",
                text: "Success New sales order",
            });
            location.reload();
        })
        .catch((error) => {
            this.$Progress.fail();
            Swal.fire({
                icon: "warning",
                title: "Something wrong.",
                confirmButtonText: `Ok`,
                html: `There is something wrong on my side. Please click ok to refresh this page and see what is it. If it still exist, you can contact our developer. <br><br>Error message: ` + error,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        });
    },
    async updateRolePermission() {
      this.$Progress.start();
      await axios.patch("/api/role-permissions/update", this.roleEditData)
        .then((response) => {
          Swal.fire({
            icon: "success",
                title: "Congratulations",
                text: "Success New sales order",
            });
            location.reload();
        })
        .catch((error) => {
            this.$Progress.fail();
            Swal.fire({
                icon: "warning",
                title: "Something wrong.",
                confirmButtonText: `Ok`,
                html: `There is something wrong on my side. Please click ok to refresh this page and see what is it. If it still exist, you can contact our developer. <br><br>Error message: ` + error,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        });
    },
    async deleteRolePermission(param, isDelete) {
      if (!isDelete) {
        this.tempDelete = param;
      }
      else {
        this.$Progress.start();
        await axios.delete("/api/role-permissions/delete/" + this.tempDelete.roleId)
          .then((response) => {
            Swal.fire({
              icon: "success",
                  title: "Congratulations",
                  text: "Success delete permission",
              });
              location.reload();
          })
          .catch((error) => {
              this.$Progress.fail();
              Swal.fire({
                  icon: "warning",
                  title: "Something wrong.",
                  confirmButtonText: `Ok`,
                  html: `There is something wrong on my side. Please click ok to refresh this page and see what is it. If it still exist, you can contact our developer. <br><br>Error message: ` + error,
              }).then((result) => {
                  if (result.isConfirmed) {
                      location.reload();
                  }
              });
          });
      }
    }
  },
};
</script>

<style scoped>
  table th, table td { 
    border-left:.5px solid #dddddd !important;  
    border-bottom:.5px solid #dddddd !important;
  }
  table tr:first-child td:last-child {
    border-right:.5px solid #dddddd !important;  
  }
  .modal-header, .modal-footer {
    border: none !important;
  }
  .modal-body {
    max-height: 35em;
    overflow: auto;
  }
  tr:hover {
    background-color: transparent !important;
  }
</style>