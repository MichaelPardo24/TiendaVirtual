<div wire:init="loadUsers">
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
                    @if (count($users))
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
                                <th wire:click="order('names')" class="cursor-pointer px-4 py-3">
                                    Nombres
                                    @if ($sort == 'names')
                                        @if ($dir == 'asc')
                                            <i class="fa fa-sort-asc float-right mt-2" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-sort-desc float-right" aria-hidden="true"></i>
                                        @endif
                                    @else
                                        <i class="fa fa-sort float-right mt-1" aria-hidden="true"></i>
                                    @endif
                                </th>
                                <th wire:click="order('email')" class="cursor-pointer px-4 py-3">
                                    Email
                                    @if ($sort == 'email')
                                        @if ($dir == 'asc')
                                            <i class="fa fa-sort-asc float-right mt-2" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-sort-desc float-right" aria-hidden="true"></i>
                                        @endif
                                    @else
                                        <i class="fa fa-sort float-right mt-1" aria-hidden="true"></i>
                                    @endif
                                </th>
                                <th wire:click="order('status')" class="cursor-pointer px-4 py-3 text-center">
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
                                <th wire:click="order('created_at')" class="cursor-pointer px-4 py-3 text-center">
                                    Creación
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
                                @foreach ($users as $item)
                                    @if ($item->id != auth()->user()->id)
                                        <tr class="text-gray-700">
                                            <td class="px-4 py-3 text-ms font-semibold border">{{$item->id}}</td>
                                            <td class="px-4 py-3 border">
                                            <div class="flex items-center text-sm">
                                                <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full" src="{{$item->profile_photo_url}}" alt="" loading="lazy" />
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-black">{{$item->names}}</p>
                                                </div>
                                            </div>
                                            </td>
                                            <td class="px-4 py-3 text-ms font-semibold border">{{$item->email}}</td>
                                            <td class="px-1 py-3 text-xs border text-center">
                                                @if ($item->status == 'activo')
                                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">{{ strtoupper($item->status) }}</span>
                                                @else
                                                    <span class="px-2 py-1 font-semibold leading-tight bg-orange-400 text-white rounded-sm">{{ strtoupper($item->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="px-1 py-3 text-sm border text-center">{{$item->created_at->format('d-m-Y')}}</td>
                                            <td class="px-1 py-3 text-sm border text-center">
                                                <x-jet-secondary-button wire:click="edit({{ $item->id }})" class="bg-gray-200 m-1">
                                                    EDITAR
                                                </x-jet-secondary-button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach    
                            </tbody>
                        </table>
                        @if ($users->hasPages())
                            <div class="bg-gray-100 px-4">
                                {{ $users->links() }}
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
    @if (count($users))
        <x-jet-dialog-modal wire:model="open_edit">
            <x-slot name="title">
                EDITAR USUARIO
            </x-slot>
            <x-slot name="content">
                <div class="my-2">
                    <x-jet-label value="NOMBRE" />
                    <x-jet-input wire:model="user.names" type="text" class="w-full"/>
                </div>
                <div class="my-2">
                    <x-jet-label value="DOCUMENTO" />
                    <x-jet-input wire:model="user.document" type="text" class="w-full"/>
                </div>
                <div class="my-2">
                    <x-jet-label value="CELULAR" />
                    <x-jet-input wire:model="user.phone" type="text" class="w-full"/>
                </div>
                <div class="my-2">
                    <x-jet-label value="ESTADO" />
                    <select wire:model="user.status" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="document_type">
                        <option value="activo" {{ old('status', $item->status) == ' activo' ? 'selected' : '' }}>ACTIVO</option>
                        <option value="inactivo" {{ old('status', $item->status) == 'inactivo' ? 'selected' : '' }}>INACTIVO</option>
                    </select>
                </div>
                <div class="my-2">
                    <x-jet-label value="EMAIL" />
                    <x-jet-input wire:model="user.email" type="email" class="w-full"/>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button class="mr-4 bg-transparent rounded-none	border-0" wire:click="$set('open_edit', false)">
                    CANCELAR
                </x-jet-secondary-button>
                <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update" class="focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 transition bg-green-400 hover:bg-green-500 active:bg-green-600 disabled:opacity-25">
                    EDITAR
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
        
        <x-jet-dialog-modal wire:model="open_destroy">
            <x-slot name="title">
                ELIMINAR USUARIO
            </x-slot>
            <x-slot name="content">
                <div class="my-2">
                    <x-jet-label value="¿ESTA SEGURO QUE QUIERE ELIMINAR ESTE USUARIO?" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button class="mr-4" wire:click="$set('open_destroy', false)">
                    CANCELAR
                </x-jet-secondary-button>
                <x-jet-danger-button wire:click="confirmDestroy" wire:loading.attr="disabled" wire:target="comfirmDestroy" class="disabled:opacity-25">
                    ELIMINAR
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
    <x-jet-dialog-modal wire:model="open_create">
        <x-slot name="title">
            CREAR USUARIO
        </x-slot>
        <x-slot name="content">

            <div class="my-2">
                <x-jet-label value="NOMBRES"/>
                <x-jet-input type="text" wire:model="names" class="w-full"/>
                <x-jet-input-error for="names"/>
            </div>

            <div class="my-2">
                <x-jet-label value="DOCUMENTO"/>
                <x-jet-input type="text" wire:model="document" class="w-full"/>
                <x-jet-input-error for="document"/>
            </div>

            <div class="my-2">
                <x-jet-label value="CELULAR"/>
                <x-jet-input type="text" wire:model="phone" class="w-full"/>
                <x-jet-input-error for="phone"/>
            </div>

            <div class="my-2">
                <x-jet-label value="CORREO ELECTRONICO"/>
                <x-jet-input type="email" wire:model="email" class="w-full"/>
                <x-jet-input-error for="email"/>
            </div>
            
            <div class="my-2">
                <x-jet-label value="CONTRASEÑA"/>
                <x-jet-input type="password" wire:model="password" class="w-full"/>
                <x-jet-input-error for="password"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button class="mr-4" wire:click="$set('open_create', false)">
                CANCELAR
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="create" wire:loading.attr="disabled" wire:target="create" class="disabled:opacity-25">
                CREAR
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>