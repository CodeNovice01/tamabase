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



<<<<<<< HEAD


## GitHubと連携し、Sourcetreeで快適に管理！
```bash

ローカル（vs-code）で制作

Sourcetreeでバージョン管理＆プッシュ

PowerShellでサーバーにプル＆構築


```



=======
◎ sorcetreeでGitHubと連動

#　サーバー側での作業
>>>>>>> 日本語化

```bash


<<<<<<< HEAD

=======
```
>>>>>>> 日本語化



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


```bash

```


```bash

```

```bash

```
--------------------　git登録編　-------------------
githubと連動させて、sorcetreeで管理する