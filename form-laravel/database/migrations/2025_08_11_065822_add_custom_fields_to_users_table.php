<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->string('nama')->after('id');
            $table->enum('tipe_pengguna', ['Klien', 'Freelancer'])->after('password');
            $table->string('telepon', 15)->nullable()->after('tipe_pengguna');
            $table->text('bio')->nullable()->after('telepon');
            $table->string('gambar')->nullable()->after('bio');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn(['nama', 'tipe_pengguna', 'telepon', 'bio', 'gambar']);
        });
    }
}
