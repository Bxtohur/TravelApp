import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Kita definisikan warna utama 'primary' jadi hijau emerald
                primary: {
                    50: '#f1f9f9',
                    100: '#daefef',
                    200: '#b8dfdf',
                    300: '#86c5c7',
                    400: '#5ba6a9',
                    500: '#3A9499', // Warna utama sesuai logo Anda
                    600: '#2f797d',
                    700: '#296266',
                    800: '#255053',
                    900: '#224446',
                    950: '#112729',
                },
            }
        },
    },

    plugins: [
        forms,
        function ({ addUtilities }) {
            addUtilities({
                '.no-scrollbar::-webkit-scrollbar': {
                'display': 'none',
                },
                '.no-scrollbar': {
                '-ms-overflow-style': 'none',
                'scrollbar-width': 'none',
                },
            })
        },
    ],
};
