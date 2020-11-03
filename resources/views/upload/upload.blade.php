<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <br>
    <div class="col-lg-offset-4 col-lg-4">
        <center><h1>Upload a file</h1></center>
        <form action="/store" enctype="multipart/form-data" method="POST" >
        {{csrf_field()}}
         <input type="file" name="image">
         <br>
         <input type="submit" value="upload">
        </form>
    </div>
    
</body>
</html>