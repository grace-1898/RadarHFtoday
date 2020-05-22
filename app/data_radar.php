<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class data_radar extends Model
{
    protected $table = "data_radar";
 
    protected $fillable = ['id_dataradar', 'tanggal', 'jam', 'lokasi', 'panaharaharus', 'value_araharus', 'value_kecarus', 'value_tinggigel', 'value_kecangin', 'created_at', 'updated_at'];
}
 

