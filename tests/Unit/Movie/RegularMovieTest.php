<?php

namespace tests;


use PHPUnit_Framework_TestCase;
use video\MovieTypes\Movie;
use video\MovieTypes\RegularMovie;

class RegularMovieTest extends PHPUnit_Framework_TestCase
{
    /** @var  Movie */
    private $regular;

    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->regular = new RegularMovie('Regular Movie');
    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->regular = null;
    }

    public function testSingleRegularMovieAmount()
    {
        $this->assertEquals(3.5, $this->regular->determineAmount(3));
        $this->assertEquals(2, $this->regular->determineAmount(1));
    }


    public function testSingleRegularMoviePoints()
    {
        $this->assertEquals(1, $this->regular->determineFrequentRenterPoints(3));
        $this->assertEquals(1, $this->regular->determineFrequentRenterPoints(2));
    }
}