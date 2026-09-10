/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./views/**/*.blade.php",
    "./public/**/*.php",
    "./src/**/*.php",
    "./data/**/*.json"
  ],
  theme: {
    extend: {
      colors: {
        ibnp: {
          primary: '#F43517',
          secondary: '#F36529',
          accent: '#EFA162',
          surface: '#F1D6A9',
          dark: '#1E293B',
          light: '#FFFFFF',
          gray: {
            50: '#F8FAFC',
            100: '#F1F5F9',
            200: '#E2E8F0',
            300: '#CBD5E1',
            400: '#94A3B8',
            500: '#64748B',
            600: '#475569',
            700: '#334155',
            800: '#1E293B',
            900: '#0F172A'
          }
        }
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
        serif: ['Merriweather', 'Georgia', 'Cambria', 'serif']
      }
    },
  },
  plugins: [],
}
