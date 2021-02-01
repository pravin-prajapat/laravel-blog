<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<!-- CSS only -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
	<div class="jumbotron">
		<center><h1>Add Blog</h1></center>
		@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	</div>
	<div class="row">
		<div class="col-lg-6 offset-lg-3">
			<form name="addBlogForm" method="post" action="{{url('update_blog')}}" enctype="multipart/form-data">
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<input type="hidden" name="id" value="{{$blog->id}}">
				<div clas="form-group">
					<img src="http://localhost/blog/storage/images/{{$blog->image}}" style="width: 100px;height: 100px; border: 1px solid #c9c9c9;"><br><br>
				</div>
				<div class="form-group">						
					<label>Title</label>
					<input type="text" name="title" class="form-control" placeholder="Enter Blog Title" value="{{$blog->title}}">
				</div>
				<div class="form-group">						
					<label>Description</label>
					<textarea class="form-control" name="description">{{$blog->description}}</textarea>
				</div>
				<div class="form-group">					
					<label>Add Tags</label>
					<div class="pull-right"><a href="javascript:void();" id="add_tags" title="Add More Tags"><i class="fa fa-plus"></i></a></div>	
					<div class="tags">						
						@foreach(explode(',', $blog->tags) as $tag)
							<input type="text" name="tags[]" class="form-control" value="{{$tag}}" placeholder="Example: #tag" style="margin-top:10px;">
						@endforeach
					</div>
				</div>
				<div class="form-group">						
					<input type="checkbox" name="change_image" id="change_image" style="width:18px;height: 20px;margin-left: 0px; vertical-align: text-bottom;">
					<label>Change Image</label>
				</div>
				<div class="form-group blog-div" style="display: none">						
					<label>Select Blog Image</label>
					<input type="file" name="image" class="form-control" accept=".png,.jpg,.jpeg">
				</div>
				<div class="form-group">						
					<input type="submit" name="Add" class="btn btn-primary btn-outline">
				</div>
			</form>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#add_tags").click(function(){
			var existingTags = $(".tags *");
			$(".tags").append('<input type="text" name="tags[]" class="form-control" placeholder="Example: #tag'+existingTags.length+'" style="margin-top:10px;">');
		});
		$("#change_image").change(function(){
			var val = $('#change_image').prop('checked');
			if(val){
				$(".blog-div").css('display','block');
			}else{
				$(".blog-div").css('display','none');
			}
		});
	});
</script>