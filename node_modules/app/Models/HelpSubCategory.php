<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpSubCategory extends Model
{
    use HasFactory;

    protected $table = 'helps_sub_category';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id' );
}
