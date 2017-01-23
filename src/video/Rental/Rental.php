<?php

namespace video\Rental;

use Exception;
use video\MovieTypes\Movie;

/**
 * Class Rental
 */
class Rental
{
    /** @var  Movie */
    private $movie;

    /** @var  int */
    private $daysRented;

    /**
     * Rental constructor.
     * @param Movie $movie
     * @param int $daysRented
     */
    public function __construct($movie, $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    /**
     * Movie's title accessor.
     * @return string
     */
    public function title() : string
    {
        return $this->movie->title();
    }

    /**
     * Movie's amount accessor.
     * @return float
     * @throws Exception
     */
    public function determineAmount() : float
    {

        switch ($this->movie()->priceCode())
        {
            case Movie::CHILDRENS:
                return $this->determineAmountChildrensMovie($this->daysRented);
                break;
            case Movie::NEW_RELEASE:
                return $this->determineAmountNewRelease($this->daysRented);
                break;
            case Movie::REGULAR:
                return $this->determineAmountRegularMovie($this->daysRented);
                break;
            default:
                throw new Exception('Type movie not exist');

        }
    }

    public function determineFrequentRenterPoints()
    {
        if (Movie::NEW_RELEASE == $this->movie()->priceCode()) {
            return $this->determineFrequentRenterPointsNewReleaseMovie($this->daysRented);
        } else {
            return 1;
        }
    }


    /**
     * @param $daysRented
     * @return float
     */
    private function determineAmountChildrensMovie($daysRented) : float
    {
        $thisAmount = 1.5;

        if ($daysRented > 3) {
            $thisAmount += ($daysRented - 3) * 1.5;
        }

        return $thisAmount;
    }

    /**
     * @param $daysRented
     * @return float
     */
    private function determineAmountNewRelease($daysRented) : float
    {
        return $daysRented * 3.0;
    }

    /**
     * @param $daysRented
     * @return float
     */
    private function determineAmountRegularMovie($daysRented) : float
    {
        $thisAmount = 2;

        if ($daysRented > 2) {
            $thisAmount += ($daysRented - 2) * 1.5;
        }

        return $thisAmount;
    }

    /**
     * @param $daysRented
     * @return int
     */
    public function determineFrequentRenterPointsNewReleaseMovie($daysRented) : int
    {
        return ($daysRented > 1) ? 2 : 1;
    }

    /**
     * @return Movie
     */
    public function movie()
    {
        return $this->movie;
    }

}
