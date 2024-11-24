<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;

class ModulPembelajaran extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'modul_pembelajaran';

    // Menambahkan 'slug' ke $fillable
    protected $fillable = [
        'title',
        'description',
        'file',
        'slug',  // Tambahkan slug ke sini
    ];

    // Fungsi untuk menentukan sumber slug (berdasarkan kolom 'title')
    protected function slugSource()
    {
        return 'title';  // Sumber slug adalah kolom 'title'
    }
}
