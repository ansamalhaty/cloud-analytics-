<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

   
    protected $table = 'documents';

   
    protected $fillable = [
        'name', 
        'path', 
        'file_type',
        'file_hash' // تأكد من وجوده هنا
    ];
}
