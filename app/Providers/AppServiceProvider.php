<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Google Fonts を head の先頭で読み込む
        Filament::registerRenderHook(
            'panels::head.start',
            fn (): string => '<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">'
        );

        // body にフォントを適用する最小CSSを head の終わりに挿入
        Filament::registerRenderHook(
            'panels::head.end',
            fn (): string => '
                <style>
                    body {
                        font-family: "Noto Sans JP", sans-serif;
                    }
                </style>
            '
        );
    }
}
