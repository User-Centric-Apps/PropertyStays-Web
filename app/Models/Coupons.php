<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $table = 'coupons';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = array('id');
}
