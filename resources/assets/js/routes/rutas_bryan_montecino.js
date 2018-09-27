
import NotFound from '../components/404.vue'
//loged

import Home from "../components/Home/Home";

import Bryanm from "../components/Home/mexi";

import AppGannt from "../components/Home/mexi/gantt/gantt";

let routes_mexi = [

{
    path: '/home',
    component: Home,
    redirect:'index',
    iconCls: 'el-icon-message',
    meta: {auth: true},
    children: [
        //{ path: '/appgantt', component: AppGannt, name: 'AppGannt' },
        { path: '/bryanm', component: AppGannt, name: 'Bryanm' },
    ]
},
{
        path: '/404',
        component: NotFound,
        name: '',
        hidden: true
    },
    {
        path: '*',
        hidden: true,
        redirect: { path: '/404' }
    }     


];

export default routes_mexi;