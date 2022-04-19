<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-200 rounded pb-5">
    <div class="flex items-center py-5">
        <h3 class="text-gray-700 text-2xl text-center font-medium">Todos Los Juegos</h3>
        <x-jet-input class="w-full mr-4" placeholder="BUSCAR..." type="text" wire:model="search"/>
    </div>
    <div class="">
        <x-jet-secondary-button class="m-0.5" wire:click="$set('selectCategory', null)">
            Todos
        </x-jet-secondary-button>
        @foreach ($categories as $id => $name)
            <x-jet-secondary-button class="m-0.5 mb-2" wire:click="$set('selectCategory', '{{ $name }}')">
                {{ $name }}
            </x-jet-secondary-button>
        @endforeach
    </div>
    @if (count($products))
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6 mb-5">
            @foreach ($products as $product)
                    <a href="{{ route('product', $product->id) }}">
                        <div class="relative w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden bg-white">
                            <div class="overflow-x-hidden relative">
                                @if ($product->image)
                                    <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{ Storage::url($product->image) }}" alt="">
                                @else
                                    <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="https://www.eluniverso.com/resizer/JmanqxXU51w1Bsa0X0Nd9iz1cSM=/660x371/smart/filters:quality(70)/cloudfront-us-east-1.images.arcpublishing.com/eluniverso/ZYX6AFU7OBH7PBXUTCXQEICJ7E.jpg" alt="">
                                @endif
                            </div>
                            <div class="mt-4 pl-2 mb-2 flex justify-between ">
                            <div>
                                <p class="text-lg font-semibold text-gray-900 mb-0">{{ Str::limit($product->name, 19) }}</p>
                                <p class="text-md text-gray-800 mt-0">$ {{ $product->price }}</p>
                                @if (count($product->categories))
                                <div class="flex">
                                    @foreach ($product->categories as $category)
                                    <p class="m-1 bg-gray-200 hover:bg-gray-300 text-center rounded-full px-2 font-bold text-sm leading-loose">
                                        {{ $category->name}}
                                    </p>
                                    @endforeach
                                </div>
                                @else
                                <p class="m-1 bg-gray-200 hover:bg-gray-300 text-center rounded-full px-2 font-bold text-sm leading-loose">
                                    Sin Categoria
                                </p>
                                @endif
                            </div>
                            </div>
                            <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed opacity-0 hover:opacity-50 transition duration-300 ease-in-out bg-gray-50"></div>
                        </div>
                    </a>
            @endforeach
        </div>
    @else
        <div class="px-6 py-12 text-2xl">
            Desgraciadamente no tenemos un videojuego con esas caracteristicas
        </div>
    @endif
    @if ($products->hasPages())
        <div class="mt-2 px-4 w-full">
            {{ $products->links() }}
        </div>
    @endif
</div>
