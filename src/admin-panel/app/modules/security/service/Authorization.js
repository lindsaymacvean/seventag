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
 * @name security#Authorization
 * @description
 * Service for authorization
 *
 * @author Arek Zając <a.zajac@clearcode.cc>
 */
class Authorization {

    /**
     * @param {Security} security
     */
    constructor (security, $state) {

        this.security = security;
        this.state = $state;

    }

    /**
     * @description Check if user have permission
     *
     * @param {Array} roles
     * @returns {User}
     */
    authorize (roles) {

        var self = this;

        return this.security.getUser()
            .then(() => {

                var isAuthenticated = self.security.isAuthenticated();

                if (roles && roles.length > 0 && !self.security.hasAnyRole(roles)) {

                    if (!isAuthenticated) {

                        self.state.go('signIn');

                    }

                }

            });

    }

}

export default Authorization;
