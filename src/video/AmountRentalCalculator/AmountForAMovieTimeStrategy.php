<?php

namespace video\AmountRentalCalculator;


class AmountForAMovieTimeStrategy implements AmountMovieStrategy
{
    /** @var  float */
    private $amountPerDay;

    /** @var  integer */
    private $limitDays;

    /** @var  float */
    private $valueForday;

    /**
     * ChildrenMovieStrategy constructor.
     * @param $amountPerDay
     * @param $limitDays
     * @param $valueForDay
     */
    public function __construct($amountPerDay, $limitDays, $valueForDay)
    {
        $this->amountPerDay = $amountPerDay;
        $this->limitDays = $limitDays;
        $this->valueForday = $valueForDay;
    }

    /**
     * @param $daysRented
     * @return float
     */
    public function calculateAmount($daysRented) : float
    {
        $thisAmount = $this->amountPerDay;

        if ($daysRented > $this->limitDays) {
            $thisAmount += ($daysRented - $this->limitDays) * $this->valueForday;
        }

        return $thisAmount;
    }
}