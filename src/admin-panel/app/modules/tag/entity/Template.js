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

import templateTypeFactory from '../entity/TemplateType.js';

var templateFactory = () => {

    let TemplateType = templateTypeFactory();

    class Template {

        /**
         * @constructor
         * @param {string} id
         * @param {string} name
         */
        constructor (id, name) {

            /**
             * @type {string}
             */
            this.id = id;

            /**
             * @type {string}
             */
            this.name = name;

            /**
             * @type {string}
             */
            this.brandUrl = undefined;

            /**
             * @type {string}
             */
            this.templateUrl = undefined;

            /**
             * @type {string}
             */
            this.type = undefined;

            /**
             * @type {Array}
             */
            this.types = [];

            /**
             * @type {object}
             */
            this.fields = [];

        }

        /**
         * @param {object} params
         * @returns {Template}
         */
        addTextField (params) {

            let field = params ? params : {};

            field.type = 'text';

            this.fields.push(field);

            return this;

        }

        /**
         * @param {object} params
         * @returns {Template}
         */
        addHiddenField (name, value) {

            let field = {};

            field.name = name;
            field.value = value;
            field.type = 'hidden';

            this.fields.push(field);

            return this;

        }

        /**
         * @param {object} params
         * @returns {Template}
         */
        addSelectField (params) {

            let field = params ? params : {};

            field.type = 'select';

            this.fields.push(field);

            return this;

        }

        /**
         * @param {string} id
         * @param {string} name
         * @returns {Template}
         */
        addType (id, name) {

            let type = new TemplateType(id, name);

            this.types.push(type);

            return type;

        }

        /**
         * @param {string} url
         * @returns {Template}
         */
        addBrand (url) {

            this.brandUrl = url;

            return this;

        }

        /**
         * @param {string} url
         * @returns {Template}
         */
        addTemplateUrl (url) {

            this.templateUrl = url;

            return this;

        }

    }

    return Template;

};


export default templateFactory;
