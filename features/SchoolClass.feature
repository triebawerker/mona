Feature: Create a school class
    In order to set up a schedule
    As a manager I would like to create a school class

  Scenario: Set up a school class
    Given is a school class
    When I setup the class
    Then I get the name
      And I get the teacher
      And I get the class room
      And I get the start date
      And I get the duration