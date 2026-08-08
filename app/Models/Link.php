<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Link extends Model{
use HasFactory;
/**
* Atribut yang diizinkan untuk diisi secara massal (Mass Assignment).
*/
protected $fillable = [
'title',
'url',
'image',
'is_active',
'clicks',
];
}