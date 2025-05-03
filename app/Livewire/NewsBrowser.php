<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News;

class NewsBrowser extends Component
{
    // 選択されたニュースを保持するプロパティだよ（初期状態はnull）
    public $selectedNews = null;

    /**
     * ニュースが選択されたときに呼び出されるメソッドだよ
     * 引数として受け取ったニュースIDを使って、そのニュースを取得・保持するよ
     */
    public function selectNews($newsId)
    {
        $this->selectedNews = News::find($newsId); // IDでニュースを検索して代入
    }

    /**
     * コンポーネントの表示に使うビューを返すメソッドだよ
     * 最新のニュース一覧を取得してビューに渡しているよ
     */
    public function render()
    {
        return view('livewire.news-browser', [
            'newsList' => News::orderBy('created_at', 'desc')->get(), // 作成日の新しい順に並べた全ニュース
        ]);
    }
}
