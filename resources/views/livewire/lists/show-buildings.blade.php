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
            Sucursales
        </x-custom.bread>
         <!-- page title -->
         <h1 class="mt-2 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">Sucursales</h1>
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
            Nueva sucursal
        </button>
    </div>
    <!-- end header -->

    <!-- Product table -->
    <div class="relative overflow-x-auto mt-4">
        @if ( $buildings->count())
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prefijo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buildings as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->prefix }}
                        </td>
                        <td class="px-6 py-4">
                            <x-button icon="pencil-alt" primary wire:click="edit({{ $item }})"/>
                            <x-button icon="trash" negative wire:click="confirmDelete({{ $item }})" />
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
        @if ($buildings->hasPages())
            <div class="my-6 mx-2">
                {{ $buildings->links()}}
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
        <x-card title="Nueva sucursal">
                <x-errors class="mb-4" />
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <x-input label="Nombre" placeholder="Nombre de la sucursal" wire:model.defer="name" />
                    </div>
                    <div>
                        <x-input label="Prefijo" placeholder="Prefijo para cavas de esta unidad" wire:model.defer="prefix" />
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
        <x-card title="Editar sucursal">
            <x-errors class="mb-4" />
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-input label="Nombre" placeholder="Nombre de la sucursal" wire:model.defer="building.name" />
                </div>
                <div>
                    <x-input label="Nombre" placeholder="Nombre de la sucursal" wire:model.defer="building.prefix" />
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
</div>
