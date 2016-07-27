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
 * @name ManageController
 */
class ManageController {

    /**
     * @param {ngTableParams} TableParams
     * @param {ContainerResource} containerResource
     * @param {Alert} alert
     * @param paramConverter
     * @param currentContainer
     */
    constructor (TableParams, containerResource, alert, paramConverter, currentContainer) {

        $alert = alert;

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

                containerResource.query(paramConverter.list(params.url())).then((resp) => {

                    params.total(resp.total);

                    $defer.resolve(resp.data);

                });

            }
        });

    }

    removeContainer (container) {

        var self = this;

        container.remove().then(
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

}

export default ManageController;
