<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Ubah tipe kolom dan set default (tanpa check)
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 255)->default('bendahara')->nullable(false)->change();
        });

        // Hapus constraint lama jika ada
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check;');

        // Tambahkan constraint baru dengan CHECK
        DB::statement(
            "ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('admin', 'bendahara', 'viewer'));"
        );
    }

    public function down(): void
    {
        // Drop constraint saat rollback
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check;');

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable()->default(null)->change();
        });
    }
};
