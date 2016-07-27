'use strict';

angular.module('stg.debugger.templates').run(['$templateCache', function($templateCache) {

  $templateCache.put('pages/events-log/events-log.html', '<div id="event-log-container" ui-view></div>\n' +
  '');

}]);
'use strict';

angular.module('stg.debugger.templates').run(['$templateCache', function($templateCache) {

  $templateCache.put('pages/overview/overview.html', '<div id="overview-container" ui-view></div>\n' +
  '');

}]);
'use strict';

angular.module('stg.debugger.templates').run(['$templateCache', function($templateCache) {

  $templateCache.put('pages/events-log/details/details.html', '<div id="event-details-container" class="animated fadeIn">\n' +
  '    <div id="event-log-breadcrumb">\n' +
  '    <ul>\n' +
  '        <li>\n' +
  '            <a href ui-sref="events-log.list">\n' +
  '                <i class="icon-arrow-left"></i>\n' +
  '                <span class="event-log-breadcrumb-label">{{ view.summary.dataLayerElement.event }}</span>\n' +
  '            </a>\n' +
  '        </li>\n' +
  '    </ul>\n' +
  '</div>\n' +
  '\n' +
  '    <section id="event-details">\n' +
  '        <div id="event-tabs">\n' +
  '    <ul>\n' +
  '        <li ng-class="{active: $state.includes(\'events-log.details.related-tags\')}">\n' +
  '            <a href ui-sref="events-log.details.related-tags.list({eventId: view.eventId})">Related tags</a>\n' +
  '        </li>\n' +
  '        <li ng-class="{active: $state.includes(\'events-log.details.data-layer\')}">\n' +
  '            <a href ui-sref="events-log.details.data-layer({eventId: view.eventId})">Data layer</a>\n' +
  '        </li>\n' +
  '        <li ng-class="{active: $state.includes(\'events-log.details.variables\')}">\n' +
  '            <a href ui-sref="events-log.details.variables({eventId: view.eventId})">Variables</a>\n' +
  '        </li>\n' +
  '    </ul>\n' +
  '</div>\n' +
  '\n' +
  '        <div ui-view></div>\n' +
  '    </section>\n' +
  '</div>\n' +
  '\n' +
  '\n' +
  '');

}]);
'use strict';

angular.module('stg.debugger.templates').run(['$templateCache', function($templateCache) {

  $templateCache.put('pages/events-log/list/list.html', '<section id="events-log" class="animated fadeIn">\n' +
  '    <table>\n' +
  '        <tbody>\n' +
  '            <tr ng-repeat="event in view.eventLog.slice().reverse()">\n' +
  '                <td>\n' +
  '                    <a href ui-sref="events-log.details.related-tags.list({eventId: view.eventLog.length - $index - 1})">\n' +
  '                        <div class="numerable">{{ view.eventLog.length - $index }}.</div>\n' +
  '                        <span class="event-name">{{ event.dataLayerElement.event }}</span>\n' +
  '                        <i class="icon-arrow-right pull-right"></i>\n' +
  '                    </a>\n' +
  '                </td>\n' +
  '            </tr>\n' +
  '        </tbody>\n' +
  '    </table>\n' +
  '</section>\n' +
  '');

}]);
'use strict';

