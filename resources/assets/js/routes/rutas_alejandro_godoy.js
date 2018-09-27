
import NotFound from '../components/404.vue'
//loged

import Home from "../components/Home/Home";

import Bryanv from "../components/Home/bryanv";
import Proyecto from "../components/Home/proyecto"
import Tarea from "../components/Home/David/tarea"
import Flujo from "../components/Home/mexi/gantt/gantt";

const url_proy = '/proyecto/:id/';

let routes_bryan_vidal = [

{
    path: '/home',
    component: Home,
    redirect:'index',
    iconCls: 'el-icon-message',
    meta: {auth: true},
    children: [
        { 
            path: '/bryanv', component: Bryanv, name: 'Bryanv' 
        },

        { 
            path: url_proy, component: Proyecto, name: 'Proyecto',redirect:url_proy+'tareas',
            children:[
                { path:url_proy+'tareas', component: Tarea, name: 'Tarea' },
                { path:url_proy+'flujo', component: Flujo, name: 'Flujo' }
            ]
        },
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

export default routes_bryan_vidal;