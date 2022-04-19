<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="container mx-auto py-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    @if (count($sales))
                        <table class="w-full">
                            <thead>
                                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-300 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3">
                                        Codigo compra
                                    </th>
                                    <th class="px-4 py-3 text-center">
                                        Producto
                                    </th>
                                    <th class="px-4 py-3 text-center">
                                        Precio
                                    </th>
                                    <th class="px-4 py-3 text-center">
                                        Fecha De Compra
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($sales as $sale)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-ms font-semibold border">{{$sale->id}}</td>
                                        <td class="px-4 py-3 text-ms font-semibold border text-center">{{$sale->product->name}}</td>
                                        <td class="px-4 py-3 text-ms font-semibold border text-center">{{$sale->total}}</td>
                                        <td class="px-1 py-3 text-sm border text-center">{{$sale->created_at->format('d-m-Y')}}</td>
                                    </tr>
                                @endforeach    
                            </tbody>
                        </table>
                    @else
                        <div class="px-6 py-4 bg-gray-200">
                            Aun no haz comprado nada
                        </div>
                    @endif
                </div>
            </div>
          </section>
    </div>
</x-app-layout>