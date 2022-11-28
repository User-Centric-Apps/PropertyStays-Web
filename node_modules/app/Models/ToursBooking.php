<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToursBooking extends Model
{
    use HasFactory;

    protected $table = 'tours_booking';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id');
}
