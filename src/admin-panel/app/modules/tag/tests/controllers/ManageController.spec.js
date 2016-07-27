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

 /* global describe: false, jasmine: false, beforeEach: false, inject: false, it: false, expect: false */
'use strict';

describe('Unit: ManageController', () => {

    var ManageController, tag, $scope, tagResource, something;

    beforeEach(module('clearcode.tm.tag', ($provide) => {

        something = {
            method: jasmine.createSpy('method').and.returnValue({
                then: () => {
                    return 'done something';
                }
            })
        };

        tag = {
            total: 0,
            data: [],
            remove: jasmine.createSpy('remove').and.returnValue({
                then: () => {
                    return 'remove called';
                }
            }),
            changeStatus: jasmine.createSpy('changeStatus').and.returnValue({
                then: (f) => {
                    f();
                }
            })
        };

        tagResource = {
            query: jasmine.createSpy('query').and.returnValue({
                then: () => {

                    return tag;

                }
            })
        };

        $provide.value('clearcode.tm.tag.tagResource', tagResource);
    }));

    beforeEach(inject(
        ($controller, $rootScope) => {

            $scope = $rootScope.$new();

            ManageController = $controller('clearcode.tm.tag.ManageController', {
                $scope: $scope
            });

            ManageController.currentContainer.makeChanges = jasmine.createSpy('makeChanges').and.returnValue({});

        }
    ));

    it('should be defined', () => {

        expect(ManageController).toBeDefined();

    });

    it('should set table properly', () => {

        expect(ManageController.tableParams).toBeDefined();

    });

    describe('when call removeTag method', () => {

        it('should call remove method on Tag object', () => {

            ManageController.removeTag(tag);

            expect(tag.remove).toHaveBeenCalled();

        });

    });

    describe('when page is changed', () => {

        beforeEach( () => {

            $scope.$emit('ngTableAfterReloadData');

        });

        it('should hide menu and triggers', () => {

            expect(ManageController.showTriggers).toBe(-1);
            expect(ManageController.showMenu).toBe(-1);

        });

    });

    describe('toggle triggers list', () => {

        beforeEach( () => {

            ManageController.toggleTriggerList(0);

        });

        it('should hide action menu', () => {

            expect(ManageController.showMenu).toBe(-1);

        });

    });

    describe('when call changeStatus method', () => {

        it('should call changeStatus method on Tag object', () => {

            ManageController.changeStatus(tag);

            expect(tag.changeStatus).toHaveBeenCalled();
            expect(ManageController.currentContainer.makeChanges).toHaveBeenCalled();

        });

    });

});
