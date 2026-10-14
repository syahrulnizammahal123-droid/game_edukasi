<!-- =========================================================
     QuizKU SOUND SYSTEM
========================================================= -->

<!-- AUDIO KLIK -->
<audio
    id="sound-click"
    src="{{ asset('sounds/click.mp3') }}"
></audio>


<!-- AUDIO JAWABAN BENAR -->
<audio
    id="sound-correct"
    src="{{ asset('sounds/correct.mp3') }}"
></audio>


<!-- AUDIO JAWABAN SALAH -->
<audio
    id="sound-wrong"
    src="{{ asset('sounds/wrong.mp3') }}"
></audio>



<!-- =========================================================
     SCRIPT
========================================================= -->

<script>

    /*
    |--------------------------------------------------------------------------
    | SUARA KLIK
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('a, button').forEach(item => {

        item.addEventListener('click', () => {

            const click =
                document.getElementById('sound-click');

            if (click) {

                click.currentTime = 0;

                click.play().catch(() => {});

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | SUARA JAWABAN BENAR
    |--------------------------------------------------------------------------
    */

    @if(session('success'))

        const correct =
            document.getElementById('sound-correct');

        if (correct) {

            correct.currentTime = 0;

            correct.play().catch(() => {});

        }

    @endif


    /*
    |--------------------------------------------------------------------------
    | SUARA JAWABAN SALAH
    |--------------------------------------------------------------------------
    */

    @if(session('error'))

        const wrong =
            document.getElementById('sound-wrong');

        if (wrong) {

            wrong.currentTime = 0;

            wrong.play().catch(() => {});

        }

    @endif

</script>