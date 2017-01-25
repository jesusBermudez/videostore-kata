<?php
namespace video\AmountRentalCalculator;

interface AmountMovieStrategy
{
    /**
     * @param $daysRented
     * @return float
     */
    public function calculateAmount($daysRented) : float;

}