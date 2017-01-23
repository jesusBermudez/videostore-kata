<?php

namespace video\Customer;
use video\Rental\RentalStatement;

/**
 * Class Customer
 */
class Customer
{
    /** @var  string */
    private $name;

    /** @var  RentalStatement */
    private $rentalStatement;


    /**
     * Customer constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->rentalStatement = new RentalStatement($this->name());
    }

    /**
     * @param $rental
     */
    public function addRental($rental)
    {
        $this->rentalStatement->addRental($rental);
    }

    /**
     * Name accessor.
     * @return string
     */
    public function name() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function statement()
    {
        return $this->rentalStatement->makeRentalStatement();
    }
}
