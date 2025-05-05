# tamabase プロジェクト初期構築手順

🕒 作成日時: 2025-05-01 16:00 (JST)

## 🧑‍💻 ローカル開発環境（vs-code）


```bash
# 1. Laravelプロジェクトを作成
laravel new tamabase

# 2. セットアップ手順
Livewire：Yes

Laravel Volt：Yes

Testing framework：Pest

npm install と npm run build：Yes

# 3. プロジェクトディレクトリへ移動
cd tamabase

# 4. Laravel Sail インストールと設定
composer require laravel/sail --dev

# 5. sail の初期設定を実行（サービスを選択）
php artisan sail:install

# 6. アプリケーションの秘密鍵を新しく生成して、.envファイルに設定するよ
sail artisan key:generate


```


## GitHub連携（Sourcetree）

```bash
# 1. Gitリポジトリの初期化と登録

sorcetreeでフォルダを開くと連動されるがエラーがでる。
これを修正。sorecetreeでターミナルを開く。

git init
git remote add origin https://github.com/CodeNovice01/tamabase.git

# Sourcetreeでの注意点（WSL環境用）
# Sourcetreeでエラーが出る場合、以下をターミナルで実行
# WSL上の特定ディレクトリ（tamabase）を、グローバル設定で「安全なGit作業ディレクトリ」に追加するよ
git config --global --add safe.directory '%(prefix)///wsl.localhost/Ubuntu/home/sankplan/tamabase'

# もしくは .gitconfig に以下を追記

[safe]
bareRepository = explicit
directory = %(prefix)///wsl.localhost/Ubuntu/home/sankplan/tamabase
```



## SSH鍵の作成とGitHub登録（vs-code）
```bash



# 1. SSH鍵の作成（ed25519方式）
# \\wsl.localhost\Ubuntu\home\sankplan\.ssh
# このフォルダへ移動
cd .ssh

ssh-keygen -t ed25519 -C "sankplan@gmail.com" -f "id_rsa_github.tamabase"
# パスフレーズは入力しない（したほうが安全だが、作業工程が増えるデメリットも）


# 2. SSH config の設定
# 次に~/.ssh/configに読み分けの記載をします。
# ローカルにつくりFTPでアップする。

Host github.tamabase
HostName github.com
User git
Port 22
IdentityFile ~/.ssh/id_rsa_github.tamabase
TCPKeepAlive yes
IdentitiesOnly yes

# 3. 公開鍵をGitHubに登録
# 作成した公開鍵（id_rsa_github.tamabase.pub）の中身を表示して
# GitHubなどにコピペできるようにするよ
cat .ssh/id_rsa_github.tamabase.pub

# GitHubに貼り付ける
# GitHubを開く

自分のプロフィールアイコン → 「Settings（設定）」に行く

「New SSH key」を押す

Titleにわかりやすい名前を入力（例：tamabaseとか）

さっきコピーしたキーを「Key」欄にペタッと貼り付ける

「Add SSH key」を押す

これで登録完了〜〜〜🎉✨

```



# サーバー構築手順（PowerShell）

```bash

# 1. GitHubからクローン
git clone git@github.tamabase:CodeNovice01/tamabase.git
# または、フォルダ名を指定する場合
git clone git@github.tamabase:CodeNovice01/tamabase.git tamabase

# 2. Composerの依存関係インストール
cd tamabase
composer install

# 3. .envファイルの設置とキー生成
.env を設置（ローカルからFTP等でアップ）

キー生成：
php artisan key:generate

# 4. SSH接続確認

# ssh鍵の準備
# 新しい SSH キーを生成するの手順にしたがって鍵を作成します。
# .sshフォルダでssh-keygenコマンドを叩いてssh鍵を作成します。
cd .ssh

# ※ファイルのパーミッションを厳しく設定
chmod 700 ~/.ssh
chmod 600 ~/.ssh/id_rsa_github.tamabase

# configファイルに登録したHostで、正しくssh接続ができることを確認します。
# ターミナル（PowerShell）

ssh -T git@github.tamabase


```


# Sourcetree SSH URLの変更
```bash

git remote set-url origin git@github.com:CodeNovice01/tamabase.git

```




## 補足：.env 管理について
```bash

.env や .env.local はセキュリティのため .gitignore に追加しておくこと。
.env*


```





