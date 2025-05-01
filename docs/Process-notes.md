# tamabase プロジェクト初期構築手順

🕒 作成日時: 2025-05-01 16:00 (JST)

#　ローカル側
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

◎ sorcetreeでGitHubと連動

# sorcetree
```bash

sorcetreeでフォルダを開くと連動されるがエラーがでる。
これを修正。sorecetreeでターミナルを開く。

# WSL上の特定ディレクトリ（tamabase）を、グローバル設定で「安全なGit作業ディレクトリ」に追加するよ
git config --global --add safe.directory '%(prefix)///wsl.localhost/Ubuntu/home/sankplan/tamabase'

```

# ローカル側
```bash
.gitconfigファイルに下記の内容を追記する

# Gitの設定（safe.directory）で、このプロジェクトフォルダを「安全な作業ディレクトリ」として明示的に登録するよ
# WSL（Windows Subsystem for Linux）上のUbuntu環境を使っている場合に特に必要になる設定だね

[safe]
bareRepository = explicit
directory = %(prefix)///wsl.localhost/Ubuntu/home/sankplan/tamabase


# git登録
# 新しくGitリポジトリを初期化して、このフォルダをバージョン管理できるようにするよ
git init


# リモートリポジトリを設定
# 既存のGitHubリポジトリ（origin）をこのプロジェクトに登録して、プッシュできるようにするよ
git remote add origin https://github.com/CodeNovice01/tamabase.git

# 新しいSSH鍵（ed25519方式）を作成して、GitHub用に使うよ
# コメントにメールアドレスを入れて、鍵ファイル名を「id_rsa_github.tamabase」と指定して保存するよ

# \\wsl.localhost\Ubuntu\home\sankplan\.ssh
# このフォルダへ移動
cd .ssh

ssh-keygen -t ed25519 -C "sankplan@gmail.com" -f "id_rsa_github.tamabase"
パスフレーズは入力しない（したほうが安全だが、作業工程が増えるデメリットも）


```


◎ 既存のフォルダをGitHubリポジトリにリンクする

# GitHub
```bash

# 既存のフォルダをGitHubリポジトリにリンクする
# Githubで登録する
https://github.com/CodeNovice01/tamabase.git

```


# ローカル側

```bash
# 次に~/.ssh/configに読み分けの記載をします。
# ローカルにつくりFTPでアップする。

Host github.tamabase
HostName github.com
User git
Port 22
IdentityFile ~/.ssh/id_rsa_github.tamabase
TCPKeepAlive yes
IdentitiesOnly yes

# 作成した公開鍵（id_rsa_github.tamabase.pub）の中身を表示して
# GitHubなどにコピペできるようにするよ
cat .ssh/id_rsa_github.tamabase.pub


```



# GitHub
```bash

# GitHubに貼り付ける
# GitHubを開く

自分のプロフィールアイコン → 「Settings（設定）」に行く

「New SSH key」を押す

Titleにわかりやすい名前を入力（例：tamabaseとか）

さっきコピーしたキーを「Key」欄にペタッと貼り付ける

「Add SSH key」を押す

これで登録完了〜〜〜🎉✨

```


# サーバー側
```bash

サーバーにFTPでキーファイルをアップ

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

# サーバー側
```bash

```


# ローカル側

```bash

```


```bash
---












#　サーバー側での作業
```bash



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