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
                        option-label="code" icon="Home" option-value="id" option-description="comments" />
                    <x-button icon="check-circle" primary wire:click="setWarehouse()" class="ml-2 mt-6" />
                </div>
                @if ($warehouse)
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
                                        <option value="{{ $item->id }}">{{ $item->product->name }}</option>
                                    @endforeach
                                </x-native-select>
                                <!-- end select product -->
                            </div>
                            <div>
                                <x-input wire:model.defer="qty" placeholder="Cantidad" />
                            </div>
                        </div>
                        <x-button label="Guardar" primary wire:click="save" />
                    </div>
                @endif
            </div>
            <div class="flex-1 p-4">
                @if ($warehouse)
                    <div>
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Código y nombre del nicho</h3>
                            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">
                                {{ $warehouse->code . '  (' . $warehouse->comments . ' )' }}</p>
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
</div>
