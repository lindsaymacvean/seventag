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

import variableFactory from '../entity/Variable.js';

var transformResponse = function (resp) {

    var Variable = variableFactory(this);

    var variable = new Variable();

    variable.id = resp.id;
    variable.name = resp.name;
    variable.description = resp.description;
    variable.type = resp.type;
    variable.value = resp.value;
    variable.options = resp.options;
    variable.updatedAt = resp.updated_at;

    return variable;

};


var appendTransform = function (defaults, transform) {

    // We can't guarantee that the default transformation is an array
    defaults = angular.isArray(defaults) ? defaults : [defaults];

    // Append the new transformation to the defaults
    return defaults.concat(transform);

};

/**
 * @name VariableResource
 */
class VariableResource {
    /**
     * @param {$http} $http
     * @param {$q} $q
     */
    constructor ($http, $q) {

        this.http = $http;
        this.q = $q;

    }

    /**
     * @returns {Variable}
     */
    getEntityObject () {

        var Variable = variableFactory(this);

        return new Variable();

    }

    /**
     * @description Send request to get specific entity
     *
     * @param {number} id
     *
     * @returns {deferred.promise}
     */
    get (id) {

        var deferred = this.q.defer();

        this.http({
            method: 'GET',
            url: `/api/variables/${id}`,
            transformResponse: appendTransform(this.http.defaults.transformResponse, (resp, header, status) => {

                if (status < 400) {

                    return transformResponse.call(this, resp.data);

                } else {

                    return resp;

                }

            })
        })
            .success((resp) => {

                deferred.resolve(resp);

            })
            .error((err) => {

                deferred.reject(err);

            });

        return deferred.promise;

    }

    /**
     * @description Send request to get list of entity
     *
     * @param {number} containerId
     * @param {Object} params
     *
     * @returns {deferred.promise}
     */
    query (containerId, params) {

        var deferred = this.q.defer();

        this.http({
            method: 'GET',
            url: `/api/containers/${containerId}/variables`,
            params: params,
            transformResponse: appendTransform(this.http.defaults.transformResponse, (resp) => {

                for (var element in resp.data) {

                    if (resp.data[element] instanceof Object) {

                        resp.data[element] = transformResponse.call(this, resp.data[element]);

                    }

                }

                return resp;

            })
        })
            .success((resp) => {

                deferred.resolve(resp);

            })
            .error((err) => {

                deferred.reject(err);

            });

        return deferred.promise;

    }

    /**
     * @description Send request to get list of entity
     *
     * @param {number} containerId
     * @param {Object} params
     *
     * @returns {deferred.promise}
     */
    queryAllAvailable (containerId, params) {

        var deferred = this.q.defer();

        this.http({
            method: 'GET',
            url: `/api/containers/${containerId}/available-variables`,
            params: params,
            transformResponse: appendTransform(this.http.defaults.transformResponse, (resp) => {

                for (var element in resp.data) {

                    if (resp.data[element] instanceof Object) {

                        resp.data[element] = transformResponse.call(this, resp.data[element]);

                    }

                }

                return resp;

            })
        })
            .success((resp) => {

                deferred.resolve(resp);

            })
            .error((err) => {

                deferred.reject(err);

            });

        return deferred.promise;

    }

    /**
     * @description Send request to delete entity
     *
     * @param {number} id
     *
     * @returns {deferred.promise}
     */
    delete (id) {

        var deferred = this.q.defer();

        this.http({
            method: 'DELETE',
            url: `/api/variables/${id}`
        })
            .success((data) => {

                deferred.resolve(data);

            })
            .error((err) => {

                deferred.reject(err);

            });

        return deferred.promise;

    }

    /**
     * @description Send request to create entity
     *
     * @param {number} containerId
     * @param {object} entity
     *
     * @returns {deferred.promise}
     */
    post (containerId, entity) {

        var deferred = this.q.defer();

        this.http({
            method: 'POST',
            url: `/api/containers/${containerId}/variables`,
            data: entity,
            transformResponse: appendTransform(this.http.defaults.transformResponse, (resp, header, status) => {

                if (status < 400) {

                    return transformResponse.call(this, resp.data);

                } else {

                    return resp;

                }

            })
        })
            .success((resp) => {

                deferred.resolve(resp);

            })
            .error((err) => {

                deferred.reject(err);

            });

        return deferred.promise;

    }

    /**
     * Send request to update entity
     *
     * @param {number} id
     * @param {object} entity
     *
     * @returns {deferred.promise}
     */
    put (id, entity) {

        var deferred = this.q.defer();

        this.http({
            method: 'PUT',
            url: `/api/variables/${id}`,
            data: entity,
            transformResponse: appendTransform(this.http.defaults.transformResponse, (resp, header, status) => {

                if (status < 400) {

                    return transformResponse.call(this, resp.data);

                } else {

                    return resp;

                }

            })
        })
            .success((resp) => {

                deferred.resolve(resp);

            })
            .error((err) => {

                deferred.reject(err);

            });

        return deferred.promise;

    }
}

export default VariableResource;
