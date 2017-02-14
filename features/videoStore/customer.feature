Feature: Information rental movies customer
  In order to show reports about rented movies
  As a customer
  I am able to choose create a report to customer about rented movies


  Scenario: Report children movies rented
    Given I insert the name of customer "Juan Lopez Garcia"
    And I rental the next movies
    |type    |title                               |days|
    |children|Daniel el travieso                  |2   |
    |children|La historia interminable            |2   |
    |children|La historia interminable II         |2   |
    When I request report of rented movies
    Then I shoud see the next report
    """
    Rental Record for Juan Lopez Garcia
	 Daniel el travieso	1.5
	 La historia interminable	1.5
	 La historia interminable II	1.5
    You owed 4.5
    You earned 3 frequent renter points

    """

  Scenario: Report regular movies rented
    Given I insert the name of customer "Juan Lopez Garcia"
    And I rental the next movies
      |type    |title                               |days|
      |regular |La mascara                          |1   |
      |regular |Ahora me ves                        |2   |
      |regular |Los piratas del caribe              |5   |
    When I request report of rented movies
    Then I shoud see the next report
    """
    Rental Record for Customer Name
      La mascara 2.0
      Ahora me ves 2.0
      Los piratas del caribe 6.5
    You owed 10.5
    You earned 3 frequent renter points
    """

  Scenario: Report regular movies rented
    Given I insert the name of customer "Juan Lopez Garcia"
    And I rental the next movies
      |type    |title                               |days|
      |new     |Capitán America: Civil War          |2   |
      |new     |Deadpool                            |2   |
      |new     |Assassin's Creed                    |7   |
    When I request report of rented movies
    Then I shoud see the next report
    """
    Rental Record for Customer Name
      Capitán America: Civil War 6.0
      Deadpool 6.0
      Assassin's Creed 21.0
     You owed 33.0
     You earned 6 frequent renter points
    """

