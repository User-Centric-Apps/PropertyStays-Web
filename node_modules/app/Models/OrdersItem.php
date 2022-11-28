<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersItem extends Model
{
    protected $table = 'orders_item';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = array('id');
}
