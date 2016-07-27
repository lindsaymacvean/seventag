Feature: Check if show detail of tag in debug mode
  As a user
  I want to see detail of tag
  So that I can access to the tag detail view

  Scenario: I should see detail of tag in debug mode
    Given I go to page "index.test.html#/tags/summary"
     When I should see "Marecki" text in element "#container-name"
      And I follow first fired tags on the list
     Then I should be on page "index.test.html#/tags/summary/tag/559"
      And I should see html tag content
      And I should see fired tags
      And I should see fired triggers
      And I should see not fired triggers
