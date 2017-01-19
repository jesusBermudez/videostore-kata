<?php


namespace tests;


use PHPUnit_Framework_TestCase;
use video\MovieTypes\ChildrensMovie;
use video\MovieTypes\Movie;

class ChildrenMovieTest extends PHPUnit_Framework_TestCase
{
    /** @var  Movie */
    private $childrens;


    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->childrens = new ChildrensMovie('Childrens');
    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->childrens = null;
    }

    public function testSingleChildrensMovieAmount()
    {
        $this->assertEquals(1.5, $this->childrens->determineAmount(3));
        $this->assertEquals(1.5, $this->childrens->determineAmount(2));
    }

    public function testSingleChildrensMoviePoints()
    {
        $this->assertEquals(1, $this->childrens->determineFrequentRenterPoints(3));
    }
}