<?php

namespace Store;


use Behat\Behat\Context\BehatContext;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use video\Customer\Customer;
use video\MovieTypes\ChildrensMovie;
use video\MovieTypes\NewReleaseMovie;
use video\MovieTypes\RegularMovie;
use video\Rental\Rental;

/**
 * Defines application features from the specific context.
 */
class CustomerContext implements Context
{
    /** @var  Customer */
    private $customer;

    /** @var  string */
    private $report;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {

    }

    /**
     * @Given /^I insert the name of customer "([^"]*)"$/
     * @Given /^I sign up as giving my name "([^"]*)"$/
     * @param string $name
     */
    public function iInsertTheNameOfCustomer($name)
    {
        $this->customer = new Customer($name);
    }

    /**
     * @When /^I request my rental statement$/
     */
    public function iRequestReportOfRentedMovies()
    {
        $this->report = $this->customer->statement();
    }

    /**
     * @Then /^I shoud see the next report$/
     * @param PyStringNode $report
     * @throws \Exception
     */
    public function iShoudSeeTheNextReport(PyStringNode $report)
    {
        $array[] = $report;
        $hola = implode("",$array);
        if ($hola != $this->report) {
            throw new \Exception($this->report);
        }
    }

    /**
     * @Given /^then I rent the following movies$/
     * @param TableNode $data
     * @throws \Exception
     */
    public function iRentalTheNextMovies(TableNode $data)
    {
        $movies = $data->getHash();
        foreach ($movies as $movie) {
            $typeMovie = $movie['type'];
            switch ($typeMovie) {
                case 'children':
                    $this->customer->addRental(new Rental(new ChildrensMovie($movie['title']), $movie['days']));
                    break;
                case  'regular':
                    $this->customer->addRental(new Rental(new RegularMovie($movie['title']), $movie['days'])) ;
                    break;
                case 'new':
                    $this->customer->addRental(new Rental(new NewReleaseMovie($movie['title']), $movie['days']));
                    break;
                default:
                    throw new \Exception('not exist type of movie');
            }
        }
    }
}