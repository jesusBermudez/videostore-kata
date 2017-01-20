<?php


namespace tests\Unit\Movie;



use PHPUnit_Framework_TestCase;
use video\MovieTypes\Movie;
use video\MovieTypes\NewReleaseMovie;
use video\Rental\Rental;

class NewReleaseMovieTest extends PHPUnit_Framework_TestCase
{
    /** @var  Movie */
    private $newRelease1;
    /** @var  Movie */
    private $newRelease2;

    /** @var Rental */
    private $rental1;
    /** @var Rental */
    private $rental2;


    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->newRelease1 = new NewReleaseMovie('New Movie 1');
        $this->newRelease2 = new NewReleaseMovie('New Movie 2');
        $this->rental1 = new Rental($this->newRelease1, 3);
        $this->rental2 = new Rental($this->newRelease2, 1);

    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->newRelease1 = null;
        $this->newRelease2 = null;
        $this->rental1 = null;
        $this->rental2 = null;
    }


    public function testSingleNewReleaseMovieAmount()
    {
        $this->assertEquals(9, $this->rental1->determineAmount());
        $this->assertEquals(3, $this->rental2->determineAmount());
    }

    public function testSingleChildrensMoviePoints()
    {
        $this->assertEquals(2, $this->rental1->determineFrequentRenterPoints());
        $this->assertEquals(1, $this->rental2->determineFrequentRenterPoints());
    }
}