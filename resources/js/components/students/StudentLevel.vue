<template>
  <!-- /.col -->
  <div class="col-md-8">
    <div class="row">
      <a @click="newModal" class="btn btn-default pull-right">
        <div v-for="result in results">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green">
                <i class="fa fa-flag-o"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-number">Show the Resut of {{ result.name }}</span>
                <span class="info-box-number">410</span>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <!-- /.tab-content -->

    <!-- /.nav-tabs-custom -->

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
            <h5 class="modal-title" id="addNewLabel">Result For</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.col -->
</template>

<script>
export default {
  props: ["results"],
  data() {
    return {};
  },
  methods: {
    newModal() {
      $("#addNew").modal("show");
    }
  }
};
</script>

<style>
</style>