const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    // mode: 'jit',
    purge: {
        enabled: true,
        content: [
            './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            './vendor/laravel/jetstream/**/*.blade.php',
            './vendor/wire-elements/modal/resources/views/*.blade.php',
            './storage/framework/views/*.php',
            './resources/views/**/*.blade.php',
            './vendor/rappasoft/laravel-livewire-tables/resources/views/tailwind/**/*.blade.php',
            './vendor/livewire-ui/modal/resources/views/*.blade.php',
        ],
        options: {
            safelist: [
                "sm:max-w-sm",
                "sm:max-w-md",
                "sm:max-w-lg",
                "sm:max-w-xl",
                "sm:max-w-2xl",
                "sm:max-w-3xl",
                "sm:max-w-4xl",
                "sm:max-w-5xl",
                "sm:max-w-6xl",
                "sm:max-w-7xl",
                "md:max-w-lg",
                "md:max-w-xl",
                "lg:max-w-2xl",
                "lg:max-w-3xl",
                "xl:max-w-4xl",
                "xl:max-w-5xl",
                "2xl:max-w-6xl",
                "2xl:max-w-7xl'",
            ],
        }
    },

    theme: {
        screens: {
            'sm': '640px',
            // => @media (min-width: 640px) { ... }

            'md': '768px',
            // => @media (min-width: 768px) { ... }

            'lg': '1024px',
            // => @media (min-width: 1024px) { ... }

            'xl': '1280px',
            // => @media (min-width: 1280px) { ... }

            '2xl': '1536px',
            // => @media (min-width: 1536px) { ... }
        },
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                '1/20': '5%',
                '2/20': '10%',
                '3/20': '15%',
                '4/20': '20%',
                '5/20': '25%',
                '6/20': '30%',
                '7/20': '35%',
                '8/20': '40%',
                '9/20': '45%',
                '10/20': '50%',
                '11/20': '55%',
                '12/20': '60%',
                '13/20': '65%',
                '14/20': '70%',
                '15/20': '75%',
                '16/20': '80%',
                '17/20': '85%',
                '18/20': '90%',
                '19/20': '95%',
                '20/20': '100%',
                '192': '48rem'
            },
            gridTemplateColumns: {
                '16': 'repeat(16,minmax(0,1fr))'
            },
            gridColumn: {
                'span-16': 'span 16 / span 16',
                'span-13': 'span 13 / span 13',
                'span-14': 'span 14 / span 14',
                'span-15': 'span 15 / span 15'
            },
            transitionProperty: {
                'width': 'width'
            }
        },
    },

    variants: {
        float: ['responsive', 'direction'],
        margin: ['responsive', 'direction'],
        padding: ['responsive', 'direction'],
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('tailwindcss-dir')()],
};
