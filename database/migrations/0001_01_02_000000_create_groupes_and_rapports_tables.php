<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ajouter la colonne supervisor_id à la table users
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('supervisor_id')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade')->after('role_id');
        });

        // Créer la table groupes
        Schema::create('groupes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        // Créer la table rapport_groupes
        Schema::create('rapport_groupes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('groupe_id')->constrained('groupes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('file');
            $table->timestamp('date_rapport')->nullable();
            $table->timestamps();
        });

        // Créer la table rapport_kas
        Schema::create('rapport_kas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('file');
            $table->timestamp('date_rapport')->nullable();
            $table->timestamps();
        });

        // Créer la table rapport_mas
        Schema::create('rapport_mas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('file');
            $table->timestamp('date_rapport')->nullable();
            $table->timestamps();
        });

        // Créer la table rapport_fps
        Schema::create('rapport_fps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('file');
            $table->timestamp('date_rapport')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport_fps');
        Schema::dropIfExists('rapport_mas');
        Schema::dropIfExists('rapport_kas');
        Schema::dropIfExists('rapport_groupes');
        Schema::dropIfExists('groupes');
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('supervisor_id');
        });
    }
};
