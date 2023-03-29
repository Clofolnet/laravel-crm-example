<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('contract_type');
            $table->string('name', 30);
            $table->string('surname', 30);
            $table->string('middle_name', 30);
            $table->date('birth_of_date');
            $table->string('email');
            $table->string('address');
            $table->string('phone', 17);
            $table->string('passport_series', 2);
            $table->string('passport_number', 7);
            $table->string('PIN', 14);
            $table->unsignedBigInteger('region_id');
            $table->string('authority');
            $table->unsignedBigInteger('major_id');
            $table->smallInteger('gender');
            $table->boolean('discount');
            $table->float('percent')->nullable();
            $table->date('discount_from')->nullable();
            $table->date('discount_to')->nullable();
            $table->boolean('super_contract');
            $table->bigInteger('super_contract_sum')->nullable();
            $table->string('passport_document');
            $table->string('IELTS_document');
            $table->string('contract_document')->nullable();
            $table->smallInteger('status')->nullable();
            $table->unsignedBigInteger('comment_id');
            $table->timestamps();

            $table->foreign('region_id')
                ->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('major_id')
                ->references('id')->on('majors')->onDelete('cascade');
            $table->foreign('comment_id')
                ->references('id')->on('comments')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}