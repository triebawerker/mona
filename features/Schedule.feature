Feature: Create a schedule
   As a school manager I would like to set up a schedule
   where I can put my classes

  Background:
   Given a schedule
    And time slots
    And a school class

  Scenario: Add a school class to a schedule
    When I add the school class to my schedule
    Then I should get a List of available classes

  Scenario: Add time slots
    When I have added time slots
    Then I should get a list of time slots

  Scenario: Assign a time slot to a school class
    When I assign a school class to a time slot
    Then the time slot is allocated
      And could not be allocated again