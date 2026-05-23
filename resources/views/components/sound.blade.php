<!-- AUDIO -->
<audio id="sound-click" src="{{ asset('sounds/click.mp3') }}"></audio>

<audio id="sound-correct" src="{{ asset('sounds/correct.mp3') }}"></audio>

<audio id="sound-wrong" src="{{ asset('sounds/wrong.mp3') }}"></audio>

<!-- SCRIPT -->
<script>

    /*
    |--------------------------------------------------------------------------
    | CLICK SOUND
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('a, button').forEach(item => {

        item.addEventListener('click', () => {

            let click = document.getElementById('sound-click');

            click.currentTime = 0;

            click.play();

        });

    });

    /*
    |--------------------------------------------------------------------------
    | SUCCESS SOUND
    |--------------------------------------------------------------------------
    */

    @if(session('success'))

        let correct = document.getElementById('sound-correct');

        correct.play();

    @endif

    /*
    |--------------------------------------------------------------------------
    | ERROR SOUND
    |--------------------------------------------------------------------------
    */

    @if(session('error'))

        let wrong = document.getElementById('sound-wrong');

        wrong.play();

    @endif

</script>