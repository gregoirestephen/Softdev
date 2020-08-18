import Vue from 'vue'
import VueRouter from 'vue-router'
import dashbord from "../view/dashbord";


Vue.use(VueRouter)


const routes = [
    { path: '/home', name: 'Dashboard', component: dashbord },

];

const router= new VueRouter({
    mode:'history',
    base: process.env.BASE_URL,
    routes

});

export default router;
