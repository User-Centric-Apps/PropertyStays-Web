<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suitable extends Model
{
    use HasFactory;

    protected $table = 'suitables';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id', 'suitable_name', 'image');
}
