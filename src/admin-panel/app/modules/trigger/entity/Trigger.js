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

var triggerFactory = function (resource) {

    /**
     * @name Trigger
     * @description Trigger entity
     */
    class Trigger {

        constructor () {

            /**
             * @type {number}
             */
            this.id = undefined;

            /**
             * @type {string}
             */
            this.name = undefined;

            /**
             * @type {Number}
             */
            this.type = 0;

            /**
            * @type {Array}
            */
            this.conditions = [];

            /**
             * @type {number}
             */
            this.tagsCount = undefined;

            /**
             * @type {string}
             */
            this.updatedAt = undefined;

        }

        /**
         * @param {Condition} condition
         */
        addCondition (condition) {

            this.conditions.push(condition);

        }

        /**
         * @param {number} index
         */
        removeCondition (index) {

            this.conditions.splice(index, 1);

        }

        /**
         * @param {number} containerId
         *
         * @returns {deferred.promise}
         */
        save (containerId) {
            var result = {}, promise;

            var excludedProperty = ['id', 'updatedAt', 'createdAt', 'tagsCount'];

            for (var property in this) {

                if (
                    !angular.isFunction(this[property]) &&
                    this.hasOwnProperty(property) &&
                    excludedProperty.indexOf(property) === -1
                ) {

                    if (property === 'conditions') {

                        var collection = [];

                        for (var index in this[property]) {

                            if (this[property][index] instanceof Object) {

                                collection.push(
                                    {
                                        variable: this[property][index].variable,
                                        condition: this[property][index].condition,
                                        value: this[property][index].value
                                    }
                                );

                            }

                        }

                        result[property] = collection;

                    } else {

                        result[property] = this[property];

                    }

                }

            }

            if (this.id === undefined) {

                promise = resource.post(containerId, result);

            } else {
                
                promise = resource.put(this.id, result);

            }

            return promise;

        }

        /**
         * @returns {deferred.promise|Boolean}
         */
        remove () {

            if (this.id === undefined) {

                return false;

            }

            return resource.delete(this.id);

        }

    }

    return Trigger;

};


export default triggerFactory;
