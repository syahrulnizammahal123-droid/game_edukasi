<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Permainan</title>
</head>
<body>

<h1>Riwayat Permainan</h1>

@foreach($data as $item)

    <p>
        Level : {{ $item->level }}
        |
        Score : {{ $item->score }}
        |
        Grade : {{ $item->grade }}
    </p>

@endforeach

</body>
</html>