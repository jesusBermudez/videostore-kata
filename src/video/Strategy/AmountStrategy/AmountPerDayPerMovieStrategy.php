<?php
namespace video\Strategy\AmountStrategy;



class AmountPerDayPerMovieStrategy implements AmountMovieStrategy
{
    /** @var float */
    private $amountPerDay;

    /**
     * NewReleaseMovieStrategy constructor.
     * @param float $amountPerDay
     * @internal param float $amountperDay
     */
    public function __construct(float $amountPerDay)
    {
        $this->amountPerDay = $amountPerDay;
    }

    /**
     * @param $daysRented
     * @return float
     */
    public function calculateAmount($daysRented) : float
    {
        return $daysRented * $this->amountPerDay;
    }
}