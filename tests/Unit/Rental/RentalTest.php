<?php
namespace tests\unit\Rental;

use PHPUnit_Framework_TestCase;
use video\MovieTypes\ChildrensMovie;
use video\MovieTypes\Movie;
use video\MovieTypes\NewReleaseMovie;
use video\MovieTypes\RegularMovie;
use video\Rental\Rental;

class RentalTest extends PHPUnit_Framework_TestCase
{
    /** @var  Movie */
    private $children1;
    /** @var  Movie */
    private $children2;
    /** @var  Movie */
    private $regular1;
    /** @var  Movie */
    private $regular2;
    /** @var  Movie */
    private $newRelease;

    /** @var Rental */
    private $rental1;
    /** @var Rental */
    private $rental2;
    /** @var Rental */
    private $rental3;
    /** @var Rental */
    private $rental4;
    /** @var Rental */
    private $rental5;

    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->children1 = new ChildrensMovie('Children Movie 1');
        $this->regular1 = new RegularMovie('Regular movie 1');
        $this->children2 = new ChildrensMovie('Children Movie 2');
        $this->regular2 = new RegularMovie('Regular movie 2');
        $this->newRelease = new NewReleaseMovie('New release movie');
        $this->rental1 = new Rental($this->children1, 4);
        $this->rental2 = new Rental($this->children2, 2);
        $this->rental3 = new Rental($this->regular1, 5);
        $this->rental4 = new Rental($this->regular2, 1);
        $this->rental5 = new Rental($this->newRelease, 3);
    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->children1 = null;
        $this->children2 = null;
        $this->regular1 = null;
        $this->regular2 = null;
        $this->newRelease = null;
        $this->rental1 = null;
        $this->rental2 = null;
        $this->rental3 = null;
        $this->rental4 = null;
        $this->rental5 = null;
    }

    public function testSingleMovieAmount()
    {
        $this->assertEquals(3.0, $this->rental1->determineAmount());
        $this->assertEquals(1.5, $this->rental2->determineAmount());
        $this->assertEquals(6.5, $this->rental3->determineAmount());
        $this->assertEquals(2.0, $this->rental4->determineAmount());
        $this->assertEquals(9.0, $this->rental5->determineAmount());
    }

    public function testSingleMoviePoints()
    {
        $this->assertEquals(1, $this->rental1->determineFrequentRenterPoints());
        $this->assertEquals(1, $this->rental3->determineFrequentRenterPoints());
        $this->assertEquals(2, $this->rental5->determineFrequentRenterPoints());
    }
}