<?php

namespace tests\Unit\Movie;


use PHPUnit_Framework_TestCase;
use video\MovieTypes\Movie;
use video\MovieTypes\MovieCategory;
use video\MovieTypes\RegularMovie;
use video\Rental\Rental;

class RegularMovieTest extends PHPUnit_Framework_TestCase
{
    /** @var  Movie */
    private $regular1;
    /** @var  Movie */
    private $regular2;

    /** @var Rental */
    private $rental1;
    /** @var Rental */
    private $rental2;

    private $category;

    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->category = new MovieCategory(2, 'Regular');
        $this->regular1 = new Movie('Regular Movie 1', $this->category);
        $this->regular2 = new Movie('Regular Movie 2', $this->category);
        $this->rental1 = new Rental($this->regular1, 3);
        $this->rental2 = new Rental($this->regular2, 1);
    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->regular1 = null;
        $this->regular2 = null;
        $this->rental1 = null;
        $this->rental2 = null;
    }

    public function testSingleRegularMovieAmount()
    {
        $this->assertEquals(3.5, $this->rental1->determineAmount());
        $this->assertEquals(2, $this->rental2->determineAmount());
    }


    public function testSingleRegularMoviePoints()
    {
        $this->assertEquals(1, $this->rental1->determineFrequentRenterPoints());
    }
}