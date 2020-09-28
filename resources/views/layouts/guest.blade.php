
<x-base-layout>
<body class="login">
        <div class="font-sans antialiased text-gray-900">
            {{ $slot }}
        </div>
         <!-- BEGIN: JS Assets-->
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->
        @yield('scripts')

    </body>
</x-base-layout>


