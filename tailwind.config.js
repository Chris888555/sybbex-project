/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php', // Laravel Blade views
    './resources/views/**/*.php',       // Kung may ibang PHP views
    './resources/js/**/*.vue',          // Vue components
    './resources/js/**/*.js',           // JavaScript files
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
