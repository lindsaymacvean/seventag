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


var userFactory = (resource) => {

    /**
     * @name User
     * @description User entity
     */
    class User {

        constructor () {

            /**
             * @type {number}
             */
            this.id = undefined;

            /**
             * @type {string}
             */
            this.email = undefined;

            /**
             * @type {string}
             */
            this.firstName = undefined;

            /**
             * @type {string}
             */
            this.lastName = undefined;

            /**
             * @type {string}
             */
            this.displayName = undefined;

            /**
             * @type {Array}
             */
            this.roles = [];

            /**
             * @type {Boolean}
             */
            this.status = false;

            /**
             * @type {Date}
             */
            this.createdAt = undefined;

            /**
             * @type {string}
             */
            this.language = undefined;

        }

        /**
         * @param role
         * @returns {boolean}
         */
        hasRole (role) {

            return this.roles.indexOf(role) !== -1;

        }

        /**
         * @returns {deferred.promise}
         */
        save () {

            var result = {}, promise;

            var excludedProperty = ['id', 'displayName', 'status', 'createdAt', 'language'];

            var excludedInEdit = ['email'];

            for (var property in this) {

                if (
                    !angular.isFunction(this[property]) &&
                    this.hasOwnProperty(property) &&
                    excludedProperty.indexOf(property) === -1
                ) {

                    if (this.id === undefined || excludedInEdit.indexOf(property) === -1) {

                        result[property] = this[property];

                    }

                }

            }

            if (this.id === undefined) {

                promise = resource.post(result);

            } else {

                promise = resource.put(this.id, result);

            }

            return promise;

        }

        /**
         * @returns {deferred.promise}
         */
        saveMe () {

            var result = {}, promise;

            var excludedProperty = ['id', 'displayName', 'roles', 'status', 'createdAt', 'email', 'language'];


            for (var property in this) {

                if (
                    !angular.isFunction(this[property]) &&
                    this.hasOwnProperty(property) &&
                    excludedProperty.indexOf(property) === -1
                ) {

                    result[property] = this[property];

                }

            }

            promise = resource.putMe(result);

            return promise;

        }

        /**
         * @returns {deferred.promise}
         */
        saveOthersSettings () {

            var result = {}, promise;

            var excludedProperty = ['id', 'displayName', 'roles', 'status', 'createdAt', 'email', 'firstName', 'lastName'];

            for (var property in this) {

                if (
                    !angular.isFunction(this[property]) &&
                    this.hasOwnProperty(property) &&
                    excludedProperty.indexOf(property) === -1
                ) {

                    result[property] = this[property];

                }

            }

            promise = resource.othersSettingsMe(result);

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

    return User;

};

export default userFactory;
