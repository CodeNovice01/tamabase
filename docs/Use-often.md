# 良く使うコマンド





# ssh本番環境でpull

git add .
git commit -m "変更"
git pull --rebase origin main
php artisan view:clear
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan migrate:status
php artisan optimize:clear
php artisan filament:clear
rm -rf bootstrap/cache/*.php




# ローカル環境 vs-code

sail artisan view:clear
sail artisan config:clear
sail artisan cache:clear
sail artisan route:clear
sail artisan optimize:clear
sail artisan filament:clear
sail artisan migrate:status
rm -rf bootstrap/cache/*.php



