<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id');

    public function properties()
    {
        return $this->hasMany(Property::class, 'city_id')->where('properties.type', '=', 1);

    }

    public function cityList($search = array())
    {
        
     $cityData = DB::table($this->table)->with(['properties']);

    return $cityData = $cityData->orderBy('id', 'desc')->groupBy('id')->paginate(12);

    }
}
