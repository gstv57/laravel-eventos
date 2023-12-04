<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('country');
            $table->string('address');
            $table->string('address_number');
            $table->string('neighborhood');
            $table->string('state');
            $table->string('zip');
            $table->string('city');
            $table->foreignIdFor(User::class);
            // foreignIdFor(User::class); faz por debaixo dos panos a mesma coisa que o comment abaixo.
            // $table->foreign('user_id')->on('users')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_contact_infos');
    }
};
