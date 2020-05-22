<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Tampilpanah extends Model
{
    protected $table = "Tampilpanah";
 
    protected $fillable = ['id_tampilpanah', 'tanggal', 'jam', 'koordinat_x', 'koordinat_y', 'panaharaharus', 'value_kecarus', 'created_at', 'updated_at'];
}
 
 

