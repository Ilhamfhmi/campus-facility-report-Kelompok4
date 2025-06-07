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
        Schema::create('officer_responses', function (Blueprint $table) {
            $table->id();
            // foreign key ke laporan_pengaduan_id atau damage_report_id
            $table->foreignId('damage_report_id')->constrained('damage_reports')->onDelete('cascade');
            $table->text('response_content'); // Isi tanggapan
            $table->string('officer_name'); // Nama petugas yang menanggapi
            $table->string('status_update')->nullable(); // Opsional: status update laporan kerusakan (misal: 'Sedang Diproses', 'Selesai')
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officer_responses');
    }
};