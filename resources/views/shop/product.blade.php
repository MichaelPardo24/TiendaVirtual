<x-app-layout>
    <div class="container mx-auto px-6 py-14">
        <div class="md:flex md:items-center">
            <div class="w-full h-64 md:w-1/2 lg:h-96">
                @if ($product->image)
                    <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{ Storage::url($product->image) }}" alt="">
                @else
                    <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="https://www.eluniverso.com/resizer/JmanqxXU51w1Bsa0X0Nd9iz1cSM=/660x371/smart/filters:quality(70)/cloudfront-us-east-1.images.arcpublishing.com/eluniverso/ZYX6AFU7OBH7PBXUTCXQEICJ7E.jpg" alt="">
                @endif
            </div>
            <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                <h3 class="text-gray-700 uppercase text-lg">{{ $product->name }}</h3>
                <span class="text-gray-500 mt-3">
                    @if (count($product->categories))
                        @foreach ($product->categories as $category)
                            {{ $category->name." | " }}
                        @endforeach  
                    @else
                        Sin Categoria
                    @endif
                </span>
                <hr class="my-3">
                <span class="text-gray-500 mt-3">
                    {{ $product->description }}
                </span>
                <h3 class="text-gray-700 pt-2 uppercase text-2xl">$ {{ $product->price }}</h3>
                <div class="flex items-center mt-6">
                    @if ($product->stock == 0 || $product->status == 'inactivo')
                        <button class="px-8 py-2 bg-gray-600 text-white text-sm font-medium rounded hover:bg-gray-500 focus:outline-none focus:bg-gray-500">Fuera De Servicio</button>
                    @else
                        <a href="{{ route('checkout', $product->id) }}">
                            <button class="px-8 py-2 bg-gray-600 text-white text-sm font-medium rounded hover:bg-gray-500 focus:outline-none focus:bg-gray-500">COMPRAR AHORA</button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="mt-16">
            <h3 class="text-gray-600 text-2xl font-medium">VIDEOJUEGOS SIMILARES</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($similarProducts as $similarProduct)
                    @if ($similarProduct->id == $product->id)
                        @continue
                    @endif
                    <a href="{{ route('product', $similarProduct->id) }}">
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
                                <p class="text-lg font-semibold text-gray-900 mb-0">{{ Str::limit($similarProduct->name, 19) }}</p>
                                <p class="text-md text-gray-800 mt-0">$ {{ $similarProduct->price }}</p>
                                @if (count($similarProduct->categories))
                                <div class="flex">
                                    @foreach ($similarProduct->categories as $category)
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
        </div>
    </div>
</x-app-layout>