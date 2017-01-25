<?php
namespace video\PointsRentalCalculator;


class PointsForAMovieTimeStrategy implements PointsMovieStrategy
{

    /** @var  integer */
    private $limitDays;

    /**
     * PointsForAMovieTimeStrategy constructor.
     * @param int $limitDays
     * @internal param float $amountPerDay
     */
    public function __construct($limitDays)
    {
        $this->limitDays = $limitDays;
    }

    /**
     * @param $daysRented
     * @return int
     */
    public function calculatePoints($daysRented) : int
    {
        return ($daysRented > $this->limitDays) ? 2 : 1;
    }
}