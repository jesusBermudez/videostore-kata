<?php

namespace video\Rental;

use Exception;
use video\AmountRentalCalculator\AmountForAMovieTimeStrategy;
use video\AmountRentalCalculator\AmountMovieStrategy;
use video\AmountRentalCalculator\AmountPerDayPerMovieStrategy;
use video\MovieTypes\Movie;
use video\PointsRentalCalculator\PointsForAMovieTimeStrategy;
use video\PointsRentalCalculator\PointsMovieStrategy;
use video\PointsRentalCalculator\PointsPerDayPerMovieStrategy;

/**
 * Class Rental
 */
class Rental
{
    /** @var  Movie */
    private $movie;

    /** @var  int */
    private $daysRented;

    private $parameters;

    /** @var AmountMovieStrategy  */
    private $amountStrategy = [];

    /** @var  PointsMovieStrategy */
    private $pointsStrategy = [];

    /** @var AmountMovieStrategy  */
    private $amountCalculate;

    /** @var  PointsMovieStrategy */
    private $pointsCalculate;

    /**
     * Rental constructor.
     * @param Movie $movie
     * @param int $daysRented
     */
    public function __construct($movie, $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
        $this->parameters = yaml_parse_file('/Users/jesus.bermudez/Documents/repo_formacion/video-store-kata/videostore-kata/templatemovie.yml');
        $this->createContext();
        $this->setStrategy();

    }

    /**
     * @throws Exception
     */
    private function setStrategy()
    {
        $typeMovie = implode('', array_slice(explode('\\', get_class($this->movie())), -1));
        $this->amountCalculate = $this->amountStrategy[$typeMovie];
        $this->pointsCalculate = $this->pointsStrategy[$typeMovie];
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
        return $this->amountCalculate->calculateAmount($this->daysRented);
    }

    /**
     * @return int
     */
    public function determineFrequentRenterPoints() : int
    {
       return $this->pointsCalculate->calculatePoints($this->daysRented);
    }

    /**
     * @return Movie
     */
    public function movie()
    {
        return $this->movie;
    }

    /**
     * @internal param float $amount
     * @internal param int $days
     */
    private function createContext()
    {
        $this->amountStrategy = array(
            'ChildrensMovie' => new AmountForAMovieTimeStrategy($this->parameters['ChildrensMovie']['Amount'], $this->parameters['ChildrensMovie']['DaysAmount'], $this->parameters['ChildrensMovie']['Value']),
            'RegularMovie' => new AmountForAMovieTimeStrategy($this->parameters['RegularMovie']['Amount'], $this->parameters['RegularMovie']['DaysAmount'], $this->parameters['ChildrensMovie']['Value']),
            'NewReleaseMovie' => new AmountPerDayPerMovieStrategy($this->parameters['NewReleaseMovie']['Amount'])
        );

        $this->pointsStrategy = array(
            'ChildrensMovie' => new PointsPerDayPerMovieStrategy(),
            'RegularMovie' => new PointsPerDayPerMovieStrategy(),
            'NewReleaseMovie' => new PointsForAMovieTimeStrategy($this->parameters['NewReleaseMovie']['DaysPoints'])
        );
    }

}
