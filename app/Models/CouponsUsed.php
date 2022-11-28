<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponsUsed extends Model
{
    protected $table = 'coupons_used';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = array('id');
}
