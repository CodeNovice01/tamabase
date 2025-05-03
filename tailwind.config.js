// tailwind.config.js
module.exports = {
    content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
    ],
    theme: {
      extend: {},
    },
    
    plugins: [
      require('@tailwindcss/typography'), // ← これ！
      require('daisyui')
    ],
  }
  