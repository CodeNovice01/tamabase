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
