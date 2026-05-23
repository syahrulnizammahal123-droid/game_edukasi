<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Next</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background: linear-gradient(to right, #1e3c72, #2a5298);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .card-custom{
            width: 600px;
            background: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .icon{
            font-size: 70px;
        }

        .title{
            font-size: 45px;
            font-weight: bold;
        }

        .desc{
            font-size: 22px;
            margin-top: 15px;
            margin-bottom: 30px;
        }

        /* BUTTON MODERN */
        .btn-next{
            background: linear-gradient(to right, #0066ff, #0052cc);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 20px;
            font-weight: bold;
            transition: 0.3s;
            color: white;
            width: 100%;
        }

        .btn-next:hover{
            transform: scale(1.03);
        }

    </style>
</head>
<body>

    <div class="card-custom">

        <div class="icon">
            ✅
        </div>

        <div class="title">
            Benar
        </div>

        <div class="desc">
            Ibukota Indonesia adalah Jakarta
        </div>

        <hr>

        <br>

        <button class="btn-next">
            ➜ Lanjut
        </button>

    </div>

</body>
</html>