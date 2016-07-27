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
 * @name Security
 * @description
 * Store information about current user access token
 *
 * @author Arek Zając <a.zajac@clearcode.cc>
 */
class Security {

    /**
     * @param {$q} $q
     * @param {$timeout} $timeout
     * @param {TokenStorage} tokenStorage
     * @param {UserResource} userResource
     * @param {OAuthResource} oauthResource
     * @param {translate} $translate
     */
    constructor ($q, $timeout, tokenStorage, userResource, oauthResource, $translate) {

        this.q = $q;
        this.timeout = $timeout;
        this.user = undefined;
        this.authenticated = false;
        this.tokenStorage = tokenStorage;
        this.userResource = userResource;
        this.oauthResource = oauthResource;
        this.translate = $translate;
        this.checked = false;

    }

    /**
     * @returns {boolean}
     */
    hasUser () {

        return this.user !== undefined;

    }

    /**
     * @description Determines if user is logged in
     *
     * @return {boolean}
     */
    isAuthenticated () {

        return this.authenticated;

    }

    /**
     * Returns true when security is checked
     *
     * @returns {Boolean}
     */
    isChecked () {

        return this.checked;

    }

    /**
     * @description Determines if user has provided role
     *
     * @param {string} roleString
     * @returns {boolean}
     */
    hasRole (roleString) {

        if (!this.authenticated || roleString === undefined) {

            return false;

        }

        return this.user.roles.indexOf(roleString) !== -1 || this.isSuperAdmin();


    }

    isSuperAdmin () {

        return this.user.roles.indexOf('ROLE_SUPER_ADMIN') !== -1;

    }

    /**
     * @description Determines if user has at least one of provide roles
     *
     * @param {array} roles
     */
    hasAnyRole (roles) {

        if (!this.authenticated || roles === undefined) {

            return false;

        }

        for (var i = 0; i < roles.length; i++) {

            if (this.hasRole(roles[i])) {

                return true;

            }

        }

        return false;

    }

    /**
     * @description Authenticate user
     *
     * @param {User} user
     */
    authenticate (user) {

        this.user = user;
        this.authenticated = true;

        this.translate.use(user.language);

    }

    /**
     * Send request to logout from oauth
     * and remove access token
     *
     * @returns {Promise}
     */
    logout () {

        var deferred = this.q.defer();

        var self = this;

        this.oauthResource.logout().then(
            () => {

                self.user = undefined;
                self.authenticated = false;
                self.tokenStorage.removeItem();

                deferred.resolve();

            },
            (err) => {

                deferred.reject(err);

            }
        );

        return deferred.promise;

    }

    /**
     * @description Get current user
     *
     * @param {boolean} force
     * @returns {deferred.promise}
     */
    getUser (force) {

        var self = this;

        var deferred = this.q.defer();

        // Force reload identity from server if necessary
        if (force === true) {

            this.reloadUser();

        }

        // Check if we retrieved the user identity from server. If we have return immediately
        if (this.user !== undefined) {

            deferred.resolve(this.user);
            self.authenticate(this.user);

            return deferred.promise;

        }

        if (undefined !== self.tokenStorage.getItem()) {

            if (!this.isAuthenticated()) {

                this.reloadUser();

            }

        } else {

            self.checked = true;

            deferred.reject();

        }

        return deferred.promise;

    }

    reloadUser () {

        var self = this;
        var deferred = this.q.defer();

        this.userResource.getMe().then(
            (resp) => {

                self.checked = true;

                self.authenticate(resp);
                deferred.resolve(self.user);

            },
            () => {

                self.checked = true;

            }
        );
    }
}

export default Security;
