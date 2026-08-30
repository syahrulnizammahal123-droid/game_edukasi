<?php

namespace Tests\Feature;

use App\Models\Progress;
use App\Models\Soal;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     */
    public function test_home_redirects_to_dashboard(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/dashboard');
    }

    public function test_guest_dashboard_is_redirected_to_login(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_leaderboard_progress_updates_when_answering_each_question(): void
    {
        $user = User::factory()->create();

        $soal = Soal::create([
            'level' => 1,
            'pertanyaan' => 'Planet tempat manusia hidup adalah?',
            'A' => 'Mars',
            'B' => 'Bumi',
            'C' => 'Venus',
            'D' => 'Jupiter',
            'jawaban' => 'B',
            'penjelasan' => 'Bumi adalah planet tempat manusia hidup.',
        ]);

        $this
            ->actingAs($user)
            ->withSession([
                'game_soals' => [$soal->id],
                'game_index' => 0,
                'game_benar' => 0,
                'game_salah' => 0,
                'game_total' => 1,
                'game_level' => 1,
                'game_answered_soals' => [],
            ])
            ->postJson(route('game.jawab'), [
                'soal_id' => $soal->id,
                'jawaban' => 'B',
            ])
            ->assertOk()
            ->assertJson([
                'success' => true,
                'isCorrect' => true,
            ]);

        $progress = Progress::where('user_id', $user->id)->first();

        $this->assertSame(10, $progress->total_xp);
        $this->assertSame(1, $progress->correct_answer);
        $this->assertSame(0, $progress->wrong_answer);

        $this
            ->actingAs($user)
            ->withSession([
                'game_index' => 1,
                'game_benar' => 1,
                'game_salah' => 0,
                'game_total' => 1,
                'game_level' => 1,
                'game_last_soal_id' => $soal->id,
                'game_answered_soals' => [$soal->id],
            ])
            ->get(route('game.hasil'))
            ->assertOk();

        $progress->refresh();

        $this->assertSame(10, $progress->total_xp);
        $this->assertSame(1, $progress->correct_answer);
        $this->assertSame(0, $progress->wrong_answer);
        $this->assertSame(1, $progress->total_play);
    }
}
