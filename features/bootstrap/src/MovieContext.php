<?php

namespace Store;

use Behat\Behat\Context\Context;
use video\MovieTypes\ChildrensMovie;
use video\MovieTypes\Movie;
use video\MovieTypes\NewReleaseMovie;
use video\MovieTypes\RegularMovie;
use video\Rental\Rental;

/**
 * Defines application features from the specific context.
 */
class MovieContext implements Context
{
    /** @var  string */
    private $typeMovie;

    /** @var  Movie */
    private $movie;

    /** @var  Rental */
    private $rentals;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {

    }


    /**
     * @When /^I rental a (children|regular|new) movie with title "([^"]*)" during (\d+) days$/
     * @param string $type
     * @param string $title
     * @param int $days
     * @throws \Exception
     */
    public function iRentalAChildrenMovieWithTitleDuringDays($type, $title, $days)
    {
        $this->typeMovie = $type;
        switch ($type) {
            case 'children':
                $this->rentals[] = new Rental($this->movie = new ChildrensMovie($title), $days);
                break;
            case  'regular':
                $this->rentals[] = new Rental($this->movie = new RegularMovie($title), $days);
                break;
            case 'new':
                $this->rentals[] = new Rental($this->movie = new NewReleaseMovie($title), $days);
                break;
            default:
                throw new \Exception('not exist type of movie');
        }
    }

    /**
     * @Then /^I should see the total amount is "([^"]*)" euros$/
     * @param float $amount
     * @throws \Exception
     */
    public function iShouldSeeTheTotalAmountIsEuros($amount)
    {
        /** @var float $totalAmount */
        $totalAmount = 0;
        foreach ($this->rentals as $rental) {
            /** @var Rental $rental */
            $totalAmount = $totalAmount + $rental->determineAmount();
        }
        if ($amount != $totalAmount) {
            throw new \Exception('The amount is not correct');
        }
    }
}
