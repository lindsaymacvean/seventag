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

import permissionFactory from '../entity/Permission.js';

var transformResponse = function (resp) {

    var permissionList = ['operator', 'publish', 'edit', 'view', 'noaccess'];

    var Permission = permissionFactory(this);

    var permission = new Permission();

    permission.user = resp.user;

    if (resp.permissions instanceof Object) {

        for (var permissionIndex in permissionList) {

            if (resp.permissions.indexOf(permissionList[permissionIndex]) !== -1) {

                permission.permissions = permissionList[permissionIndex];
                break;

            }

        }

    } else {

        permission.permissions = resp.permissions;

    }

    return permission;

};

var appendTransform = function (defaults, transform) {

    // We can't guarantee that the default transformation is an array
    defaults = angular.isArray(defaults) ? defaults : [defaults];

    // Append the new transformation to the defaults
    return defaults.concat(transform);

};

/**
 * @name PermissionResource
 *
 */
class PermissionResource {
    /**
     * @param {$http} $http
     * @param {$q} $q
     */
    constructor ($http, $q) {

        this.http = $http;
        this.q = $q;

    }

    /**
     * @returns {Permission}
     */
    getEntityObject () {

        var Permission = permissionFactory(this);

        return new Permission();

    }

    query (id, params) {

        var deferred = this.q.defer();

        this.http({
            method: 'GET',
            url: `/api/containers/${id}/permissions`,
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

    put (id, entity) {

        var deferred = this.q.defer();

        this.http({
            method: 'PUT',
            data: entity,
            url: `api/containers/${id}/permissions`,
            transformResponse: appendTransform(this.http.defaults.transformResponse, (resp, header, status) => {

                if (status < 400) {

                    return transformResponse.call(this, resp.data);

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

}

export default PermissionResource;
