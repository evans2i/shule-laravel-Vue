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