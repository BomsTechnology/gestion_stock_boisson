<template>
    <div class="flex flex-col">
    <div class="mb-4 flex justify-between items-center w-full">
        <div class="flex items-center">
      <div>
        <router-link :to="{name:'outputs.create'}" class="px-3 py-2 bg-green-500 text-white rounded-md hover:bg-green-700 text-center"> Effectuer une sortie </router-link >
      </div>
      <div class="mx-2">
        <router-link :to="{name:'inputs.create'}" class="px-3 py-2 bg-green-500 text-white rounded-md hover:bg-green-700 text-center"> Effectuer une entrée </router-link >
      </div> 
      <div class="relative">
          <span class="absolute mt-3 ml-2 text-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
</svg></span>
          <input type="search" name="search" v-model="searchKey" placeholder="Recherche"
              class="rounded pl-8 placeholder-gray-700 border-gray-500">
      </div>   
      </div>
      <div>
         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
            </svg>
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
                Type
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
          <tbody class="bg-white divide-y divide-gray-200" v-if="filteredList.length != 0">            
            <tr v-for="move in filteredList" :key="move.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900">
                      <!-- <span v-for="customer in customers" :key="customer.id">
                        <span v-if="customer.id == output.customer"> -->
                        {{ move.person }}
                        <!-- </span></span> -->
                    </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                    {{ move.type }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                    {{ move.date }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  {{ move.amount }} FCFA
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" v-if="move.type == 'Sorties'">
                <a :href="'outputs/' + move.id + '/details'" class="px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700"> Détails </a >
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" v-else>
                <a :href="'inputs/' + move.id + '/details'" class="px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700"> Détails </a >
              </td>
            </tr>
            

          </tbody>
         
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
import useDashboard from "../../services/transactionservices.js";
import useNotification from "../../services/notificationservices.js";

export default {
  props: {
          id : {
              required: true,
              type: String
          }
      },
  data() {
    return{
      searchKey: ''
    }
  },
  setup(props) {

    const { getRecents, moves} = useDashboard();
    const { checkNotification, notifications} = useNotification();

    return {
      getRecents,
      moves,
      checkNotification,
      notifications
    };

  },
  computed: {
  filteredList() {
          return this.moves.filter((move) => {
              return move.person.toLowerCase().includes(this.searchKey.toLowerCase());
          });
      },
  },
  mounted() {
    this.getRecents();
  },
  
}
</script>