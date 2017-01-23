<?php

namespace video\MovieTypes;

/**
 * Class Movie
 */
abstract class Movie
{
    /** @var  string */
    private $title;

    const REGULAR = 0;
    const NEW_RELEASE = 1;
    const CHILDRENS = 2;

    /**
     * Movie constructor.
     * @param $title
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Title accessor.
     * @return string
     */
    public function title() : string
    {
        return $this->title;
    }


    /**
     * @return string
     */
    abstract public function priceCode();


}
