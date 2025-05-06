<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="retro" class="min-h-screen">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PWA manifest -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#1e40af">

    <!-- iOS向け -->
    <link rel="apple-touch-icon" href="/images/icons/icon-192x192.png">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Service Worker -->
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
                .then(() => console.log('✅ Service worker registered!'))
                .catch(err => console.error('SW registration failed:', err));
        }
    </script>

    <title>Laravel</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Lucide Icons Web Components CDN読み込み -->
    <script type="module">
        import {
            defineCustomElements
        } from 'https://cdn.jsdelivr.net/npm/lucide@latest/dist/esm/lucide.js';
        defineCustomElements();
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>

    {{-- ViteでビルドされたCSSとJSファイルを読み込むためのディレクティブだよ --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <livewireStyles />
</head>



<body class="fi-body fi-panel-admin min-h-screen font-normal">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full all ">

            <!-- ヘッダー -->
            <div class="navbar bg-base-100 shadow-sm fixed top-0 left-0 w-full z-50">
                <div class="flex-1">
                    <div class="ml-12 w-fit">
                        <a class="hover:bg-transparent hover:text-inherit active:bg-transparent focus:bg-transparent"
                            href="/"><img src="{{ asset('images/logo.svg') }}" alt="ロゴ"
                                style="height: 1.5rem;"></a>
                    </div>
                </div>

                <div class="flex-none">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="badge badge-sm indicator-item">8</span>
                            </div>
                        </div>
                        <div tabindex="0" class="card card-compact dropdown-content bg-base-100 z-1 mt-3 w-52 shadow">
                            <div class="card-body">
                                <span class="text-lg font-bold">8 Items</span>
                                <span class="text-info">Subtotal: $999</span>
                                <div class="card-actions">
                                    <button class="btn btn-primary btn-block">View cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS Navbar component"
                                    src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                            <li>
                                <a class="justify-between">
                                    プロフィール
                                    <span class="badge">New</span>
                                </a>
                            </li>
                            <li><a href="/admin">ダッシュボード</a></li>
                            <li><a href="">ログアウト</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- ドロワーメニュー-->
            <div class="drawer z-50 top-0 left-0 w-full h-full" x-show="drawerOpen" x-transition>

                <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content fixed top-4 left-4 z-51">
                    <!-- Page content here -->
                    <div class="drawer-content fixed top-4 left-4 z-50">
                        <label for="my-drawer" class="swap swap-rotate cursor-pointer">
                            <!-- 開いてないとき（menu） -->
                            <i data-lucide="menu" class="swap-off w-6 h-6 text-gray-700"></i>
                            <!-- 開いてるとき（x） -->
                            <i data-lucide="x" class="swap-on w-6 h-6 text-gray-700"></i>
                        </label>

                    </div>

                </div>
                <div class="drawer-side">
                    <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>

                    {{-- メニュー全体 --}}
                    <ul class="menu bg-base-200 text-base-content min-h-full w-80 px-2 py-0">

                        {{-- ロゴ表示 --}}
                        <div class="py-5 pl-12">
                            <a class="hover:bg-transparent hover:text-inherit active:bg-transparent focus:bg-transparent"
                                href="/">
                                <img src="{{ asset('images/logo.svg') }}" alt="ロゴ" style="height: 1.5rem;">
                            </a>
                        </div>

                        {{-- メニュー定義 --}}
                        @php
                            $menuItems = [
                                ['label' => 'ダッシュボード', 'url' => '/admin', 'icon' => 'home'],
                                ['label' => 'News', 'url' => '/news', 'icon' => 'pencil'],
                                ['label' => 'ディレクション', 'url' => '/admin', 'icon' => 'clipboard-check'],
                                ['label' => 'ダッシュボード', 'url' => '/admin', 'icon' => 'home'],
                                ['label' => 'デザインルール', 'url' => '/admin', 'icon' => 'pencil'],
                                ['label' => 'ディレクション', 'url' => '/admin', 'icon' => 'clipboard-check'],
                                ['label' => 'ナレッジ共有', 'url' => '/admin', 'icon' => 'book-open'],
                                ['label' => 'ビジョン', 'url' => '/admin', 'icon' => 'eye'],
                                ['label' => 'ミッション', 'url' => '/admin', 'icon' => 'bolt'],
                                ['label' => 'バリュー', 'url' => '/admin', 'icon' => 'sparkles'],
                                ['label' => 'Item 1', 'url' => '/admin', 'icon' => 'archive'],
                                ['label' => 'Item 2', 'url' => '/admin', 'icon' => 'folder'],
                                ['label' => 'Item 3', 'url' => '/admin', 'icon' => 'package'],
                            ];
                        @endphp


                        {{-- メニュー表示ループ --}}
                        @foreach ($menuItems as $item)
                            <li>
                                <a href="{{ $item['url'] }}"
                                    class="py-3 mt-0 hover:bg-gray-100 transition flex items-center space-x-2">
                                    <div class="flex items-center gap-x-2">

                                        {{-- ✅ Filament標準のHeroiconアイコンを使う --}}
                                        <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4 text-gray-700"></i>
                                        <span>{{ $item['label'] }}</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>

            </div>

            @if (Route::has('login'))
                <!-- ログインしている状態 -->
                @auth

                    <!-- メインコンテンツ -->
                    <main class="fi-main relative mx-auto w-full min-h-[calc(100vh-94px)]" style="padding-top: 94px;">
                        @yield('content')
                    </main>
                    <!-- ログインしていない状態 -->
                @else
                    <!-- ヒーローエリア -->
                    <section class="text-center py-20 h-96 bg-red-700">
                        <h2 class="text-4xl md:text-5xl font-black mb-4">
                            WE ARE PLAYFUL PROFESSIONALS
                        </h2>
                        <p class="text-sm text-gray-700">私たちは、遊び心のあるプロフェッショナルです</p>
                    </section>

                    <!-- コンセプトセクション -->
                    <section class="text-center py-20 px-6 md:px-16">
                        <h3 class="text-2xl md:text-3xl font-bold mb-6">個性を活かす ものづくりを</h3>
                        <p class="max-w-2xl mx-auto leading-relaxed text-gray-700 space-y-4 text-sm md:text-base">
                            Tamabaseは、ゲーム事業を中心として<br>
                            一人ひとりの得意を活かした<br>
                            最高のエンターテインメントを生み出しつづけていきます。<br>
                            また、子どもたちが好きなこと、<br>
                            夢中になれることを一緒に見つけてモノづくりする<br>
                            共育事業も行っています。
                        </p>

                        <div class="mt-10">
                            <a href="#more"
                                class="bg-black text-white px-8 py-2 rounded-full text-sm hover:bg-gray-800 transition">
                                More
                            </a>
                        </div>
                    </section>


                    <div class="flex flex-col items-center justify-center min-h-screen space-y-4">



                        <button class="btn bg-black text-white border-black">
                            <svg aria-label="GitHub logo" width="16" height="16"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="white"
                                    d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z">
                                </path>
                            </svg>
                            TamaBaseにログイン
                        </button>

                        <button class="btn btn-primary" onclick="location.href='/admin'">
                            ログイン
                        </button>
                        <!-- Email -->


                    @endauth
            @endif

        </div>
    </div>
    <script>
        lucide.createIcons();
    </script>

    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
                .then(function(registration) {
                    console.log('✅ Service Worker registered with scope:', registration.scope);
                })
                .catch(function(error) {
                    console.error('❌ Service Worker registration failed:', error);
                });
        }
    </script>


    <livewireScripts />
</body>

</html>