angular.module('stg.debugger.templates').run(['$templateCache', function($templateCache) {

  $templateCache.put('pages/overview/tag-details/tag-details.html', '<section id="overview-tag-details" class="animated fadeIn">\n' +
  '    <div id="overview-tag-details-breadcrumb">\n' +
  '        <ul>\n' +
  '            <li>\n' +
  '                <a href ui-sref="overview.tags">\n' +
  '                    <i class="icon-arrow-left"></i>\n' +
  '                    <span class="event-log-breadcrumb-label" title="{{ view.tagSummary.name | limitTo : 22 }}">\n' +
  '                        {{ view.tagSummary.name | limitTo : 22 }}{{ view.tagSummary.name.length > 22 ? \'...\' : \'\' }}\n' +
  '                    </span>\n' +
  '                </a>\n' +
  '            </li>\n' +
  '        </ul>\n' +
  '    </div>\n' +
  '    <div id="overview-tag-details-code-preview">\n' +
  '        <h5>HTML tag content</h5>\n' +
  '        <pre>\n' +
  '<code ng-bind="view.tagSummary.code"></code>\n' +
  '        </pre>\n' +
  '    </div>\n' +
  '    <div id="overview-tag-details-status">\n' +
  '        <h5>Fired</h5>\n' +
  '        <div class="status-pill">\n' +
  '            <span ng-if="view.tagSummary.isFiredMoreThenOnce()">{{ view.tagSummary.firedCount }} times</span>\n' +
  '            <span ng-if="view.tagSummary.isFiredOnce()">{{ view.tagSummary.firedCount }} time</span>\n' +
  '            <span ng-if="(!view.tagSummary.isFired() && !view.tagSummary.isRespectVisitorsPrivacy(view.doNotTrackEnabled)) && !view.tagSummary.isDisabled()">Not fired</span>\n' +
  '            <span ng-if="view.tagSummary.isRespectVisitorsPrivacy(view.doNotTrackEnabled) && !view.tagSummary.isDisabled()">Do not track</span>\n' +
  '            <span ng-if="view.tagSummary.isDisabled()">Disabled</span>\n' +
  '        </div>\n' +
  '    </div>\n' +
  '    <div id="overview-tag-details-triggers">\n' +
  '        <table>\n' +
  '            <thead>\n' +
  '            <tr>\n' +
  '                <th class="size-90">Trigger name</th>\n' +
  '                <th class="size-10"></th>\n' +
  '            </tr>\n' +
  '            </thead>\n' +
  '            <tbody ng-repeat="trigger in view.tagSummary.triggers" ng-init="folded = false">\n' +
  '                <tr ng-click="folded = !folded">\n' +
  '                    <td class="size-70" title="{{ trigger.name }}">{{ trigger.name | limitTo : 22 }}{{ trigger.name.length > 22 ? \'...\' : \'\' }}</td>\n' +
  '                    <td class="size-10">\n' +
  '                        <i class="icon-arrow-right" ng-if="!folded"></i>\n' +
  '                        <i class="icon-arrow-down" ng-if="folded"></i>\n' +
  '                    </td>\n' +
  '                </tr>\n' +
  '                <tr ng-if="folded">\n' +
  '                    <td colspan="3" class="children">\n' +
  '                        <table>\n' +
  '                            <tbody>\n' +
  '                                <tr ng-repeat="condition in trigger.conditions">\n' +
  '                                    <td>\n' +
  '                                        <strong>{{ condition.variable }}</strong><br />\n' +
  '                                        <span>{{ condition.action }}</span><br />\n' +
  '                                        <span>"{{ condition.value }}"</span>\n' +
  '                                    </td>\n' +
  '                                </tr>\n' +
  '                            </tbody>\n' +
  '                        </table>\n' +
  '                    </td>\n' +
  '                </tr>\n' +
  '            </tbody>\n' +
  '        </table>\n' +
  '    </div>\n' +
  '</section>\n' +
  '\n' +
  '');

}]);
'use strict';

