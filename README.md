
# neo-tamabase 初期セットアップ手順

🕒 作成日時: 2025-05-01（JST）

---

## 📦 環境構成
- **Laravel** 12.x  
- **Livewire** 3.x（Alpine.js併用）  
- **Filament** 3.x（`app/Filament/Providers/AdminPanelProvider.php` を使用）  
- **Tailwind CSS** v4.x（Lightning CSS、PostCSS不要）  
- **Vite** v6.x  
- **daisyUI** v5.x（Tailwind v4対応済）  

---

## ⚙️ 前提方針
- Filament の UI カスタマイズは `app/Filament/Providers/AdminPanelProvider.php` で行う  
- Tailwind のカスタムは `tailwind.config.js` ＋ `resources/css/app.css` で管理  
- daisyUI は `resources/css/app.css` に `@plugin "daisyui";` を追記するのみ（`tailwind.config.js` の plugins 設定不要）  
- 開発は npm ベース（pnpm 非使用）  
- PostCSS 設定ファイルは原則使わない  
- Livewire と Filament の連携を前提とした構築  

---

## 🚀 セットアップ手順

```bash
