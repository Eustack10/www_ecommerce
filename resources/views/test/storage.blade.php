<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('storage.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="img" id="">
        <button>Upload</button>
    </form>
    <img src="{{ asset('test_images/abc.jpg') }}" alt="">
</body>
</html>
