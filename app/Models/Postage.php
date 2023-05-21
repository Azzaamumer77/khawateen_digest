<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postage extends Model
{
    use HasFactory;

    protected $fillable =
    [
    'name',
    'city',
    'registration_no',
    'invoice_no',
    'date',
    'details',
    'status'  //Received, Returned and Pending
   ];
}
