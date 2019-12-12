<template>
  <div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">level Table</h3>
            <a @click="newModal" class="btn btn-primary pull-right">
              <i class="fa fa_add"></i>Add new level
            </a>
          </div>
          <!-- /.box-header -->
          <!-- <level-show :levels="levels"></level-show> -->
          <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(level, index) in levels['level']" :key="level.id">
                  <td>{{ index+1 }}</td>
                  <td>{{ level.name }}</td>
                  <td>
                    <a
                      @click="editModal(level)"
                      class="btn btn-round btn-warning btn-icon btn-sm edit"
                    >
                      <i class="fa fa-edit"></i>Edit
                    </a>
                    <a
                      @click="deletelevel(level.id)"
                      class="btn btn-round btn-danger btn-icon btn-sm remove"
                    >
                      <i class="fa fa-times"></i>Deleted
                    </a>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body @click="newModal" -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>

    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="editmode" class="modal-title" id="addNewLabel">Update level info</h5>
            <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add New</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updatelevel() : createlevel()">
            <div class="modal-body">
              <div class="form-group">
                <label>Your First Name</label>
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                  placeholder="Name of Class"
                />
                <has-error :form="form" field="name"></has-error>
              </div>

              <div class="form-group">
                <label>subjects</label>
                <select
                  name="subjects[]"
                  v-model="form.subjects"
                  id="type"
                  class="form-control select2"
                  data-placeholder="Select a Subjects"
                  style="width: 100%;"
                  :class="{ 'is-invalid': form.errors.has('subjects') }"
                  v-bind:multiple="multiple"
                >
                  <option value>Select Subjects</option>
                  <option
                    v-for="level in levels['subject']"
                    :value=" level.id "
                    :key="level.id"
                  >{{ level.name }}</option>
                </select>
                <has-error :form="form" field="subjects"></has-error>
              </div>
              <!-- /.form-group -->
              <!-- <b-form-select v-model="subjects" :options="levels['subject']" multiple :select-size="4"></b-form-select> -->

              <div class="form-group">
                <label>Description</label>
                <textarea
                  id="submitMode"
                  v-model="form.description"
                  type="description"
                  name="description"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('description') }"
                  placeholder="description"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Update changes</button>
              <button
                :disabled="isDisabled"
                v-show="!editmode"
                type="submit"
                class="btn btn-primary"
              >Save changes</button>
              <!-- :disabled='isDisabled' -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
</style>

<script>
export default {
  data() {
    return {
      editmode: false,
      submitMode: false,
      multiple: true,
      levels: {},
      form: new Form({
        id: "",
        name: "",
        description: "",
        subjects: []
      })
    };
  },

  methods: {
    editModal(level) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(level);
    },
    showModal(id) {
      $("#showNew").modal("show");
      axios.get("api/levels").then(({ data }) => (this.levels = data.data));
      this.form.fill(level);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    loadlevels() {
      axios.get("api/levels").then(({ data }) => (this.levels = data));
    },
    deletelevel(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          this.form
            .delete("api/levels/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              Fire.$emit("AfterCreated");
            })

            .catch(() => {
              Swal.fire("Not Deleted!", "Your file has not deleted.", "danger");
            });
        }
      });
    },
    updatelevel() {
      this.$Progress.start();
      this.form
        .put("api/levels/" + this.form.id)
        .then(() => {
          Fire.$emit("AfterCreated");
          $("#addNew").modal("hide");
          Toast.fire({
            type: "success",
            title: "level Updated successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            type: "error",
            title: "level did not Updated successfully"
          });
        });
    },
    createlevel() {
      this.$Progress.start();
      this.form
        .post("api/levels")
        .then(() => {
          Fire.$emit("AfterCreated");
          $("#addNew").modal("hide");

          Toast.fire({
            type: "success",
            title: "level created successfully"
          });

          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            type: "error",
            title: "level did not created successfully"
          });
        });
    }
  },

  computed: {
    isDisabled: function() {
      if (!this.form.name) {
        return !this.submitMode;
      }
    }
  },
  created() {
    this.loadlevels();
    console.log("levels");
    Fire.$on("AfterCreated", () => {
      this.loadlevels();
    });
    //  setInterval(() => this.loadlevels(),3000);
  }
};
</script>