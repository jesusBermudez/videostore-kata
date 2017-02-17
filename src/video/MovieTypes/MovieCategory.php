<?php
namespace video\MovieTypes;


class MovieCategory
{
    /** @var  int */
    private $id;

    /** @var  string */
    private $description;

    /**
     * MovieCategory constructor.
     * @param int $id
     * @param $description
     */
    public function __construct($id, $description)
    {
        $this->id = $id;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }


}