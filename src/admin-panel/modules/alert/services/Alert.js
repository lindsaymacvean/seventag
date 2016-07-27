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

/**
 * @name alert#Alert
 * @namespace clearcode.tm.alert
 */

/**
* @description Remove Alert after Timeout
*
* @param {Integer} id from storage
*/
var removeAfterTimeout = function (id) {

    var self = this;

    if (self.settings.interval > 0) {

        return self.$timeout(() => {

            self.storage.remove(id);

        }, self.settings.interval);

    }

};

/**
* @description Add alert to storage
*
* @param {String} type
* @param {String} pattern
* @param {Array} params
* @returns {Number}
*/
var addAlert = function (type, pattern, params) {

    var message, id, self = this;
    message = self.convertToMessage(pattern, params);

    self
        .translate([message])
        .then((translations) => {

            id = self.storage.add(type, translations[message]);
            removeAfterTimeout.call(self, id);

            return id;

        });

};

class Alert {

    constructor ($timeout, storage, provider, $translate) {

        /**
         * @type {AlertStorage}
         */
        this.storage = storage;
        /**
         * @type {Object}
         */
        this.$timeout = $timeout;
        /**
         * @type {TranslationProvider}
         */
        this.settings = this.settings === undefined ? provider
            : angular.extend(this.settings, provider);

        /**
         * @readonly
         * @type {string}
         */
        this.INFO_TYPE = 'info';

        /**
         * @readonly
         * @type {string}
         */
        this.ERROR_TYPE = 'danger';

        /**
         * @readonly
         * @type {string}
         */
        this.SUCCESS_TYPE = 'success';

        /**
         * @readonly
         * @type {$translate}
         */
        this.translate = $translate;
    }

    /**
     * @description Add success type alert
     *
     * @param {String} id
     * @param {Array} params
     */
    success (id, params = []) {

        addAlert.call(this, this.SUCCESS_TYPE, id, params);

    }

    /**
     * @description Add error type alert
     *
     * @param {String} id
     * @param {Array} params
     */
    error (id, params = []) {

        addAlert.call(this, this.ERROR_TYPE, id, params);

    }

    /**
     * @description Add info type alert
     *
     * @param {String} id
     * @param {Array} params
     */
    info (id, params = []) {

        addAlert.call(this, this.INFO_TYPE, id, params);

    }

    /**
     * @returns {AlertStorage}
     */
    getStorage () {

        return this.storage;

    }

    /**
     * @description Convert message if is a pattern
     *
     * @param {Object|String} pattern
     * @param {Array} params
     * @returns {String}
     */
    convertToMessage (pattern, params) {

        var self, message;

        self = this;

        if (angular.isDefined(pattern)) {

            pattern = self.settings.getMessagePattern(pattern);

        }

        message = vsprintf(pattern, params);

        return message;

    }

}

export default Alert;
