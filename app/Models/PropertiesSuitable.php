<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesSuitable extends Model
{
    use HasFactory;

    protected $table = 'properties_suitables';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id');
}
