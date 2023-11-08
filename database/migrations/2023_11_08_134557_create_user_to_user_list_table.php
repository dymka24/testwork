<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\User;
use \App\Models\UserList;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_users_list', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->constrained();
            $table->unsignedBigInteger('user_list_id');
            $table->foreign('user_list_id')->references('id')->on('user_lists')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_to_user_list');
    }
};
