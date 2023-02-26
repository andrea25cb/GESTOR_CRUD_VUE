import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../components/HomeView.vue'

import FiltrarDatos from '../components/FiltrarDatos.vue'
import EditarUsuario from '../components/EditarUsuario.vue'
import EditarPoliza from '../components/EditarPoliza.vue'
import EditarCliente from '../components/EditarCliente.vue'
import ListarUsuarios from '../components/ListarUsuarios.vue'
import ListarPolizas from '../components/ListarPolizas.vue'
import ListarClientes from '../components/ListarClientes.vue'
import CrearUsuario from '../components/CrearUsuario.vue'
import CrearPoliza from '../components/CrearPoliza.vue'
import CrearCliente from '../components/CrearCliente.vue'
// import DetallesUsuario from '../components/DetallesUsuario.vue'
// import DetallesPoliza from '../components/DetallesPoliza.vue'
import DetallesCliente from '../components/DetallesCliente.vue'
// import LoginForm from '../components/LoginForm.vue'


Vue.use(VueRouter)
    //importa el component desde una vista, quiere cargar una vista
const routes = [

    {
        path: '/',
        name: 'login',
        component: () =>
            import ('@/components/LoginForm.vue'),
        meta: {
            hideNavbar: true,
        }
    },

    {
        path: '/homeView',
        name: 'homeView',
        component: HomeView
    },
    {
        path: '/filtrarDatos',
        name: 'filtrarDatos',
        component: FiltrarDatos
    },

    {
        path: '/crearUsuario',
        name: 'crearUsuario',
        component: CrearUsuario,

    },
    {
        path: '/crearPoliza',
        name: 'crearPoliza',
        component: CrearPoliza,

    },
    {
        path: '/crearCliente',
        name: 'crearCliente',
        component: CrearCliente,

    },
    {
        path: '/listarUsuarios',
        name: 'listarUsuarios',
        component: ListarUsuarios,

    },
    {
        path: '/listarPolizas',
        name: 'listarPolizas',
        component: ListarPolizas,

    },
    {
        path: '/listarClientes',
        name: 'listarClientes',
        component: ListarClientes,

    },
    {
        path: '/detallesCliente',
        name: 'detallesCliente',
        component: DetallesCliente,

    },
    {
        path: '/editarUsuario',
        name: 'editarUsuario',
        component: EditarUsuario,

    },
    {
        path: '/editarPoliza',
        name: 'editarPoliza',
        component: EditarPoliza,

    },
    {
        path: '/editarCliente',
        name: 'editarCliente',
        component: EditarCliente,

    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router