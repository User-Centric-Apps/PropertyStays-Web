<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Blog;
use App\Models\BlogImages;
use DB;

class BlogController extends Controller
{
    public function blog(Request $request)
    {
        $blog = new Blog;
        $post = array();
        $blog = $blog->blogList($post);
        $blog->appends($request->except('page'));
        return view('general.blog', ['blogs'=> $blog]);
    }

    public function blogDetail($slug)
    {
      $blog = Blog::where('slug', '=', $slug)->first();
      if($blog)
      {
       $blog_id = $blog->id;
       
       //Get One Image
       $featured_image = BlogImages::where('blog_id', '=', $blog_id)->first();
       return view('general.blog-detail', ['blog' => $blog, 'featured_image' => $featured_image]);
      }
      else 
      {
          $blog = new Blog;
          
          $post = array();

          $blog = $blog->blogList($post);

          $blog->appends($request->except('page'));

          return view('general.blog', ['blogs'=> $blog]);
      }
    }
}
