<?php

namespace App\Modules\Documentos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = ['category_id', 'title', 'contents'];
    protected $table = 'documents';
}