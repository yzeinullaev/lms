<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE users MODIFY role_id ENUM('1', '2', '3', '4') DEFAULT '3'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE users MODIFY role_id ENUM('1', '2', '3') DEFAULT '3'");
    }

};
