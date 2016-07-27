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

'use strict';

describe('Unit: callback factory module', function () {

    var callbackFactory;
    var target;

    beforeEach(function () {
        callbackFactory = window.sevenTag.$injector.get('$callbackFactory');
    });

    it('should be defined', function () {
        expect(callbackFactory).toBeDefined();
    });

    describe('Unit: return undefined', function() {

        it('should return undefined if is defaultPrevented', function () {
            expect(callbackFactory.get('click', {defaultPrevented: true})).toBeUndefined();
            expect(callbackFactory.get('submit', {defaultPrevented: true})).toBeUndefined();
        });

        it('should return undefined if is returnValue set on false', function () {
            expect(callbackFactory.get('click', {returnValue: false})).toBeUndefined();
            expect(callbackFactory.get('submit', {returnValue: false})).toBeUndefined();
        });

        it('should return undefined if event is not click/submit', function () {
            expect(callbackFactory.get('toggle', {})).toBeUndefined();
            expect(callbackFactory.get('drag', {})).toBeUndefined();
        });

        it('should return undefined on click tag name is not anchor', function () {
            expect(callbackFactory.get('click', {target: {nodeName: 'FORM'}})).toBeUndefined();
        });

    });

    describe('Unit: return callback', function() {

        beforeEach(function() {
            target = {
                target: {nodeName: 'A'},
                preventDefault: function() {}
            };

            spyOn(target, 'preventDefault');
        });

        it('should return callback on anchor click', function () {
            expect(callbackFactory.get('click', target)).toBeDefined();
            expect(target.preventDefault).toHaveBeenCalled();
        });

        it('should return callback on form submission', function () {
            expect(callbackFactory.get('submit', target)).toBeDefined();
            expect(target.preventDefault).toHaveBeenCalled();
        });
    });
});
