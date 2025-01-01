<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;

class Event extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'events';

    // Menambahkan kolom ke dalam $fillable
    protected $fillable = [
        'nama',
        'mentor',
        'lokasi',
        'waktu_mulai',
        'waktu_selesai',
        'gambar',
        'slug',  // Menambahkan slug di sini
    ];

    // Fungsi untuk menentukan sumber slug (berdasarkan kolom 'nama')
    protected function slugSource()
    {
        return 'nama';  // Sumber slug adalah kolom 'nama'
    }
}
