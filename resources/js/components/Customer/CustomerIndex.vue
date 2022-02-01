<template>
<ConfirmModal :open="show" :toogleModal="toogleModal" :validateModal="validateModal"/>
<div class="flex flex-col">
  <div class="text-red-500 mb-4" v-if="errors !== ''">
            {{ errors }}
        </div>
    <div class="mb-4 flex justify-between items-center w-full">
      <div>
        <router-link :to="{name:'customers.create'}" class="px-3 py-2 bg-green-500 text-white rounded-md hover:bg-green-700 text-center"> Ajouter un client </router-link >
        </div>
        <div class="relative flex items-center">
          <span class="absolute mt-1/2 ml-2 text-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
</svg></span>
          <input type="search" name="search" v-model="searchKey" placeholder="Rechercher un client"
              class="rounded pl-8 placeholder-gray-700 border-gray-500">
              <span @click="toogleNotif"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 cursor-pointer" :class="{'h-4 w-4 animate-ping text-orange-500 ': notifications.length != []}" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
            </svg></span>
            <Notification :open="show_notif" :notifications="notifications" />
        </div>
    </div>
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">     
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nom
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Contact
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <span class="sr-only">Action</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200" v-if="filteredList.length != 0">
            <tr v-for="customer in filteredList" :key="customer.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900">
                      {{ customer.name }}
                    </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ customer.contact }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <router-link :to="{name: 'transaction.customer', params: { id: customer.id }}" class="px-2 py-1 bg-purple-500 text-white rounded-md hover:bg-purple-700"> Transactions </router-link >
                <router-link :to="{name: 'customers.edit', params: { id: customer.id }}" class="px-2 ml-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700"> Modifier </router-link >
                <button @click="toogleModal(customer.id)" class="px-2 py-1 ml-2 bg-red-500 text-white rounded-md hover:bg-red-700"> Supprimer </button>
              </td>
            </tr>

          </tbody>
        <tr v-else-if="loading != true">
            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-center"
                colspan="3">
                <span class="text-center ">
                    <svg class="animate-spin w-10 h-10 text-blue-500 inline-block"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4335 4335">
                        <path fill="#008DD2"
                            d="M3346 1077c41,0 75,34 75,75 0,41 -34,75 -75,75 -41,0 -75,-34 -75,-75 0,-41 34,-75 75,-75zm-1198 -824c193,0 349,156 349,349 0,193 -156,349 -349,349 -193,0 -349,-156 -349,-349 0,-193 156,-349 349,-349zm-1116 546c151,0 274,123 274,274 0,151 -123,274 -274,274 -151,0 -274,-123 -274,-274 0,-151 123,-274 274,-274zm-500 1189c134,0 243,109 243,243 0,134 -109,243 -243,243 -134,0 -243,-109 -243,-243 0,-134 109,-243 243,-243zm500 1223c121,0 218,98 218,218 0,121 -98,218 -218,218 -121,0 -218,-98 -218,-218 0,-121 98,-218 218,-218zm1116 434c110,0 200,89 200,200 0,110 -89,200 -200,200 -110,0 -200,-89 -200,-200 0,-110 89,-200 200,-200zm1145 -434c81,0 147,66 147,147 0,81 -66,147 -147,147 -81,0 -147,-66 -147,-147 0,-81 66,-147 147,-147zm459 -1098c65,0 119,53 119,119 0,65 -53,119 -119,119 -65,0 -119,-53 -119,-119 0,-65 53,-119 119,-119z" />
                    </svg>
                    <span class="ml-2 text-lg font-semibold text-black">
                        Chargement
                    </span>
                </span>
            </td>
        </tr>
          <tr v-else>
              <td class="px-6 py-4 whitespace-nowrap text-center" colspan="3">
                AUCUN RESULTAT
              </td>
            </tr>
        </table>
      </div>
    </div>
  </div>
</div>

</template>

<script>
import useCustomers from "../../services/customerservices.js";
import useNotification from "../../services/notificationservices.js";
import ConfirmModal from "../Modal/ConfirmModal.vue";
import Notification from "../Modal/Notification.vue";
export default {
    components: { ConfirmModal, Notification },
    data () {
      return {
        show: false,
        s_id: '',
        searchKey: '' ,
        show_notif: false,
      }
    },
    setup(){
        const {customers, getCustomers, destroyCustomer, errors, loading } = useCustomers();
        const { checkNotification, notifications} = useNotification();

        const deleteCustomer = async (id) => {
          await destroyCustomer(id);
          await getCustomers();
        }

        return{
            customers,
            errors,
            deleteCustomer,
            getCustomers,
            loading,
            checkNotification,
            notifications
        }
    },
    methods: {
      toogleModal(id) {
        this.show = !this.show;
        this.s_id = id;
      },
      validateModal() {
            this.deleteCustomer(this.s_id);
            this.show = !this.show;
        },
        toogleNotif() {
      this.show_notif = !this.show_notif;
    },
    },
    computed: {
    filteredList() {
        return this.customers.filter((customer) => {
            return customer.name.toLowerCase().includes(this.searchKey.toLowerCase());
        })
    },
  },
    mounted () {
  this.getCustomers();
  this.checkNotification();
  },
}
</script>