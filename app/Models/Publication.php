<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Publication extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'invoice_no',
        'debit',
        'credit',
        'date'
   ];

   public function scopeSum($query)
   {
       return $query->select('name', 
               DB::raw('SUM(debit) as debit_total'),
               DB::raw('SUM(credit) as credit_total')
           )
           ->groupBy('name');
   }
}
