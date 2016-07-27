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
 * @type {$mockProvider}
 */
var mockProvider;

/**
 * Finding elements by id from specific tables
 * @param {Array} table
 * @param {Number} id
 * @return {Object}
 */
var findElementById = (table, id) => {

    var tableIndex = table.length;

    while (tableIndex--) {

        if (table[tableIndex].id === parseInt(id)) {

            return table[tableIndex];

        }

    }

};

/* eslint-disable */
/**
 * Service for managing mocks
 */
class Mock {

    constructor ($mockProvider) {

        mockProvider = $mockProvider;

    }

	/**
	 * Get elements from table with specific criteria
	 * @param {String} tableName
	 * @param {Object} criteria
	 */
    query (tableName, criteria) {

        var response = [];

        if (mockProvider.collection.hasOwnProperty(tableName)) {

            for (var tableIndex in mockProvider.collection[tableName]) {

                if (mockProvider.collection[tableName].hasOwnProperty(tableIndex)) {

                    for (var key in criteria) {

                        if (mockProvider.collection[tableName][tableIndex][key] === criteria[key]) {

                            response.push(mockProvider.collection[tableName][tableIndex]);

                        }

                    }

                }

            }

            return response;

		}

	}

	/**
	 * Get all elements from specific table
	 * @param {String} tableName
	 * @return {Array}
	 */
	all (tableName) {

		if (mockProvider.collection.hasOwnProperty(tableName)) {

			return mockProvider.collection[tableName];

		}

		return false;

	}

	/**
	 * Get element from specific table
	 * @param {String} tableName
	 * @param {Number} id
	 * @return {Object}
	 */
	get (tableName, id) {

		if (mockProvider.collection.hasOwnProperty(tableName)) {

			return findElementById(mockProvider.collection[tableName], id);

		}

	}

	/**
	 * Add new element into table
	 * @param {String} tableName
	 * @param {Object} element
	 */
	add (tableName, element) {

		if (mockProvider.collection.hasOwnProperty(tableName)) {

			mockProvider.collection[tableName].unshift(element);
			return true;

		}

	}

    /**
	 * Add new element into table
	 * @param {String} tableName
	 * @param {Object} element
	 */
	setElement (tableName, element) {

		if (mockProvider.collection.hasOwnProperty(tableName)) {

			mockProvider.collection[tableName] = element;
			return true;

		}

	}

	/**
	 * Update existing mock
	 * @param {String} tableName
	 * @param {Object} element
	 */
	update (tableName, element) {

		if (mockProvider.collection.hasOwnProperty(tableName)) {

			var tableIndex = mockProvider.collection[tableName].length;

			while (tableIndex--) {

				if (mockProvider.collection[tableName][tableIndex].id === parseInt(element.id)) {

		            mockProvider.collection[tableName].splice(tableIndex, 1);
    				mockProvider.collection[tableName].unshift(element);

					return true;

				}

			}

		}

	}

	/**
	 * Remove element from specific table
	 * @param {String} tableName
	 * @param {Number} id
	 * @return {Array}
	 */
	remove (tableName, id) {

		if (mockProvider.collection.hasOwnProperty(tableName)) {

			var element = findElementById(mockProvider.collection[tableName], id),
				tableIndex = mockProvider.collection[tableName].length;

			while (tableIndex--) {

				if (mockProvider.collection[tableName][tableIndex] === element) {

					mockProvider.collection[tableName].splice(tableIndex, 1);
					return mockProvider.collection[tableName];

				}

			}

		}

	}

	/**
	 * Find highest id from table
	 * @param {String} tableName
	 * @param {Number} id
	 * @return {Array}
	 */
	highestId (tableName) {

		if (mockProvider.collection.hasOwnProperty(tableName)) {

			var highestId = 0,
				tableIndex = mockProvider.collection[tableName].length;

			while (tableIndex--) {

				if (mockProvider.collection[tableName][tableIndex].id >= highestId) {

					highestId = mockProvider.collection[tableName][tableIndex].id;

				}

			}

			return highestId;

		}

	}

	/**
	 * Copy collection
	 */
	copy () {

		mockProvider.copy();

	}

	/**
	 * Restore collection
	 */
	restore () {

		mockProvider.restore();

	}

    /**
	 * Clear collection
	 */
    clear (tableName) {

        if (mockProvider.collection.hasOwnProperty(tableName)) {

			mockProvider.collection[tableName] = [];
            return true;

		}

		return false;

    }

}
/* eslint-enable */

export default Mock;
