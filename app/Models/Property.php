<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Property extends Model
{
    protected $table = 'properties';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id');

    public function locations()
    {
        return $this->hasMany(Property::class, 'city_id')->where('properties.type', '=', 1);
    }

    public function propertyLists($search = array(), $sort_by = 'properties.id', $order_by = 'desc')
    {
       $itemData = DB::table($this->table)
            ->select('properties.*', 'cities.cityname', DB::raw('count(feedback.property_id) as total_comments'))
            ->leftJoin('feedback', 'feedback.property_id', '=', 'properties.id')
            ->leftjoin('cities', 'cities.id', '=', 'properties.city_id')
            ->where('properties.type','=', 1);

        if(isset($search['location']))
        {
            if(count($search['location']) > 0)
            {
                $itemData = $itemData->whereIn('properties.city_id', $search['location']);
            }
        }
        if(isset($search['adults']))
        {
            $itemData = $itemData->where('properties.adults','=',$search['adults']);
        }
        if(isset($search['bed']))
        {
            $itemData = $itemData->where('properties.bed','=',$search['bed']);
        }
        if(isset($search['bath']))
        {
            $itemData = $itemData->where('properties.bath', '=', $search['bath']);
        }
        if(isset($search['childrens']))
        {
            $itemData = $itemData->whereIn('properties.childrens',$search['childrens']);
        } 
        if(isset($search['min_price']))
        {
            $itemData = $itemData->whereBetween('properties.original_price', [$search['min_price'], $search['max_price']]);
        }
        if(isset($search['keywords']))
        {
            $itemData = $itemData->where('properties.title', 'LIKE', "%".$search['keywords']."%");
        }
        
        return $itemData = $itemData->orderBy($sort_by, $order_by)->groupBy('properties.id')->paginate(12);

    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function tourLists($search = array(), $sort_by = 'properties.id', $order_by = 'desc')
    {
       $itemData = DB::table($this->table)
            ->select('properties.*', 'cities.cityname')
            ->leftjoin('cities', 'cities.id', '=', 'properties.city_id')
            ->where('properties.type','=', 2);

        if(isset($search['location']))
        {
            if(count($search['location']) > 1)
            {
                $itemData = $itemData->whereIn('properties.city_id', $search['location']);
            }
        }
        if(isset($search['min_price']))
        {
            $itemData = $itemData->whereBetween('properties.adult_price', [$search['min_price'], $search['max_price']]);
        }
        if(isset($search['keywords']))
        {
            $itemData = $itemData->where('properties.title', 'LIKE', "%".$search['keywords']."%");
        }
        
        return $itemData = $itemData->orderBy($sort_by, $order_by)->groupBy('properties.id')->paginate(12);

    }
}
