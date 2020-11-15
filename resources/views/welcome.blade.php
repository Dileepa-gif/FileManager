<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

       
    </head>
    <body>
      <form name="frm" action ="{{route('ImageUpload')}}" method="POST" enctype="multipart/form-data">
      {{csrf_field()}}
      <br>
      <input type="file" name="img[]" multiple>
      <br>
      <input type="submit" name="ok" value="upload">
      </form>
      @if(Session::has('msg'))
      {{Session::get('msg')}}
      @endif
    </body>
</html>
