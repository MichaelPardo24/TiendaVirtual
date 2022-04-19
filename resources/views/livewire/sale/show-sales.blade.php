<div wire:init="loadSales">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="container mx-auto py-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <div class="px-6 py-4 bg-gray-200 flex items-center">
                        <x-jet-input class="w-full mr-4" placeholder="BUSCAR..." type="text" wire:model="search"/>
                    </div>
                    @if (count($sales))
                        <table class="w-full">
                            <thead>
                                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-300 uppercase border-b border-gray-600">
                                    <th wire:click="order('id')" class="cursor-pointer px-4 py-3">
                                        ID
                                        @if ($sort == 'id')
                                            @if ($dir == 'asc')
                                                <i class="fa fa-sort-asc float-right mt-2" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-sort-desc float-right" aria-hidden="true"></i>
                                            @endif
                                        @else
                                            <i class="fa fa-sort float-right mt-1" aria-hidden="true"></i>
                                        @endif
                                    </th>
                                    <th class="px-4 py-3 text-center">
                                        cliente
                                    </th>
                                    <th class="px-4 py-3 text-center">
                                        Producto
                                    </th>
                                    <th class="px-4 py-3 text-center">
                                        Precio
                                    </th>
                                    <th wire:click="order('total')" class="cursor-pointer px-4 py-3">
                                        SUB TOTAL + IMPUESTOS
                                        @if ($sort == 'total')
                                            @if ($dir == 'asc')
                                                <i class="fa fa-sort-asc float-right mt-2" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-sort-desc float-right" aria-hidden="true"></i>
                                            @endif
                                        @else
                                            <i class="fa fa-sort float-right mt-1" aria-hidden="true"></i>
                                        @endif
                                    </th>
                                    <th wire:click="order('created_At')" class="cursor-pointer px-4 py-3">
                                        Fecha Venta
                                        @if ($sort == 'created_At')
                                            @if ($dir == 'asc')
                                                <i class="fa fa-sort-asc float-right mt-2" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-sort-desc float-right" aria-hidden="true"></i>
                                            @endif
                                        @else
                                            <i class="fa fa-sort float-right mt-1" aria-hidden="true"></i>
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($sales as $sale)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-ms font-semibold border">{{$sale->id}}</td>
                                        <td class="px-4 py-3 border">
                                            <div class="flex items-center text-sm">
                                                <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full" src="{{$sale->user->profile_photo_url}}" alt="" loading="lazy" />
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-black">{{$sale->user->names}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-3 text-sm border text-center">{{$sale->product->name}}</td>
                                        <td class="px-1 py-3 font-semibold text-sm border text-center">$ {{$sale->product->price}}</td>
                                        <td class="px-1 py-3 font-bold text-sm border text-center">$  {{$sale->total}}</td>
                                        <td class="px-1 py-3 text-sm border text-center">{{$sale->created_at->format('d-m')}}</td>
                                    </tr>
                                @endforeach    
                            </tbody>
                        </table>
                        @if ($sales->hasPages())
                            <div class="bg-gray-100 px-4">
                                {{ $sales->links() }}
                            </div>
                        @endif
                    @else
                        <div class="px-6 py-4 bg-gray-200">
                            Ningun registro coincide
                        </div>
                    @endif  
                </div>
            </div>
          </section>
    </div>
</div>
