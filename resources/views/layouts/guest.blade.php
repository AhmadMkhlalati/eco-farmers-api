<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="{{ asset('images/mainLogo.png') }}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>


    <!-- Focus plugin -->

    @livewireStyles
    @livewire('livewire-ui-modal')

    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}" />

    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="login">
    {{ $slot }}
</body>
@livewireScripts
<script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG7gNHAhDzgYmq4-EHvM4bqW1DNj2UCuk&libraries=places">
</script>
<script src="{{ mix('dist/js/app.js') }}"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    (function() {
        async function login() {
            // Reset state
            $('#login-form').find('.login__input').removeClass('border-danger')
            $('#login-form').find('.login__input-error').html('')

            // Post form
            let email = $('#email').val()
            let password = $('#password').val()

            // Loading state
            $('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
            tailwind.svgLoader()
            await helper.delay(1500)

            axios.post(`login`, {
                email: email,
                password: password
            }).then(res => {
                location.href = '/'
            }).catch(err => {
                $('#btn-login').html('Login')
                if (err.response.data.message == 'auth.failed') {
                    $('#error-validation').css('display', 'block')
                } else if (err.response.data.message != 'Wrong email or password.') {
                    for (const [key, val] of Object.entries(err.response.data.errors)) {
                        $(`#${key}`).addClass('border-danger')
                        $(`#error-${key}`).html(val)

                    }
                } else {
                    $(`#password`).addClass('border-danger')
                    $(`#error-password`).html(err.response.data.message)
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
    })()
</script>

</html>
