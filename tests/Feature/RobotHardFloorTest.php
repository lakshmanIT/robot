<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RobotHardFloorTest extends TestCase
{
    /**
     * Robot hard floor testing
     * @return void
     */
    public function test()
    {
        $response = $this->get('/clean?floor=hard&area=75');

        $response->assertStatus(200);
    }
}
