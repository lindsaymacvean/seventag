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

import triggerFactory from '../entity/Trigger.js';

var transformResponse = function (resp) {

    var Trigger = triggerFactory(this);

    var trigger = new Trigger();

    if (resp !== undefined) {

        trigger.id = resp.id;
        trigger.name = resp.name;
        trigger.type = resp.type;
        trigger.conditions = resp.conditions;
        trigger.tagsCount = resp.tags_count;
        trigger.updatedAt = resp.updated_at;

    }

    return trigger;

};


var appendTransform = function (defaults, transform) {

    // We can't guarantee that the default transformation is an array
    defaults = angular.isArray(defaults) ? defaults : [defaults];

    // Append the new transformation to the defaults
    return defaults.concat(transform);

};

/**
 * @name TriggerResource
 */
class TriggerResource {
    /**
     * @param {$q} $q
     * @param {$http} $http
     */
    constructor ($http, $q) {

        this.http = $http;
        this.q = $q;

    }

    /**
     * @returns {Trigger}
     */
    getEntityObject () {

        var Trigger = triggerFactory(this);

        return new Trigger();

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
            url: `/api/triggers/${id}`,
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
     * @param {Array} params
     *
     * @returns {deferred.promise}
     */
    query (containerId, params) {

        var deferred = this.q.defer();

        this.http({
            method: 'GET',
            url: `/api/containers/${containerId}/triggers`,
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
            url: `/api/triggers/${id}`
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
            url: `/api/containers/${containerId}/triggers`,
            data: entity,
            transformResponse: appendTransform(this.http.defaults.transformResponse, (resp, header, status) => {

                if (status < 400) {

                    return transformResponse.call(this, resp.data);

                } else {

                    return resp;

                }

            })
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
            url: `/api/triggers/${id}`,
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

export default TriggerResource;