angular.module('stg.debugger.templates').run(['$templateCache', function($templateCache) {

  $templateCache.put('pages/overview/tags/tags.html', '<section id="overview-tag-list" class="animated fadeIn">\n' +
  '    <table>\n' +
  '        <thead>\n' +
  '            <tr>\n' +
  '                <th class="size-55">Tag name</th>\n' +
  '                <th class="size-35">Fired</th>\n' +
  '                <th class="size-10"></th>\n' +
  '            </tr>\n' +
  '        </thead>\n' +
  '        <tbody>\n' +
  '            <tr ng-if="view.tags === undefined">\n' +
  '                <td colspan="3" class="information">\n' +
  '                    Container has no tags\n' +
  '                </td>\n' +
  '            </tr>\n' +
  '            <tr\n' +
  '                ng-repeat="tag in view.tags"\n' +
  '                ng-class="{\'status-not-fired\': tag.firedCount === 0, \'status-disabled\': tag.disableInDebugMode}"\n' +
  '                ng-click="$state.go(\'overview.tag-details\', {id: tag.id})"\n' +
  '            >\n' +
  '                <td>{{ tag.name | limitTo : 22 }}{{ tag.name.length > 22 ? \'...\' : \'\' }}</td>\n' +
  '                <td class="overview-tag-list-fired-count">\n' +
  '                    <div class="status-pill status-pill-notifiable" countable model="tag.firedCount" count-class="fire">\n' +
  '                        <span ng-if="tag.isFiredMoreThenOnce()">{{ tag.firedCount }} times</span>\n' +
  '                        <span ng-if="tag.isFiredOnce()">{{ tag.firedCount }} time</span>\n' +
  '                        <span ng-if="(!tag.isFired() && !tag.isRespectVisitorsPrivacy(view.doNotTrackEnabled)) && !tag.isDisabled()">Not fired</span>\n' +
  '                        <span ng-if="tag.isRespectVisitorsPrivacy(view.doNotTrackEnabled) && !tag.isDisabled()">DNT</span>\n' +
  '                        <span ng-if="tag.isDisabled()">Disabled</span>\n' +
  '                    </div>\n' +
  '                    <div class="status-pill-changed-notifier">\n' +
  '                        <span>+1</span>\n' +
  '                    </div\n' +
  '                </td>\n' +
  '                <td class="size-10"><i class="icon-arrow-right"></i></td>\n' +
  '            </tr>\n' +
  '        </tbody>\n' +
  '    </table>\n' +
  '</section>\n' +
  '\n' +
  '');

}]);
'use strict';

angular.module('stg.debugger.templates').run(['$templateCache', function($templateCache) {

  $templateCache.put('pages/events-log/details/data-layer/data-layer.html', '<div id="event-details-data-layer" class="animated fadeIn">\n' +
  '    <pre>\n' +
  '<code ng-bind="view.summary.dataLayerElement | json"></code>\n' +
  '    </pre>\n' +
  '</div>\n' +
  '');

}]);
'use strict';

angular.module('stg.debugger.templates').run(['$templateCache', function($templateCache) {

  $templateCache.put('pages/events-log/details/related-tags/related-tags.html', '<div id="event-details-tags-container" ui-view></div>\n' +
  '');

}]);
'use strict';

angular.module('stg.debugger.templates').run(['$templateCache', function($templateCache) {

  $templateCache.put('pages/events-log/details/variables/variables.html', '<section id="event-details-variables" class="animated fadeIn">\n' +
  '    <table>\n' +
  '        <thead>\n' +
  '            <tr>\n' +
  '                <th class="size-30">Name</th>\n' +
  '                <th class="size-70">Value</th>\n' +
  '            </tr>\n' +
  '        </thead>\n' +
  '        <tbody>\n' +
  '            <tr ng-repeat="(name, value) in view.summary.variableCollection">\n' +
  '                <td class="size-30">{{ name }}</td>\n' +
  '                <td class="size-70">\n' +
  '                    <span ng-if="value !== undefined">{{ value | json }}</span>\n' +
  '                    <span ng-if="value === undefined">undefined</span>\n' +
  '                </td>\n' +
  '            </tr>\n' +
  '        </tbody>\n' +
  '    </table>\n' +
  '</section>\n' +
  '');

}]);
'use strict';

