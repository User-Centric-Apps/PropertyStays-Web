<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentTypes extends Model
{
    use HasFactory;

    protected $table = 'renttypes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id', 'name', 'image');
}
