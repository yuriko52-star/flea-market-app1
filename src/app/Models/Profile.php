<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','img_url','post_code','address','building'
    ];
    // protected $attributes = [
        // 'img_url' => 'default-profile.png',
    // ];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
