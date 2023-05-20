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
    'publication_id',
    'author_id',
    'image',
    'is_popular'
   ];
   
   public function bills()
    {
        return $this->belongsToMany(Bill::class)->withPivot('quantity');
    }
    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
