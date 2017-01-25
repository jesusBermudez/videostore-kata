<?php

namespace video\PointsRentalCalculator;


interface PointsMovieStrategy
{
    /**
     * @param $daysRented
     * @return int
     */
    public function calculatePoints($daysRented) : int;
}