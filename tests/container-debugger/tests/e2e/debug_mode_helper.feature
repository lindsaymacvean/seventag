Feature: Check if assistance hints appear on the service.
  As a user
  I want to see assistance hints about service component
  So that I can should see this hints

  Scenario: Check if assistance hints appear in debug mode
    Given I go to page "index.test.html#/tags/summary"
     When I should see "Marecki" text in element "#container-name"
     Then I should see hint about "fired_tags"
     Then I should see hint about "not_fired_tags"
      And I go to page "index.test.html#/report/summary/tag/562"
     Then I should see hint about "available_triggers"


