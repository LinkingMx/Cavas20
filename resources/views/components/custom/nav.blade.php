<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="#" class="flex ml-2 md:mr-24">

                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #d1e6e9
                                }

                                .cls-2 {
                                    fill: #a1d8df
                                }

                                .cls-3 {
                                    fill: #68c7d3
                                }

                                .cls-4 {
                                    fill: #30acc2
                                }
                            </style>
                        </defs>
                        <g id="Lockers">
                            <path class="cls-1" d="M2 3h9v24H2zM11 3h10v24H11zM21 3h9v24h-9z" />
                            <path class="cls-2" d="M10 3h2v24h-2zM20 3h2v24h-2z" />
                            <path class="cls-3" d="M2 27h28v2H2zM2 1h28v2H2z" />
                            <path class="cls-4" d="M2 29h2v2H2zM10 29h2v2h-2zM28 29h2v2h-2zM20 29h2v2h-2z" />
                            <path class="cls-3"
                                d="M4 5h4v6H4zM24 5h4v6h-4zM14 5h4v6h-4zM8 16a1 1 0 0 1-2 0 1 1 0 0 1 2 0zM18 16a1 1 0 0 1-2 0 1 1 0 0 1 2 0zM28 16a1 1 0 0 1-2 0 1 1 0 0 1 2 0zM4 23h4v2H4zM14 23h4v2h-4zM24 23h4v2h-4z" />
                        </g>
                    </svg>

                    <span
                        class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white text-gray-700">CAVAS
                        GC</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ml-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <x-avatar md label="US" />
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{Auth::user()->name}}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{Auth::user()->email}}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('profile.show')}}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Perfil</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();""
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Logout</a>
                                </form>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
