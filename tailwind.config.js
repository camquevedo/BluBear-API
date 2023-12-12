import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            maxWidth: {
                '1/2': '50%',
                '9/10': '90%'
            },
            backgroundColor: {
                'digimon': {
                    'logo': {
                        '1': '#FE6501',
                        '2': '#FE8215',
                        '3': '#A6B183',
                        '4': '#A1CCCD',
                        '5': '#1C73A6',
                        '6': '#074A87',
                        '7': '#3F2B0C',
                        '8': '#161C12'
                    },
                    't1': {
                        '1': '#f1ba63',
                        '2': '#fbf39b',
                        '3': '#643c30',
                        '4': '#a76050',
                        '5': '#d1c9bc',
                        '6': '#443c70'
                    },
                    't2': {
                        '1': '#99453A',
                        '2': '#C15934',
                        '3': '#E7C363',
                        '4': '#DCDCDC',
                        '5': '#50739B',
                    },
                    't3': {
                        '1': '#773520',
                        '2': '#CD5316',
                        '3': '#AD8E82',
                        '4': '#FF8D42',
                        '5': '#C5C3B1',
                    },
                },
            }
        },
    },

    plugins: [forms],
};
