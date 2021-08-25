const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'trueGray': colors.trueGray,
                'blue': colors.blue,
                'orange': colors.orange,
                'cyan': colors.cyan,
                'violet': colors.violet,
                'rose': colors.rose

            },
            backgroundImage: {
                'wave-pattern': "url('/img/fondo/wave-white.png')",
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],

    corePlugins: {
       container: false,
    },
};
