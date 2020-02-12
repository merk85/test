<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUserDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('departments')->insert([
            [
                'name' => 'Администрация',
                'created_at' => date('Y-m-d H:i:s')
            ], [
                'name' => 'Менеджеры',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->integer('department_id')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('department_id');
        });
    }
}
