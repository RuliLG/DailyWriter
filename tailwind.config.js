const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
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
                sans: ['Exo', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#E4F6FF',
                    100: '#C2E0EC',
                    200: '#A1CBD8',
                    300: '#7FB5C5',
                    400: '#5D9FB1',
                    500: '#508C9C',
                    600: '#427986',
                    700: '#356671',
                    800: '#28545C',
                    900: '#1B4147',
                    950: '#0D2E31',
                    1000: '#001B1C',
                },
                secondary: {
                    50: '#FFF4C4',
                    100: '#F4DA97',
                    200: '#E8C169',
                    300: '#DDA73C',
                    400: '#C79435',
                    500: '#B0822D',
                    600: '#9A6F26',
                    700: '#835D1E',
                    800: '#6D4A17',
                    900: '#56370F',
                    950: '#402508',
                    1000: '#291200',
                },
                green: {
                    dark: '#3F7483',
                    light: '#5D9FB1',
                },
                yellow: {
                    DEFAULT: '#F8F2E7',
                    dark: '#DDA73C',
                    light: '#FCF9F3',
                },
                grey: {
                    DEFAULT: '#CEDBE3',
                    dark: '#899AA1',
                    light: '#EFF6FA',
                },
                success: {
                    DEFAULT: '#2E7D32',
                    light: '#4CAF50',
                    dark: '#1B5E20',
                },
                red: {
                    DEFAULT: '#D32F2F',
                    light: '#EF5350',
                    dark: '#C62828',
                },
                gradient: {
                    DEFAULT: '#D2E1E3',
                },
            },
            boxShadow: {
                letter: '0 0 20px 0 rgba(0, 0, 0, 0.05)',
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
