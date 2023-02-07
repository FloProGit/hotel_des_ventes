/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        "bg-button-color": "var(--bg-button-color)",
      },
    },
  },
  plugins: [],
}
