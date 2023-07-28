import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import daisyui from "daisyui";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Lato', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    daisyui: {
        themes: [
            {
                'digimaly-light': {
                    'primary': '#570df8',
                    'secondary': '#F8C8DC',
                    'accent': '#36d399',
                    'neutral': '#3d4451',
                    'base-100': '#ffffff',
                    'info': '#3abff8',
                    'success': '#36d399',
                    'warning': '#FFC857',
                    'error': '#C5283D',

                },
                'digimaly-dark': {
                    'primary': '#570df8',
                    'secondary': '#F8C8DC',
                    'accent': '#36d399',
                    'neutral': '#3d4451',
                    'base-100': '#1d232a',
                    'info': '#3abff8',
                    'success': '#36d399',
                    'warning': '#FFC857',
                    'error': '#C5283D',
                }
            }
        ]
    },


    plugins: [forms, typography, daisyui],
};
