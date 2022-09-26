<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>
<body>
  
    <div class="container">
        <div class="mt-5">
            <table class="mb-3">
                <tr>
                  <th>Name</th>
                  <th>title</th>
                  <th>body</th>
                  <th>Time</th>
                  <th>Edit</th>
                  <th>Soft Delete</th>
                  
                </tr>
                @foreach ($post as $value )
                <tr>
                  <td>{{$value->user->name}}</td>  {{-- Inverse --}}
                  <td>{{$value->title}}</td>
                  <td>{{$value->body}}</td>
                  <td>{{(\Carbon\Carbon::parse($value->updated_at)->diffForHumans())}}</td>
                  <td><a href="{{route('edit-post',['id'=>$value->id])}}">Edit</a></td>

                  <td><a href="{{route('delete-post',['id'=>$value->id])}}">Delete</a></td>

                  {{-- <td><a href="{{url('/post/delete',$post->id)}}">Delete</a></td>
                  <td><a href="{{route('post_destroy/{id}')}}">Delete</a></td> --}}

                </tr>
                @endforeach

              </table>

              {{ $post->links() }}
              
        </div>
       {{-- delete data show  --}}

       <h5><a href="{{route('show_delete_post')}}">show Soft Delete post</a></h5>


    </div>

</body>
</html>