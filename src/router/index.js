import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'

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
import LoginForm from '../components/LoginForm.vue'

// import LogoutForm from '../components/RegisterForm.vue'

Vue.use(VueRouter)
    //importa el component desde una vista, quiere cargar una vista
const routes = [

    {
        path: '/',
        name: 'login',
        component: LoginForm
    },

    {
        path: '/homeView',
        name: 'homeView',
        component: HomeView
    },

    {
        path: '/crearUsuario',
        name: 'crearUsuario',
        component: CrearUsuario,
        meta: { requireAuth: true }
    },
    {
        path: '/crearPoliza',
        name: 'crearPoliza',
        component: CrearPoliza,
        meta: { requireAuth: true }
    },
    {
        path: '/crearCliente',
        name: 'crearCliente',
        component: CrearCliente,
        meta: { requireAuth: true }
    },
    {
        path: '/listarUsuarios',
        name: 'listarUsuarios',
        component: ListarUsuarios,
        meta: { requireAuth: true }
    },
    {
        path: '/listarPolizas',
        name: 'listarPolizas',
        component: ListarPolizas,
        meta: { requireAuth: true }
    },
    {
        path: '/listarClientes',
        name: 'listarClientes',
        component: ListarClientes,
        meta: { requireAuth: true }
    },
    // {
    //     path: '/detallesUsuario',
    //     name: 'detallesUsuario',
    //     component: DetallesUsuario,
    //     meta: { requireAuth: true }
    // },
    // {
    //     path: '/detallesPoliza',
    //     name: 'detallesPoliza',
    //     component: DetallesPoliza,
    //     meta: { requireAuth: true }
    // },
    {
        path: '/detallesCliente',
        name: 'detallesCliente',
        component: DetallesCliente,
        meta: { requireAuth: true }
    },
    {
        path: '/editarUsuario',
        name: 'editarUsuario',
        component: EditarUsuario,
        meta: { requireAuth: true }
    },
    {
        path: '/editarPoliza',
        name: 'editarPoliza',
        component: EditarPoliza,
        meta: { requireAuth: true }
    },
    {
        path: '/editarCliente',
        name: 'editarCliente',
        component: EditarCliente,
        meta: { requireAuth: true }
    },

    // {
    //     path: '/logout',
    //     name: 'logout',
    //     component: LogoutForm
    // },
    // {
    //     path: '/register',
    //     name: 'register',
    //     component: RegisterForm
    // },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router