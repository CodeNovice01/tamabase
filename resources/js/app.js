// resources/js/app.js

// JSやVueなどだけを監視対象にする（.blade.php は除外！）
import.meta.glob([
    '../js/**/*.js',
    // '../views/**/*.blade.php', ← 本番では読み込まない！
  ]);
  
  console.log('📦 app.js loaded (safe for production build)');
  