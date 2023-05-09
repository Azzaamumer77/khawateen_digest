<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PublicationInvoice extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'publication_id',
        'invoice_no',
        'debit',
        'credit',
        'date'
   ];
   public function scopeSum($query)
   {
       return $query->select('publication_id', 
               DB::raw('SUM(debit) as debit_total'),
               DB::raw('SUM(credit) as credit_total')
           )
           ->groupBy('publication_id');
   }
   public function publication()
    {
        return $this->belongsTo(Publication::class);
    }
}
