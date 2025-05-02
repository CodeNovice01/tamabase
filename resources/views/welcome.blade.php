@extends('layouts.top-style')


{{-- ここが「中身」を差し込むセクションです --}}
@section('content')
    <div class="flex min-h-screen">
        <!-- 左：固定メニュー -->
        <aside class="hidden md:block w-64 pl-6 pt-8">


            @php
                // 📦 表示するカード情報を配列で定義（アイコン名・タイトル・リンクURL）
                $cards = [
                    ['title' => 'ダッシュボード', 'url' => '/admin', 'icon' => 'home'],
                    ['title' => 'ユーザー管理', 'url' => route('users.index'), 'icon' => 'users'],
                    ['title' => '設定', 'url' => '/settings', 'icon' => 'settings'],
                    ['title' => 'ダッシュボード', 'url' => '/admin', 'icon' => 'home'],
                    ['title' => 'ニュース一覧', 'url' => route('news.index'), 'icon' => 'newspaper'],
                    ['title' => 'ユーザー管理', 'url' => route('users.index'), 'icon' => 'users'],
                    ['title' => '設定', 'url' => '/settings', 'icon' => 'settings'],
                    ['title' => 'ダッシュボード', 'url' => '/admin', 'icon' => 'home'],
                    ['title' => 'ニュース一覧', 'url' => route('news.index'), 'icon' => 'newspaper'],
                    ['title' => 'ユーザー管理', 'url' => route('users.index'), 'icon' => 'users'],
                    ['title' => '設定', 'url' => '/settings', 'icon' => 'settings'],
                    ['title' => 'ダッシュボード', 'url' => '/admin', 'icon' => 'home'],
                    ['title' => 'ニュース一覧', 'url' => route('news.index'), 'icon' => 'newspaper'],
                    ['title' => 'ユーザー管理', 'url' => route('users.index'), 'icon' => 'users'],
                    ['title' => '設定', 'url' => '/settings', 'icon' => 'settings'],
                ];
            @endphp


            <!-- 🧱 カードのグリッド表示（1列） -->
            <div class="grid grid-cols-1 gap-y-2">
                @foreach ($cards as $card)
                    <a href="{{ $card['url'] }}" class="grid bg-white hover:bg-gray-100 p-3 rounded shadow transition">
                        <div class="flex items-center gap-x-1">

                            {{-- ✅ Filament標準のHeroiconアイコンを使う --}}
                            <i data-lucide="{{ $card['icon'] }}" class="w-4 h-4 text-gray-700"></i>

                            {{-- 🏷 カードのタイトル --}}
                            <h3 class="font-semibold text-gray-800 text-sm">
                                {{ $card['title'] }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>




        </aside>

        <!-- 右：コンテンツ -->
        <main class="flex-1 p-6">

            <!-- レスポンシブグリッド -->
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6 p-2 bg-base-100 min-h-screen">

                @for ($i = 1; $i <= 12; $i++)
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="font-semibold text-gray-800">カード {{ $i }}</h3>
                        <p class="text-sm text-gray-600 mt-1">説明文や概要が入ります。</p>
                    </div>
                @endfor
            </div>
        </main>
    </div>







    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6 bg-base-100 min-h-screen">
        <!-- カード1 -->
        <div class="card bg-base-200 shadow-md p-4">
            <div class="card-title">Preview</div>
            <!-- タグ・チェック・リスト -->
            <div class="flex flex-wrap gap-2 mt-2">
                <div class="badge badge-outline">Shoes</div>
                <div class="badge badge-outline">Bags</div>
                <div class="badge badge-outline">Hoodies</div>
            </div>
        </div>

        <!-- カード2：チャート -->
        <div class="card bg-base-200 shadow-md p-4">
            <div class="text-lg font-bold">Sales volume</div>
            <progress class="progress progress-primary w-full" value="75" max="100"></progress>
            <div class="tabs mt-4">
                <a class="tab tab-bordered tab-active">Charts</a>
                <a class="tab tab-bordered">Details</a>
            </div>
        </div>

        <!-- カード3：音楽プレーヤー -->
        <div class="card bg-base-200 shadow-md p-4">
            <div class="text-lg font-semibold mb-2">PM Zoomcall ASMR</div>
            <div class="flex justify-between">
                <button class="btn btn-circle btn-sm">⏮</button>
                <button class="btn btn-circle btn-sm btn-primary">▶️</button>
                <button class="btn btn-circle btn-sm">⏭</button>
            </div>
            <div class="mt-2 text-xs text-center">2 hours</div>
        </div>

        <!-- カード4：ページスコア -->
        <div class="card bg-base-200 shadow-md p-4">
            <div class="font-semibold">Page Score</div>
            <div class="text-3xl font-bold text-green-600">91</div>
            <div class="text-sm text-gray-500">All good ✅</div>
        </div>

        <!-- カード5：Recent Orders -->
        <div class="card bg-base-200 shadow-md p-4">
            <div class="font-semibold mb-2">Recent orders</div>
            <ul>
                <li class="flex justify-between">Charlie <span class="badge badge-info">Send</span></li>
                <li class="flex justify-between">Howard <span class="badge badge-error">Failed</span></li>
                <li class="flex justify-between">Fiona <span class="badge badge-warning">In progress</span></li>
                <li class="flex justify-between">Nick <span class="badge badge-success">Completed</span></li>
            </ul>
        </div>

        <!-- カード6：投稿エリア -->
        <div class="card bg-base-200 shadow-md p-4">
            <label class="label"><span class="label-text">Write a new post</span></label>
            <textarea class="textarea textarea-bordered w-full" rows="4" placeholder="What's happening?"></textarea>
            <div class="flex justify-end gap-2 mt-2">
                <button class="btn">Draft</button>
                <button class="btn btn-primary">Publish</button>
            </div>
        </div>
    </div>




    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold">TAMABASE</h1>
                <p class="py-6">
                    Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p>
                <button class="btn btn-primary">Get Started</button>
            </div>
        </div>
    </div>
    <div class="hero bg-base-300 min-h-screen">
        <div class="hero-content flex-col lg:flex-row heman">
            <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
                class="max-w-sm rounded-lg shadow-2xl" />
            <div>
                <h1 class="text-5xl font-bold">我々は、次なるステージへ</h1>
                <p class="py-6">
                    それさえもできる時代になったのです。<br>
                    ネクストステージへ突き進む！
                </p>
                <button class="btn btn-primary">Get Started</button>
            </div>
        </div>
    </div>
    <div class="hero bg-base-200 min-h-screen py-20">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Login now!</h1>
                <p class="py-6">
                    Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p>
            </div>
            <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
                <div class="card-body">
                    <fieldset class="fieldset">
                        <label class="fieldset-label">Email</label>
                        <input type="email" class="input" placeholder="Email" />
                        <label class="fieldset-label">Password</label>
                        <input type="password" class="input" placeholder="Password" />
                        <div><a class="link link-hover">Forgot password?</a></div>
                        <button class="btn btn-neutral mt-4">Login</button>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <div class="hero min-h-screen py-20"
        style="background-image: url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp);">
        <div class="hero-overlay"></div>
        <div class="hero-content text-neutral-content text-center">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">TAMABASE</h1>
                <p class="mb-5">
                    Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p>
                <button class="btn btn-primary">Get Started</button>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="drawer">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            <label for="my-drawer" class="btn btn-primary drawer-button">Open drawer</label>
        </div>
        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                <!-- Sidebar content here -->
                <li><a>Sidebar Item 1</a></li>
                <li><a>Sidebar Item 2</a></li>
            </ul>
        </div>
    </div>






    <!-- ヒーローエリア -->
    <section class="text-center h-96 bg-red-700">
        <h2 class="text-4xl md:text-5xl font-black mb-4">
            WE ARE PLAYFUL PROFESSIONALS
        </h2>
        <p class="text-sm text-gray-700">私たちは、遊び心のあるプロフェッショナルです</p>
    </section>

    <!-- コンセプトセクション -->
    <section class="text-center px-6 py-20 md:px-16">
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
            <a href="#more" class="bg-black text-white px-8 py-2 rounded-full text-sm hover:bg-gray-800 transition">
                More
            </a>
        </div>
    </section>
@endsection
