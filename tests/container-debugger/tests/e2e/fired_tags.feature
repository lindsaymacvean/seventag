Feature: Check if trigger work correctly in debug mode
  As a user
  I want to debug my tags
  So that I can access to the debug mode

    Scenario: Check if fired tags with page view trigger work correctly
        Given I go to page "index.test.html#/tags/summary"
         When I should see "Marecki" text in element "#container-name"
         Then I should see page view fired tag "page url contains localhost:3000"
          And I should see page view fired tag "page url doesn't contains localhost:3001"
          And I should see page view fired tag "page url starts with localhost:3000"
          And I should see page view fired tag "page url ends with summary"
          And I should see page view fired tag "page url equals localhost:3000/index.test.html#/report/summary"
          And I should see page view fired tag "page url regexp report"
          And I should see page view fired tag "page url doesn't starts with localhost:3001"
          And I should see page view fired tag "page url doesn't ends with test"
          And I should see page view fired tag "page path contains index.test"
          And I should see page view fired tag "page url regexp doesn't equal with dev"
          And I should see page view fired tag "page url doesn't equals localhost:3001/index.test.html#/report/summary"
          And I should see page view fired tag "page url doesn't start with summary"
          And I should see page view not fired tag "page url doesn't equals localhost:3000/index.test.html#/report/summary"
          And I should see page view not fired tag "page url regexp doesn't equal with test"
          And I should see page view not fired tag "page hostname contains localhost:3000"
          And I should see page view not fired tag "page path contains index.dev"
          And I should see page view not fired tag "page hostname contains localhost:3001"
          And I should see page view not fired tag "page url starts with localhost:3001"
          And I should see page view not fired tag "page url doesn't ends with summary"
          And I should see page view not fired tag "page url contains localhost:3001"
          And I should see page view not fired tag "page url doesn't contains localhost:3000"
          And I should see page view not fired tag "page url ends with test"
          And I should see page view not fired tag "page url equlas http://localhost:3001/index.test.html#/report/summary"
          And I should see page view not fired tag "page url regexp dev"
          And I should see page view not fired tag "referrer contains index.test"

  Scenario: Check if fired tags with click trigger work correctly
    Given I go to page "index.test.html#/tags/summary"
     When I should see "Marecki" text in element "#container-name"
     Then I should see click not fired tag "click page path contain index"
      And I should see click not fired tag "click page url contain index"
      And I should see click not fired tag "click page hostname contains localhost"
      And I should see click not fired tag "click page referrer contains index2"
      And I should see click not fired tag "click page click classes contain simple-btn"
      And I should see click not fired tag "click page click id contain test-button"
      And I should see click not fired tag "click page click url contain index2"
     When I click Be Awesome button
     Then I should see click fired tag "click page url contain index"
      And I should see click fired tag "click page path contain index"
      And I should see click fired tag "click page click classes contain simple-btn"
      And I should see click fired tag "click page click id contain test-button"
      And I should see click fired tag "click page hostname contains localhost"

  Scenario: Check if fired tags with event trigger work correctly
    Given I go to page "index.test.html#/tags/summary"
     When I should see "Marecki" text in element "#container-name"
     Then I should see event fired tag "event contains customEvent"
      And I should see event not fired tag "event contains customEvent2"

  Scenario: Check if fired tags with submit forms trigger work correctly
    Given I go to page "index.test.html?user=&pass=#/tags/summary"
     When I should see "Marecki" text in element "#container-name"
     Then I should see submit forms not fired tag "form classess contains form-class"
     Then I should see submit forms not fired tag "form id contains test-form"
      And I should see submit forms not fired tag "form url contains http://7tag.dev/index.test.html?user=&pass=#/tags/summary"
      And I click login button in form
      And I should see submit forms fired tag "form classess contains form-class"
      And I should see submit forms fired tag "form id contains test-form"
      And I should see submit forms fired tag "form url contains http://7tag.dev/index.test.html?user=&pass=#/tags/summary"








