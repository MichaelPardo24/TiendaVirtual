<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="px-5 pt-5">
            <div class="mb-5 text-gray-400">
                <a href="{{ route('shop') }}" class="focus:outline-none hover:underline text-gray-500">Inicio</a> / <a href="{{ route('product', $product->id) }}" class="focus:outline-none hover:underline text-gray-500">Producto</a> / <span class="text-gray-600">Compra</span>
            </div>
        </div>
        <div class="w-full bg-white border-t border-b border-gray-200 px-5 py-10 text-gray-800">
            <div class="w-full">
                <div class="-mx-3 md:flex items-start">
                    <div class="px-3 md:w-7/12 lg:pr-10">
                        <div class="w-full mx-auto text-gray-800 font-light mb-6 border-b border-gray-200 pb-6">
                            <div class="w-full flex items-center">
                                <div class="overflow-hidden rounded-lg w-16 h-16 bg-gray-50 border border-gray-200">
                                    @if ($product->image)
                                        <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{ Storage::url($product->image) }}" alt="">
                                    @else
                                        <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="https://www.eluniverso.com/resizer/JmanqxXU51w1Bsa0X0Nd9iz1cSM=/660x371/smart/filters:quality(70)/cloudfront-us-east-1.images.arcpublishing.com/eluniverso/ZYX6AFU7OBH7PBXUTCXQEICJ7E.jpg" alt="">
                                    @endif
                                </div>
                                <div class="flex-grow pl-3">
                                    <h6 class="font-semibold uppercase text-gray-600">{{ $product->name }}</h6>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-600 text-xl">{{ $product->price }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-6 pb-6 border-b border-gray-200 text-gray-800">
                            <div class="w-full flex mb-3 items-center">
                                <div class="flex-grow">
                                    <span class="text-gray-600">Subtotal</span>
                                </div>
                                <div class="pl-3">
                                    <span class="font-semibold">{{ $product->price }}</span>
                                </div>
                            </div>
                            <div class="w-full flex items-center">
                                <div class="flex-grow">
                                    <span class="text-gray-600">Impuestos</span>
                                </div>
                                <div class="pl-3">
                                    <span class="font-semibold">{{ $product->price * $product->tax / 100 }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6 pb-6 border-b border-gray-200 md:border-none text-gray-800 text-xl">
                            <div class="w-full flex items-center">
                                <div class="flex-grow">
                                    <span class="text-gray-600">Total</span>
                                </div>
                                <div class="pl-3">
                                    <span class="font-semibold text-gray-400 text-sm">COP</span> <span class="font-semibold"> {{ ($product->price * $product->tax / 100) + $product->price}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-3 md:w-5/12">
                        <form action="{{ route('confirmPayment', $product->id) }}" method="GET">
                            @csrf
                            <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 text-gray-800 font-light mb-6">
                                <div class="w-full p-3 border-b border-gray-200">
                                    <div class="mb-5">
                                        <label for="type1" class="flex items-center cursor-pointer">
                                            <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-6 ml-3">
                                        </label>
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Nombre en la tarjeta</label>
                                            <div>
                                                <input name="name" value="{{ old('name') }}" class="w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="Nombre" type="text"/>
                                                <x-jet-input-error for="name" class="mt-2 ml-4" />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Numero de tarjeta</label>
                                            <div>
                                                <input name="num" value="{{ old('num') }}" class="w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="0000 0000 0000 0000" type="text"/>
                                                <x-jet-input-error for="num" class="mt-2 ml-4" />
                                            </div>
                                        </div>
                                        <div class="mb-3 mx-2 flex items-end">
                                            <div class="px-2 w-1/4">
                                                <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Fecha de expiración</label>
                                                <div>
                                                    <select name="expirationMonth" value="{{ old('expirationMonth') }}" class="form-select w-full px-1 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                                                        <option value="01" {{ old('expirationMonth') == '01' ? 'selected' : '' }}>01 - Ene</option>
                                                        <option value="02" {{ old('expirationMonth') == '02' ? 'selected' : '' }}>02 - Feb</option>
                                                        <option value="03" {{ old('expirationMonth') == '03' ? 'selected' : '' }}>03 - Mar</option>
                                                        <option value="04" {{ old('expirationMonth') == '04' ? 'selected' : '' }}>04 - Abr</option>
                                                        <option value="05" {{ old('expirationMonth') == '05' ? 'selected' : '' }}>05 - May</option>
                                                        <option value="06" {{ old('expirationMonth') == '06' ? 'selected' : '' }}>06 - Jun</option>
                                                        <option value="07" {{ old('expirationMonth') == '07' ? 'selected' : '' }}>07 - Jul</option>
                                                        <option value="08" {{ old('expirationMonth') == '08' ? 'selected' : '' }}>08 - Ago</option>
                                                        <option value="09" {{ old('expirationMonth') == '09' ? 'selected' : '' }}>09 - Sep</option>
                                                        <option value="10" {{ old('expirationMonth') == '10' ? 'selected' : '' }}>10 - oct</option>
                                                        <option value="11" {{ old('expirationMonth') == '11' ? 'selected' : '' }}>11 - Nov</option>
                                                        <option value="12" {{ old('expirationMonth') == '12' ? 'selected' : '' }}>12 - Dic</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="px-2 w-1/4">
                                                <select name="expirationYear" class="form-select w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                                                    <option value="2022" {{ old('expirationYear') == '2022' ? 'selected' : '' }}>2022</option>
                                                    <option value="2023" {{ old('expirationYear') == '2023' ? 'selected' : '' }}>2023</option>
                                                    <option value="2024" {{ old('expirationYear') == '2024' ? 'selected' : '' }}>2024</option>
                                                    <option value="2025" {{ old('expirationYear') == '2025' ? 'selected' : '' }}>2025</option>
                                                    <option value="2026" {{ old('expirationYear') == '2026' ? 'selected' : '' }}>2026</option>
                                                    <option value="2027" {{ old('expirationYear') == '2027' ? 'selected' : '' }}>2027</option>
                                                    <option value="2028" {{ old('expirationYear') == '2028' ? 'selected' : '' }}>2028</option>
                                                    <option value="2029" {{ old('expirationYear') == '2029' ? 'selected' : '' }}>2029</option>
                                                </select>
                                            </div>
                                            <div class="px-2 w-1/4">
                                                <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Codigo de seguridad</label>
                                                <div>
                                                    <input name="securityCode" value="{{ old('securityCode') }}" class="w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="000" type="text"/>
                                                </div>
                                            </div>
                                        </div>
                                        <x-jet-input-error for="securityCode" class="mt-2 ml-4" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="block w-full max-w-xs mx-auto bg-gray-500 hover:bg-gray-700 focus:bg-gray-700 text-white rounded-lg px-3 py-2 font-semibold"><i class="mdi mdi-lock-outline mr-1"></i> Realizar Pago</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>