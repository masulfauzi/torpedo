<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_mengajar', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('id_jadwal');
            $table->foreign('id_jadwal')->references('id')->on('jadwal')->onDelete('restrict')->onUpdate('cascade');

            $table->date('tgl_pembelajaran');
            $table->text('materi');

            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnal_mengajar');
    }
};
