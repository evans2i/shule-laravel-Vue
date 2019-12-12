export default class Gate {
    constructor(user) {
        this.user = user;
    }

    isAdmin() {
        return this.user.role === 'administrator';
    }

    isStaff() {
        return this.user.role === 'staff';
    }

    isStudent() {
        return this.user.role === 'student';
    }

    isHr() {
        return this.user.role === 'hr';
    }
}
