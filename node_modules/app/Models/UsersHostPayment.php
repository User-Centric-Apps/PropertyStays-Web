<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersHostPayment extends Model
{
    use HasFactory;

    protected $table = 'users_host_payment';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id');
}
