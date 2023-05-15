<div>
    <!-- page title -->
    <div class="mb-4">
        <h1
            class="text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">
            Consumir cava</h1>
        <p class="tracking-tighter text-gray-500 md:text-lg dark:text-gray-400">
            Proceso en el cual se actualiza una cava segúb el consumo del cliente.
        </p>
    </div>

    <!-- operation and info section -->
    <div class="flex items-center justify-center">
        <div class="w-full flex flex-col sm:flex-row">
            <div class="flex-1 p-4">
                <div class="flex">
                    <x-select class="w-3/4" label="Elegir cava y presiona el boton para confirmar"
                        wire:model.defer="code" placeholder="Elige la cava a utilizar" :async-data="route('api.warehouses.index')"
                        option-label="code" icon="bookmark-alt" option-value="id" option-description="comments" />
                    <x-button icon="check-circle" primary wire:click="setWarehouse()" class="ml-2 mt-6" />
                </div>
                @if ($warehouse)

                    @if ( $products == NULL)
                        <div class="flex p-4 my-6 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Info</span>
                            <div>
                            <span class="font-medium">Atención!</span> Esta cava esta vacía y no es posible realizar un consumo. Si quieres agregar priductos a la cava dirígete a la sección "Vender cava" o da <a href="{{ route('sell') }}"><b>click aquí</b></a>
                            </div>
                        </div>
                    @else
                        <!-- divider -->
                        <hr class="my-4 h-0.5 border-t-0 bg-neutral-100 opacity-100 dark:opacity-50" />
                        <!-- end divider -->

                        <div class="mt-4 p-4">
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <!-- select for product -->
                                    <x-native-select placeholder="Selecciona un producto..." wire:model.defer="product_id">
                                        <!-- select options -->
                                        <option>Selecciona un producto...</option>
                                        @foreach ($products as $item)
                                            <option value="{{ $item->product_id }}">{{ $item->product->name }}</option>
                                        @endforeach
                                    </x-native-select>
                                    <!-- end select product -->
                                </div>
                                <div>
                                    <x-inputs.number wire:model.defer="qty" placeholder="Cantidad" />
                                </div>
                            </div>
                            <x-button label="Guardar" primary wire:click="save" />
                        </div>
                    @endif
                @endif
            </div>
            <div class="flex-1 p-4">
                @if ($warehouse)
                    <div>
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Código y nombre del nicho</h3>
                            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">
                                {{ $warehouse->code . '  (' . $warehouse->name . ' )' }}</p>
                        </div>
                        <div class="mt-6 border-t border-gray-100">
                            <dl class="divide-y divide-gray-100">
                                <p class="mt-6">
                                    Cava ubicada en la sucursal de <b>{{ $warehouse->building->name }} </b> con fecha de
                                    primera transacción del
                                    <b>21-03-022</b> a nombre de: <b>{{ $warehouse->customer_name }} </b> cuyo RFC:
                                    <b>{{ $warehouse->customer_rfc }} </b>
                                    y puede ser contactado via email a la siguiente dirección:
                                    <b>{{ $warehouse->customer_email }} </b>
                                </p>
                            </dl>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
        
        @if ( $warehouse )
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID prod
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Prod name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cantidad
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $inventory as $item )
                        <tr class="bg-white dark:bg-gray-800">
                            
                            <td class="px-6 py-4">
                                {{ $item->product_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->product->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->qty }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
</div>
