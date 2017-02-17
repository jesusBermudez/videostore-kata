<?php

namespace video\Rental;

use Exception;
use Symfony\Component\Yaml\Yaml;
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
        $this->parameters = Yaml::parse(file_get_contents('templatemovie.yml'));
        $this->createContext();
        $this->setStrategy();

    }

    /**
     * @throws Exception
     */
    private function setStrategy()
    {
        $category = $this->movie->category();
        $typeMovie = $category->getDescription();
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
            'Children' => new AmountForAMovieTimeStrategy($this->parameters['ChildrensMovie']['Amount'], $this->parameters['ChildrensMovie']['DaysAmount'], $this->parameters['ChildrensMovie']['Value']),
            'Regular' => new AmountForAMovieTimeStrategy($this->parameters['RegularMovie']['Amount'], $this->parameters['RegularMovie']['DaysAmount'], $this->parameters['ChildrensMovie']['Value']),
            'New release' => new AmountPerDayPerMovieStrategy($this->parameters['NewReleaseMovie']['Amount'])
        );

        $this->pointsStrategy = array(
            'Children' => new PointsPerDayPerMovieStrategy(),
            'Regular' => new PointsPerDayPerMovieStrategy(),
            'New release' => new PointsForAMovieTimeStrategy($this->parameters['NewReleaseMovie']['DaysPoints'])
        );
    }

}
