<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public $dates= ['created_at','updated_at','tanggal_lahir'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
