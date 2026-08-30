@extends('layouts.game')

@section('title', 'Jawaban Ulangan - QuizGo')

@push('styles')
<style>
body {
            background: linear-gradient(135deg, #07111f, #123c68);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }


        /* BACKGROUND */

        body::before {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            background: rgba(34, 211, 238, 0.15);
            border-radius: 50%;
            filter: blur(80px);
            top: -100px;
            left: -100px;
        }


        body::after {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            background: rgba(168, 85, 247, 0.15);
            border-radius: 50%;
            filter: blur(80px);
            bottom: -100px;
            right: -100px;
        }


        /* CARD */

        .card-custom {
            width: 600px;
            max-width: 100%;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-radius: 30px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            position: relative;
            z-index: 1;
        }


        /* ICON */

        .icon-box {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px auto;
            border-radius: 28px;
            background: linear-gradient(135deg, #34d399, #059669);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 35px rgba(16, 185, 129, 0.3);
        }


        .icon {
            font-size: 50px;
            color: white;
            line-height: 1;
        }


        /* LABEL */

        .label {
            display: inline-block;
            background: rgba(34, 211, 238, 0.12);
            border: 1px solid rgba(34, 211, 238, 0.2);
            color: #67e8f9;
            padding: 7px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }


        /* TITLE */

        .title {
            font-size: 42px;
            font-weight: 800;
            color: white;
            margin-bottom: 15px;
        }


        /* DESCRIPTION */

        .desc {
            color: rgba(255, 255, 255, 0.72);
            font-size: 17px;
            line-height: 1.7;
            margin-bottom: 30px;
        }


        /* INFORMATION */

        .info-box {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 15px 18px;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.65);
            font-size: 13px;
        }


        .info-box strong {
            color: #67e8f9;
        }


        /* BUTTON */

        .btn-next {
            background: linear-gradient(90deg, #22d3ee, #2563eb);
            border: none;
            border-radius: 18px;
            padding: 16px 20px;
            font-size: 17px;
            font-weight: 800;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.25);
        }


        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.35);
        }


        .btn-next:active {
            transform: scale(0.98);
        }


        /* FOOTER */

        .footer-text {
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.35);
            font-size: 11px;
        }


        /* RESPONSIVE */

        @media (max-width: 576px) {

            .card-custom {
                padding: 30px 22px;
                border-radius: 25px;
            }

            .title {
                font-size: 32px;
            }

            .desc {
                font-size: 14px;
            }

            .icon-box {
                width: 85px;
                height: 85px;
            }

            .icon {
                font-size: 40px;
            }

        }
</style>
@endpush

@section('content')
<div class="card-custom">


        <!-- ICON -->

        <div class="icon-box">

            <div class="icon">
                âœ“
            </div>

        </div>


        <!-- LABEL -->

        <div class="label">
            QuizGo â€¢ Ulangan IPA
        </div>


        <!-- TITLE -->

        <div class="title">
            Jawaban Benar!
        </div>


        <!-- DESCRIPTION -->

        <div class="desc">

            Jawaban kamu benar.
            Pemahamanmu terhadap materi IPA semakin baik.
            Tetap semangat untuk melanjutkan ulangan berikutnya!

        </div>


        <!-- INFORMATION -->

        <div class="info-box">

            <strong>Hebat!</strong>

            Kamu berhasil menjawab soal dengan tepat.
            Lanjutkan dan raih hasil terbaikmu.

        </div>


        <hr
            style="
                border-color: rgba(255,255,255,0.10);
                margin-bottom: 25px;
            "
        >


        <!-- BUTTON -->

        <button
            class="btn-next"
            type="button"
        >

            <span style="margin-right: 8px;">
                â†’
            </span>

            Lanjut ke Soal Berikutnya

        </button>


        <!-- FOOTER -->

        <div class="footer-text">

            QuizGo â€” Media Pembelajaran IPA

        </div>


    </div>
@endsection

