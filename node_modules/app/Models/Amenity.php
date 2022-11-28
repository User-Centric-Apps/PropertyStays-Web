<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $table = 'amenities';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id', 'name', 'image');
}
