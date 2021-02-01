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
		<center><h1>Blogs</h1></center>
		@if (Route::has('login'))
            <div class="top-right links">
                @auth
					<a href="/add_blog" class="btn btn-primary" ><i class="fa fa-plus"></i> Add Blog</a>
					<a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @endif
                @endauth
            </div>
        @endif
	</div>
	<div class="row">
		<div class="col-lg-6 offset-lg-3">
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th>#</th>
			      <th>Title</th>
			      <th>Description</th>
			      <th>Tags</th>
			      <th>CreatedBy</th>
			      @auth
			      	<th>Action</th>
			      @endauth
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($blogs as $key => $value)
			    <tr>
			      <th>{{$key + 1}}</th>
			      <td>{{$value->title}}</td>
			      <td>{{$value->description}}</td>
			      <td>{{$value->tags}}</td>
			      <td>{{$value->users->name}}</td>
			      @auth
			      	<td>
			      		@if(auth()->user()->id == $value->createdBy)
			      		<a href="/edit_blog/{{$value->id}}"><i class="fa fa-pencil"></i></a> &nbsp; <a href="/delete_blog/{{$value->id}}"><i class="fa fa-trash" style="color:red"></i></a>
			      		@endif
			      	</td>
			      @endauth
			    </tr>
			   @endforeach
			  </tbody>
			</table>
		</div>
	</div>
</body>
</html>