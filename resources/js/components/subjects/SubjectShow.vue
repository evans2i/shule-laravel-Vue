

<template>
  <div>
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <!-- <profile class="profile-user-profile profile-responsive profile-circle" src="../../dist/profile/user4-128x128.jpg" alt="User profile picture"> -->

              <h3 class="profile-username text-center">{{ subject.name }}</h3>

              <p class="text-muted text-center">{{ subject.slug }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b>
                  <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b>
                  <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b>
                  <a class="pull-right">13,287</a>
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
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#activity" data-toggle="tab">Activity</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <!-- <profile class="profile-circle profile-bordered-sm" src="../../dist/profile/user1-128x128.jpg" alt="user image"> -->
                    <span class="username">
                      <a href="#">Jonathan Burke Jr.</a>
                      <a href="#" class="pull-right btn-box-tool">
                        <i class="fa fa-times"></i>
                      </a>
                    </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>
                  <ul class="list-inline">
                    <li>
                      <a href="#" class="link-black text-sm">
                        <i class="fa fa-share margin-r-5"></i> Share
                      </a>
                    </li>
                    <li>
                      <a href="#" class="link-black text-sm">
                        <i class="fa fa-thumbs-o-up margin-r-5"></i> Like
                      </a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm">
                        <i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)
                      </a>
                    </li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment" />
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <!-- <profile class="profile-circle profile-bordered-sm" src="../../dist/profile/user7-128x128.jpg" alt="User Image"> -->
                    <span class="username">
                      <a href="#">Sarah Ross</a>
                      <a href="#" class="pull-right btn-box-tool">
                        <i class="fa fa-times"></i>
                      </a>
                    </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>

                  <form class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                        <input class="form-control input-sm" placeholder="Response" />
                      </div>
                      <div class="col-sm-3">
                        <button
                          type="submit"
                          class="btn btn-danger pull-right btn-block btn-sm"
                        >Send</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <!-- <profile class="profile-circle profile-bordered-sm" src="../../dist/profile/user6-128x128.jpg" alt="User Image"> -->
                    <span class="username">
                      <a href="#">Adam Jones</a>
                      <a href="#" class="pull-right btn-box-tool">
                        <i class="fa fa-times"></i>
                      </a>
                    </span>
                    <span class="description">Posted 5 photos - 5 days ago</span>
                  </div>

                  <ul class="list-inline">
                    <li>
                      <a href="#" class="link-black text-sm">
                        <i class="fa fa-share margin-r-5"></i> Share
                      </a>
                    </li>
                    <li>
                      <a href="#" class="link-black text-sm">
                        <i class="fa fa-thumbs-o-up margin-r-5"></i> Like
                      </a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm">
                        <i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)
                      </a>
                    </li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment" />
                </div>
                <!-- /.post -->
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
      subject: {},
      editing: false
    };
  },

  methods: {
    getsubject() {
      axios
        .get(`/api/subjects/${this.$route.params.slug}`)
        .then(res => (this.subject = res.data.data));
    }
  },
  created() {
    // this.listen()
    this.getsubject();
  }
};
</script>

<style scoped>
</style>