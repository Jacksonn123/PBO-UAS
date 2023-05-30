<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_no', 255);
            $table->string('description', 255);
            $table->string('acquisition', 255);
            $table->string('document', 255);
            $table->string('serial_no', 255)->nullable();
            $table->string('price', 255);
            $table->date('tax_date_line')->nullable();
            $table->string('tax_price', 255)->nullable();
            $table->date('wto_date_line')->nullable();
            $table->string('wto_price', 255)->nullable();
            $table->date('life_time')->nullable();
            $table->string('depreciation', 255)->nullable();
            $table->string('location_of_document', 255)->nullable();
            $table->string('location_of_asset', 255)->nullable();
            $table->string('size', 255)->nullable();
            $table->string('unit', 255);
            $table->string('condition', 255);
            $table->string('responsible_person', 255)->nullable();
            $table->string('remarks', 255)->nullable();
            $table->string('kategori', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
