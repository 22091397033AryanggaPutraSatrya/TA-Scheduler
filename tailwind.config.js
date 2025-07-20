import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
          colors: {
            'primary': '#07689F',    // Biru Tua
            'secondary': '#A2D5F2', // Biru Muda
            'base': '#FAFAFA',      // Putih Gading
            'accent': '#FF7E67',     // Oranye/Coral
          },
        },
      },
    plugins: [],
};
