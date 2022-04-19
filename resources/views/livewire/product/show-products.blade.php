<div wire:init="loadProducts">
    @if ($message)
        <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="mt-2 fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                    <p class="font-bold">Nuevo Aviso...</p>
                    <p>{{ $message }}</p>
                </div>
                <button type="button" class="ml-auto -mx-1.5 mt-2 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg wire:click="closeAlert" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  </button>
            </div>
        </div>
    @endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="container mx-auto py-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <div class="px-6 py-4 bg-gray-200 flex items-center">
                        <x-jet-input class="w-full mr-4" placeholder="BUSCAR..." type="text" wire:model="search"/>
                        <x-jet-danger-button class="focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 transition bg-green-400 hover:bg-green-500 active:bg-green-600 disabled:opacity-25" wire:click="$set('open_create', true)">
                            CREAR
                        </x-jet-danger-button>
                    </div>
                    @if (count($products))
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
                                <th wire:click="order('name')" class="cursor-pointer px-4 py-3">
                                    nombre
                                    @if ($sort == 'name')
                                        @if ($dir == 'asc')
                                            <i class="fa fa-sort-asc float-right mt-2" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-sort-desc float-right" aria-hidden="true"></i>
                                        @endif
                                    @else
                                        <i class="fa fa-sort float-right mt-1" aria-hidden="true"></i>
                                    @endif
                                </th>
                                <th wire:click="order('description')" class="cursor-pointer px-4 py-3">
                                    descripción
                                    @if ($sort == 'description')
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
                                    Categoria
                                </th>
                                <th wire:click="order('status')" class="cursor-pointer px-4 py-3">
                                    Estado
                                    @if ($sort == 'status')
                                        @if ($dir == 'asc')
                                            <i class="fa fa-sort-asc float-right mt-2" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-sort-desc float-right" aria-hidden="true"></i>
                                        @endif
                                    @else
                                        <i class="fa fa-sort float-right mt-1" aria-hidden="true"></i>
                                    @endif
                                </th>
                                <th wire:click="order('price')" class="cursor-pointer px-4 py-3">
                                    Precio
                                    @if ($sort == 'price')
                                        @if ($dir == 'asc')
                                            <i class="fa fa-sort-asc float-right mt-2" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-sort-desc float-right" aria-hidden="true"></i>
                                        @endif
                                    @else
                                        <i class="fa fa-sort float-right mt-1" aria-hidden="true"></i>
                                    @endif
                                </th>
                                <th wire:click="order('tax')" class="cursor-pointer px-4 py-3">
                                    Impuesto
                                    @if ($sort == 'tax')
                                        @if ($dir == 'asc')
                                            <i class="fa fa-sort-asc float-right mt-2" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-sort-desc float-right" aria-hidden="true"></i>
                                        @endif
                                    @else
                                        <i class="fa fa-sort float-right mt-1" aria-hidden="true"></i>
                                    @endif
                                </th>
                                <<th wire:click="order('stock')" class="cursor-pointer px-4 py-3">
                                    stock
                                    @if ($sort == 'stock')
                                        @if ($dir == 'asc')
                                            <i class="fa fa-sort-asc float-right mt-2" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-sort-desc float-right" aria-hidden="true"></i>
                                        @endif
                                    @else
                                        <i class="fa fa-sort float-right mt-1" aria-hidden="true"></i>
                                    @endif
                                </th>
                                <th wire:click="order('created_at')" class="cursor-pointer px-4 py-3">
                                    creación
                                    @if ($sort == 'created_at')
                                        @if ($dir == 'asc')
                                            <i class="fa fa-sort-asc float-right mt-2" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-sort-desc float-right" aria-hidden="true"></i>
                                        @endif
                                    @else
                                        <i class="fa fa-sort float-right mt-1" aria-hidden="true"></i>
                                    @endif
                                </th>
                                <th class="px-4 py-3 text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($products as $item)
                                    <tr class="text-gray-700">
                                        <td class="px-4 text-center py-3 text-ms font-semibold border">{{$item->id}}</td>
                                        <td class="px-4 py-3 border">
                                        <div class="flex items-center text-sm">
                                            <div class="mr-2 overflow-hidden rounded-lg w-8 h-8 bg-gray-50 border border-gray-200">
                                                @if ($product->image)
                                                    <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{ Storage::url($product->image) }}" alt="">
                                                @else
                                                    <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="https://www.eluniverso.com/resizer/JmanqxXU51w1Bsa0X0Nd9iz1cSM=/660x371/smart/filters:quality(70)/cloudfront-us-east-1.images.arcpublishing.com/eluniverso/ZYX6AFU7OBH7PBXUTCXQEICJ7E.jpg" alt="">
                                                @endif                                            </div>
                                            <div>
                                                <p class="font-semibold text-black">{{Str::limit($item->name, 10)}}</p>
                                            </div>
                                        </div>
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">{{Str::limit($item->description, 70)}}</td>
                                        <td class="px-2 py-3 text-ms font-semibold border">
                                            @foreach ($item->categories as $item->category)
                                                <li>{{ $item->category->name }}</li>
                                            @endforeach
                                        </td>
                                        <td class="px-1 py-3 text-xs border text-center">
                                            @if ($item->status == 'activo')
                                                <span class="px-4 mx-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">{{ strtoupper($item->status) }}</span>
                                            @else
                                                <span class="px-4 mx-2 py-1 font-semibold leading-tight bg-orange-400 text-white rounded-sm">{{ strtoupper($item->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-3 text-ms font-semibold border text-center">${{$item->price}}</td>
                                        <td class="px-12 py-3 text-ms font-semibold border text-center">{{$item->tax}}%</td>
                                        <td class="px-10 py-3 text-ms font-semibold border text-center">{{$item->stock}}</td>
                                        <td class="px-10 py-3 text-sm border text-center">{{$item->created_at->format('d-m-Y')}}</td>
                                        <td class="px-1 py-3 text-sm border text-center">
                                            <x-jet-secondary-button wire:click="edit({{ $item->id }})" class="bg-gray-200 m-1">
                                                EDITAR
                                            </x-jet-secondary-button>
                                        </td>
                                    </tr>
                                @endforeach    
                            </tbody>
                        </table>
                        @if ($products->hasPages())
                            <div class="bg-gray-100 px-4">
                                {{ $products->links() }}
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

    @if (count($products))
        <x-jet-dialog-modal wire:model="open_edit">
            
            <x-slot name="title">
                EDITAR PRODUCTO
            </x-slot>
            
            <x-slot name="content">
                <div wire:loading wire:target="image" class="w-full flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                    <p>Subiendo Archivo.</p>
                </div>
                
                @if ($image)
                    <img class="mb-2" src="{{ $image->temporaryUrl() }}">
                @endif

                <div class="my-2">
                    <x-jet-label value="NOMBRE"/>
                    <x-jet-input type="text" wire:model="product.name" class="w-full"/>
                    <x-jet-input-error for="product.name"/>
                </div>

                <div class="my-2">
                    <x-jet-label value="DESCRIPCCIÓN"/>
                    <x-jet-input type="text" wire:model="product.description" class="w-full"/>
                    <x-jet-input-error for="product.description"/>
                </div>

                <div class="my-2">
                    <x-jet-label value="PRECIO"/>
                    <x-jet-input type="text" wire:model="product.price" class="w-full"/>
                    <x-jet-input-error for="product.price"/>
                </div>

                <div class="my-2">
                    <x-jet-label value="IMPUESTO"/>
                    <x-jet-input type="text" wire:model="product.tax" class="w-full"/>
                    <x-jet-input-error for="product.tax"/>
                </div>

                <div class="my-2">
                    <x-jet-label value="STOCK"/>
                    <x-jet-input type="text" wire:model="product.stock" class="w-full"/>
                    <x-jet-input-error for="product.stock"/>
                </div>

                <div class="my-2">
                    <x-jet-label value="ESTADO" />
                    <select wire:model="product.status" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="document_type">
                        <option value="activo" {{ old('status', $item->status) == ' activo' ? 'selected' : '' }}>ACTIVO</option>
                        <option value="inactivo" {{ old('status', $item->status) == 'inactivo' ? 'selected' : '' }}>INACTIVO</option>
                    </select>
                </div>

                <div class="my-2">
                    <input type="file" wire:model="image" id="{{ $identifier }}">
                    <x-jet-input-error for="image"/>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button class="mr-4" wire:click="$set('open_edit', false)">
                    CANCELAR
                </x-jet-secondary-button>
                <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update, image" class="focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 transition bg-green-400 hover:bg-green-500 active:bg-green-600 disabled:opacity-25">
                    GUARDAR
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

        <x-jet-dialog-modal wire:model="open_create">
            <x-slot name="title">
                CREAR PRODUCTO
            </x-slot>
            <x-slot name="content">
                <div wire:loading wire:target="image" class="w-full flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                    <p>Subiendo Archivo.</p>
                </div>
                
                @if ($image)
                    <img class="mb-2" src="{{ $image->temporaryUrl() }}">
                @endif

                <div class="my-2">
                    <x-jet-label value="NOMBRE"/>
                    <x-jet-input type="text" wire:model="name" class="w-full"/>
                    <x-jet-input-error for="name"/>
                </div>

                <div class="my-2">
                    <x-jet-label value="DESCRIPCCIÓN"/>
                    <x-jet-input type="text" wire:model="description" class="w-full"/>
                    <x-jet-input-error for="description"/>
                </div>

                <div class="my-2">
                    <x-jet-label value="CATEGORIAS" />
                    @foreach ($allCategories as $id => $name)
                        <x-jet-input type="checkbox" wire:model="selectedCategories.{{ $id }}" value="{{$id}}" />
                        {{$name}}
                        <br>
                    @endforeach
                    <x-jet-input-error for="selectedCategories"/>
                </div>

                <div class="my-2">
                    <x-jet-label value="PRECIO"/>
                    <x-jet-input type="text" wire:model="price" class="w-full"/>
                    <x-jet-input-error for="price"/>
                </div>

                <div class="my-2">
                    <x-jet-label value="IMPUESTO"/>
                    <x-jet-input type="text" wire:model="tax" class="w-full"/>
                    <x-jet-input-error for="tax"/>
                </div>

                <div class="my-2">
                    <x-jet-label value="STOCK"/>
                    <x-jet-input type="text" wire:model="stock" class="w-full"/>
                    <x-jet-input-error for="stock"/>
                </div>
                
                <div class="my-2">
                    <input type="file" wire:model="image" id="{{ $identifier }}">
                    <x-jet-input-error for="image"/>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button class="mr-4" wire:click="$set('open_create', false)">
                    CANCELAR
                </x-jet-secondary-button>
                <x-jet-danger-button wire:click="create" wire:loading.attr="disabled" wire:target="create, image" class="focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 transition bg-green-400 hover:bg-green-500 active:bg-green-600 disabled:opacity-25">
                    CREAR
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>