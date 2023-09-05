<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
           $table->unsignedBigInteger('id', true);//unsigned-+なし
           $table->longText('content');
           $table->unsignedBigInteger('user_id');
           //論理削除を定義
           $table->softDeletes();
           $table->timestamp('update_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
           $table->timestamp('create_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
           //user_idに入るのはusersのidに属するの
           $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memos');
    }
};
