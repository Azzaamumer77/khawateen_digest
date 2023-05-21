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
   public function publication()
    {
        return $this->belongsTo(Publication::class);
    }
}
