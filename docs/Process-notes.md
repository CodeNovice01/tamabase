# tamabase プロジェクト初期構築手順

🕒 作成日時: 2025-05-01 16:00 (JST)

```bash
# 1. 新しいLaravelプロジェクトを作成
laravel new tamabase

# 2. Livewireを選択
#    Laravel's built-in authenticationを選択

# 3. Laravel Voltを使いますか？
#    Would you like to use Laravel Volt?
#    → Yes を選択

# 4. テストフレームワークを選択
#    Which testing framework do you prefer?
#    → Pest を選択

# 5. npm install と npm run build を実行するか選択
#    Would you like to run npm install and npm run build?
#    → Yes を選択

# 6. 作成したプロジェクトディレクトリに移動
cd tamabase

# 7. Sail をインストール（開発用）
composer require laravel/sail --dev

# 8. sail の初期設定を実行（サービスを選択）
php artisan sail:install

# アプリケーションの秘密鍵を新しく生成して、.envファイルに設定するよ
sail artisan key:generate


```


# git登録

```bash
# 新しくGitリポジトリを初期化して、このフォルダをバージョン管理できるようにするよ
git init

リモートリポジトリを設定

# 既存のGitHubリポジトリ（origin）をこのプロジェクトに登録して、プッシュできるようにするよ
git remote add origin https://github.com/CodeNovice01/tamabase.git




# 新しいSSH鍵（ed25519方式）を作成して、GitHub用に使うよ
# コメントにメールアドレスを入れて、鍵ファイル名を「id_rsa_github.tamabase」と指定して保存するよ

\\wsl.localhost\Ubuntu\home\sankplan\.ssh
このフォルダへ移動

ssh-keygen -t ed25519 -C "sankplan@gmail.com" -f "id_rsa_github.tamabase"

```


```bash

```
# sorcetreeでGitHubと連動

```bash
sorcetreeでフォルダを開くと連動されるがエラーがでる。
これを修正。sorecetreeでターミナルを開く。

# WSL上の特定ディレクトリ（tamabase）を、グローバル設定で「安全なGit作業ディレクトリ」に追加するよ
git config --global --add safe.directory '%(prefix)///wsl.localhost/Ubuntu/home/sankplan/tamabase'


.gitconfigファイルに下記の内容を追記する

# Gitの設定（safe.directory）で、このプロジェクトフォルダを「安全な作業ディレクトリ」として明示的に登録するよ
# WSL（Windows Subsystem for Linux）上のUbuntu環境を使っている場合に特に必要になる設定だね

[safe]
bareRepository = explicit
directory = %(prefix)///wsl.localhost/Ubuntu/home/sankplan/tamabase

```







```bash

```


```bash

```


```bash

```

```bash

```
--------------------　git登録編　-------------------
githubと連動させて、sorcetreeで管理する