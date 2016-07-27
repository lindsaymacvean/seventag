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

(function (sevenTag, MODULE_NAME, MODULE_NAME_DEBUGGER) {

    /**
     * @constructor
     */
    var Debugger = function (breakpointManager, $location, $cookie, DEBUG_PARAM_NAME, $debugParamFilter) {

        var enabled = false;
        var listeners = [];

        this.stack = [];

        this.tagTree = [];

        this.breakpoints = breakpointManager;

        /**
         * @returns {boolean}
         */
        this.isEnabled = function () {
            return enabled;
        };

        /**
         * @returns {boolean}
         */
        this.start = function(tagTree) {
            enabled = true;

            this.tagTree = tagTree;

            return true;
        };

        /**
         * @returns {boolean}
         */
        this.stop = function() {
            enabled = false;

            return true;
        };

        /**
         * @param element
         * @returns {boolean}
         */
        this.push = function(element) {

            if(!enabled) {
                return false;
            }

            this.stack.push(element);

            return true;
        };

        this.close = function () {

            $cookie.remove(DEBUG_PARAM_NAME);

            $location.href = $debugParamFilter.filterFromHash($debugParamFilter.filterFromQuery($location.href));

        };

        /**
         * @param {Object} listener
         * @returns {boolean}
         */
        this.addListener = function (listener) {
            listeners.push(listener);

            return true;
        };

        /**
         * @param {Object} listener
         * @returns {boolean}
         */
        this.hasListener = function (listener) {
            for (var listenerIdx in listeners) {
                if(listener === listeners[listenerIdx]) {
                    return true;
                }
            }

            return false;
        };

        /**
         * @param {Object} listener
         * @returns {boolean}
         */
        this.removeListener = function (listener) {
            for (var listenerIdx in listeners) {
                if (listener === listeners[listenerIdx]) {
                    listeners.splice(listenerIdx, 1);
                    return true;
                }
            }

            return false;
        };

        /**
         * @returns {boolean}
         */
        this.removeListeners = function () {
            listeners = [];

            return true;
        };


        this.debug = function () {

            if (!enabled) {
                return;
            }

            for (var listener in listeners) {
                if (listeners.hasOwnProperty(listener)) {
                    listeners[listener](this.stack);
                }
            }
        };

        return this;

    };

    Debugger.$inject = [
        '$breakpointManager',
        '$location',
        '$cookie',
        'DEBUG_PARAM_NAME',
        '$debugParamFilter'
    ];

    sevenTag.service(MODULE_NAME, Debugger);
    sevenTag[MODULE_NAME_DEBUGGER] = sevenTag.$injector.get('$debugger');

})(window.sevenTag, '$debugger', 'debugger');
