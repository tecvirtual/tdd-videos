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
        $video = Video::factory()->create();

        //Call an api to request a video
        $response = $this->get(sprintf('api/videos/%s', $video->id));

        //Check that you return a video to us
        $response->assertJsonFragment($video->toArray());
    }
}
