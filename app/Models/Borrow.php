<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $table = "borrow";
    protected $primaryKey = "id";
    protected $fillable = ["MATRICULA", "book_id", "date_borrow", "status", "hora", "borrow_create"];
}
