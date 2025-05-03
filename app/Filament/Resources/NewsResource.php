<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    // このリソースが扱うEloquentモデルを指定しているよ
    protected static ?string $model = News::class;

    // ナビゲーションメニューに表示されるアイコンを指定しているよ
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * 管理画面の「作成」「編集」フォームで使用するフィールドを定義しているよ
     */
    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                // タイトル入力フィールド。必須かつ最大255文字
                Forms\Components\TextInput::make('title')
                    ->label('タイトル')
                    ->required()
                    ->maxLength(255),

                // RichEditor（記事本文用のWYSIWYGエディタ）
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
                    ])
                    ->fileAttachmentsDisk('private') // ← diskを変更
                    ->fileAttachmentsDirectory('private-news') // ← private-news フォルダは app/private の下
                    ->fileAttachmentsVisibility('private')
                    ->columnSpan('full'),

            ]);
    }

    /**
     * 一覧ページ（テーブル）で表示するカラムや操作を定義しているよ
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // タイトルのカラム。検索可能
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

                // 作成日時のカラム。並び替え可能でデフォルトでは非表示
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // 更新日時のカラム。並び替え可能でデフォルトでは非表示
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // 今はフィルターなし。必要に応じて追加できるよ
            ])
            ->actions([
                // 各行に表示される「編集」ボタン
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // 一括操作用のボタン。今は「削除」のみ
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * 関連（リレーション）の管理用。今は使っていないので空だよ
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * このリソースに関連付けられるページ（一覧・作成・編集）を定義しているよ
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'), // 一覧ページのルート
            'create' => Pages\CreateNews::route('/create'), // 作成ページのルート
            'edit' => Pages\EditNews::route('/{record}/edit'), // 編集ページのルート（ID付き）
        ];
    }
}
