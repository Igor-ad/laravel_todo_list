<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->integer('user_id');
            $table->string('status')->default('todo');
            $table->smallInteger('priority')->default(1);
            $table->string('title');
            $table->longText('description');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('completed_at')->default(null);
            $table->index('user_id');
            $table->index('priority');
            $table->index('parent_id');
            $table->fullText('title');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
