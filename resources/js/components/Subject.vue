<template>
  <div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">subject Table</h3>
            <a @click="newModal" class="btn btn-primary pull-right">
              <i class="fa fa_add"></i>Add new subject
            </a>
          </div>
          <!-- /.box-header -->
          <!-- <subject-show :subjects="subjects"></subject-show> -->
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
                <tr v-for="(subject, index) in subjects" :key="subject.id">
                  <td>{{ index+1 }}</td>
                  <td>{{ subject.name }}</td>
                  <td>
                    <a
                      @click="editModal(subject)"
                      class="btn btn-round btn-warning btn-icon btn-sm edit"
                    >
                      <i class="fa fa-edit"></i>Edit
                    </a>
                    <router-link
                      :to="subject.path"
                      class="btn btn-round btn-success btn-icon btn-sm eye"
                    >
                    <i class="fa fa-eye"></i>Show
                    </router-link>

                    <a
                      @click="deletesubject(subject.id)"
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
            <h5 v-show="editmode" class="modal-title" id="addNewLabel">Update subject info</h5>
            <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add New</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updatesubject() : createsubject()">
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
import SubjectShow from "./subjects/SubjectShow";
export default {
  components: {
    showsubject: SubjectShow
  },
  data() {
    return {
      editmode: false,
      submitMode: false,
      showMode: false,
      subjects: {},
      subject1: {},
      form: new Form({
        id: "",
        name: "",
        description: ""
      })
    };
  },

  methods: {
    editModal(subject) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(subject);
    },
    showModal(id) {
      $("#showNew").modal("show");
      axios
        .get("api/subjects/" + id)
        .then(({ data }) => (this.subject1 = data.data))
        .catch(() => {
          Swal.fire("Not Found!", "not Found.", "danger");
        });
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    loadsubjects() {
      axios.get("api/subjects").then(({ data }) => (this.subjects = data.data));
    },
    deletesubject(id) {
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
            .delete("api/subjects/" + id)
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
    updatesubject() {
      this.$Progress.start();
      this.form
        .put("api/subjects/" + this.form.id)
        .then(() => {
          Fire.$emit("AfterCreated");
          $("#addNew").modal("hide");
          Toast.fire({
            type: "success",
            title: "subject Updated successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            type: "error",
            title: "subject did not Updated successfully"
          });
        });
    },
    createsubject() {
      this.$Progress.start();
      this.form
        .post("api/subjects")
        .then(() => {
          Fire.$emit("AfterCreated");
          $("#addNew").modal("hide");

          Toast.fire({
            type: "success",
            title: "subject created successfully"
          });

          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            type: "error",
            title: "subject did not created successfully"
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
    this.loadsubjects();
    console.log("subjects");
    Fire.$on("AfterCreated", () => {
      this.loadsubjects();
    });
    //  setInterval(() => this.loadsubjects(),3000);
  }
};
</script>