<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesRenttypes extends Model
{
    use HasFactory;

    protected $table = 'properties_renttypes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id');
}
