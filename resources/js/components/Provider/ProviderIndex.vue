<template>
<ConfirmModal :open="show" :toogleModal="toogleModal" :validateModal="validateModal"/>
    <div class="flex flex-col">
        <div class="mb-4 flex justify-between w-full">
          <div>
            <router-link :to="{name : 'providers.create'}" class="py-2 px-3 bg-green-500 text-white rounded-lg hover:bg-green-700 text-center"> Ajouter un fournisseur </router-link >
            </div>
            <div class="relative">
          <span class="absolute mt-3 ml-2 text-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
</svg></span>
          <input type="search" name="search" v-model="searchKey" placeholder="Rechercher un fournisseur"
              class="rounded pl-8 placeholder-gray-700 border-gray-500">
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
          <tbody class="bg-white divide-y divide-gray-200" v-for="provider in filteredList" :key="provider.id">
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900">
                      {{ provider.name }}
                    </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ provider.contact }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <router-link :to="{name: 'providers.edit', params: { id: provider.id }}" class="px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700"> Modifier </router-link >
                <button @click="toogleModal(provider.id)" class="px-2 py-1 ml-2 bg-red-500 text-white rounded-md hover:bg-red-700"> Supprimer </button>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import { onMounted } from 'vue';
import useProviders from "../../services/providerservices.js";
import ConfirmModal from "../Modal/ConfirmModal.vue";

export default {
  components: { ConfirmModal },
    data () {
      return {
        show: false,
        s_id: '',
        searchKey: '' ,
      }
    },
    setup(){
        const {providers, getProviders, destroyProvider } = useProviders();

        const deleteProvider = async (id) => {
          await destroyProvider(id);
          await getProviders();
        }

        return{
            providers,
            deleteProvider,
            getProviders
        }
    },
    methods: {
      toogleModal(id) {
        this.show = !this.show;
        this.s_id = id;
      },
      validateModal() {
            this.deleteProvider(this.s_id);
            this.show = !this.show;
        }
    },
    computed: {
    filteredList() {
        return this.providers.filter((provider) => {
            return provider.name.toLowerCase().includes(this.searchKey.toLowerCase());
        })
    },
  },
    mounted () {
  this.getProviders();
  },
}
</script>