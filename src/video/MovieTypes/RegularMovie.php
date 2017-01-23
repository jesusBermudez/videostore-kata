<?php

namespace video\MovieTypes;

/**
 * Class RegularMovie
 */
class RegularMovie extends Movie
{
    /**
     * RegularMovie constructor.
     * @param $title
     */
    public function __construct($title)
    {
        parent::__construct($title);
    }

    /**
     * @return string
     */
    public function priceCode()
    {
        return self::REGULAR;
    }
}
