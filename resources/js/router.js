import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Pages
import NotFound from './views/NotFound'
import Login from './views/Login'
import Logout from './views/Logout'
import Dashboard from './views/Dashboard'
import Assets from './views/FixedAssets'
import AddNotDocument from './views/clients/AddNotDocument'

//certificado de diplomados
import AddGraduateCertificate from './views/document/AddGraduateCertificate'

import Welcome from './views/Welcome'
import Home from './views/Home'
import Layout from './views/Layout'

//bienes e inventarios

//clientes 
import LoginClient from './views/clients/Login'
import DashboardClient from './views/clients/Dashboard'
//import { component } from 'vue/types/umd'

// Routes
const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            children: [
                { path: '', name: 'layout', component: Layout },
            ],
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/client', name: 'loginclient', component: LoginClient
        },
        {
            path: '/client/:id', name: 'dashboardclient', component: DashboardClient,
            children: [
                { path: '', name: 'welcome2', component: Welcome },
                { path: 'nodebt', name: 'addnotdocument2', component: AddNotDocument },
            ],

        },

        {
            path: '/logout',
            name: 'logout',
            component: Logout,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/api', // /dashboard  /api/assets /api/profiles
            name: 'dashboard',
            component: Dashboard,
            children: [
                // UserHome will be rendered inside User's <router-view>
                // when /user/:id is matched0
                { path: '', name: 'welcome', component: Welcome },
                { path: 'assets', name: 'assets', component: Assets },
                // enlaces para administrar los usuarios
                { path: 'users', name: 'users', component: Users },
                { path: 'user/add', name: 'adduser', component: AddUser },
                { path: 'user/:id', name: 'edituser', component: EditUser },
                { path: 'user/show', name: 'showuser', component: ShowUser },
                { path: 'user/profiles', name: 'edituserprofiles', component: EditUserProfiles },

                // enlaces para administrar las personas
                { path: 'persons', name: 'persons', component: Persons },
                { path: 'person/add', name: 'addperson', component: AddPerson },
                { path: 'person/:id', name: 'editperson', component: EditPerson },

                { path: 'addgraduatecertificate', name: 'addgraduatecertificate' , component: AddGraduateCertificate },

                //enlaces para la administracion de paginas de tesoreria
                { path: 'solvency', name: 'solvency', component: Solvency }, // solvencias
                { path: 'salestudents', name: 'salestudents', component: SaleStudents }, //dia de alumnos nuevos
                { path: 'salestudents/:id', name: 'students', component: Students }, //alumnos nuevos
                { path: 'appenddebtors', name: 'appenddebtors', component: AppendDebtors }, //dia de deudores
                { path: 'appenddebtors/:id', name: 'debtors', component: Debtors }, // deudores
                { path: 'documentsfixedassets', name: 'documentsfixedassets', component: DocumentsFixedAssets }, //lista de documentos de entrega activos fijos
                { path: 'documentsfixedassets/:id', name: 'selectedFixedAssetsByDocument', component: SelectedFixedAssetsByDocument }, // documentos de entrega activos fijos impresion
                { path: 'historytransactions', name: 'historytransactions', component: HistoryTransactions }, // historial de transacciones por persona
            ],
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/404',
            name: '404',
            component: NotFound,
        },
        {
            path: '*',
            redirect: '/404',
        },
    ],
});

export default router