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
        Schema::create('user_to_user_list', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->onUpdateCascade()->onDeleteCascade();
            $table->foreignIdFor(UserList::class)->onUpdateCascade()->onDeleteCascade();
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
