<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public $id;

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

        $this->id = DB::table('urls')->insertGetId($url);
    }

    public function testIndex()
    {
        $response = $this->get(route('urls.index'));

        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('urls.create'));

        $response->assertOk();
    }

    public function testStore()
    {
        $response = $this->post(route('urls.store'));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();


        $this->assertDatabaseHas('urls', ['id' => $this->id]);
    }

    public function testShow()
    {
        $response = $this->get(route('urls.show', $this->id));

        $response->assertOk();
    }
}
