<?php

namespace video\MovieTypes;

/**
 * Class Movie
 */
class Movie
{
    /** @var  string */
    private $title;

    /** @var  MovieCategory */
    private $category;

    /**
     * Movie constructor.
     * @param string $title
     * @param  MovieCategory $category
     */
    public function __construct($title, $category)
    {
        $this->title = $title;
        $this->category = $category;
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
     * @return MovieCategory
     */
    public function category() : MovieCategory
    {
        return $this->category;
    }


}
