<?php

namespace video\MovieTypes;

/**
 * Class Movie
 */
abstract class Movie
{
    /** @var  string */
    private $title;

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

}
