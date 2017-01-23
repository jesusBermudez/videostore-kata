<?php

namespace video\MovieTypes;

/**
 * Class NewReleaseMovie
 */
class NewReleaseMovie extends Movie
{
    /**
     * NewReleaseMovie constructor.
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
        return self::NEW_RELEASE;
    }

}
