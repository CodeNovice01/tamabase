{{-- resources/views/news/index.blade.php などで Livewire コンポーネントを読み込んでいるよ --}}
@extends('layouts.top-style')






<header class="w-full lg:max-w-4xl max-w-[335px] text-sm mt-10 mb-6 not-has-[nav]:hidden">
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
                <a href="{{ url('/admin') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                    ダッシュボード
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                    ログイン
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        新規登録
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>
