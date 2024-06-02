<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Menu extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name',
    //     'gambar',
    //     'harga',
    // ];

    protected $guarded = [];
    public function getImageAsset($model = '')
    {
        if (File::exists($this->gambar)) {
            return asset($this->gambar);
        }
        
        if (File::exists($this->gambar)) {
            return asset($this->gambar);
        }

        return 'https://placehold.co/80x80?text=No+Image';
    }
}
