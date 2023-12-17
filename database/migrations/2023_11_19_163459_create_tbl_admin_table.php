<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // Tạo table
    public function up(): void
    {
        Schema::create('tbl_admin', function (Blueprint $table) {
            $table->increments('admin_id'); /* increments là khóa chính và giá trị tự động tăng */
            $table->string('admin_email', 100);
            $table->string('admin_password');
            $table->string('admin_name');
            $table->string('admin_phone');
            $table->timestamps(); /* tự động thêm thời gì khi tạo table này */
        });
    }

    /**
     * Reverse the migrations.
     */
    // Xóa nếu table đã tồn tại
    public function down(): void
    {
        Schema::dropIfExists('tbl_admin');
    }
};
