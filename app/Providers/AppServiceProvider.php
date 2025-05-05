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

        // body に適用するCSS
        Filament::registerRenderHook(
            'panels::head.end',
            fn (): string => '


                <style>
                    body {
                        font-family: "Noto Sans JP", sans-serif;
                    }

                    /* 全体のキャレットを消す */
                    body * {
                        caret-color: transparent;
                    }

                      /* --- 入力やテキストエリア、コンテンツ編集エリアなどは元に戻す --- */
                        input,
                        input[type="text"],
                        input[type="email"],
                        input[type="password"],
                        textarea,
                        [contenteditable="true"] {
                        caret-color: #333 !important;
                        }
                        
                        form * {
                        caret-color: #333 !important;
                        }
                        
                        /* --- キャレットを不要なものに再度上書きで消す --- */
                        input[type="checkbox"],
                        input[type="radio"],
                        button,
                        .fi-btn-label,
                        select {
                        caret-color: transparent!important;
                        }


                        .fi-main {
                        max-width: 1200px !important;
                        }
                        /* --- フォームの幅を制限 --- */
                        .fi-input-wrp {
                        max-width: 860px !important;
                        }

                        .prose {
                        padding:30px;
                        }

                        .prose :where(p):not(:where([class~=not-prose],[class~=not-prose] *)) {
                        margin-bottom: 0.5em;
                        margin-top: 0.5em;
                        font-size: 0.95rem;
                        }




                        /* --- フォームの高さ --- */
                        .fi-input {
                        padding:10px;}



                        .fi-simple-header-heading{font-size: 16px;}






                        /* --- ボタンの高さ --- */
                        .fi-btn {
                        padding:16px;}



                    
                </style>
                
                '


        );
    }
}
