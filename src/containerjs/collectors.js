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

(function (sevenTag) {

    var config = function ($collectorProvider, $cookie, $window, $document, $location, $utils) {

        $collectorProvider
            .add('dataLayer', function (variable, state) {

                if(typeof state.dataLayer[variable.value] !== 'undefined') {
                    return state.dataLayer[variable.value];
                }

                return undefined;

            })
            .add('constant', function (variable) {

                return variable.value;

            })
            .add('cookie', function (variable) {

                return $cookie.get(variable.value);

            })
            .add('url', function (variable) {

                var definedValues = ['href', 'hostname', 'pathname'];

                if ($utils.inArray(variable.value, definedValues) !== -1) {
                    return $location[variable.value];
                }

                if (variable.value === 'referrer') {
                    return $document.referrer;
                }

                return variable.value;
            })
            .add('document', function (variable) {

                return $document[variable.value];

            })
            .add('random', function () {

                return Math.random();

            });

    };

    config.$inject = [
        '$collectorProvider',
        '$cookie',
        '$window',
        '$document',
        '$location',
        '$utils'
    ];

    sevenTag.config(config);

}(window.sevenTag));
