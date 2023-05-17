<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameAuditsTableToLogs extends Migration
{
    public function up()
    {
        Schema::rename('audits', 'logs');
    }

    public function down()
    {
        Schema::rename('logs', 'audits');
    }
}
