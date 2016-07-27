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
 * @name alert#AlertStorage
 * @namespace clearcode.tm.alert
 */

var indicator;

class AlertStorage {

    constructor () {

        indicator = 0;
        this.collection = {};

    }

    /**
     * @description Returns all alerts objects
     *
     * @returns {Object}
     */
    getAlerts () {

        return this.collection;

    }

    /**
     * @description Returns specific alert object
     *
     * @param {String} id
     * @returns {Object}
     */
    getAlert (id) {

        return this.collection[id];

    }

    /**
     * @description Add alert to collection
     *
     * @param {String} type
     * @param {String} message
     * @returns {Number}
     */
    add (type, message) {

        this.collection[indicator] = {
            type: type,
            message: message
        };

        return indicator++;

    }

    /**
     * @description Check whether collection contains alert
     *
     * @param {String} type
     * @param {String} message
     * @returns {Boolean}
     */
    has (type, message) {

        for (var alert in this.collection) {

            if (type === this.collection[alert].type && message === this.collection[alert].message) {

                return true;

            }

        }

        return false;

    }

    /**
     * @description Remove alert from collection
     *
     * @param {Number} id
     * @returns {Boolean}
     */
    remove (id) {

        var self = this;

        if (self.collection[id] !== undefined) {

            delete self.collection[id];

            return true;

        }

        return false;

    }

    /**
     * @description Remove all alerts from collection
     */
    clean () {

        this.collection = {};

    }

}

export default AlertStorage;
