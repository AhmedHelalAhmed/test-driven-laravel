<?php

namespace Tests\Feature;

use App\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewConcertingListingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_view_a_concert_listing()
    {
        // Arrange
        // Create a concert
        $concert = Concert::create([
            'title' => 'The Red Chord',
            'subtitle' => 'with animosity and Lethargy',
            'date' => Carbon::parse('December 13, 2016 8:00pm'),
            'ticket_price' => 3250,
            'venue' => 'The Mosh Pit',
            'venue_address' => '123 Example Lane',
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '17916',
            'additional_information' => 'For ticket call (555) 555-5555.'

        ]);

        // Act
        // View the concert listing
        $this->visit('/concerts/'.$concert->id);


        // Assert
        // See the concert details
        $this->see('The Red Chord');
        $this->see('with animosity and Lethargy');
        $this->see('December 13, 2016');
        $this->see('8:00pm');
        $this->see('32.50');
        $this->see('The Mosh Pit');
        $this->see('123 Example Lane');
        $this->see('Laraville, ON 17916');
        $this->see('For ticket call (555) 555-5555.');
    }

    /** @test */
    public function user_cannot_view_unpublished_concert_listings()
    {
        $concert = factory(Concert::class)->create([
            'published_at' => null,
        ]);

        $this->get('/concerts/'.$concert->id);

        $this->assertResponseStatus(404);
    }
}
