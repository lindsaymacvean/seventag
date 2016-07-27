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
 * @name form#CheckboxDirective
 * @namespace clearcode.tm.form
 */
/* eslint-disable */
var CheckboxDirective = () => {

	return {
		restrict: 'A',
		require: '?ngModel',
		scope: {
        	ngModel: '=',
        },
        link: (scope, element, attrs) => {

        	var checkedClass = 'cc-checkbox-checked';

			element.wrap('<div class="cc-checkbox"></div>');

			if (scope.ngModel !== undefined) {

				if (scope.ngModel || (attrs.ngTrueValue !== undefined && scope.ngModel === attrs.ngTrueValue)) {

			  		element.parent().addClass(checkedClass);

				} else {

				  	element.parent().removeClass(checkedClass);

				}

			}

			scope.$watch('ngModel', (value) => {

				if (value === true || (attrs.ngTrueValue !== undefined && value === attrs.ngTrueValue)) {

				  	element.parent().addClass(checkedClass);

				} else {

				  	element.parent().removeClass(checkedClass);

				}

			});

        }
	};

};
/* eslint-enable */

export default CheckboxDirective;
