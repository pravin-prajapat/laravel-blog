<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Blog;
use Auth;

class BlogController extends Controller
{
	public function getBlogs(Request $request){
		$blogs = Blog::with('users')->get();
		return view('list_blogs',['blogs' => $blogs]);
	}

    public function storeBlog(Request $request){
    	
    	$input = $request->except('_token','Add');
    	$file = $request->file('image');
      
    	$validator = $request->validate([
    		'title' => 'required|max:255', 
    		'description' => 'required|max:65535',
    		'tags' => 'required',
    		'image' => 'required|max:100000',
    	]);

		$insert = [];
		$insert['title'] = $input['title'];
		$insert['description'] = $input['description'];
		$tags = implode(',', $input['tags']);
		$insert['tags'] = $tags;
		$insert['createdBy'] = Auth::user()->id;

	    $imageName = $file->getClientOriginalName();
	    $imageName = str_replace(' ', '_', $imageName);
	    $imageName = time().'_'.$imageName;
		
		$insert['image'] = $imageName;

		Blog::create($insert);    

	    $path = storage_path('images');
	    if(!is_dir($path))
	    	mkdir($path);

	    $file->move($path, $imageName);

	    return redirect()->route('list_blogs');
    }

    public function editBlog(Request $request, $id){
    	$res = Blog::find($id);
    	return view('edit_blog',['blog' => $res]);
    }

    public function updateBlog(Request $request){

    	$input = $request->except('_token','Add');
    	$file = $request->file('image');
      	$blog = Blog::find($input['id']);

    	$validator = $request->validate([
    		'title' => 'required|max:255', 
    		'description' => 'required|max:65535',
    		'tags' => 'required'
    	]);

		$update = [];
		$update['title'] = $input['title'];
		$update['description'] = $input['description'];
		$tags = implode(',', $input['tags']);
		$update['tags'] = $tags;

		$path = storage_path('images');

		if(strlen($blog->image) && $file){			
			if(file_exists($path.'/'.$blog->image)){				
				unlink($path.'/'.$blog->image);
				$update['image'] = '';
			}
		}

		if($file){
		    $imageName = $file->getClientOriginalName();
		    $imageName = str_replace(' ', '_', $imageName);
		    $imageName = time().'_'.$imageName;
			
			$update['image'] = $imageName;

		    $file->move($path, $imageName);
		}

		Blog::where('id', $input['id'])->update($update);    


	    return redirect()->route('list_blogs');
    }

    public function deleteBlog(Request $request, $id){
    	Blog::find($id)->delete();
    	return redirect()->route('list_blogs');
    }
}
