@section('title')
Login Simpopel Laravel
@endsection

<x-guest-layout>
    <div class="container sm:px-10">
        <div class="block grid-cols-2 gap-4 xl:grid">
            <!-- BEGIN: Login Info -->
            <div class="flex-col hidden min-h-screen xl:flex">
                <a href="" class="flex items-center pt-5 -intro-x">
                    <x-jet-authentication-card-logo class="w-8"></x-jet-authentication-card-logo>
                    {{-- <img alt="Midone Laravel Admin Dashboard Starter Kit" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                    --}}
                    <span class="ml-3 text-lg text-white">
                        MA <span class="font-medium">Hasanah</span>
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="Midone Laravel Admin Dashboard Starter Kit" class="w-1/2 -mt-16 -intro-x"
                        src="{{ asset('dist/images/illustration.svg') }}">
                    <div class="mt-10 text-4xl font-medium leading-tight text-white -intro-x">Sistem Poin Pelanggaran
                        Siswa</div>
                    <div class="mt-5 text-lg text-white -intro-x">MA Hasanah Pekanbaru</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="flex h-screen py-5 my-10 xl:h-auto xl:py-0 xl:my-0">
                <div
                    class="w-full px-5 py-8 mx-auto my-auto bg-white rounded-md shadow-md xl:ml-20 xl:bg-transparent sm:px-8 xl:p-0 xl:shadow-none sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="text-2xl font-bold text-center intro-x xl:text-3xl xl:text-left">Masuk</h2>
                    @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif
                    <x-jet-validation-errors id="validationError" class="mb-4"></x-jet-validation-errors>
                    <div class="mt-8 intro-x">
                        <form @submit.prevent="submitData" method="POST" x-data="LoginForm()" id="loginForm">
                            @csrf

                            <x-login-input id="input-username" type="text" name="username" :value="old('username')"
                                placeholder="{{ __('Username') }}" class="block border border-gray-300 " required
                                autofocus x-model="formData.username"></x-login-input>
                            <div id="error-username" class="w-5/6 mt-2 input__error text-theme-6"></div>
                            <x-login-input id="input-password" x-model="formData.password" type="password"
                                name="password" placeholder="{{ __('Password') }}" required
                                autocomplete="current-password" class="block border border-gray-300"></x-login-input>
                            <div id="error-password" class="w-5/6 mt-2 input__error text-theme-6"></div>



                            <div class="flex mt-4 text-xs text-gray-700 intro-x sm:text-sm">
                                <div class="flex items-center mr-auto">
                                    <input type="checkbox" id="input-remember-me"
                                        class="mr-2 border input form-checkbox" id="remember-me"
                                        x-model="formData.rememberMe">
                                    <label class="cursor-pointer select-none"
                                        for="remember-me">{{ __('Ingat Saya') }}</label>
                                </div>
                                @if (Route::has('password.request'))
                                <a class="text-sm text-gray-600 underline flex-items hover:text-gray-900"
                                    href="{{ route('password.request') }}">
                                    {{ __('Lupa Password?') }}
                                </a>
                                @endif

                            </div>

                            <div class="justify-center mt-5 intro-x xl:mt-8 xl:flex xl:justify-start">
                                <x-button id="loginButton"
                                    class="w-full text-white disabled:opacity-50 button button--lg xl:w-32 bg-theme-1 xl:mr-3"
                                    x-bind:disabled="isLoading">
                                    {{ __("Login") }}
                                </x-button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- END: Login Form -->
    </div>
    </div>

    @section('scripts')
    <script>
        function LoginForm()
        {
            const action="{{ route('login') }}";
            return {
                formData: {
                    username:'',
                    password:'',
                    rememberMe:false,

                },
                isLoading:false,
                async submitData(){


                    this.isLoading = true;
                    $("#loginButton").html(`<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>`).svgLoader();
                    const data = {
                        username:this.formData.username,
                        password: this.formData.password,
                        rememberMe:this.formData.rememberMe
                    };
                    try{
                        await helper.delay(1500);
                       const response =  await axios.post(action,JSON.stringify(data),{
                        headers: { 'Content-Type': 'application/json' },
                        });
                        if(response.two_factor){
                            window.location.href="{{ route('two-factor.login') }}";
                        }
                        window.location.href="{{ route('dashboard') }}";


                    }catch(error){
                        const items = Object.entries(error.response.data.errors);
                        for(const [key,value] of items){
                        //     document.querySelector("#input-"+key).classList.add("border-theme-6");
                        //    document.querySelector("#error-"+key).innerHTML=value;
                           $("#input-"+key).addClass("border-theme-6");
                           $("#error-"+key).html(value);
                        }
                    } finally{
                        $("#loginButton").html("Login");
                        this.isLoading = false;
                    }


                }
            };


        }
    </script>
    @endsection

</x-guest-layout>
{{-- $(document).ready(function() {
    async function login() {
    // Reset state
    $('#login-form').find('.input').removeClass('border-theme-6')
    $('#login-form').find('.input__error').html('')

    // Post form
    let email = $('#input-email').val()
    let password = $('#input-password').val()
    let rememberMe = $('#input-remember-me').val()

    // Loading state
    $('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
    await helper.delay(1500)

    axios.post(`login`, {
    email: email,
    password: password,
    remember_me: rememberMe
    }).then(res => {
    location.reload()
    }).catch(err => {
    $('#btn-login').html('Login')
    for (const [key, val] of Object.entries(err.response.data.errors)) {
    $(`#input-${key}`).addClass('border-theme-6')
    $(`#error-${key}`).html(val)
    }
    })
    }

    $('#login-form').on('keyup', function(e) {
    if (e.keyCode === 13) {
    login()
    }
    })

    $('#btn-login').on('click', function() {
    login()
    })
    }) --}}
