<div>
    <!-- tooltips -->
    <div>
        <div id="tooltip-import" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Importar Excel
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <div id="tooltip-export" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Exportar Excel
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
    <!-- end tooltips -->

    <!-- header -->
    <div class="mb-4">
        <!-- bread -->
        <x-custom.bread>
            @slot('category') Catalogos  @endslot
            Cavas
        </x-custom.bread>
         <!-- page title -->
         <h1 class="mt-2 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">Cavas</h1>
    </div>

    <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
        <div class="flex items-center mb-4 sm:mb-0">
            <div class="relative w-4/6 mt-1">
                <!-- search input -->
                <x-input wire:model="search" icon="search" label="" placeholder="Busqueda" class="mb-2" />
            </div>
            <div class="flex items-center w-2/6 sm:justify-end">
                <div class="flex pl-2 space-x-1">
                    <a wire:click="$set('openUpload', true)" href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg data-tooltip-target="tooltip-import" class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10.5 3.75a6 6 0 00-5.98 6.496A5.25 5.25 0 006.75 20.25H18a4.5 4.5 0 002.206-8.423 3.75 3.75 0 00-4.133-4.303A6.001 6.001 0 0010.5 3.75zm2.03 5.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72v4.94a.75.75 0 001.5 0v-4.94l1.72 1.72a.75.75 0 101.06-1.06l-3-3z"></path>
                          </svg>
                    </a>
                    <a href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg data-tooltip-target="tooltip-export" class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 4.5A.75.75 0 013 3.75h14.25a.75.75 0 010 1.5H3a.75.75 0 01-.75-.75zm0 4.5A.75.75 0 013 8.25h9.75a.75.75 0 010 1.5H3A.75.75 0 012.25 9zm15-.75A.75.75 0 0118 9v10.19l2.47-2.47a.75.75 0 111.06 1.06l-3.75 3.75a.75.75 0 01-1.06 0l-3.75-3.75a.75.75 0 111.06-1.06l2.47 2.47V9a.75.75 0 01.75-.75zm-15 5.25a.75.75 0 01.75-.75h9.75a.75.75 0 010 1.5H3a.75.75 0 01-.75-.75z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <button id="createProductButton" wire:click="$set('openNew', true)" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800" type="button" data-drawer-target="drawer-create-product-default" data-drawer-show="drawer-create-product-default" aria-controls="drawer-create-product-default" data-drawer-placement="right">
            Nueva cava
        </button>
    </div>
    <!-- end header -->

    <!-- Product table -->
    <div class="relative overflow-x-auto mt-4">
        @if ( $warehouses->count())
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Código
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sucursal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nicho
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warehouses as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <x-button icon="eye" wire:click="showMore({{ $item }})"/>
                            {{ $item->code }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->building->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->comments }}
                        </td>
                        <td class="px-6 py-4">
                            <x-button icon="pencil-alt" primary wire:click="edit({{ $item }})"/>
                            <x-button icon="trash" negative wire:click="delete({{ $item }})" />
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        @else
            <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
            <span class="font-medium">Alert!</span> No se encontraron registros con esa cadena de busqueda
          </div>
        @endif
        <!-- paginate -->
        @if ($warehouses->hasPages())
            <div class="my-6 mx-2">
                {{ $warehouses->links()}}
            </div>
        @endif
    </div>
    <!-- end product table -->

    <!-- Upload Products Modals -->
    <x-modal blur wire:model="openUpload">
        <x-card title="Cargas CSV productos">

            Hello
            
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button label="Cargar" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
    <!-- End Upload Products Modals -->

    <!-- New product Modal -->
    <x-modal blur wire:model="openNew">
        <x-card title="Nueva cava">
                <x-errors class="mb-4" />
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <x-input label="Cava" placeholder="Cava" wire:model.defer="code" disabled />
                    </div>
                    <div>
                        <x-native-select
                            label="Sucursal"
                            placeholder="Selecciona la sucursal"
                            option-label="name"
                            option-value="id"
                            wire:model.defer="building_id"
                        >
                        @foreach ($buildings as $item)
                            <option id="{{ $item->id }}" value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        </x-native-select>
                    </div>
                    <div>
                        <x-input label="Comentarios" placeholder="Nombre del nicho" wire:model.defer="comments" />
                    </div>
                    <div>
                        <x-input label="Cliente" placeholder="Nombre del cliente" wire:model.defer="customer_name" />
                    </div>
                    <div>
                        <x-input label="email" placeholder="email del cliente" wire:model.defer="customer_email" />
                    </div>
                    <div>
                        <x-input label="RFC" placeholder="rfc del cliente" wire:model.defer="customer_rfc" />
                    </div>
                </div>
                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <x-button flat label="Cancel" wire:click="$set('openNew', false)" />
                        <x-button primary label="Aceptar" wire:click="save" />
                    </div>
                </x-slot>
        </x-card>
    </x-modal>
    <!-- End new product modal -->

    <!-- Edit product Modal -->
    <x-modal blur wire:model="openEdit">
        <x-card title="Editar cava">
            <x-errors class="mb-4" />
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-input label="Cava" placeholder="Cava" wire:model.defer="warehouse.code" />
                </div>
                <div>
                    <x-native-select
                            label="Sucursal"
                            placeholder="Selecciona la sucursal"
                            option-label="name"
                            option-value="id"
                            wire:model.defer="warehouse.building_id"
                        >
                        @foreach ($buildings as $item)
                            <option id="{{ $item->id }}" value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        </x-native-select>
                </div>
                <div>
                    <x-input label="Comentarios" placeholder="Nombre del nicho" wire:model.defer="warehouse.comments" />
                </div>
                <div>
                    <x-input label="Cliente" placeholder="Nombre del cliente" wire:model.defer="warehouse.customer_name" />
                </div>
                <div>
                    <x-input label="email" placeholder="email del cliente" wire:model.defer="warehouse.customer_email" />
                </div>
                <div>
                    <x-input label="RFC" placeholder="rfc del cliente" wire:model.defer="warehouse.customer_rfc" />
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" wire:click="$set('openEdit', false)" />
                    <x-button primary label="Aceptar" wire:click="update" />
                </div>
            </x-slot>
    </x-card>
    </x-modal>
    <!-- End edit product modal -->

    <!-- Show more Modal -->
    <x-modal blur wire:model="openDetails">
        <x-card title="Información adicional">
            <x-errors class="mb-4" />
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                @if ( $warehouse )
                    
                    <div class="relative overflow-x-auto">
                        
                        <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Detalles de la cava:</h2>
                        <ol class="max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">Código</span> : {{ $warehouse->code }}
                            </li>
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">Sucursal</span> : {{ $warehouse->building->name }}
                            </li>
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">Nicho</span> : {{ $warehouse->comments }}
                            </li>
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">Cliente</span> : {{ $warehouse->customer_name }}
                            </li>
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">email</span> : {{ $warehouse->customer_email }}
                            </li>
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">RFC</span> : {{ $warehouse->customer_rfc }}
                            </li>
                        </ol>

                    </div>

                @endif
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cerrar" wire:click="$set('openDetails', false)" />
                </div>
            </x-slot>
    </x-card>
    </x-modal>
    <!-- End edit product modal -->
</div>