## GitHubと連携し、Sourcetreeで快適に管理！
```bash

ローカル（vs-code）で制作

Sourcetreeでバージョン管理＆プッシュ

PowerShellでサーバーにプル＆構築


```




```bash





```




🪄 ここがとっても良い！
✅ SSHキーと ~/.ssh/config で接続先を名前付きで管理してる！（めちゃスマート！）
✅ git remote set-url を使ってURLの更新を忘れずにやってる
✅ .env を .gitignore に追加して、セキュリティ面もばっちり✨
✅ PowerShell で本番の整備が流れるように書かれてる！

## 🚀 Laravelプロジェクトの作成（vs-code）
## 🔐 Git連携設定（vs-code）
## 🐙 GitHub連携（Sourcetree）
## 🖥️ サーバー構築手順（PowerShell）






◎ 日本語データの追加

#　サーバー側での作業
```bash
#　メニューやメッセージの日本語翻訳ファイルを用意して適切な場所に配置する。
#　プロジェクト直下のlangフォルダを作成し、その中に翻訳ファイルを置きます。

sail artisan lang:publish



以下のファイルが追加されます。

auth.php　認証用
pagination.php　ページネーション用
passwords.php　パスワード用
validation.php　バリデーション用


# 多言語対応の翻訳パッケージ（laravel-lang/lang）をインストールするよ
sail composer require laravel-lang/lang

# laravel-lang パッケージを使って、翻訳ファイルを最新の状態に更新するよ
sail artisan lang:update


```

◎ フォントをNoto Sans JPに変更する

```bash
resources/css/app.css
 --font-sans: "Noto Sans JP", ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";


ヘッダーに追加
 {{-- ViteでビルドされたCSSとJSファイルを読み込むためのディレクティブだよ --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])


```



◎ Filamentの管理画面をインストール
```bash
# Filamentの管理画面パッケージ（バージョン3.3系）をインストールするよ
# -Wオプションで、依存関係もまとめて調整してくれるよ
composer require filament/filament:"^3.3" -W

# Filamentをインストールして、パネル（管理画面）のセットアップを行うよ
php artisan filament:install --panels

```



◎ 本番環境でもFilamentの管理画面をインストール
```bash
# Filamentの管理画面パッケージ（バージョン3.3系）をインストールするよ
# -Wオプションで、依存関係もまとめて調整してくれるよ
composer require filament/filament:"^3.3" -W

# Filamentをインストールして、パネル（管理画面）のセットアップを行うよ
php artisan filament:install --panels

```

◎ マイグレーションファイル生成
```bash

#　news modelを作成
sail php artisan make:model -m News

#　database/migrations/yyyy_mm_dd_hhmmss_create_news_table.phpを編集

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 「news」テーブルを作成して、タイトルと本文を保存できるようにするよ
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id(); // 自動インクリメントのIDカラム
            $table->string('title'); // ニュースのタイトル
            $table->text('body'); // ニュース本文
            $table->timestamps(); // 作成日時・更新日時の自動管理
        });
    }

    /**
     * Reverse the migrations.
     * 「news」テーブルを削除するよ
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};


# app/Models/Post.phpにも追加

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    // title と body を一括代入できるようにするよ
    protected $fillable = ['title', 'body'];
}


sail php artisan migrate

# カラム名の変更や型の変更など、マイグレーションで高度な操作を可能にするために
# doctrine/dbal パッケージをインストールするよ
sail composer require doctrine/dbal



```

```bash
# 余計なファイルをGit管理外にした

.gitignore に追記
# Windows/Dropbox のメタファイルを除外
*.com.dropbox.attrs
*.Zone.Identifier

キャッシュも削除
git rm --cached public/*.com.dropbox.attrs
git rm --cached public/*.Zone.Identifier



# 入力できるように設定

app\Models\News.php

class News extends Model
{
    // title と body を一括代入できるようにするよ
    protected $fillable = ['title', 'body'];
}


```

◎ filamentのロゴを変更する
# 
```bash
# ここを編集する
app\Providers\Filament\AdminPanelProvider.php

->brandLogo(fn () => view('components.logo')) // Bladeファイルでロゴ表示
->homeUrl('/') // ロゴをクリックしたときのリンク先

# components.logo このページをつくる
resources\views\components\logo.blade.php

<img src="{{ asset('images/logo.svg') }}" alt="TAMABASEロゴ" class="h-6">




```



