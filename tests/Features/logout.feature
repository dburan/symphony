Feature: Logout
  Scenario: User logs out
    Given I am logged in as "user@example.com"
    When I click "Logout"
    Then I should be redirected to "/login"
    And I should see "You have been logged out"
