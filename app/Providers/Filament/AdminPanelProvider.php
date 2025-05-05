<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
        ->brandName('タマベース🐢') // 上部に出る名前
            ->brandLogo(fn () => view('components.logo')) // Bladeファイルでロゴ表示
            ->homeUrl('/') // ロゴをクリックしたときのリンク先
            ->default() // デフォルトのパネルとして設定するよ
            ->id('admin') // このパネルのID（識別子）を 'admin' に設定しているよ
            ->path('admin') // パネルのURLパス（例: /admin）を指定してるよ
            ->login() // ログイン機能を有効にするよ
            ->colors([
                'primary' => Color::Amber, // プライマリーカラーをアンバーに設定するよ
            ])
            // リソース（CRUD管理クラス）を自動で検出・登録するよ
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            // ページクラスを自動で検出・登録するよ
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class, // ダッシュボードページを明示的に追加してるよ
            ])
            // ウィジェットを自動検出・登録するよ
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class, // アカウント情報のウィジェット
                Widgets\FilamentInfoWidget::class, // Filamentバージョン情報などのウィジェット
            ])
            // ミドルウェアを順番に登録してるよ（セッション、CSRF保護など）
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])










            // パネルの認証ミドルウェアを指定してるよ（ログインユーザーのチェック）
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
