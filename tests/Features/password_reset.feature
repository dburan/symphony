Feature: Password Reset
  Scenario: User resets password successfully
    Given I am on "/reset-password"
    When I fill in "email" with "user@example.com"
    And I press "Send Reset Link"
    Then I should see "Password reset link sent"
