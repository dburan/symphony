Feature: User API Management

  Scenario: Creating a new user
    Given I am an authenticated user
    When I create a user with the name "John Doe" and email "john@example.com"
    Then I should see the user with name "John Doe" and email "john@example.com" in the response

  Scenario: Getting a user by ID
    Given I am an authenticated user
    When I retrieve the user with ID "1"
    Then I should see the user with ID "1" in the response

  Scenario: Updating a user's details
    Given I am an authenticated user
    When I update the user with ID "1" to have name "John Doe Updated" and email "john_updated@example.com"
    Then I should see the user with name "John Doe Updated" in the response

  Scenario: Deleting a user
    Given I am an authenticated user
    When I delete the user with ID "1"
    Then the user with ID "1" should no longer exist

  Scenario: Creating a user with missing email
    Given I am an authenticated user
    When I try to create a user with the name "John Missing Email"
    Then I should see an error response

  Scenario: Retrieving all users
    Given I am an authenticated user
    When I retrieve the list of all users
    Then I should see a list of users in the response

  Scenario: Creating a user with invalid email format
    Given I am an authenticated user
    When I try to create a user with the name "Invalid Email User" and email "invalid-email"
    Then I should see an error response

  Scenario: Creating a user with a special role
    Given I am an authenticated user with role "admin"
    When I create a user with the name "Admin User" and email "admin_user@example.com"
    Then I should see the user with name "Admin User" in the response

  Scenario: Getting a non-existent user
    Given I am an authenticated user
    When I try to retrieve the user with ID "9999"
    Then I should see a 404 response

  Scenario: Creating a user without authentication
    Given I am not authenticated
    When I try to create a user with the name "No Auth User"
    Then I should see an error response indicating authentication is required
