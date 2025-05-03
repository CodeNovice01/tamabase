{{-- resources/views/livewire/news-browser.blade.php --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    {{-- 左カラム：ニュースのタイトル一覧を表示するよ --}}
    <div class="col-span-1 border-r pr-4">
        <h2 class="text-lg font-bold mb-4">ニュース一覧</h2>
        <ul>
            @foreach ($newsList as $news)
                <li class="mb-2">
                    {{-- タイトルをクリックすると selectNews メソッドが呼ばれて、詳細が右側に表示されるよ --}}
                    <button wire:click="selectNews({{ $news->id }})" class="text-blue-600 hover:underline">
                        {{ $news->title }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- 右カラム：選択されたニュースの本文を表示するよ --}}
    <div class="col-span-2">
        @if ($selectedNews)
            <h2 class="text-xl font-bold mb-2">{{ $selectedNews->title }}</h2>
            <p class="text-sm text-gray-500 mb-4">{{ $selectedNews->created_at->format('Y-m-d H:i') }}</p>
            <div class="prose max-w-none">
                {!! $selectedNews->body !!} {{-- HTMLをそのまま表示（画像やタグも含めて） --}}
            </div>
        @else
            {{-- 初期状態または何も選ばれていないときに表示するメッセージ --}}
            <p class="text-gray-400">記事を選択してください</p>
        @endif
    </div>
</div>
