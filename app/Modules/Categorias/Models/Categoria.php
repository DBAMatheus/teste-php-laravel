<?php
namespace App\Modules\Categorias\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['name'];
    protected $table = 'categories';
}