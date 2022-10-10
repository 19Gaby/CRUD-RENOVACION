<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $table = "students";
    protected $primaryKey = "id";
    protected $fillable = ["MATRICULA", "firtsname", "lastname", "correo", "photo", "created_on","status","n_sancion"];
}
