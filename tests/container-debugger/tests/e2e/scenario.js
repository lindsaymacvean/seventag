/**
 * Copyright (C) 2015 Digimedia Sp. z.o.o. d/b/a Clearcode
 *
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License as published by the Free
 * Software Foundation, either version 3 of the License, or (at your option) any
 * later version.
 *
 * This program is distrubuted in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
'use strict';

var expect = require('expect');
var Q = require('q');
var scenario = require('./lib/scenario');
/* eslint-disable */
var should = require('should');
/* eslint-enable */
var chai = require('chai');
var chaiAsPromised = require('chai-as-promised');
chai.use(chaiAsPromised);

module.exports = function () {

    scenario.use(this);

    /* eslint-disable */
    this.BeforeFeature(function (event, callback) {
        callback();
    });

    this.BeforeScenario(function (event, callback) {

        var exec = require('child_process').exec,
            child;

        exec('bin/console d:s:d --force', function () {

            exec('bin/console d:s:c', function () {

                exec('bin/console d:f:l --fixtures=src/SevenTag/Api/TestBundle/DataFixtures/e2e --no-interaction', function () {

                    callback();

                });

            });

        });

    });

    this.AfterScenario(function (event, callback) {
        callback();
    });

    this.BeforeStep(function (event, callback) {
        callback();
    });
    /* eslint-enable */

    scenario.define(
        /^I go to page "(.*)"$/, function iGoToPage(url, callback) {

            browser.get(url).then(function () {
                var shouldBeOnPage = scenario.context(
                    /^I should be on page "(.*)"$/,
                    url
                );

                shouldBeOnPage.then(function () {
                    callback();
                });
            });
        });

    scenario.define(
        /^I go to homepage$/,
        function iGoToHomepage(callback) {

            var url = browser.baseUrl;
            var splitUrl = url.replace(browser.baseUrl, '');

            var homepagePromise = scenario.context(
                /^I go to page "(.*)"$/,
                splitUrl + '#/sign-in'
            );

            homepagePromise.then(function () {
                callback();
            });
        });

    scenario.define(
        /^I should be on page "(.*)"$/,
        function iShouldBeOnPage(url, callback) {
            browser.getCurrentUrl().then(function (result) {
                result.should.equal(browser.baseUrl + url);
                callback();
            });
        });

    scenario.define(/^I should not be on page "(.*)"$/,
        function iShouldBeOnPage(url, callback) {
            browser.getCurrentUrl().then(function (result) {
                result.should.notEqual(browser.baseUrl + url);
                callback();
            });
        });

    scenario.define(
        /^I fill in "(.*)" with "(.*)"$/,
        function iFillInWith(locator, text, callback) {
            browser.findElement(by.css(locator)).then(function (result) {
                result.clear().then(function () {
                    result.sendKeys(text).then(function () {
                        callback();
                    });
                });
            });
        });

    scenario.define(/^I click "(.*)" element$/,
        function iClickElement(locator, callback) {
            browser.findElement(by.css(locator)).then(function (result) {
                result.click().then(function () {
                    callback();
                });
            });
        });

    scenario.define(/^I press "(.*)" button$/,
        function iPressButton(locator, callback) {

            var buttonPromise = scenario.context(/^I click "(.*)" element$/,
                locator
            );
            buttonPromise.then(function () {
                callback();
            });
        });

    scenario.define(/^I follow "(.*)" link$/,
        function iFollowLink(locator, callback) {

            var buttonPromise = scenario.context(/^I click "(.*)" element$/,
                locator
            );
            buttonPromise.then(function () {
                callback();
            });
        });

    scenario.define(/^I follow "(.*)" link to "(.*)"$/,
        function iFollowLinkTo(locator, url, callback) {

            var buttonPromise = scenario.context(/^I follow "(.*)" link$/,
                locator
            );

            buttonPromise.then(function () {
                var pagePromise = scenario.context(/^I should be on page "(.*)"$/,
                    url
                );
                pagePromise.then(function () {
                    callback();
                });
            });
        });

    scenario.define(/^I should see an "(.*)" element$/,
        function iShouldSeeElement(locator, callback) {

            browser.isElementPresent(by.css(locator)).then(function(result){
                result.should.equal(true);
                callback();
            });
        });

    scenario.define(/^I should not see an "(.*)" element$/,
        function iShouldNotSeeElement(locator, callback) {

            browser.isElementPresent(by.css(locator)).then(function(result){

                result.should.equal(false);
                callback();
            });
        });

    scenario.define(/^I select "(.*)" from "(.*)"$/,
        function iSelectFrom(optionNum, locator, callback) {

            browser.findElements(by.css(locator + '-dropdown li')).then(function(options){

                options[optionNum].click().then(function(){
                    callback();
                });
            });
        }
    );

    scenario.define(/^I should see "(.*)" text$/,
        function iShouldSeeText(text, callback) {

            browser.findElements(by.xpath('//*[contains(text(),"' + text + '")]')).then(function () {
                callback();
            });
        });

    scenario.define(
        /^I should see "(.*)" text in element "(.*)"$/,
        function iShouldSeeTextInElement(text, locator, callback) {

            var elementWithText = element(by.css(locator));

            elementWithText.getText().then(function (resultText) {
                resultText = resultText.replace(/\.\.\.$/, '');
                expect(text).toContain(resultText);
                callback();
            });
        }
    );

    scenario.define(
        /^I should not see "(.*)" text in element "(.*)"$/,
        function iShouldSeeTextInElement(text, locator, callback) {

            var elementWithText = element(by.css(locator));
            elementWithText.getText().then(function (resultText) {
                resultText = resultText.replace(/\.\.\.$/, '');
                expect(text).not.toContain(resultText);
                callback();
            });
        }
    );

    scenario.define(/^I am logged in as a "(.*)"/,
        function (userType, callback) {

            var usernamePromise = scenario.context(
                /^I fill in "(.*)" with "(.*)"$/,
                '#signin-form-login',
                userType
            );
            var passwordPromise = scenario.context(
                /^I fill in "(.*)" with "(.*)"$/,
                '#signin-form-password',
                'testing'
            );

            Q.all([
                usernamePromise,
                passwordPromise
            ]).then(function () {
                var submitPromise = scenario.context(/^I press "(.*)" button$/,
                    '#signin-form-submit'
                );

                submitPromise.then(function () {
                    scenario.context(/^I should be on page "(.*)"$/,
                        '#/containers'
                    );
                    callback();
                });
            });
        });

    scenario.define(
        /^the checkbox "(.*)" should (?:be unchecked|not be checked)$/,
        function (locator, callback) {
            var checkbox = element(by.css(locator));

            checkbox.isSelected().then(function (value) {
                if (value === false) {
                    callback();
                } else {
                    throw new Error('is not checked');
                }
            });
        }
    );

    scenario.define(/^the checkbox "(.*)" should be checked$/,
        function (locator, callback) {
            var checkbox = element(by.css(locator));

            checkbox.isSelected().then(function (value) {
                if (value === true) {
                    callback();
                } else {
                    throw new Error('is checked');
                }
            });
        });

    scenario.define(/^I check "(.*)"$/,
        function (locator, callback) {

            var checkboxPromise = scenario.context(/^the checkbox "(.*)" should (?:be unchecked|not be checked)$/,
                locator
            );

            checkboxPromise.then(function () {

                var checkedPromise = scenario.context(/^I click "(.*)" element$/,
                    locator
                );

                checkedPromise.then(function () {
                    callback();
                });
            });
        });

    scenario.define(/^I uncheck "(.*)"$/,
        function (locator, callback) {

            var checkboxPromise = scenario.context(/^the checkbox "(.*)" should be checked$/,
                locator
            );

            checkboxPromise.then(function () {

                var checkedPromise = scenario.context(/^I click "(.*)" element$/,
                    locator
                );

                checkedPromise.then(function () {
                    callback();
                });
            });
        });


    scenario.define(/^I should see disabled "(.*)" button$/,
        function (locator, callback) {

            var button = element.all(by.css(locator + ':disabled'));

            button.count().then(function (count) {
                if (count > 0) {
                    callback();
                } else {
                    throw new Error('button is enabled');
                }
            });
        });

    scenario.define(/^I should see disabled "(.*)" link/,
        function (locator, callback) {

            var button = element.all(by.css(locator + '[disabled]'));

            button.count().then(function (count) {
                if (count > 0) {
                    callback();
                } else {
                    throw new Error('link is enabled');
                }
            });
        }
    );

    scenario.define(/^I select "(.*)" option from "(.*)"$/,
        function (optionId, selectId, callback) {

            var chooseConditionVariablePromise = scenario.context(
                /^I click "(.*)" element$/,
                selectId
            );

            chooseConditionVariablePromise.then(function() {

                var chooseOptionFromConditionVariablePromise = scenario.context(
                    /^I click "(.*)" element$/,
                    optionId
                );

                chooseOptionFromConditionVariablePromise.then(function() {
                    callback();
                });
            });
        });

    scenario.define(/^I should not see hidden "(.*)" element$/,
        function (locator, callback) {

            var hiddenElement = element(by.css(locator));

            hiddenElement.isDisplayed().then(function (isVisible) {
                if (isVisible === false) {
                    callback();
                } else {
                    throw new Error('is visible');
                }
            });
        });

    scenario.define(/^I should see page view fired tag "(.*)"$/,
        function (tagName, callback) {

            var elementId;

            switch (tagName) {
                case 'page url contains localhost:3000':
                    elementId = '#fired-tag-559';
                    break;

                case 'page url doesn\'t contains localhost:3001':
                    elementId = '#fired-tag-560';
                    break;

                case 'page url starts with localhost:3000':
                    elementId = '#fired-tag-561';
                    break;

                case 'page url ends with summary':
                    elementId = '#fired-tag-562';
                    break;

                case 'page url equals localhost:3000/index.test.html#/report/summary':
                    elementId = '#fired-tag-563';
                    break;

                case 'page url regexp report':
                    elementId = '#fired-tag-565';
                    break;

                case 'page url doesn\'t starts with localhost:3001':
                    elementId = '#fired-tag-566';
                    break;

                case 'page url doesn\'t ends with test':
                    elementId = '#fired-tag-567';
                    break;

                case 'page path contains index.test':
                    elementId = '#fired-tag-589';
                    break;

                case 'page url regexp doesn\'t equal with dev':
                    elementId = '#fired-tag-594';
                    break;

                case 'page url doesn\'t equals localhost:3001/index.test.html#/report/summary':
                    elementId = '#fired-tag-600';
                    break;

                case 'page url doesn\'t start with summary':
                    elementId = '#fired-tag-624';
                    break;

                case 'referrer contains index.test':
                    elementId = '#fired-tag-649';
                    break;


            }

            var iSeePageViewFiredTagsPromise = scenario.context(
                /^I should see "(.*)" text in element "(.*)"$/,
                tagName,
                elementId
            );

            iSeePageViewFiredTagsPromise.then(function() {
                callback();
            });
        });


    scenario.define(/^I should see page view not fired tag "(.*)"$/,
        function (tagName, callback) {

            var elementId;

            switch (tagName) {
                case 'page url doesn\'t equals localhost:3000/index.test.html#/report/summary':
                    elementId = '#not-fired-tag-564';
                    break;

                case 'page url regexp doesn\'t equal with test':
                    elementId = '#not-fired-tag-568';
                    break;

                case 'page hostname contains localhost:3000':
                    elementId = '#not-fired-tag-590';
                    break;

                case 'page path contains index.dev':
                    elementId = '#not-fired-tag-591';
                    break;

                case 'page hostname contains localhost:3001':
                    elementId = '#not-fired-tag-592';
                    break;

                case 'page url starts with localhost:3001':
                    elementId = '#not-fired-tag-593';
                    break;

                case 'page url doesn\'t ends with summary':
                    elementId = '#not-fired-tag-595';
                    break;

                case 'page url contains localhost:3001':
                    elementId = '#not-fired-tag-596';
                    break;

                case 'page url doesn\'t contains localhost:3000':
                    elementId = '#not-fired-tag-597';
                    break;

                case 'page url ends with test':
                    elementId = '#not-fired-tag-598';
                    break;

                case 'page url equlas http://localhost:3001/index.test.html#/report/summary':
                    elementId = '#not-fired-tag-599';
                    break;

                case 'page url regexp dev':
                    elementId = '#not-fired-tag-623';
                    break;

                case 'referrer contains index.test':
                    elementId = '#not-fired-tag-649';
                    break;


            }

            var iSeePageViewNotFiredTagsPromise = scenario.context(
                /^I should see "(.*)" text in element "(.*)"$/,
                tagName,
                elementId
            );

            iSeePageViewNotFiredTagsPromise.then(function() {
                callback();
            });
        });

    scenario.define(/^I click link$/,
        function (callback) {
            var iClickLinkPromise = scenario.context(
                /^I click "(.*)" element$/,
                '#referrer'
            );

            iClickLinkPromise.then(function() {
                setTimeout(callback, 1000);
            });
        });


    scenario.define(/^I should see click not fired tag "(.*)"$/,
        function (tagName, callback) {

            var elementId;

            switch (tagName) {
                case 'click page path contain index':
                    elementId = '#not-fired-tag-651';
                    break;

                case 'click page url contain index':
                    elementId = '#not-fired-tag-650';
                    break;

                case 'click page hostname contains localhost':
                    elementId = '#not-fired-tag-652';
                    break;

                case 'click page referrer contains index2':
                    elementId = '#not-fired-tag-653';
                    break;

                case 'click page click classes contain simple-btn':
                    elementId = '#not-fired-tag-654';
                    break;

                case 'click page click id contain test-button':
                    elementId = '#not-fired-tag-655';
                    break;

                case 'click page click url contain index2':
                    elementId = '#not-fired-tag-656';
                    break;

            }

            var iSeeClickNotFiredTagsPromise = scenario.context(
                /^I should see "(.*)" text in element "(.*)"$/,
                tagName,
                elementId
            );

            iSeeClickNotFiredTagsPromise.then(function() {
                callback();
            });
        });


    scenario.define(/^I should see click fired tag "(.*)"$/,
        function (tagName, callback) {

            var elementId;

            switch (tagName) {
                case 'click page path contain index':
                    elementId = '#fired-tag-651';
                    break;

                case 'click page url contain index':
                    elementId = '#fired-tag-650';
                    break;

                case 'click page hostname contains localhost':
                    elementId = '#fired-tag-652';
                    break;

                case 'click page referrer contains index2':
                    elementId = '#fired-tag-653';
                    break;

                case 'click page click classes contain simple-btn':
                    elementId = '#fired-tag-654';
                    break;

                case 'click page click id contain test-button':
                    elementId = '#fired-tag-655';
                    break;

                case 'click page click url contain index2':
                    elementId = '#fired-tag-656';
                    break;

            }

            var iSeeClickFiredTagsPromise = scenario.context(
                /^I should see "(.*)" text in element "(.*)"$/,
                tagName,
                elementId
            );

            iSeeClickFiredTagsPromise.then(function() {
                callback();
            });
        });

    scenario.define(/^I click Be Awesome button$/,
        function (callback) {
            var iClickLinkPromise = scenario.context(
                /^I click "(.*)" element$/,
                '#test-button'
            );

            iClickLinkPromise.then(function() {
                callback();
            });
        });

    scenario.define(/^I should see event fired tag "(.*)"$/,
        function (tagName, callback) {

            var elementId;

            switch (tagName) {
                case 'event contains customEvent':
                    elementId = '#fired-tag-689';
                    break;

            }

            var iSeeEventFiredTagsPromise = scenario.context(
                /^I should see "(.*)" text in element "(.*)"$/,
                tagName,
                elementId
            );

            iSeeEventFiredTagsPromise.then(function() {
                callback();
            });
        });

    scenario.define(/^I should see event not fired tag "(.*)"$/,
        function (tagName, callback) {

            var elementId;

            switch (tagName) {
                case 'event contains customEvent2':
                    elementId = '#not-fired-tag-690';
                    break;

            }

            var iSeeEventNotFiredTagsPromise = scenario.context(
                /^I should see "(.*)" text in element "(.*)"$/,
                tagName,
                elementId
            );

            iSeeEventNotFiredTagsPromise.then(function() {
                callback();
            });
        });

    scenario.define(/^I click login button in form$/,
        function (callback) {
            var iClickLoginButtonPromise = scenario.context(
                /^I click "(.*)" element$/,
                '#submit-button'
            );

            iClickLoginButtonPromise.then(function() {
                callback();
            });
        });


    scenario.define(/^I should see submit forms fired tag "(.*)"$/,
        function (tagName, callback) {

            var elementId;

            switch (tagName) {
                case 'form classess contains form-class':
                    elementId = '#fired-tag-691';
                    break;

                case 'form id contains test-form':
                    elementId = '#fired-tag-692';
                    break;

                case 'form url contains http://localhost:3000/index.test.html?user=&pass=#/report/summary':
                    elementId = '#fired-tag-693';
                    break;

            }

            var iSeeSubmitFormsFiredTagsPromise = scenario.context(
                /^I should see "(.*)" text in element "(.*)"$/,
                tagName,
                elementId
            );

            iSeeSubmitFormsFiredTagsPromise.then(function() {
                callback();
            });
        });

    scenario.define(/^I should see submit forms not fired tag "(.*)"$/,
        function (tagName, callback) {

            var elementId;

            switch (tagName) {
                case 'form classess contains form-class':
                    elementId = '#not-fired-tag-691';
                    break;

                case 'form id contains test-form':
                    elementId = '#not-fired-tag-692';
                    break;

                case 'form url contains http://localhost:3000/index.test.html?user=&pass=#/report/summary':
                    elementId = '#not-fired-tag-693';
                    break;

            }

            var iSeeSubmitFormsNotFiredTagsPromise = scenario.context(
                /^I should see "(.*)" text in element "(.*)"$/,
                tagName,
                elementId
            );

            iSeeSubmitFormsNotFiredTagsPromise.then(function() {
                callback();
            });
        });

    scenario.define(/^I follow first fired tags on the list$/,
        function (callback) {
            var iClickFirstFiredTagPromise = scenario.context(
                /^I click "(.*)" element$/,
                '#fired-tag-559'
            );

            iClickFirstFiredTagPromise.then(function() {
                callback();
            });
        });


    scenario.define(/^I should see html tag content$/,
        function (callback) {

            var iSeeHtmlTagContentTagsPromise = scenario.context(
                /^I should see an "(.*)" element$/,
                '#html-tag-content'
            );

            iSeeHtmlTagContentTagsPromise.then(function() {
                callback();
            });
        });

    scenario.define(/^I should see fired tags$/,
        function (callback) {

            var iSeeFiredTagsPromise = scenario.context(
                /^I should see an "(.*)" element$/,
                '#fired-tags'
            );

            iSeeFiredTagsPromise.then(function() {
                callback();
            });
        });

    scenario.define(/^I should see fired triggers$/,
        function (callback) {

            var iSeeFiredTriggersPromise = scenario.context(
                /^I should see an "(.*)" element$/,
                '#fired-triggers'
            );

            iSeeFiredTriggersPromise.then(function() {
                callback();
            });
        });

    scenario.define(/^I should see not fired triggers$/,
        function (callback) {

            var iSeeNotFiredTriggersPromise = scenario.context(
                /^I should see an "(.*)" element$/,
                '#fired-triggers'
            );

            iSeeNotFiredTriggersPromise.then(function() {
                callback();
            });
        });

    scenario.define(/^I follow first not fired tags on the list$/,
        function (callback) {
            var iClickFirstNotFiredTagPromise = scenario.context(
                /^I click "(.*)" element$/,
                '#not-fired-tag-564'
            );

            iClickFirstNotFiredTagPromise.then(function() {
                callback();
            });
        });

    scenario.define(
        /^I should see hint about "(.*)"$/,
        function (option, callback) {

            var infoButton;

            switch (option) {
                case 'fired_tags':
                    infoButton = 'div.row.ng-scope:nth-of-type(1) div.col-md-12 header h4.page-header i.help-tooltip.ng-isolate-scope img.help-icon';
                    break;
                case 'not_fired_tags':
                    infoButton = 'div.row.ng-scope:nth-of-type(2) div.col-md-12 header h4.page-header i.help-tooltip.ng-isolate-scope img.help-icon';
                    break;
                case 'available_triggers':
                    infoButton = 'i.help-tooltip.ng-isolate-scope img.help-icon';
                    break;

            }

            var seeInfoButtonPromise = scenario.context(
                /^I click "(.*)" element$/,
                infoButton
            );

            seeInfoButtonPromise.then(function () {
                callback();

            });

        }
    );
};
