<?php

namespace Tests\Feature;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetVideoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_get_video_by_id()
    {
        //Create scenario

        /*factory(Video::class)->create([
            'id' => 1,
            'title' => 'My tittle',
            'description' => 'My description',
            'url_video' => 'https://www.youtube.com/watch?v=zTEYUFgLveY'
        ]);*/

        Video::factory()->create();

        //Call an api to request a video
        $response = $this->get('api/videos/1');

        //Check that you return a video to us

        $response->assertJsonFragment([
            'id' => 1,
            'title' => 'My tittle',
            'description' => 'My description',
            'url_video' => 'https://www.youtube.com/watch?v=zTEYUFgLveY'
        ]);
    }
}
