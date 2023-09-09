import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        colors: {
            lightYukarte: '#00F5A0',
            darkYukarte: '#00D9F5',
            yukarte: {
                100: '#CAFAE4',
                200: '#97F5D2',
                300: '#5FE2BE',
                400: '#37C6AB',
                500: '#45CBB2',
                600: '#2ED3B7',
                700: '#15B79E',
                800: '#0E9384',
                900: '#107569',
                950: '#125D56'
            },
            carrot: {
                100: '#FFF3D5',
                200: '#FFE4AB',
                300: '#FFD181',
                400: '#FFBE62',
                500: '#FFA02E',
                600: '#DB7E21',
                700: '#B75F17',
                800: '#93450E',
                900: '#7A3108',
                950: '#602706'
            },
            transparent: 'transparent',
            current: 'currentColor',
            slate: colors.slate,
            gray: colors.gray,
            sky: colors.sky,
            teal: colors.teal,
            red: colors.rose,
            green: colors.green,
            fuchsia: colors.fuchsia,
            amber: colors.amber,
            emerald: colors.emerald,
            lime: colors.lime,
        },
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography],
};
