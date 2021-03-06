const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                'Comforter': ['Comforter'],
                'Supermercado-One': ['Supermercado One'],
            },
            spacing: {
                '128': '32rem',
                '118': '28rem',
              },
              rotate: {
                '-15': '-15deg',
              }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
