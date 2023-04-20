<x-guest-layout>
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Rubick Tailwind HTML Admin Template" class="w-6"
                        src="{{ asset('dist/images/logo.png') }}">
                    <span class="text-white text-lg ml-3">
                        Agro-ethical
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="Rubick Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                        src="{{ asset('dist/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">We go the extra mile for
                        you </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">A one-stop-shop
                        for all your logistics</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto"
                    >
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Sign In</h2>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your
                        account. Manage all your e-commerce accounts in one place</div>
                    <div class="intro-x mt-8">
                        <form id="login-form">
                            <input id="email" type="text"
                                class="intro-x login__input form-control py-3 px-4 block" placeholder="Email"
                                value="midone@left4code.com">
                            <div id="error-email" class="login__input-error text-danger mt-2"></div>
                            <input id="password" type="password"
                                class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password"
                                value="password">
                            <div id="error-password" class="login__input-error text-danger mt-2"></div>
                        </form>
                    </div>

                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button id="btn-login"
                            class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                    </div>

                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
</x-guest-layout>
