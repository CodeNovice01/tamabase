<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6">

    {{-- 🧭 左カラム：検索と一覧 --}}
    <div class="col-span-1 space-y-4">
        <div class="card bg-base-100 shadow-md p-4 max-w-4xl w-full"
            style="height: calc(100vh - 150px); overflow-y: auto;">
            <h2 class="text-lg font-bold mb-2">📋 ニュース一覧</h2>

            {{-- 検索入力フィールド（入力値は Livewire の $search プロパティにバインドされてるよ） --}}
            <label class="input input-bordered flex items-center gap-2 mb-4">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="検索..." class="grow" />
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                </svg>
            </label>

            {{-- ニュース記事の一覧表示。検索結果が反映されるよ --}}
            <ul class="space-y-2 max-h-[60vh] overflow-y-auto pr-1">
                @forelse ($newsList as $news)
                    <li>
                        {{-- タイトルをクリックすると右側に本文が表示されるよ --}}
                        <button wire:click="selectNews({{ $news->id }})"
                            class="btn btn-block justify-start text-left truncate">
                            {{ $news->title }}
                        </button>
                    </li>
                @empty
                    {{-- 該当するニュースがなかった場合の表示 --}}
                    <li class="text-gray-400 text-sm">該当する記事がありません</li>
                @endforelse
            </ul>

            <div class="mt-4">
                {{ $newsList->links() }}
            </div>
        </div>
    </div>

    {{-- 📄 右カラム：選択されたニュースの本文表示 --}}
    <div class="col-span-2">
        <div class="card bg-base-100 shadow-md p-6 max-w-4xl w-full"
            style="height: calc(100vh - 150px); overflow-y: auto;">

            @if ($selectedNews)
                {{-- 選択されたニュースのタイトルと作成日時 --}}
                <h2 class="text-2xl font-bold mb-1">{{ $selectedNews->title }}</h2>
                <p class="text-sm text-gray-500 mb-4">{{ $selectedNews->created_at->format('Y年n月j日 H:i') }}</p>

                {{-- 本文をHTMLとして表示。画像や装飾も含まれるよ --}}
                <div class="prose max-w-none">
                    {!! preg_replace_callback(
                        // src= または href= 属性にある private-news の画像URLを対象に
                        '/(src|href)="https?:\/\/[^\/]+\/storage\/private-news\/([^"?]+)(?:\?[^"]*)?"/',
                        function ($matches) {
                            // $matches[1] = 'src' or 'href'
                            // $matches[2] = ファイル名
                            $attr = $matches[1];
                            $filename = $matches[2];
                            $secureUrl = route('news-images.show', ['filename' => $filename]);
                            return "{$attr}=\"{$secureUrl}\"";
                        },
                        // 元のHTML本文
                        $selectedNews->body,
                    ) !!}
                </div>
            @else
                {{-- 初期状態または未選択時のメッセージ --}}
                <div class="text-gray-400">← 記事を選択してください</div>
            @endif
        </div>
    </div>
</div>
