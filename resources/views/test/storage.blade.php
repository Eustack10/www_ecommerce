{{-- <!DOCTYPE html>
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
</html> --}}
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
</head>
<body>
    <form id="form1">
    <div id="dvContainer">
        This content needs to be printed.
    </div>
    <input type="button" value="Print Div Contents" id="btnPrint" />
    </form>
</body>
</html>