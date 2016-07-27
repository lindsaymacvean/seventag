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
 * @type {$stateParams}
 */
var stateParams;

/**
 * @name ManageController
 */
class ManageController {

    /**
     * @param {ngTableParams} TableParams
     * @param {$stateParams} $stateParams
     * @param {IntegrationResource} Integration
     * @param {Alert} alert
     * @param {ParamConverter} paramConverter
     * @param {PageInfo} PageInfo
     * @param {$translate} $translate
     */
        constructor (
            TableParams,
            $stateParams,
            Integration,
            alert,
            paramConverter,
            PageInfo,
            $translate
        ) {

        $alert = alert;
        stateParams = $stateParams;

        this.permissions = [];

        this.tableParams = new TableParams({
            page: 1,
            count: 10,
            sorting: {
                name: 'asc'
            }
        }, {
            total: 0,
            getData: ($defer, params) => {

                Integration.query(paramConverter.list(params.url())).then((resp) => {

                    params.total(resp.total);

                    $defer.resolve(resp.data);

                });

            }
        });

        const BREADCRUMB_TEXT = 'Integrations';

        $translate([BREADCRUMB_TEXT])
            .then((translations) => {

                PageInfo.clear()
                    .add(translations[BREADCRUMB_TEXT])
                    .broadcast();

            });

    }

    removeIntegration (Integration) {

        Integration.remove().then(
            () => {

                $alert.success('success.remove');

                if (this.tableParams.data.length === 1 && this.tableParams.page() > 1) {

                    this.tableParams.page(this.tableParams.page() - 1);

                } else {

                    this.tableParams.reload();

                }

            },
            () => {

                $alert.error('error.remove');

                this.tableParams.reload();

            }
        );

    }

}

export default ManageController;
