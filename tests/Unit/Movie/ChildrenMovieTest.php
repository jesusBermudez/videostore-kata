<?php


namespace tests;


use PHPUnit_Framework_TestCase;
use video\MovieTypes\ChildrensMovie;
use video\MovieTypes\Movie;
use video\Rental\Rental;

class ChildrenMovieTest extends PHPUnit_Framework_TestCase
{
    /** @var  Movie */
    private $children1;
    /** @var  Movie */
    private $children2;

    /** @var Rental */
    private $rental1;
    /** @var Rental */
    private $rental2;


    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->children1 = new ChildrensMovie('Children1');
        $this->children2 = new ChildrensMovie('Children2');
        $this->rental1 = new Rental($this->children1, 4);
        $this->rental2 = new Rental($this->children2, 2);

    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->children1 = null;
        $this->children2 = null;
        $this->rental1 = null;
        $this->rental2 = null;
    }

    public function testSingleChildrensMovieAmount()
    {
        $this->assertEquals(3.0, $this->rental1->determineAmount());
        $this->assertEquals(1.5, $this->rental2->determineAmount());
    }

    public function testSingleChildrensMoviePoints()
    {
        $this->assertEquals(1, $this->rental1->determineFrequentRenterPoints());
    }
}