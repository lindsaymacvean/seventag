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

describe('Unit: BaseController', () => {

    var BaseController, tagObject, tagResource, variableResource, variables, $translate, translations, currentContainer, templatesStorage, $scope;

    beforeEach(module('clearcode.tm.tag', ($provide) => {

        tagObject = {

            addTrigger: jasmine.createSpy('getEntityObject'),

            editTrigger: jasmine.createSpy('getEntityObject'),

        };

        tagResource = {

            getEntityObject: jasmine.createSpy('getEntityObject').and.returnValue(tagObject),

            get: jasmine.createSpy('get').and.returnValue({
                then: () => {

                    return 'get has been called';

                }
            })
        };

        variables = {

          data: ['Random', 'Lorem ipsum']

        };


        variableResource = {

            queryAllAvailable: jasmine.createSpy('queryAllAvailable').and.returnValue({
                then: (callback) => {

                    callback(variables);

                    return 'queryAllAvailable has been called';

                }
            })

        };

        templatesStorage = {

            getAll: jasmine.createSpy('getAll').and.returnValue({
                then: () => {

                    return 'getAll has been called';

                }
            })

        };

        currentContainer = {
            get: jasmine.createSpy('get').and.returnValue({
                then: () => {

                    return 'get called';

                }
            })
        };

        translations = {};
        translations['Place the code'] = 'Place the code';

        $translate = jasmine.createSpy('$translate').and.returnValue({
            then: (callback) => {

                callback(translations)

                return '$translate called';

            }
        });
        $translate.storageKey = jasmine.createSpy('storageKey');
        $translate.storage = jasmine.createSpy('storage');
        $translate.preferredLanguage = jasmine.createSpy('preferredLanguage');

        $provide.value('clearcode.tm.tag.tagResource', tagResource);
        $provide.value('clearcode.tm.tag.templatesStorage', templatesStorage);
        $provide.value('clearcode.tm.variable.variableResource', variableResource);
        $provide.value('$translate', $translate);

    }));

    beforeEach(inject(
        ($controller, $rootScope) => {

            $scope = $rootScope.$new();

            BaseController = $controller('clearcode.tm.tag.EditController', {
                $scope: $scope
            });

        }
    ));

    it('should be defined', () => {

        expect(BaseController).toBeDefined();

    });

    describe('when call constructor method', () => {

        it('should create Tag entity', () => {

            expect(tagResource.getEntityObject).toHaveBeenCalled();

        });

        it('should read all available templates', () => {

            expect(templatesStorage.getAll).toHaveBeenCalled();

        });

        it('should translate placeholder text for text editor', () => {

            expect($translate).toHaveBeenCalledWith(['Place the code']);

            expect(BaseController.textEditorConfig.placeholder).toBe(translations['Place the code']);

        });

        it('should retrieve list of variables that can be inserted into editor', () => {

          expect(variableResource.queryAllAvailable).toHaveBeenCalled();

          expect(BaseController.variables).toBe(variables.data);

        });

    });

    describe('when trigger is added', () => {

        beforeEach(() => {

            $scope.$emit('trigger.add', {});

        });

        it('should add trigger to the tag object', () => {

            expect(tagObject.addTrigger).toHaveBeenCalled();

        });

        it('should hide trigger selection form', () => {

          expect(BaseController.showTriggerForm).toBe(false);

        });

    });

    describe('when trigger is edited', () => {

      beforeEach(() => {

          $scope.$emit('trigger.edit', {});

      });

      it('should edit trigger in the tag object', () => {

          expect(tagObject.editTrigger).toHaveBeenCalled();

      });

      it('should hide trigger selection form', () => {

          expect(BaseController.editTriggerForm).toBe(false);

      });

    });

    describe('when hasVariables is called', () => {

      it('should only use array', () => {

          BaseController.variables = 1;
          expect(BaseController.hasVariables()).toBe(false);

      });

      it('should return false if variable array is empty', () => {

        BaseController.variables = [];
        expect(BaseController.hasVariables()).toBe(false);

      });

      it('should return true if variable array has elements', () => {

        BaseController.variables = [1, 2];
        expect(BaseController.hasVariables()).toBe(true);

      });

    });

    describe('when text editor is loaded', () => {

      var editor;

      beforeEach(() => {

          editor = {

            on: jasmine.createSpy('on'),

            options: {}

          };

          BaseController.textEditorConfig.onLoad(editor);

      });

      it('should add handler to focus event', () => {

          expect(editor.on).toHaveBeenCalledWith('focus', jasmine.any(Function));

      });

      it('should add handler to focus lost event', () => {

          expect(editor.on).toHaveBeenCalledWith('blur', jasmine.any(Function));

      });

    });

    describe('when inserting variable into snippet', () => {

      var editor;

      beforeEach(() => {

          var doc = {

              replaceSelection: jasmine.createSpy('replaceSelection')

          };

          editor = {

            on: jasmine.createSpy('on'),

            focus: jasmine.createSpy('focus'),

            doc: doc,

            options: {}

          };

          BaseController.textEditorConfig.onLoad(editor);

      });

      it('should insert it with correct format', () => {

          var variable = {
              name: 'my variable'
          };

          $scope.insertVariableIntoCode(variable);

          expect(editor.doc.replaceSelection).toHaveBeenCalledWith('{{ my variable }}');

      });

      it('should switch focus back to snippet editor', () => {

          var variable = {
              name: 'my variable'
          };

          $scope.insertVariableIntoCode(variable);

          expect(editor.focus).toHaveBeenCalled();

      });

    });

});
