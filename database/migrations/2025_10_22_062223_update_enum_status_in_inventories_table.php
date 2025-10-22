<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE inventories MODIFY status ENUM('ok', 'rusak', 'hilang', 'dipakai', 'baru') DEFAULT 'ok'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE inventories MODIFY status ENUM('ok', 'rusak', 'hilang', 'dipakai') DEFAULT 'ok'");
    }
};
