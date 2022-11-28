<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToursImages extends Model
{
    use HasFactory;

    protected $table = 'tours_images';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id');
}
