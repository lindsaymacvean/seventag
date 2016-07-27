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

(function(sevenTag) {

    var eventListeners = [];

    sevenTag.value('$window', window);

    sevenTag.service('$document', function() {
        return document;
    });

    sevenTag.emit = function (eventName, target) {

        for (var listener in eventListeners) {

            eventListeners[listener](eventName, target);

        }

    };

    sevenTag.on = function (eventName, handler) {

        eventListeners.push(function (targetEventName, target) {

            if (targetEventName === eventName) {
                handler(target);
            }

        });

    };

    sevenTag.service('$postscribe', function() {
        return window.postscribe;
    });

    var BodyElement = function(Element) {
        return new Element(window.document.body);
    };

    BodyElement.$inject = [
        'Element'
    ];

    sevenTag.service('$bodyElement', BodyElement);

    var DocumentElement = function(Element) {
        return new Element(document);
    };

    DocumentElement.$inject = [
        'Element'
    ];

    sevenTag.service('$documentElement', DocumentElement);

    sevenTag.service('$injector', function() {
        return sevenTag.$injector;
    });

    sevenTag.provider('DOMAIN', function () {
        return '##domain##';
    });

    sevenTag.provider('DELAY', function () {
        return '##delay##';
    });

    sevenTag.provider('ID', function () {
        return '##id##';
    });

    sevenTag.value('$variables', function () {
        return window.sevenTag.variables;
    });

    sevenTag.value('DEBUG_PARAM_NAME', '_stg_debug');

    sevenTag.value('$location', window['location']);

})(window.sevenTag);
