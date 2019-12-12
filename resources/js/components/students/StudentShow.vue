<template>
  <div>
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">{{ vans.name }}</h3>

              <p class="text-muted text-center">{{ vans.created_at }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>{{ vans.name }}</b>
                </li>

                <li class="list-group-item">
                  <b>{{ vans.parent_name }}</b>
                </li>
                <li class="list-group-item">
                  <b>{{ vans.last_name }}</b>
                </li>
                <li class="list-group-item">
                  <b>{{ vans.stream }}</b>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block">
                <b>Follow</b>
              </a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div>
          <div class="col-md-8">
            <!-- Application buttons -->
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Application Buttons</h3>
              </div>
              <div class="box-body">
                <p>
                  Add the classes
                  <code>.btn.btn-app</code> to an
                  <code>&lt;a&gt;</code> tag to achieve the following:
                </p>
                <div class="row" v-for="level in levels" :key="level.id">
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <a @click="showResult(level.slug)" class="btn btn-app">
                      <span class="badge bg-green">300</span>
                      <i class="fa fa-barcode"></i>
                      {{ level.name }}
                    </a>
                    <p class="pull-right">
                      Add the classes
                      <code>.btn.btn-app</code> to an
                      <code>&lt;a&gt;</code> tag to achieve the following:
                    </p>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>

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
            <h5 class="modal-title" id="addNewLabel">Update User info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body row">
            <div class="nav-tabs-custom">
              <div class="tab-content">
                <div class="active tab-pane">
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>level</th>
                          <th>subject</th>
                          <th>marks</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="result in results" :key="result.id">
                          <td>{{ result.level }}</td>
                          <td>{{ result.subject }}</td>
                          <td>{{ result.marks }}</td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>level</th>
                          <th>subject</th>
                          <th>marks</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>



<script>
  export default {
    components: {},
    data() {
      return {
        toggle: false,
        levelshow: false,
        vans: {},
        results: [],
        levels: []
      };
    },
    methods: {
      getstudent() {
        axios
          .get(`/api/students/${this.$route.params.slug}`)
          .then(({ data }) => (this.vans = data.data));
      },

      getlevels() {
        axios
          .get(`/api/students/${this.$route.params.slug}/levels`)
          .then(({ data }) => (this.levels = data));
      },
      resultofLevel() {
        axios.get("/api/level");
      },

      showResult(slug) {
        $("#addNew").modal("show");
        axios
          .get(
            `/api/students/${this.$route.params.slug}/levels/` + slug + "/results"
          )
          .then(({ data }) => (this.results = data));
      }
    },
    created() {
      this.getstudent();
      this.getlevels();
      this.showResult();
    }
  };
</script>

<style>
</style>