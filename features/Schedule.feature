Feature: Create a schedule
   As a school manager I would like to set up a schedule
   where I can put my classes

  Background:
   Given a schedule
    And time slots
    And a school class

  Scenario: Add a school class to a schedule
    When I add the school class to my schedule
    Then I should get a list of time slots

  Scenario: Assign a time slot to a school class
    When I assign a school class to a time slot
    Then the time slot is allocated
      And has a start point
      And has an end point

  Scenario: A schedule has a defined number of time slots
    When a time slot has a length of 15 minutes
      And the schedule's week has 7 days
      And the the schedule's day has 24 hours
    Then I should have 7*24*4 time slots