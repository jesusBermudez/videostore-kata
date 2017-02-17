<?php
namespace tests\unit\Rental;


use PHPUnit_Framework_TestCase;
use video\MovieTypes\ChildrensMovie;
use video\MovieTypes\Movie;
use video\MovieTypes\MovieCategory;
use video\MovieTypes\NewReleaseMovie;
use video\MovieTypes\RegularMovie;
use video\Rental\Rental;
use video\Rental\RentalStatement;

class RentalStatementTest extends PHPUnit_Framework_TestCase
{
    /** @var  RentalStatement */
    private $statement;
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
    /** @var  MovieCategory */
    private $category1;
    /** @var  MovieCategory */
    private $category2;
    /** @var  MovieCategory */
    private $category3;

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
        $this->category1 = new MovieCategory(1, 'Children');
        $this->category2 = new MovieCategory(2, 'Regular');
        $this->category3 = new MovieCategory(3, 'New release');
        $this->statement = new RentalStatement('Customer Name');
        $this->children1 = new Movie('Children Movie 1', $this->category1);
        $this->regular1 = new Movie('Regular movie 1', $this->category2);
        $this->children2 = new Movie('Children Movie 2', $this->category1);
        $this->regular2 = new Movie('Regular movie 2', $this->category2);
        $this->newRelease = new Movie('New release movie', $this->category3);
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

    public function testMakeRentalStatementFormat()
    {
        $this->statement->addRental($this->rental1);
        $this->statement->addRental($this->rental3);
        $this->statement->addRental($this->rental5);

        $this->assertEquals(
            "Rental Record for Customer Name\n" .
            "\tChildren Movie 1\t3.0\n" .
            "\tRegular movie 1\t6.5\n" .
            "\tNew release movie\t9.0\n" .
            "You owed 18.5\n" .
            "You earned 4 frequent renter points\n",
            $this->statement->makeRentalStatement()
        );
    }
}