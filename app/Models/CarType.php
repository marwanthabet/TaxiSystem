<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CarType extends Model
{
    use HasFactory;
    // protected $hidden = ['created_at', 'updated_at']; 
    protected $appends = ['image_url'];
    public function getImageUrlAttribute(){
        return url(Storage::url($this->image));
    }
}
