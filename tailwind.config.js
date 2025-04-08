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
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                blue: '#007bff',
                indigo: '#6610f2',
                purple: '#6f42c1',
                pink: '#e83e8c',
                red: '#dc3545',
                orange: '#fd7e14',
                yellow: '#ffc107',
                green: '#28a745',
                teal: '#20c997',
                cyan: '#17a2b8',
                white: '#fff',
                gray: '#6c757d',
                'gray-dark': '#343a40',
                primary: '#007bff',
                secondary: '#6c757d',
                success: '#28a745',
                info: '#17a2b8',
                warning: '#ffc107',
                danger: '#dc3545',
                light: '#f8f9fa',
                dark: '#343a40',
                // Add the metro colors here
                'metro-primary': '#0078C8', // Replace with your desired primary color
                'metro-dark': '#00517A',    // Replace with your desired dark color
                'metro-light': '#E6F4FF',   // Replace with your desired light color
            },
            fontFamily: {
                sans: ['Outfit', 'sans-serif'],
                monospace: ['SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'Liberation Mono', 'Courier New', 'monospace'],
            },
            fontWeight: {
                regular: '400',
            },
            lineHeight: {
                normal: '1.5',
            },
            boxSizing: {
                border: 'border-box',
            },
            zIndex: {
                navbar: '1020',
            },
        },
    },
    plugins: [forms],
};
