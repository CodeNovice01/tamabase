<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News;

class NewsBrowser extends Component
{
    // 検索キーワードを保持するプロパティ（検索フォームと連動してるよ）
    public $search = '';

    // 現在選択されているニュース記事を保持するプロパティ
    public $selectedNews = null;

    // サイドメニューの開閉状態を管理するためのフラグ（モバイル対応などで使う想定）
    public $isMenuOpen = false;

    /**
     * サイドメニューの開閉を切り替えるメソッドだよ
     */
    public function toggleMenu()
    {
        $this->isMenuOpen = !$this->isMenuOpen;
    }

    /**
     * ニュースが選択されたときに、そのIDから記事を取得して表示するためのメソッドだよ
     *
     * @param int $id 表示するニュース記事のID
     */
    public function selectNews($id)
    {
        $this->selectedNews = News::find($id);
    }

    /**
     * 検索ワードに応じてニュース一覧を取得するcomputedプロパティだよ
     * 検索が空なら全件、入力があればタイトルや本文にマッチしたものを返すよ
     *
     * @return \Illuminate\Support\Collection ニュース一覧のコレクション
     */
    public function getNewsListProperty()
    {
        return News::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('body', 'like', '%' . $this->search . '%');
            })
            ->latest() // 作成日の新しい順に並べるよ
            ->get();
    }

    /**
     * コンポーネントのビューを返すメソッドだよ
     * newsList は computed プロパティを使っているので $this->newsList で取得されるよ
     */
    public function render()
    {
        return view('livewire.news-browser', [
            'newsList' => $this->newsList, // getNewsListProperty() の結果がここに渡るよ
        ]);
    }
}
