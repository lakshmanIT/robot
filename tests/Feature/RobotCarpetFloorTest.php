<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RobotCarpetFloorTest extends TestCase
{
    /**
     * Robot carpet floor testing.
     *
     * @return void
     */
    public function test()
    {
        $response = $this->get('/clean?floor=carpet&area=120');

        $response->assertStatus(200);
    }
}
