/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{js,jsx,ts,tsx}",],
  theme: {
    extend: {
      spacing:{
        'hero':'calc(100vh - 56px)',
        'heroTileColWidth':'49%'
      }
    },
  },
  plugins: [],
}

