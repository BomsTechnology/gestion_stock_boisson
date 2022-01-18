<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased" id="app">
    <div class="min-h-screen bg-gray-100">

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
                    {{-- <div class="p-6 bg-white border-b border-gray-200"> --}}
                        <div class="py-4 relative">
                            <div class="text-sm absolute left-25">
                              <a href="/inputs"
                                    class="bg-blue-500  flex text-white tracking-widest p-1 px-2 rounded shadow-md  items-center">
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
                                    <div class="text-2xl font-semibold tracking-widest"> <h2>N° facture : {{ $move->id }}</h2> </div>
                                    <div class="mt-4">
                                        <div class="md:mt-0 md:col-span-2">
                                              <div class="shadow overflow-hidden sm:rounded-md">
                                                <div class="px-4 py-5 bg-white sm:p-6">
                                                    <div class="col-span-6 sm:col-span-3 mb-3 text-xl font-bold">
                                                        <span for="country" class="text-gray-900 px-2">Date : {{ $move->created_at }}</span>
                                                        <span for="country" class="text-gray-500 px-2">Nom Fournisseur : {{ $person->name }}</span>
                                                        <span class="px-2 text-gray-500">Contact : {{ $person->contact }}</span>
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
                                                                            <?php $sum = 0 ?>
                                                                            @forelse ($move->drinks as $drink)
                                                                                <tr>
                                                                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium  text-gray-900">
                                                                                        {{ $drink->id }}
                                                                                    </td>
                                                                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                                                                        {{ $drink->name }}
                                                                                    </td>
                                                                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                                                                        {{ $drink->pivot->price }}
                                                                                    </td>
                                                                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                                                                        {{ $drink->pivot->quantity }}
                                                                                    </td>
                                                                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                                                                        {{ floatval($drink->pivot->price) * floatval($drink->pivot->quantity) }}
                                                                                    </td>
                                                                                </tr>
                                                                                <?php $sum += floatval($drink->pivot->price) * floatval($drink->pivot->quantity) ?>
                                                                            @empty
                                                                                
                                                                            @endforelse
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
                                                                <input type="text"  value="{{ $sum }}" readonly class="w-full shadow-sm sm:text-sm border-none rounded-md">
                                                                </div>
                                                                <div class="inline-block  px-1 mt-2">
                                                                <button onclick="window.print()" class="text-purple-600 hover:text-purple-900 w-full bg-purple-100 rounded p-2" onClick="window.print()">imprimé</button>
                                                            </div>
                                                        </div>
                                                      
                                                
                                              </div>
                    
                                        </div>
                                      </div>
                                    </div>
                            </div>
                        </div>
                        </div>
                    {{-- </div> --}}
                {{-- </div> --}}
            </div>
        </div>


    </div>
</body>

</html>
