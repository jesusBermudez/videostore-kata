<?php
namespace video\Strategy\AmountStrategy;

interface AmountMovieStrategy
{
    /**
     * @param $daysRented
     * @return float
     */
    public function calculateAmount($daysRented) : float;

}