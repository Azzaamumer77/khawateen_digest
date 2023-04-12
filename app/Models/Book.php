<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable =
    [
    'urdu_name',
    'english_name',
    'quantity',
    'price',
    'discounted_price',
    'publications_name',
    'author',
    'image',
   ];
   
   public function bills()
    {
        return $this->belongsToMany(Bill::class)->withPivot('quantity');
    }
}
