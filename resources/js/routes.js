
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default
let forget = require('./components/auth/forget.vue').default
let logout = require('./components/auth/logout.vue').default

//logs
let logs = require('./components/logs/index.vue').default

let manage_session = require('./components/sessions/index.vue').default

export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/logout', component: logout, name: 'forget' },
    { path: '/manage_session', component: manage_session, name: 'manage_session' },
    { path: '/logs', component: logs, name: 'logs' },
]


