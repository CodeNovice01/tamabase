<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class NewsBrowser extends Component
{
    use WithPagination; // Livewireのページネーション機能を使うためのトレイトだよ

    // 検索キーワードを保持するプロパティだよ
    public $search = '';

    // 選択されたニュース記事を格納するプロパティ（初期値は null）
    public $selectedNews = null;

    // 検索語をURLのクエリパラメータに保持する設定だよ（戻るボタンやブックマーク対策に便利）
    protected $queryString = ['search'];

    /**
     * 検索語が更新されたときに自動で呼び出されるメソッドだよ
     * ページ番号をリセットして、先頭ページに戻す処理だよ
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * ニュース記事がクリックされたときに呼ばれるメソッドだよ
     * 指定されたIDのニュース記事を取得して $selectedNews にセットするよ
     */
    public function selectNews($id)
    {
        $this->selectedNews = News::find($id);
    }

    /**
     * コンポーネントの表示ロジックだよ
     * 検索条件に一致するニュース記事を新しい順にページネーションで取得して、ビューに渡すよ
     */
    public function render()
    {
        $newsList = News::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('body', 'like', '%' . $this->search . '%');
                });
            })
            ->latest() // 作成日の新しい順に並べるよ
            ->paginate(10); // ページごとに10件ずつ表示するよ

        return view('livewire.news-browser', [
            'newsList' => $newsList, // ビューで使うニュース一覧データを渡しているよ
        ]);
    }
}
