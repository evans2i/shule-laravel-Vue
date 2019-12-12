<template>
  <div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">stream Table</h3>
            <a @click="newModal" class="btn btn-primary pull-right">
              <i class="fa fa_add"></i>Add new stream
            </a>
          </div>
          <!-- /.box-header -->
          <!-- <stream-show :streams="streams"></stream-show> -->
          <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Student of the Class</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(stream, index) in streams['stream']" :key="stream.id">
                  <td>{{ index+1 }}</td>
                  <td>{{ stream.name }}</td>
                  <td>
                    <router-link to="/streamsubject" :stream1="stream.id">
                      <i class="fa fa-books"></i>
                      <span>Subject in Stream</span>
                    </router-link>
                  </td>

                  <td>
                    <a
                      @click="editModal(stream)"
                      class="btn btn-round btn-warning btn-icon btn-sm edit"
                    >
                      <i class="fa fa-edit"></i>Edit
                    </a>
                    <a
                      @click="deletestream(stream.id)"
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
            <h5 v-show="editmode" class="modal-title" id="addNewLabel">Update stream info</h5>
            <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add New</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updatestream() : createstream()">
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
                <label>levels</label>
                <select
                  name="levels"
                  v-model="form.levels"
                  type="text"
                  id="type"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('levels') }"
                >
                  <option value>Select Class</option>
                  <option
                    v-for="stream in streams['level']"
                    :value=" stream.id "
                    :key="stream.id"
                  >{{stream.name}}</option>
                </select>
                <has-error :form="form" field="levels"></has-error>
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
// import StreamLevel from "./streams/StreamLevel";
// import StreamStaff from "./streams/StreamStaff";

// import StreamStudent from "./streams/StreamStudent";
// import StreamSubject from "./streams/StreamSubject";

export default {
  // components: {
  //   streamsubject: StreamSubject,
  //   streamstudent: StreamStudent,
  //   streamstaff: StreamStaff,
  //   streamlevel: StreamLevel
  // },
  data() {
    return {
      editmode: false,
      submitMode: false,
      streams: {},
      form: new Form({
        id: "",
        name: "",
        levels: "",
        description: ""
      })
    };
  },

  methods: {
    editModal(stream) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(stream);
    },
    showModal(id) {
      $("#showNew").modal("show");
      axios.get("api/streams").then(({ data }) => (this.streams = data.data));
      this.form.fill(stream);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    loadstreams() {
      axios.get("api/streams").then(({ data }) => (this.streams = data));
    },
    deletestream(id) {
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
            .delete("api/streams/" + id)
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
    updatestream() {
      this.$Progress.start();
      this.form
        .put("api/streams/" + this.form.id)
        .then(() => {
          Fire.$emit("AfterCreated");
          $("#addNew").modal("hide");
          Toast.fire({ type: "success", title: "stream Updated successfully" });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            type: "error",
            title: "stream did not Updated successfully"
          });
        });
    },
    createstream() {
      this.$Progress.start();
      this.form
        .post("api/streams")
        .then(() => {
          Fire.$emit("AfterCreated");
          $("#addNew").modal("hide");

          Toast.fire({
            type: "success",
            title: "stream created successfully"
          });

          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            type: "error",
            title: "stream did not created successfully"
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
    this.loadstreams();
    console.log("streams");
    Fire.$on("AfterCreated", () => {
      this.loadstreams();
    });
    //  setInterval(() => this.loadstreams(),3000);
  }
};
</script>