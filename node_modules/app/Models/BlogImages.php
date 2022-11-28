<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogImages extends Model
{
    protected $table = 'blog_images';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = array('id');
}
