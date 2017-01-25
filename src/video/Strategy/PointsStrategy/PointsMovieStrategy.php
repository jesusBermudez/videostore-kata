<?php

namespace video\Strategy\PointsStrategy;


interface PointsMovieStrategy
{
    /**
     * @param $daysRented
     * @return int
     */
    public function calculatePoints($daysRented) : int;
}