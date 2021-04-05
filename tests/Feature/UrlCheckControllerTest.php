<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UrlCheckControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public $id;

    public $name;

    protected function setUp(): void
    {
        parent::setUp();
        $faker = Factory::create();

        $urlParsed = parse_url($faker->url);

        $urlScheme = strtolower($urlParsed['scheme']);
        $urlHost = strtolower($urlParsed['host']);

        $name = "{$urlScheme}://{$urlHost}";
        $url = [
            'name' => $name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $this->name = $name;
        $this->id = DB::table('urls')->insertGetId($url);
    }

    public function testStore()
    {
        $url = DB::table('urls')->find($this->id);

        $response = $this->post(route('urls.checks.store', $url->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('url_checks', ['url_id' => $url->id]);
    }
}
