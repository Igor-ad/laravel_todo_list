<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $db = config('database.database');
        $testDb = config('database.test_db');
        DB::statement("CREATE TABLE `$testDb`.`tasks` LIKE `$db`.`tasks`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(sprintf("%s.tasks", config('database.test_db')));
    }
};
