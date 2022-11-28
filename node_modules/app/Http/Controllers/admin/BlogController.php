<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Blog;
use App\Models\Comments;
use App\Models\BlogImages;
use DB;
use File;
use Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $data = Blog::select('id','title', 'date', 'category_name');

            return Datatables::of($data)->addColumn('action', function ($data)
            {

                $abc = '';
                $abc .= '<a href="'.url('admin/blog/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a>';
                if(Auth::guard('admin')->user()->type == 1)
                {

                  $abc .= '<button id="'.$data->id.'" class="delete btn red btn-xs " title="Delete"  ><i class="fa fa-times"></i> </button>';

                }
                return '<div class="btn-group pull-right">'.$abc.'</div>';
                
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('admin.blog.index');
    }

    public function manageBlog($id = null)
    {
        $blog = Blog::find($id);
        $blog_images = array();
        if($blog)
        {
            $blog_images = BlogImages::where('blog_id', '=', $id)->get();
        }
        return view('admin.blog.manage', ['blog' => $blog , 'blog_images' => $blog_images ]);
    }

    public function doSaveBlog(Request $request)
    {

        $post = $request->only('id', 'user_id', 'title', 'description', 'alt','category_name','meta', 'keywords');

        $blog = new Blog;

        if($post['id'])
        {
            $id = intval($post['id']);
            $blog = $blog->find($id);
        }
        $blog->title = $post['title'];
        $blog->description = $post['description'];
        $blog->alt = $post['alt'];
        $blog->category_name = $post['category_name'];
        $blog->meta = $post['meta'];
        $blog->keywords = $post['keywords'];
        $blog->date = date('Y-m-d');
        $blog->slug = Str::slug($post['title']);
        $blog->save();

        // Delete uploded Images
          if($request->has('remove-images'))
          {
            $removeImgslist = $request->get('remove-images');
            if(!empty($removeImgslist)){
                foreach($removeImgslist as $image){
                    //echo $image;exit;
                    BlogImages::where('blog_id', '=', $blog->blog_id)->where('image', '=', $image)->delete();
                    File::delete('storage/app/public/uploads/blog/'.$image);
                }
             }
          }
        // Save uploded Images

        if($request->has('flist'))
        {
            $flist = $request->get('flist');
            if(!empty($flist))
            {
                foreach($flist as $row)
                {
                    if($row)
                    {
                        $blogImages = new BlogImages;
                        $blogImages->image = $row;
                        $blogImages->date = date('Y-m-d');
                        $blogImages->blog_id = $blog->id;
                        $blogImages->save();
                    }
                }
            }
        }
        return redirect('admin/blog')->with('success', 'Blog updated successfully!');
    }

    public function deleteBlog($id)
    {

        Blog::where('id', '=', $id)->delete();
        BlogImages::where('blog_id', '=', $id)->delete();
    }

    public function uploadImage(Request $request)
    {
      $name = $request->input('name');
      if ($request->hasFile('file'))
      {
        $file = $request->file('file');
        $filename = time()."_".$file->getClientOriginalName();
        $request->file('file')->move('storage/app/public/uploads/blog/', $filename);
        $data = array('result'=>'OK', 'id'=>$filename);
        echo json_encode($data);
      }
    }
}
