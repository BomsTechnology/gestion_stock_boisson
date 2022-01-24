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
              <span><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
            </svg></span>
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
                      <!-- <span v-for="provider in providers" :key="provider.id">
                        <span v-if="provider.id == input.provider"> -->
                        {{ input.person }}
                        <!-- </span></span> -->
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
                <!-- <router-link :to="{name: 'inputs.details', params: { id: input.id }}" class="px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700"> Détails </router-link > -->
                <!-- <button  class="px-2 py-1 ml-2 bg-red-500 text-white rounded-md hover:bg-red-700"> Supprimer </button> -->
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
import { onMounted } from 'vue';
import useInputs from "../../services/inputservices.js";


export default {
    data () {
      return {
        searchKey: '' ,
      }
    },
    setup(){
        const {inputs, getInputs } = useInputs();
        return{
            inputs,
            getInputs,
        }
    },
    methods: {
        
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
  },
}
</script>