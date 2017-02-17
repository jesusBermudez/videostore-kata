<?php


namespace tests\Unit\Movie;


use PHPUnit_Framework_TestCase;
use video\MovieTypes\Movie;
use video\MovieTypes\MovieCategory;
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
    /** @var  MovieCategory */
    private $category;


    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->category = new MovieCategory(1, 'Children');
        $this->children1 = new Movie('Children1', $this->category);
        $this->children2 = new Movie('Children2', $this->category);
        $this->rental1 = new Rental($this->children1, 4);
        $this->rental2 = new Rental($this->children2, 2);

    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->category = null;
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