<?php


namespace tests;



use PHPUnit_Framework_TestCase;
use video\MovieTypes\Movie;
use video\MovieTypes\NewReleaseMovie;

class NewReleaseMovieTest extends PHPUnit_Framework_TestCase
{
    /** @var  Movie */
    private $newRelease;


    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->newRelease = new NewReleaseMovie('New Movie');
    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->newRelease = null;
    }


    public function testSingleNewReleaseMovieAmount()
    {
        $this->assertEquals(9, $this->newRelease->determineAmount(3));
        $this->assertEquals(6, $this->newRelease->determineAmount(2));
    }

    public function testSingleChildrensMoviePoints()
    {
        $this->assertEquals(2, $this->newRelease->determineFrequentRenterPoints(3));
        $this->assertEquals(1, $this->newRelease->determineFrequentRenterPoints(1));
    }
}