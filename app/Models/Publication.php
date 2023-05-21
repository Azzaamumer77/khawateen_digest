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
   ];
   public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function publication_invoices()
    {
        return $this->hasMany(PublicationInvoice::class);
    }

}
