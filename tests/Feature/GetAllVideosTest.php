<?php

namespace Tests\Feature;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAllVideosTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_videos()
    {
        //$this->withoutExceptionHandling();

        //Create videos

        $videos = Video::factory(2)->create();

        //Access the route

        $this->getJson('api/videos')->assertOk()->assertJsonCount(2);

        //Check videos

        $this->getJson('api/videos')->assertJson($videos->toArray());
    }

    public function test_get_all_videos_order_by_date_desc(){

        $videoHaceUnMes = Video::factory()->create([
            'created_at' => Carbon::now()->subDays(30)
        ]);
        $videoHoy = Video::factory()->create([
            'created_at' => Carbon::now()
        ]);
        $videoAyer = Video::factory()->create([
            'created_at' => Carbon::now()->subDays(1)
        ]);

        $this->getJson('api/videos')->assertJsonPath('0.id', $videoHoy->id)
            ->assertJsonPath('1.id', $videoAyer->id)
            ->assertJsonPath('2.id', $videoHaceUnMes->id);

    }
}
