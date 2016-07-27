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

const HTML_HEAD_WRAP_START = '<!DOCTYPE HTML><html><head>';
const HTML_HEAD_WRAP_END = '</head><body></body></html>';

/**
 * @name TagTemplateLinter
 */
class TagTemplateLinter {

    /**
     * @param  TagTemplateToJsConverter tagTemplateToJsConverter
     * @param  LintingRules lintingRules
     * @param  HtmlLinter htmlLinter
     */
    constructor (tagTemplateToJsConverter, lintingRules, htmlLinter) {

          this.tagTemplateToJsConverter = tagTemplateToJsConverter;
          this.lintingRules = lintingRules;
          this.htmlLinter = htmlLinter;

    }

    /**
     * @param  {string} text
     * @param  {object} options
     * @param  {object} cm
     * @return {[object]}
     */
    validate (text, options, cm) {

        if (options.deactivate){
            return [];
        }

        let htmlWrappedText = this.wrapInHtmlTag(text),
            lines = htmlWrappedText.split('\n');

        this.tagTemplateToJsConverter.convert(lines, cm.options);

        let tagTemplateWithFixedJsText = lines.join('\n'),
            allErrors = this.lint(tagTemplateWithFixedJsText, options),
            jsErrors = this.filterOutHtmlErrors(allErrors, lines.length),
            errors = [];

        for (let i = 0; i < jsErrors.length; i++) {
            errors.push(this.mapToLintRepresentation(jsErrors[i]));
        }

        return errors;

    }

    /**
     * @param  {string} text
     * @return {string}
     */
    wrapInHtmlTag (text) {

        return `${HTML_HEAD_WRAP_START}
                ${text}
                ${HTML_HEAD_WRAP_END}`;

    }

    /**
     * @param  {[object]} errors
     * @param  {number} lineCount
     * @return {[object]}
     */
    filterOutHtmlErrors (errors, lineCount) {

        let jsErrors = [];

        for (let i = 0; i < errors.length; i++) {
            let error = errors[i];

            if (!this.isHtmlError(error, lineCount)){

                error.line -= 1;
                jsErrors.push(error);
            }
        }

        return jsErrors;

    }

    /**
     * @param  {object}  error
     * @param  {number}  lastLine
     * @return {Boolean}
     */
    isHtmlError (error, lastLineIdx) {

        return error.line === 0 || error.line === lastLineIdx;

    }

    /**
     * @param  {string} text
     * @param  {object} options
     * @return {[object]}
     */
    lint (text, options) {

        options = options || {};

        let lintRules = angular.extend({}, this.lintingRules.getLintingRules(), options);

        return this.htmlLinter.lint(text, lintRules);

    }

    /**
     * @param  {object} message
     * @return {object}
     */
    mapToLintRepresentation (message) {

        return {
            from: CodeMirror.Pos(message.line - 1, 0),
            to: CodeMirror.Pos(message.line - 1, 0),
            message: message.message,
            severity : message.type
        };

    }

}

export default TagTemplateLinter;