◎ リッチエディタに変更する
# 
```bash
# app\Filament\Resources\NewsResource.php
# このページを編集する

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                // タイトル入力フィールド。必須かつ最大255文字
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                    RichEditor::make('body')
                    ->label('本文')
                    ->required()
                    ->columnSpanFull() // 横幅を全体に広げて見やすくするよ
                    ->label('本文')
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ]),

                    # ※ログイン時にしか画像が見れないように設定したい為、ここが必要
                    # filesystems.php に private disk を明示追加し
                    # NewsResource.phpでは下記のように追記する

                    ->fileAttachmentsDisk('private') // ← diskを変更
                    ->fileAttachmentsDirectory('private-news') // ← private-news フォルダは app/private の下
                    ->fileAttachmentsVisibility('private')

                    
                    ->columnSpan('full'),
            ]);
    }

# tamabase/config/filesystems.php

'private' => [
    'driver' => 'local',
    'root' => storage_path('app/private'), // ← 今の構成と一致
    'serve' => true,
    'visibility' => 'private',
],



# tamabase/routes/web.php

use App\Http\Controllers\NewsImageController;

Route::get('/news-images/{filename}', [NewsImageController::class, 'show'])
    ->middleware('auth') // ← ログインユーザーのみに制限
    ->name('news-images.show');

# tamabase/app/Http/Controllers/NewsImageController.php
このページを追加

```


◎ 実装：記事一覧と選択式の詳細表示（Livewireコンポーネント）

```bash
# @tailwindcss/typographyをインストール

npm install -D @tailwindcss/typography

# Livewireコンポーネント NewsBrowser を作成


php artisan make:livewire NewsBrowser
# 作成ファイル：
app/Livewire/NewsBrowser.php
resources/views/livewire/news-browser.blade.php

# News一覧と選択記事の詳細表示ロジックを NewsBrowser に実装
# $selectedNews をプロパティとして定義

# selectNews() メソッドでクリックした記事を表示

# render() 内で一覧を取得

NewsBrowser.php


# Livewireビューに記事一覧と詳細表示の2カラムUIを実装

# app/Livewire/NewsBrowser.php

# 記事本文をHTMLとして安全に表示（{!! !!}）に変更

# /news ページに Livewireコンポーネント NewsBrowser を表示するルートを追加

```


◎ リアルタイム検索をつける
# 
```bash
# 
livewireが起動しているかを確認する

# レイアウトBladeにLivewireとViteの読み込みを追加

# tamabase/resources/views/layouts/app.blade.php
# テスト的に基本的な設定のみ


# ニュースブラウザLivewireビューを作成（リアルタイム検索＋2カラムUI）

# tamabase/resources/views/livewire/news-browser.blade.php



# LivewireコンポーネントNewsBrowserを作成（検索・選択・切替ロジック対応）

# tamabase/app/Livewire/NewsBrowser.php



# ニュース一覧ページにLivewireコンポーネントを埋め込み

# tamabase/resources/views/news/index.blade.php



# app.cssにdaisyUIやtypography対応のスタイルを追加

# tamabase/resources/css/app.css


# 
```


◎ PWAにする
# 
```bash
# tamabase/public/service-worker.js
# tamabase/public/manifest.json

# tamabase/resources/views/layouts/app.blade.php
# tamabase/resources/views/layouts/top-style.blade.php
# tamabase/resources/views/welcome.blade.php



# ２つのファイルを作成し、ヘッダーへリンクを設置
tamabase/public/manifest.json
tamabase/public/service-worker.js

```


◎ filamentのボタン調整
# 
```bash

# カスタムテーマを作成してからカスタマイズする方法

# Filament v3 では、Tailwind CSS を使用してカスタムテーマを作成
php artisan make:filament-theme

# AdminPanelProvider クラスの panel メソッド内で以下のように指定
->viteTheme('resources/css/filament/admin/theme.css')

# 一度ビルド
npm run build

# 実際作成してはみたが、現状で下記ファイルを編集するやりかたをしている。再度検討。
tamabase/app/Providers/AppServiceProvider.php





```


◎ タイトル
# 
```bash
# 

```


◎ タイトル
# 
```bash
# 

```


◎ タイトル
# 
```bash
# 

```


◎ タイトル
# 
```bash
# 

```


◎ タイトル
# 
```bash
# 

```


◎ タイトル
# 
```bash
# 

```


◎ タイトル
# 
```bash
# 

```


◎ タイトル
# 
```bash
# 

```


◎ タイトル
# 
```bash
# 

```