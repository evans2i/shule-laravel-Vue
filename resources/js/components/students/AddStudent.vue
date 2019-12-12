<template>
  <div>
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Quick Example</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form @submit.prevent="createstudent()" role="form">
          <div class="box-body">
            <div class="form-group col-md-4 col-sm-14 col-xs-4">
              <label>Your First Name</label>
              <input
                v-model="form.name"
                type="text"
                name="name"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('name') }"
                placeholder="First_name"
              />
              <has-error :form="form" field="name"></has-error>
            </div>
            <div class="form-group col-md-4 col-sm-14 col-xs-4">
              <label for="exampleInputEmail1">Student Last Name</label>
              <input
                v-model="form.last_name"
                type="text"
                name="last_name"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('last_name') }"
                placeholder="Your last name"
              />
              <has-error :form="form" field="last_name"></has-error>
            </div>

            <div class="form-group col-md-4 col-sm-14 col-xs-4">
              <label>Your Middle Name</label>
              <input
                v-model="form.middle_name"
                type="text"
                name="middle_name"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('middle_name') }"
                placeholder="Your middle name"
              />
              <has-error :form="form" field="middle_name"></has-error>
            </div>
            <div class="form-group col-md-6 col-sm-12 col-xs-6">
              <label>Your Email</label>
              <input
                v-model="form.email"
                type="text"
                name="email"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('email') }"
                placeholder="Email address"
              />
              <has-error :form="form" field="email"></has-error>
            </div>
            <div class="form-group col-md-6 col-sm-12 col-xs-6">
              <label>Parent/Mlezi name</label>
              <input
                v-model="form.parent_name"
                type="text"
                name="parent_name"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('parent_name') }"
                placeholder="parent name"
              />
              <has-error :form="form" field="parent_name"></has-error>
            </div>
            <div class="form-group col-md-6 col-sm-12 col-xs-6">
              <label>Parent Phone</label>
              <input
                v-model="form.phone"
                type="text"
                name="phone"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('phone') }"
                placeholder="phone"
              />
              <has-error :form="form" field="phone"></has-error>
            </div>

            <div class="form-group col-md-6 col-sm-12 col-xs-6">
              <label>Parent work</label>
              <input
                v-model="form.parent_work"
                type="text"
                name="parent_work"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('parent_work') }"
                placeholder="Parent work"
              />
              <has-error :form="form" field="parent_work"></has-error>
            </div>

            <div class="form-group col-md-6 col-sm-12 col-xs-6">
              <label>birth date</label>
              <input
                v-model="form.birth_date"
                type="date"
                name="birth_date"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('birth_date') }"
                placeholder="birth date"
              />
              <has-error :form="form" field="birth_date"></has-error>
            </div>

            <div class="form-group col-md-6 col-sm-12 col-xs-6">
              <label>date registered</label>
              <input
                v-model="form.date_registered"
                type="date"
                name="date_registered"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('date_registered') }"
                placeholder="birth date"
              />
              <has-error :form="form" field="date_registered"></has-error>
            </div>

            <div class="form-group col-md-6 col-sm-12 col-xs-6">
              <label>Status</label>
              <select
                name="gender"
                v-model="form.status"
                type="text"
                id="type"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('status') }"
              >
                <option value>Select status</option>
                <option value="active">Active</option>
                <option value="passive">Passive</option>
              </select>
              <has-error :form="form" field="status"></has-error>
            </div>

            <div class="form-group col-md-6 col-sm-12 col-xs-6">
              <label>Parent Address</label>
              <input
                v-model="form.address"
                type="text"
                name="address"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('address') }"
                placeholder=" address"
              />
              <has-error :form="form" field="address"></has-error>
            </div>

            <div class="form-group col-md-6 col-sm-12 col-xs-6">
              <label>Gender</label>
              <select
                name="gender"
                v-model="form.gender"
                type="text"
                id="type"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('gender') }"
              >
                <option value>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
              <has-error :form="form" field="gender"></has-error>
            </div>

            <div class="form-group col-md-6 col-sm-12 col-xs-6">
              <label>stream_id</label>
              <select
                name="stream_id"
                v-model="form.stream_id"
                type="text"
                id="type"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('stream_id') }"
              >
                <option value>Select Class</option>
                <option
                  v-for="stream in streams"
                  :value=" stream.id "
                  :key="stream.id"
                >{{stream.name}}</option>
              </select>
              <has-error :form="form" field="stream_id"></has-error>
            </div>

            <div class="form-group">
              <label for="exampleInputFile">Student Photo</label>
              <input type="file" id="exampleInputFile" />
              <p class="help-block">Example block-level help text here.</p>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="modal-footer">
            <button :disabled="isDisabled" type="submit" class="btn btn-primary">Save changes</button>
            <!-- :disabled='isDisabled' -->
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      submitMode: false,
      streams: {},
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
    loadStaff() {
      axios.get("api/streams").then(({ data }) => (this.streams = data.data));
    },
    createstudent() {
      this.$Progress.start();
      this.form
        .post("api/students")
        .then(() => {
          Fire.$emit("AfterCreated");
          this.form.reset();
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
        !this.form.gender ||
        !this.form.phone ||
        !this.form.parent_name ||
        !this.form.birth_date ||
        !this.form.date_registered ||
        !this.form.stream_id
      ) {
        return !this.submitMode;
      }
    }
  },
  created() {
    this.loadStaff();
  }
};
</script>