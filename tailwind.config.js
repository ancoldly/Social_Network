/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.{html,js,php}"
  ],
  theme: {
    extend: {
      colors: { 
        blackColors: "#333",
        mainColors: "#1bbc9b",
        whiteColors: "#fdfdfd",
        shadowColors: "rgba(0,0,0, .2)"
      },
      fontFamily: {
        reenieFonts: ["Reenie Beanie", "Sans-serif"]
      }
    },
  },
  plugins: [],
}