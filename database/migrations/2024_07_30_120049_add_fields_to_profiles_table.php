<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('instagram_link')->nullable();
            $table->text('skills')->nullable();
            $table->string('current_occupation')->nullable();
            $table->string('linkedin_profile')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('instagram_link');
            $table->dropColumn('skills');
            $table->dropColumn('current_occupation');
            $table->dropColumn('linkedin_profile');
            $table->dropColumn('gender');
            $table->dropColumn('age');
        });
    }
}
