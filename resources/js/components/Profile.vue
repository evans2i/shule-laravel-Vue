<template>
    <div>
            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle" :src="profilePhoto()" alt="User profile picture">

                                <h3 v-if="user.name" class="profile-username text-center">{{user.name}}</h3>

                                <p v-if="user.role" class="text-muted text-center">{{user.role}}</p>

                                <ul class="list-group list-group-unbordered">
                                    <li v-if="user.gender" class="list-group-item">
                                        <b>{{user.gender}}</b>
                                    </li>
                                    <li v-if="user.role" class="list-group-item">
                                        <b>{{user.role}}</b>
                                    </li>
                                    <li v-if="user.phone" class="list-group-item">
                                        <b>{{user.phone}}</b>
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{user.email}}</b>
                                    </li>
                                    <li v-if="user.address" class="list-group-item">
                                        <b>{{user.address}}</b>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <h1 class="heading">Change your detail here</h1>
                        <div class="nav-tabs-custom">
                            <div class="tab-content">
                                <div id="timeline">
                                    <!-- /.tab-pane -->
                                        <form class="form-horizontal" >
                                            <!-- name field -->
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                                <div class="col-sm-10">
                                                    <input v-model="form.name" type="text" name="name" class="form-control" id="inputName" :placeholder="user.name">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                                                <div class="col-sm-10">
                                                    <input v-model="form.last_name" type="text" name="last_name" class="form-control" id="inputName" :placeholder="user.last_name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-2 control-label">Middle Name</label>

                                                <div class="col-sm-10">
                                                    <input v-model="form.middle_name" type="text" name="middle_name" class="form-control" id="inputName" :placeholder="user.middle_name">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                                <div class="col-sm-10">
                                                    <input v-model="form.email" type="email" name="email" class="form-control" id="inputEmail" :placeholder="user.email">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="Phone" class="col-sm-2 control-label">Phone</label>

                                                <div class="col-sm-10">
                                                    <input type="text" v-model="form.phone" name="phone"  class="form-control" id="inputPhone" :placeholder="user.phone">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress" class="col-sm-2 control-label">Address</label>

                                                <div class="col-sm-10">
                                                    <input type="text" v-model="form.address" name="address" class="form-control" id="inputAddress" :placeholder="user.address">
                                                </div>
                                            </div>

                                            <!-- img field -->
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-2 control-label">Image</label>

                                                <div class="col-sm-10">
                                                    <input  type="file" name="img" @change="updatephoto" class="form-control" :placholder="user.img">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" @click.prevent="updateInfo" class="btn btn-primary" >Update changes</button>
                                                    <!-- :disabled='isDisabled' -->
                                                </div>
                                            </div>
                                        </form>
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </section>
            <!-- /.content -->
    </div>
</template>

<script>


    export default {
        data() {
            return {
                user: {},
                form: new Form({
                    id: "",
                    name: "",
                    last_name: "",
                    middle_name: "",
                    email: "",
                    phone: "",
                    address: "",
                    img: "",
                    password: ""
                })
            }
        },

        methods: {

            profilePhoto(){
                return 'profile/' + this.user.img;
            },

            updatephoto(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                if (file['size'] < 2111775) {
                    reader.onloadend = (file) => {
                        this.form.img = reader.result;
                    }
                    reader.readAsDataURL(file);
                }
                else {
                    // this.$Progress.fail();
                    Toast.fire({
                        type: "error",
                        title: "The file your uploading is large than 2 Megabyte"
                    });
                }

            },

            updateInfo(){
                this.$Progress.start();
                this.form.put("api/profile")
                    .then(()=>{
                        Fire.$emit("AfterCreated");
                        $("#addNew").modal("hide");
                        Toast.fire({ type: "success", title: "Profile Updated successfully" });
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        Toast.fire({
                            type: "error",
                            title: "Profile did not Updated successfully"
                        });
                    });
            },
            loadUsers(){
                axios.get("api/profile")
                    .then(({data})=>(this.user = data))
                    .then(this.form.fill(user));
            }
        },



        created() {
            this.loadUsers()
            Fire.$on("AfterCreated", () => {
                this.loadUsers();
            });
        },
    }

</script>
<style scoped>

    .heading{
        text-align: center;
        background-color: #0b93d5;
        text-transform: uppercase;
        text-decoration: #ffffff;
        color:white;
    }
</style>

