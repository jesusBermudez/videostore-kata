<?php

namespace video\Strategy\PointsStrategy;


class PointsPerDayPerMovieStrategy implements PointsMovieStrategy
{
    /**
     * PointsPerDayPerMovieStrategy constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param $daysRented
     * @return int
     */
    public function calculatePoints($daysRented) : int
    {
        return 1;
    }
}