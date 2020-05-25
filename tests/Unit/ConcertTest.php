<?php

namespace Tests\Unit;

use App\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

//use PHPUnit\Framework\TestCase;

class ConcertTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_get_formatted_date()
    {

        // Create a concert with a known date
        $concert = Concert::create([
            'date' => Carbon::parse('2016-12-01 8:00pm'),
            'title' => 'The Red Chord',
            'subtitle' => 'with animosity and Lethargy',
            'ticket_price' => 3250,
            'venue' => 'The Mosh Pit',
            'venue_address' => '123 Example Lane',
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '17916',
            'additional_information' => 'For ticket call (555) 555-5555.'
        ]);

        // Retrieve the formatted date
        $date = $concert->formatted_date;

        // Verify the date is formatted as expected
        $this->assertEquals('December 1, 2016', $date);
    }
}
