<template>
  <div>
  	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">staff Table</h3>
              <a @click="newModal" class=" btn btn-primary pull-right">Add new staff</a>
              	
            </div>  
            <!-- /.box-header -->
  				
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(staff, index) in staffs" :key="staff.id">
                    <td>{{ index+1 }}</td>
                    <td>{{ staff.position }}.{{ staff.name }}</td>
                    <td>{{ staff.email }}</td>
                    <td>{{ staff.phone }}</td>
                    <td> {{ staff.address }}</td>
                    <td> {{ staff.qualification }}</td>
                    <td>
                        <a @click="editModal(staff)" class="btn btn-round btn-warning btn-icon btn-sm edit"><i class="fa fa-edit"></i>Edt</a>
                            <a @click="deletestaff(staff.id)" class="btn btn-round btn-danger btn-icon btn-sm remove"><i class="fa fa-times"></i>Del</a>
                          </td>
                  </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>address</th>
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


     <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 v-show="editmode" class="modal-title" id="addNewLabel">Update staff info</h5>
                  <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add New</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form @submit.prevent="editmode ? updatestaff() : createstaff()">
                  <div class="modal-body row">
                      <div class="form-group col-md-6 col-sm-12 col-xs-6">
                        <label>Your First Name</label>
                        <input v-model="form.name" type="text" name="name"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="First_name" >
                        <has-error :form="form" field="name"></has-error>
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-xs-6">
                        <label>Your Last Name</label>
                        <input v-model="form.last_name" type="text" name="last_name"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('last_name') }" placeholder="Your last name" >
                        <has-error :form="form" field="last_name"></has-error>
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-xs-6">
                        <label>Your Middle Name</label>
                        <input v-model="form.middle_name" type="text" name="middle_name"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('middle_name') }" placeholder="Your middle name" >
                        <has-error :form="form" field="middle_name"></has-error>
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-xs-6">
                        <label>Your Email</label>
                        <input v-model="form.email" type="text" name="email"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Email address" >
                        <has-error :form="form" field="email"></has-error>
                      </div>

                      <div class="form-group col-md-6 col-sm-12 col-xs-6">
                        <label>Parent Phone</label>
                        <input v-model="form.phone" type="text" name="phone"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }" placeholder="phone" >
                        <has-error :form="form" field="phone"></has-error>
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-xs-6">
                        <label>Parent Address</label>
                        <input v-model="form.address" type="text" name="address"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('address') }" placeholder=" address" >
                        <has-error :form="form" field="address"></has-error>
                      </div>

                      <div class="form-group col-md-6 col-sm-12 col-xs-6">
                        <label>Image</label>
                        <input v-model="form.img" type="text" name="img"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('img') }" placeholder=" image " >
                        <has-error :form="form" field="img"></has-error>
                      </div>

                      <div class="form-group col-md-6 col-sm-12 col-xs-6">
                        <label>Gender</label>
                        <select name="gender" v-model="form.gender" type="text"  id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }" >
                          <option value="" >Select Gender</option>
                              <option value="male" >Male</option>
                              <option value="female" >Female</option>
                      </select>   
                        <has-error :form="form" field="gender"></has-error>
                      </div>

                      <div class="form-group col-md-6 col-sm-12 col-xs-6">
                        <label>PassWord</label>
                        <input v-model="form.password" type="password" name="password"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" placeholder="password" >
                          <span>{{  }}</span>
                        <has-error :form="form" field="password"></has-error>
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-xs-6">
                        <label>Confirm Your PassWord</label>
                        <input id='submitMode' v-model="form.password_confirmation" type="password" name="password_confirmation"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" placeholder="confirmation your password" >
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button v-show="editmode" type="submit" class="btn btn-success">Update changes</button>
                      <button :disabled='isDisabled' v-show="!editmode" type="submit" class="btn btn-primary" >Save changes</button>
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
      submitMode:false,
      staffs: [],
      	form: new Form({
    	        id: '',
    	        name: '',
              last_name:'',
              middle_name:'',
    	        email: '',
    	        phone:'',
    	        address:'',
              img:'',
    	        gender:'',
    	        password:'',
              password_confirmation:'',
              parent_name:'',
              parent_work:'',
              birth_date:'',
    	        status:'',
              date_registered:'',
              stream_id:'',
	    })
    };
  },

  methods: {
    editModal(staff){
        this.editmode = true;
        this.form.reset();
        $('#addNew').modal('show');
        this.form.fill(staff);
    },
  	newModal(){
        this.editmode = false;
        this.form.reset();
        $('#addNew').modal('show');
     },
    loadstaffs() {
      axios.get("api/staffs").then(({ data }) => (this.staffs = data.data));
    },
    deletestaff(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.value) {
          this.form.delete('api/staffs/'+id)
          .then(()=>{ Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
          Fire.$emit('AfterCreated');
              })   
              .catch(()=>{
                  Swal.fire(
                        'Not Deleted!',
                        'Your file has not deleted.',
                        'danger'
                      );
              })}
            
          })
    },
    updatestaff(){     
     this.$Progress.start()
       this.form.put('api/staffs/'+this.form.id)
      .then(() =>{
      Fire.$emit('AfterCreated');
      $('#addNew').modal('hide')
      Toast.fire({type: 'success',title: 'staff Updated successfully'})
      this.$Progress.finish() })
      .catch(()=>{
      this.$Progress.fail()            
      Toast.fire({ type: 'error',title: 'staff did not Updated successfully'})
      })           
    },
    createstaff() {
      this.$Progress.start()
        this.form.post('api/staffs')
        .then(() =>{
            Fire.$emit('AfterCreated');
            $('#addNew').modal('hide');

            Toast.fire({
            type: 'success',
            title: 'staff created successfully'
            })

                this.$Progress.finish()
        })
        .catch(()=>{
            Toast.fire({
              type: 'error',
              title: 'staff did not created successfully'
            })
        })    
    }
  },
  
  computed: {
    isDisabled: function(){
      if (!this.form.password_confirmation 
        || !this.form.password 
        || !this.form.name 
        || !this.form.email 
        || !this.form.last_name
        || !this.form.middle_name
        || !this.form.gender
         ) {
        return !this.submitMode;
      }
    },
  },
  created() { 
    this.loadstaffs();
    console.log("staffs");
    Fire.$on("AfterCreated", () => {
      this.loadstaffs();
    });
    //  setInterval(() => this.loadstaffs(),3000);
  }
};
</script>