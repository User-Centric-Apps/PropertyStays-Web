<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;

    protected $table = 'helps';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id' );
}