angular.module('stg.debugger.templates').run(['$templateCache', function($templateCache) {

  $templateCache.put('pages/events-log/details/related-tags/details/details.html', '<section id="events-log-tag-details" class="animated slideInRight">\n' +
  '    <div id="events-log-tag-details-breadcrumb">\n' +
  '        <ul>\n' +
  '            <li>\n' +
  '                <a href ui-sref="events-log.details.related-tags.list({eventId: view.eventId})">\n' +
  '                    <i class="icon-arrow-left"></i>\n' +
  '                    <span class="event-log-breadcrumb-label">{{ details.tagSummary.name }}</span>\n' +
  '                </a>\n' +
  '            </li>\n' +
  '        </ul>\n' +
  '    </div>\n' +
  '    <div id="events-log-tag-details-code-preview">\n' +
  '        <h5>HTML tag content</h5>\n' +
  '        <pre>\n' +
  '<code ng-bind="details.tagSummary.code"></code>\n' +
  '        </pre>\n' +
  '    </div>\n' +
  '    <div id="events-log-tag-details-triggers">\n' +
  '        <table>\n' +
  '            <thead>\n' +
  '            <tr>\n' +
  '                <th class="size-70">Trigger name</th>\n' +
  '                <th class="size-20">Status</th>\n' +
  '                <th class="size-10"></th>\n' +
  '            </tr>\n' +
  '            </thead>\n' +
  '            <tbody ng-repeat="trigger in details.tagSummary.triggers" ng-init="folded = false">\n' +
  '                <tr ng-click="folded = !folded">\n' +
  '                    <td class="size-70" title="{{ trigger.name }}">{{ trigger.name | limitTo : 22 }}{{ trigger.name.length > 22 ? \'...\' : \'\' }}</td>\n' +
  '                    <td class="size-20">\n' +
  '                        <i class="icon-resolved" ng-if="trigger.resolved"></i>\n' +
  '                        <i class="icon-unresolved" ng-if="!trigger.resolved"></i>\n' +
  '                    </td>\n' +
  '                    <td class="size-10">\n' +
  '                        <i class="icon-arrow-right" ng-if="!folded"></i>\n' +
  '                        <i class="icon-arrow-down" ng-if="folded"></i>\n' +
  '                    </td>\n' +
  '                </tr>\n' +
  '                <tr ng-if="folded">\n' +
  '                    <td colspan="3" class="children">\n' +
  '                        <table>\n' +
  '                            <tbody>\n' +
  '                            <tr ng-repeat="condition in trigger.conditions">\n' +
  '                                <td class="size-80">\n' +
  '                                    <strong>{{ condition.variable }}</strong><br />\n' +
  '                                    <span>{{ condition.action }}</span><br />\n' +
  '                                    <span>"{{ condition.value }}"</span>\n' +
  '                                </td>\n' +
  '                                <td class="size-20">\n' +
  '                                    <i class="icon-resolved" ng-if="condition.resolved"></i>\n' +
  '                                    <i class="icon-unresolved" ng-if="!condition.resolved"></i>\n' +
  '                                </td>\n' +
  '                            </tr>\n' +
  '                            </tbody>\n' +
  '                        </table>\n' +
  '                    </td>\n' +
  '                </tr>\n' +
  '            </tbody>\n' +
  '        </table>\n' +
  '    </div>\n' +
  '</section>\n' +
  '\n' +
  '');

}]);
'use strict';

angular.module('stg.debugger.templates').run(['$templateCache', function($templateCache) {

  $templateCache.put('pages/events-log/details/related-tags/list/list.html', '<section id="event-details-related-tags" class="animated fadeIn">\n' +
  '    <table>\n' +
  '        <thead>\n' +
  '        <tr>\n' +
  '            <th class="size-55">Tag name</th>\n' +
  '            <th class="size-35">Status</th>\n' +
  '            <th class="size-10"></th>\n' +
  '        </tr>\n' +
  '        </thead>\n' +
  '        <tbody>\n' +
  '            <tr ng-if="view.tagSummary === undefined">\n' +
  '                <td colspan="3" class="information">\n' +
  '                    Container has no tags\n' +
  '                </td>\n' +
  '            </tr>\n' +
  '            <tr\n' +
  '                ng-repeat="tag in view.tagSummary"\n' +
  '                ng-class="{\'status-not-fired\': !tag.resolved, \'status-disabled\': tag.disableInDebugMode}"\n' +
  '                ng-click="$state.go(\'events-log.details.related-tags.details\', {id: tag.id})"\n' +
  '            >\n' +
  '                <td>{{ tag.name | limitTo : 22 }}{{ tag.name.length > 22 ? \'...\' : \'\' }}</td>\n' +
  '                <td>\n' +
  '                    <div class="status-pill">\n' +
  '                        <span ng-if="tag.resolved && !tag.disableInDebugMode">Fired</span>\n' +
  '                        <span ng-if="!tag.resolved && !tag.disableInDebugMode">Not fired</span>\n' +
  '                        <span ng-if="tag.disableInDebugMode">Disabled</span>\n' +
  '                    </div>\n' +
  '                </td>\n' +
  '                <td class="size-10"><i class="icon-arrow-right"></i></td>\n' +
  '            </tr>\n' +
  '        </tbody>\n' +
  '    </table>\n' +
  '</section>\n' +
  '');

}]);