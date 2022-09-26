<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <div class="container">

      <form method="POST">
          <div class="form-row mt-5" >
            @csrf
            <div class="col">
              <input type="text" class="form-control" placeholder="Title" id="title" name="title">
            </div>
            <div class="col mt-5">
              <input type="text" class="form-control" placeholder="Body" id="body" name="body">
            </div>
            <button type="submit" name="submit" class="add_product">Submit</button>
          </div>
        </form>

</div>
</body>
</html>