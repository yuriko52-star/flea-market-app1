<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

      protected $fillable = [
        'user_id','item_id','payment_method','shipping_address'
    ];
    public function user() {
        return $this->belongsTo(User::class,'usesr_id');
    }
    public function item() {
        return $this->belongsTo(Item::class);
    }
}
