<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained(); // Aktifkan jika sudah ada login user
            
            // Status Pengajuan (Default: Menunggu Verifikasi)
            $table->string('no_pelayanan')->unique(); // Generate otomatis nanti
            $table->enum('status_verifikasi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            
            // STEP 2: Identitas WP
            $table->string('nik');
            $table->string('nama_wp'); // name="nama"
            $table->string('pekerjaan')->nullable();
            $table->string('npwp')->nullable();
            $table->string('jalan_wp')->nullable();
            $table->string('rt_wp')->nullable();
            $table->string('rw_wp')->nullable();
            $table->string('kota_wp')->nullable(); // name="kota"
            $table->string('status_wp')->nullable(); // Pemilik/Penyewa
            $table->string('no_telp')->nullable();
            $table->string('blok_kav_no_wp')->nullable();
            $table->string('kelurahan_wp')->nullable();
            $table->string('kode_pos_wp')->nullable();
            $table->string('file_foto_ktp')->nullable(); // Path Upload

            // STEP 3: Letak Objek Pajak
            $table->string('nop_tetangga')->nullable();
            $table->string('kecamatan_op')->nullable();
            $table->string('kelurahan_op')->nullable();
            $table->string('jalan_op')->nullable();
            $table->string('blok_op')->nullable();
            $table->string('rt_op')->nullable();
            $table->string('rw_op')->nullable();
            $table->double('luas_tanah')->nullable();
            $table->enum('status_tanah', ['TANAH + BANGUNAN', 'TANAH KOSONG']);
            $table->string('file_foto_sppt')->nullable(); // Path Upload
            $table->string('file_foto_sertifikat')->nullable(); // Path Upload

            // STEP 4: Informasi Bangunan (Nullable karena bisa jadi Tanah Kosong)
            $table->integer('no_bangunan')->nullable();
            $table->string('jenis_bangunan')->nullable();
            $table->double('luas_bangunan')->nullable();
            $table->integer('jml_lantai')->nullable();
            $table->integer('thn_dibangun')->nullable();
            $table->integer('thn_renovasi')->nullable();
            $table->string('kondisi_bangunan')->nullable();
            $table->string('daya_listrik')->nullable();
            $table->string('konstruksi')->nullable();
            $table->string('atap')->nullable();
            $table->string('dinding')->nullable();
            $table->string('lantai')->nullable();
            $table->string('langit_langit')->nullable();
            // AC
            $table->integer('ac_split')->nullable();
            $table->integer('ac_window')->nullable();
            // Uploads Step 4
            $table->string('file_foto_bangunan')->nullable(); // Path Upload
            $table->string('file_imb')->nullable(); // Path Upload
            
            // Khusus Tanah Kosong
            $table->string('file_foto_tanah_kosong')->nullable(); // Path Upload
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};