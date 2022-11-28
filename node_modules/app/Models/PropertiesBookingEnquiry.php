<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesBookingEnquiry extends Model
{
    use HasFactory;

    protected $table = 'properties_booking_enquiry';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id');
}
