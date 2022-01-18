<template>
<div class="py-4 relative">
        <div class="text-sm absolute left-25">
          <a href="/inputs"
                class="bg-blue-500 text-white tracking-widest p-1 px-2 rounded shadow-md flex items-center">
                <span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
                <span class="ml-2">
                    Home
                </span>
            </a >
        </div>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-none rounded-r-md p-2 bg-white">
                <div class="text-2xl font-semibold tracking-widest"> <h2>N° facture : </h2> </div>
                <div class="mt-4">
                    <div class="md:mt-0 md:col-span-2">
                          <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="col-span-6 sm:col-span-3 mb-3 text-xl font-bold">
                                    <span for="country" class="text-gray-900 px-2">Date : </span>
                                    <span for="country" class="text-gray-500 px-2">Nom Fournisseur : </span>
                                    <span class="px-2 text-gray-500">Contact : </span>
                                  </div>

                                <div class="col-span-6 sm:col-span-4 mb-3">
                                  <label for="" class="block text-sm font-medium text-gray-700">Liste des produits</label>
                                    <div class="col-span-6 mt-2">
                                        <div class="flex flex-col">
                                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Id
                                                          </th>
                                                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                              Name
                                                            </th>
                                                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Price
                                                          </th>
                                                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Quantity
                                                          </th>
                                                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Amount
                                                          </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">

                                                            <tr>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium  text-gray-900">
                                                                    
                                                                </td>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                                                    
                                                                </td>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                                                    
                                                                </td>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                                                    
                                                                </td>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                                                    
                                                                </td>
                                                            </tr>
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2 grid justify-items-end">
                                            <div>
                                                <h1 class="font-bold">Montant Total :</h1>
                                            <input type="text"  value="" readonly class="w-full shadow-sm sm:text-sm border-none rounded-md">
                                            </div>
                                            <div class="inline-block  px-1 mt-2">
                                            <button  class="text-purple-600 hover:text-purple-900 w-full bg-purple-100 rounded p-2" onClick="window.print()">imprimé</button>
                                        </div>
                                    </div>
                                  
                            
                          </div>

                    </div>
                  </div>
                </div>
        </div>
    </div>
    </div>
 

</template>
// <script>
// import { onMounted } from 'vue';

// import useInputs from "../../services/inputservices.js";

// export default {
//     props: {
//           id : {
//               required: true,
//               type: String
//           }
//       },
//     setup(props){
//         const { details, drinkList } = useInputs();

//         onMounted(details(props.id));
        
//         return{
//             drinkList,
//             details
//         }
//     },
//     methods: {

//     },
// }
// </script>