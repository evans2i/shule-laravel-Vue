<template>
  <div v-if="$gate.isAdmin()">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Table With Full Features</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row">
            <div class="col-sm-6">
              <div class="dataTables_length" id="example1_length">
                <label>
                  Show
                  <select
                    name="example1_length"
                    aria-controls="example1"
                    class="form-control input-sm"
                  >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select> entries
                </label>
              </div>
            </div>
            <div class="col-sm-6">
              <div id="example1_filter" class="dataTables_filter">
                <label>
                  Search:
                  <input
                    type="search"
                    class="form-control input-sm"
                    placeholder
                    aria-controls="example1"
                  />
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <table
                id="example1"
                class="table table-bordered table-striped dataTable"
                role="grid"
                aria-describedby="example1_info"
              >
                <thead>
                  <tr role="row">
                    <th
                      class="sorting_asc"
                      tabindex="0"
                      aria-controls="no"
                      rowspan="0"
                      colspan="0.5"
                      aria-sort="ascending"
                      aria-label="Rendering engine: activate to sort column descending"
                      style="width: 20px;"
                    >No</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="name"
                      rowspan="0"
                      colspan="1"
                      aria-label="name: activate to sort column ascending"
                      style="width: 381px;"
                    >Name</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="email"
                      rowspan="0"
                      colspan="1"
                      aria-label="email: activate to sort column ascending"
                      style="width: 150px;"
                    >Email</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="phone"
                      rowspan="1"
                      colspan="1"
                      aria-label="phone: activate to sort column ascending"
                      style="width: 153px;"
                    >Phone</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="example1"
                      rowspan="1"
                      colspan="1"
                      aria-label="CSS grade: activate to sort column ascending"
                      style="width: 113px;"
                    >Status</th>

                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="example1"
                      rowspan="1"
                      colspan="1"
                      aria-label="CSS grade: activate to sort column ascending"
                      style="width: 130px;"
                    >Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(student, index) in students" :key="student.id" role="row" class="odd">
                    <td class="sorting_1">{{ index + 1 }}</td>
                    <td id="name">
                      <router-link
                        :to="student.path"
                        class="btn btn-round btn-success btn-icon btn-sm eye"
                      >{{ student.name }} {{ student.last_name }} {{ student.middle_name }}</router-link>
                    </td>
                    <td>{{ student.email }}</td>
                    <td>{{ student.phone }}</td>
                    <td>{{ student.status }}</td>
                    <td>
                      <a
                        @click="editModal(student)"
                        class="btn btn-round btn-warning btn-icon btn-sm edit"
                      >
                        <i class="fa fa-edit"></i>Edit
                      </a>
                      <a
                        @click="deletestudent(student.id)"
                        class="btn btn-round btn-danger btn-icon btn-sm remove"
                      >
                        <i class="fa fa-times"></i>Delete
                      </a>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th rowspan="1" colspan="1">No</th>
                    <th rowspan="1" colspan="1">Name</th>
                    <th rowspan="1" colspan="1">email</th>
                    <th rowspan="1" colspan="1">Phone</th>
                    <th rowspan="1" colspan="1">Status</th>
                    <th rowspan="1" colspan="1">Actions</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-5">
              <div
                class="dataTables_info"
                id="example1_info"
                role="status"
                aria-live="polite"
              >Showing 1 to 10 of 57 entries</div>
            </div>
            <div class="col-sm-7">
              <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                <ul class="pagination">
                  <li class="paginate_button previous disabled" id="example1_previous">
                    <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
                  </li>
                  <li class="paginate_button active">
                    <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a>
                  </li>
                  <li class="paginate_button">
                    <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a>
                  </li>
                  <li class="paginate_button">
                    <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a>
                  </li>
                  <li class="paginate_button">
                    <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a>
                  </li>
                  <li class="paginate_button">
                    <a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a>
                  </li>
                  <li class="paginate_button">
                    <a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a>
                  </li>
                  <li class="paginate_button next" id="example1_next">
                    <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
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
      studentField: false,
      userField: true,
      students: {},
      form: new Form({
        id: "",
        name: "",
        last_name: "",
        middle_name: "",
        email: "",
        phone: "",
        address: "",
        img: "",
        gender: "",
        parent_name: "",
        parent_work: "",
        birth_date: "",
        status: "",
        date_registered: "",
        stream_id: ""
      })
    };
  },

  methods: {
    showField() {
      this.studentField = true;
      this.userField = false;
    },
    editModal(student) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(student);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    loadstudents() {
      axios.get("api/students").then(({ data }) => (this.students = data.data));
    },
    deletestudent(id) {
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
            .delete("api/students/" + id)
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
    updatestudent() {
      this.$Progress.start();
      this.form
        .put("api/students/" + this.form.id)
        .then(() => {
          Fire.$emit("AfterCreated");
          $("#addNew").modal("hide");
          Toast.fire({
            type: "success",
            title: "student Updated successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            type: "error",
            title: "student did not Updated successfully"
          });
        });
    },
    createstudent() {
      this.$Progress.start();
      this.form
        .post("api/students")
        .then(() => {
          Fire.$emit("AfterCreated");
          $("#addNew").modal("hide");

          Toast.fire({
            type: "success",
            title: "student created successfully"
          });

          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            type: "error",
            title: "student did not created successfully"
          });
        });
    }
  },

  computed: {
    isDisabled: function() {
      if (
        !this.form.name ||
        !this.form.email ||
        !this.form.last_name ||
        !this.form.middle_name ||
        !this.form.gender
      ) {
        return !this.submitMode;
      }
    }
  },
  created() {
    this.loadstudents();
    console.log("students");
    Fire.$on("AfterCreated", () => {
      this.loadstudents();
    });
    //  setInterval(() => this.loadstudents(),3000);
  }
};
</script>