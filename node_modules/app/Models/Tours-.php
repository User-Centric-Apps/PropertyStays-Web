<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Tours extends Model
{
    protected $table = 'tours';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id');

    public function locations()
    {
        return $this->hasMany(Tours::class, 'city_id');
    }

    public function tourLists($search = array(), $sort_by = 'tours.id', $order_by = 'desc')
    {
       $itemData = DB::table($this->table)
            ->select('tours.*', 'cities.cityname')
            ->leftjoin('cities', 'cities.id', '=', 'tours.city_id');

        if(isset($search['location']))
        {
            if(count($search['location']) > 1)
            {
                $itemData = $itemData->whereIn('tours.city_id', $search['location']);
            }
        }
        if(isset($search['min_price']))
        {
            $itemData = $itemData->whereBetween('tours.adult_price', [$search['min_price'], $search['max_price']]);
        }
        if(isset($search['keywords']))
        {
            $itemData = $itemData->where('tours.title', 'LIKE', "%".$search['keywords']."%");
        }
        
        return $itemData = $itemData->orderBy($sort_by, $order_by)->groupBy('tours.id')->paginate(12);

    }
}
