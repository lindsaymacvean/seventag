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
 * @name variable#VariableFormProvider
 * @namespace clearcode.tm.variable
 */
/* eslint-disable */
class VariableFormProvider {

    constructor () {

        this.collection = {};

    }

    /**
     * @description Add variable form template for specific type
     *
     * @param {String} name
     * @param {Object} settings
     * @returns {VariableFormProvider}
     */
    addType (name, settings) {

        var self = this;

        if (self.collection[name] !== undefined) {

            throw new Error('Form type with provided name already exist');

        }

        self.collection[name] = settings;

        return self;

    }

    /**
     * @description Get specific form template by name of variable type
     *
     * @param {String} name
     * @returns {String|Boolean}
     */
    getType (name) {

        var self = this;

        if (self.collection[name] !== undefined) {

            return self.collection[name];

        }

        return false;

    }

    $get () {

        return this;

    }
}
/* eslint-enable */
export default VariableFormProvider;
