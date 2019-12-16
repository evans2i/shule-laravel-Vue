
export default [
    // { path: '/dashboard', component:  require('./components/Dashboard.vue').default },
    {path: '/students',component: require('./components/Student.vue').default},
    {path: '/addstudents',component: require('./components/students/AddStudent.vue').default},
    {path: '/students/:slug',component: require('./components/students/StudentShow.vue').default},
    
    
    {path: '/users',component: require('./components/User.vue').default},

    {path: '/app-profile',component: require('./components/Profile.vue').default},

    {
        path: '/staffs',
        component: require('./components/Staff.vue').default
    },
    {
        path: '/streams',
        component: require('./components/Stream.vue').default
    },


    {path: '/streams',component: require('./components/Stream.vue').default},
    {path: '/streamsubject',component: require('./components/streams/StreamSubject.vue').default},
    {path: '/streamstudent',component: require('./components/streams/StreamStudent.vue').default},
    {path: '/streamstaff',component: require('./components/streams/StreamStaff.vue').default},
    {path: '/streamlevel',component: require('./components/streams/StreamLevel.vue').default},


    {
        path: '/streams',
        component: require('./components/Stream.vue').default
    },

    {
        path: '/levels',
        component: require('./components/Level.vue').default
    },
    {
        path: '/subjects',
        component: require('./components/Subject.vue').default
    },
    {
        path: '/subjects/:slug',
        component: require('./components/subjects/SubjectShow.vue').default
    },


    {
        path: '/passport-clients',
        component: require('./components/passport/Clients.vue').default
    },


    {
        path:'/authorized-clients',
        component:require('./components/passport/AuthorizedClients.vue').default
    },

    {
        path:'/access-tokens',
        component:require('./components/passport/PersonalAccessTokens.vue').default
    },


    {
        path: '/*',
        component: require('./components/NotFound.vue').default
    },
];
