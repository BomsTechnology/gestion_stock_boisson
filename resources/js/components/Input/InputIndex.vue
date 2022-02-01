<template>

<div class="flex flex-col">
    <div class="mb-4 flex justify-between items-center w-full">
      <div>
        <router-link :to="{name:'inputs.create'}" class="px-3 py-2 bg-green-500 text-white rounded-md hover:bg-green-700 text-center"> Effectuer une entrée </router-link >
      </div>
        
        <div class="relative flex items-center">
          <span class="absolute mt-1/2 ml-2 text-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
</svg></span>
          <input type="search" name="search" v-model="searchKey" placeholder="Rechercher un fournisseur"
              class="rounded pl-8 placeholder-gray-700 border-gray-500">
              <span @click="toogleNotif"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 cursor-pointer" :class="{'h-4 w-4 animate-ping text-orange-500': notifications.length != []}" viewBox="0 0 20 20" fill="currentColor">
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
                Nom du Fournisseur
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Montant
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <span class="sr-only">Action</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200" v-if="filteredInputs.length != 0">            
            <tr v-for="input in filteredInputs" :key="input.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900">
                        {{ input.person }}
                    </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                    {{ input.date }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  {{ input.amount }} FCFA
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a :href="'inputs/' + input.id + '/details'" class="px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700"> Détails </a >
              </td>
            </tr>

          </tbody>
        <tr v-else-if="loading != true">
            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-center"
                colspan="4">
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
              <td class="px-6 py-4 whitespace-nowrap text-center" colspan="4">
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
import useInputs from "../../services/inputservices.js";
import Notification from "../Modal/Notification.vue";
import useNotification from "../../services/notificationservices.js";


export default {
  components: {  Notification },
    data () {
      return {
        searchKey: '' ,
        show_notif: false,
      }
    },
    setup(){
        const {inputs, getInputs, loading } = useInputs();
        const { checkNotification, notifications} = useNotification();
        return{
            inputs,
            getInputs,
            loading,
            checkNotification,
            notifications
        }
    },
    methods: {
        toogleNotif() {
        this.show_notif = !this.show_notif;
      },
    },
  computed: {
    filteredInputs() {
       let filteredByProvider =  this.inputs.filter((input) => {
            return input.person.toLowerCase().includes(this.searchKey.toLowerCase());
        })

        if(filteredByProvider.length != 0){
          return filteredByProvider;

        }else{
            return this.inputs.filter((input) => {
            return input.id.toLowerCase().includes(this.searchKey.toLowerCase());
        });
        }
    },
  },
    mounted () {
      this.getInputs();
      this.checkNotification();
  },
}
</script>