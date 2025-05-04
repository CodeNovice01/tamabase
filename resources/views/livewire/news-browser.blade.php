<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6">

    {{-- 🧭 左カラム：検索と一覧 --}}
    <div class="col-span-1 space-y-4">
        <div class="card bg-base-100 shadow-md p-4 max-w-4xl w-full"
            style="height: calc(100vh - 150px); overflow-y: auto;">
            <h2 class="text-lg font-bold mb-2">📋 ニュース一覧</h2>

            {{-- 検索フィールド --}}
            <label class="input input-bordered flex items-center gap-2 mb-4">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="検索..." class="grow" />
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                </svg>
            </label>

            {{-- ニュース記事の一覧 --}}
            <ul class="space-y-2 max-h-[60vh] overflow-y-auto pr-1">
                @forelse ($newsList as $news)
                    <li>
                        <button wire:click="selectNews({{ $news->id }})"
                            class="btn btn-block justify-start text-left truncate">
                            {{ $news->title }}
                        </button>
                    </li>
                @empty
                    <li class="text-gray-400 text-sm">該当する記事がありません</li>
                @endforelse
            </ul>

            <div class="mt-4">
                {{ $newsList->links() }}
            </div>
        </div>
    </div>

    {{-- 📄 右カラム：選択されたニュースの本文 --}}
    <div class="col-span-2">
        <div class="card bg-base-100 shadow-md p-6 max-w-4xl w-full"
            style="height: calc(100vh - 150px); overflow-y: auto;">

            @if ($selectedNews)
                <h2 class="text-2xl font-bold mb-1">{{ $selectedNews->title }}</h2>
                <p class="text-sm text-gray-500 mb-4">{{ $selectedNews->created_at->format('Y年n月j日 H:i') }}</p>

                {{-- 本文の表示 --}}
                <div class="prose max-w-none transition-opacity duration-500 opacity-0 animate-fade-in" id="news-body">

                    {!! preg_replace_callback(
                        '/(src|href)="https?:\/\/[^\/]+\/storage\/private-news\/([^"?]+)(?:\?[^"]*)?"/',
                        function ($matches) {
                            $attr = $matches[1];
                            $filename = $matches[2];
                            $secureUrl = route('news-images.show', ['filename' => $filename]);
                    
                            if ($attr === 'href') {
                                return "{$attr}=\"#\" data-url=\"{$secureUrl}\" class=\"preview-trigger\"";
                            }
                            return "{$attr}=\"{$secureUrl}\"";
                        },
                        $selectedNews->body,
                    ) !!}
                </div>
            @else
                <div class="text-gray-400">← 記事を選択してください</div>
            @endif
        </div>
    </div>


    {{-- 🌟 モーダル本体（DaisyUIのdialogタグ） --}}
    <dialog id="preview_modal" class="modal">
        <div class="modal-box max-w-4xl">
            <h3 class="font-bold text-lg mb-2">プレビュー</h3>
            <div id="preview_content" class="py-2">
                <!-- 画像やPDFがここに入るよ -->
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">閉じる</button>
                </form>
            </div>
        </div>
    </dialog>

    {{-- ✨ モーダル表示スクリプト --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('preview_modal');
            const content = document.getElementById('preview_content');

            document.body.addEventListener('click', function(e) {
                const trigger = e.target.closest('.preview-trigger');
                if (!trigger) return;

                e.preventDefault();
                const url = trigger.getAttribute('data-url');

                content.innerHTML = '';

                if (url.match(/\.(jpg|jpeg|png|gif|webp)$/i)) {
                    content.innerHTML =
                        `<img src="${url}" class="max-w-full max-h-[70vh] mx-auto rounded-lg transition-opacity duration-500 opacity-0" onload="this.classList.add('opacity-100')" />`;

                } else if (url.match(/\.pdf$/i)) {
                    content.innerHTML = `<iframe src="${url}" class="w-full h-[70vh] rounded-lg"></iframe>`;
                } else {
                    content.innerHTML =
                        `<a href="${url}" target="_blank" class="text-blue-500 underline">こちらを開く</a>`;
                }

                modal.showModal();
            });
        });
    </script>


</div>
