<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Blog extends Model
{
    protected $table = 'blog';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = array('blog_id','slug');

  	public function blogList($search = array())
  	{
  		
     $blogData = DB::table($this->table.' as b')
      ->select('b.*', 'bi.image', DB::raw('count(bi.blog_id) as total_image'))->leftJoin('blog_images as bi', 'b.id', '=', 'bi.blog_id');

    return $blogData = $blogData->orderBy('b.id', 'desc')->groupBy('b.id')->paginate(12);

  	}

  	public function blogDetail($slug){
		return $blogData = DB::table($this->table.' as b')
			->select('b.*')
      ->where('b.slug', '=', $slug)
			->first();

	}
}
