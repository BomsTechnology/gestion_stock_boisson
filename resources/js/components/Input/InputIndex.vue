<template>

<div class="flex flex-col">
    <div class="mb-4">
        <router-link :to="{name:'inputs.create'}" class="px-3 py-2 bg-green-500 text-white rounded-md hover:bg-green-700 text-center"> Effectuer une entrée </router-link >
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
          <tbody class="bg-white divide-y divide-gray-200" >
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900">
                      
                    </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">

                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <!-- <router-link :to="{name: 'inputs.show', params: { id: '' }}" class="px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700"> Voir </router-link > -->
                <!-- <button  class="px-2 py-1 ml-2 bg-red-500 text-white rounded-md hover:bg-red-700"> Supprimer </button> -->
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</template>
