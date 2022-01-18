import { createRouter, createWebHistory } from "vue-router";
import DashboardIndex from "../components/DashboardIndex.vue";
import CustomerIndex from "../components/Customer/CustomerIndex.vue";
import CustomerCreate from "../components/Customer/CustomerCreate.vue";
import CustomerEdit from "../components/Customer/CustomerEdit.vue";
import ProviderIndex from "../components/Provider/ProviderIndex.vue";
import ProviderCreate from "../components/Provider/ProviderCreate.vue";
import ProviderEdit from "../components/Provider/ProviderEdit.vue";
import InputIndex from "../components/Input/InputIndex.vue";
import InputCreate from "../components/Input/InputCreate.vue";
import InputDetails from "../components/Input/InputDetails.vue";
import OutputIndex from "../components/Output/OutputIndex.vue";
import OutputCreate from "../components/Output/OutputCreate.vue";
import DrinkIndex from "../components/Drink/DrinkIndex.vue";
import DrinkCreate from "../components/Drink/DrinkCreate.vue";
import DrinkEdit from "../components/Drink/DrinkEdit.vue";
import Bilan from "../components/Bilan.vue";


const routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: DashboardIndex
    },
    {
        path: '/customers',
        name: 'customers',
        component: CustomerIndex
    },
    {
        path: '/customers/create',
        name: 'customers.create',
        component: CustomerCreate
    },
    {
        path: '/customers/:id/edit',
        name: 'customers.edit',
        props: true,
        component: CustomerEdit
    },
    {
        path: '/drinks',
        name: 'drinks',
        component: DrinkIndex
    },
    {
        path: '/drinks/create',
        name: 'drinks.create',
        component: DrinkCreate
    },
    {
        path: '/drinks/:id/edit',
        name: 'drinks.edit',
        props: true,
        component: DrinkEdit
    },
    {
        path: '/providers',
        name: 'providers',
        component: ProviderIndex
    },
    {
        path: '/providers/create',
        name: 'providers.create',
        component: ProviderCreate
    },
    {
        path: '/providers/:id/edit',
        name: 'providers.edit',
        props: true,
        component: ProviderEdit
    },
    {
        path: '/inputs',
        name: 'inputs',
        component: InputIndex
    },
    {
        path: '/inputs/create',
        name: 'inputs.create',
        component: InputCreate
    },
    {
        path: '/inputs/:id/details',
        name: 'inputs.details',
        props: true,
        component: InputDetails
    },
    {
        path: '/outputs',
        name: 'outputs',
        component: OutputIndex
    },
    {
        path: '/outputs/create',
        name: 'outputs.create',
        component: OutputCreate
    },
    // {
    //     path: '/outputs/:id/details',
    //     name: 'outputs.details',
    //     props: true,
    //     component: InputDetails
    // },
    {
        path: '/bilan',
        name: 'bilan',
        component: Bilan
    }

]

export default createRouter({
    history: createWebHistory(),
    routes

});