<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-weight: 600;
            font-size: 23px;
            font-style: italic;
        }
        .back {
            //background-image: url('/images/{{$image}}');
            width: 720px;
            height: 1019px;
            position: fixed;
            background-size: 720px;
        }
        .name{
            position: absolute;
            left: 0;
            text-align: center;
            width: 100%;
            top: 505px;
        }
        .date{
            position: absolute;
            left: 413px;
            text-align: center;
            width: 100%;
            top: 914px;
            color: #6d6d6d;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="back">
        <img src="{{asset('images/'.$image)}}" width="720" height="1019">
        <div class="name">
            {{$name}}
        </div>
        <div class="date">
            {{$date}}
        </div>
    </div>
</body>
</html>