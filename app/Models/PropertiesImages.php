<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesImages extends Model
{
    use HasFactory;

    protected $table = 'properties_images';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id');
}
