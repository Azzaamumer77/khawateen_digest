<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable=
    [
     'customer_name',
     'invoice_no',
     'total_amount',
     'discount'

    ];

    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('quantity','discount');
    }
}
