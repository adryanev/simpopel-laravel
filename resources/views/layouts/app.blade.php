<x-base-layout>
 <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{-- @yield('content') --}}
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
         <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=['your-google-map-api']&libraries=places"></script>
        <script src="{{ mix('dist/js/app.js') }}"></script>

        @yield('scripts')
        <!-- END: JS Assets-->
    </body>
</x-base-layout>

