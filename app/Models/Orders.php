<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = array('id');
}
