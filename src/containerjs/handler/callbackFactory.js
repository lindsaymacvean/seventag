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

(function(sevenTag, MODULE_NAME) {

    var CallbackFactory = function ($utils, $location) {

        this.get = function (eventName, event) {
            if (event.defaultPrevented || event.returnValue === false) {
                return undefined;
            }
            var target = typeof event.target !== 'undefined' ? event.target : event.srcElement;

            if (eventName === 'click' && $utils.inArray(target.nodeName, ['A']) !== -1) {

                event.preventDefault();
                return function() {
                    $location.href = target.href;
                };
            }

            if (eventName === 'submit') {
                event.preventDefault();
                return function() {
                    target.submit();
                };
            }

            return undefined;

        };

        return this;
    };

    CallbackFactory.$inject = [
        '$utils',
        '$location'
    ];

    sevenTag.service(MODULE_NAME, CallbackFactory);

})(window.sevenTag, '$callbackFactory');
