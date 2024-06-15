/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    100: '#E6F0FF',
                    200: '#C0D3FF',
                    300: '#99B6FF',
                    400: '#4D7EFF',
                    500: '#0065FF',
                    600: '#005AD9',
                    700: '#004C99',
                    800: '#003966',
                    900: '#002633',
                },
                secondary: {
                    100: '#FFF5E6',
                    200: '#FFE0B3',
                    300: '#FFCC80',
                    400: '#FFA726',
                    500: '#FF9800',
                    600: '#F57C00',
                    700: '#BF5C00',
                    800: '#804000',
                    900: '#4B2600',
                },
            },
        },
        plugins: [],
    }
}

