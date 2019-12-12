<template>
	
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Name</th>
	                  <th>Email</th>
	                  <th>Phone</th>
	                  <th>address</th>
	                  <th>roles</th>
	                  <th>Action</th>
	                </tr>
                </thead>
                <tbody>
	                <tr v-for="(user, index) in users">
	                	<td>{{ index+1 }}</td>
	                  <td>{{ user.name }}</td>
	                  <td>{{ user.email }}</td>
	                  <td>{{ user.phone }}</td>
	                  <td> {{ user.address }}</td>
	                  <td>{{ user.role }}</td>
	                  <td>
	                  		<a @click="editModal(user)" class="btn btn-round btn-warning btn-icon btn-sm edit"><i class="fa fa-edit"></i>Edt</a>
                           	<a @click="deleteUser(user.id)" class="btn btn-round btn-danger btn-icon btn-sm remove"><i class="fa fa-times"></i>Del</a>
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
	                  <th>roles</th>
	                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            
         
</template>

<script>
export default {
	props:['users'],
	data(){
		return {
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
            })
        }
	},
	methods: {
		editModal(user){
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(user);
        },
	},
}	
</script>