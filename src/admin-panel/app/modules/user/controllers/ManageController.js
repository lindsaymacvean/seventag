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
 * @type {Alert}
 */
var $alert;

/**
 * @type {UserResource}
 */
var $userResource;

/**
 * @type {String}
 */
const BREADCRUMB_TEXT = 'Users';

/**
 * @name ManageController
 */
class ManageController {

    /**
     * @param {ngTableParams} TableParams
     * @param {UserResource} userResource
     * @param {Alert} alert
     * @param paramConverter
     * @param currentContainer
     * @param {PageInfo} PageInfo
     * @param {$translate} $translate
     */
    constructor (TableParams, userResource, alert, paramConverter, currentContainer, PageInfo, $translate) {

        this.translate = $translate;
        $alert = alert;
        $userResource = userResource;

        currentContainer.disableDebugMode();

        this.tableParams = new TableParams({
            page: 1,
            count: 10,
            sorting: {
                name: 'asc'
            }
        }, {
            total: 0,
            getData: ($defer, params) => {

                userResource.query(paramConverter.list(params.url())).then((resp) => {

                    params.total(resp.total);

                    $defer.resolve(resp.data);

                });

            }
        });

        this
            .translate([BREADCRUMB_TEXT])
            .then((translations) => {

                PageInfo.clear()
                    .add(translations[BREADCRUMB_TEXT])
                    .broadcast();

            });

    }

    removeUser (user) {

        var self = this;

        user.remove().then(
            () => {

                $alert.success('success.remove');

                if (self.tableParams.data.length === 1) {

                    self.tableParams.page(self.tableParams.page() - 1);

                }

                self.tableParams.reload();

            },
            () => {

                $alert.error('error.remove');

                self.tableParams.reload();

            }
        );

    }

    resetPassword (user) {

        var data = {
            username: user.email
        };

        this.resetPromise = $userResource.resetPassword(data);

        this.resetPromise.then(
            () => {

                $alert.success('user.reset');
                this.tableParams.reload();

            },
            () => {

            }
        );

    }

}

export default ManageController;
