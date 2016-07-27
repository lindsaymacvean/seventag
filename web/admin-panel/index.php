<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title cc-Title ng-bind-template="{{ !$state.includes('container') &amp;&amp; !$state.includes('editProfile') ? titleCtrl.title : titleCtrl.default }}"></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width"><!--[if IE]>
    <link rel="shortcut icon" href="/favicon.ico"><![endif]-->
    <link rel="icon" href="/favicon.ico">
    <!-- build:css styles.css--><!-- inject:css -->
    <link rel="stylesheet" href="/app/vendor.css">
    <link rel="stylesheet" href="/app/app.css">
    <link rel="stylesheet" href="/app/styles/context-menu.css">
    <link rel="stylesheet" href="/app/styles/help-system.css">
    <link rel="stylesheet" href="/modules/confirm/confirm.css">
    <link rel="stylesheet" href="/animate.min.css">
    <link rel="stylesheet" href="/codemirror.css">
    <link rel="stylesheet" href="/icons.css">
    <link rel="stylesheet" href="/lint.css">
    <!-- endinject -->
    <!-- endbuild-->
  </head>
  <body>
    <?php $pathTop = __DIR__.'/../../var/cache/seventagPluginsJavascriptTop.php'; if(is_file($pathTop)) { require_once $pathTop; } ?>
    <section id="wrapper" ng-init="animateSidebarReady = false" class="wrapper">
      <!--mixin icon(name)-->
      <!--    i.icon-#{name}-->
      <header id="top" role="banner" ng-class="{'navbar-not-logged': !security.isAuthenticated()}" class="navbar navbar-static-top navbar-default navbar-not-logged">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display-->
          <div class="navbar-header">
            <button id="collapse-button" type="button" data-toggle="collapse" data-target="#collapse-navbar" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a id="brand" ui-sref="container" class="navbar-brand"><img src="/app/images/logo.png"></a>
          </div>
          <div id="navbar-collapse" class="collapse navbar-collapse">
            <div id="top-container-list" ng-if="isContainerView()" ng-cloak class="navbar-nav container-list">
              <div class="navbar-form">
                <div class="form-group">
                  <div id="top-navbar-menu" class="navbar-containers btn-group">
                          <a class="btn btn-primary btn-md btn-navbar" id="top-menu-icon" href ui-sref="container" ng-if="security.isAuthenticated()"><i class="icon-list"></i>
                          </a>
                    <div ng-class="{'disabled': currentContainerLoading}" class="btn btn-primary btn-md btn-navbar top-container-name"><span ng-if="currentContainerLoading" translate="Loading..."></span><span ng-if="!currentContainerLoading" title="{{ currentContainer.$container.name }}" class="cut-text">{{ currentContainer.$container.name }}</span></div>
                  </div>
                </div>
                <div class="form-group">
                  <div id="top-navbar-publish" class="btn-group">
                          <a class="btn btn-publish btn-md btn-block btn-navbar" id="top-version-publish" ng-if="currentContainer.$container.hasPermission('publish')" ng-click="currentContainer.publish()" ng-class="{'disabled': currentContainerLoading}" tooltip-class="help-tooltip-wrapper" tooltip-placement="bottom" tooltip="{{'Clicking on this button pushes all the changes to production. It won’t be possible to discard changes after publishing it.'|translate}}"><i class="icon-publish"></i><span translate="Publish"></span>
                          </a>
                  </div>
                </div>
              </div>
            </div>
            <div ng-if="isContainerView() &amp;&amp; !currentContainerLoading" class="nav navbar-nav">
              <div ng-cloak class="version-info"><span id="top-version-status" ng-if="currentContainer.isPublished()" translate="Published"></span><span id="top-version-status" ng-if="!currentContainer.isPublished()" translate="Draft"></span><span ng-if="currentContainer.$container.publishedAt">,&nbsp;</span><span ng-if="currentContainer.$container.publishedAt" id="top-version-date">{{ currentContainer.$container.publishedAt| date:'yyyy-MM-dd HH:mm' }}</span></div>
            </div>
            <div id="top-profile-settings" ng-if="security.isAuthenticated()" ng-cloak class="nav navbar-nav pull-right">
              <div class="navbar-form">
                <div class="form-group">
                  <div dropdown id="top-user-menu" class="user-dropdown btn-group">
                          <a class="btn btn-primary btn-md btn-navbar user-profile" id="top-profile-link" ui-sref="editProfile"><i class="icon-user"></i><span class="cut-text">{{ security.user.displayName }}</span>
                          </a>
                          <a class="btn btn-primary btn-md btn-navbar user-menu dropdown-toggle" id="top-profile-opitons" href dropdown-toggle ng-if="security.isAuthenticated()"><i class="icon-arrow-down"></i>
                          </a>
                    <ul role="menu" class="dropdown-menu user-dropdown-menu">
                      <li id="user-menu-my-account"><a ui-sref="editProfile" class="user-menu-item"><i class="icon-user"></i><span translate="My account"></span></a></li>
                      <li ng-if="security.hasRole('ROLE_SUPER_ADMIN')" id="user-menu-user-management"><a ui-sref="users" class="user-menu-item"><i class="icon-users"></i><span translate="User management"></span></a></li>
                      <li ng-if="security.hasRole('ROLE_SUPER_ADMIN')" id="user-menu-integration-settings"><a ui-sref="integration" class="user-menu-item"><i class="icon-integrations"></i><span translate="Integrations"></span></a></li>
                      <li><a ng-click="logout()" id="top-profile-logout" class="user-menu-item"><i class="icon-logout"></i><span translate="Logout"></span></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="navbar-debug" ng-show="isContainerView()" ng-cloak class="collapse navbar-collapse">
            <div id="top-debug-nav" ng-class="{shown: isContainerView() &amp;&amp; currentContainer &amp;&amp; currentContainer.isDirty()}" class="navbar-nav">
              <div ng-style="{ 'visibility': currentContainerLoading? 'hidden' : 'visible'}" class="navbar-form">
                <div ng-if="isContainerView() &amp;&amp; currentContainer.isDirty()" class="form-group">
                  <div class="navbar-debug-item"><span translate="Open your website in Preview and debug mode:"></span></div>
                  <div ng-cloak ng-if="currentContainer.$container &amp;&amp; currentContainer.$container.websites &amp;&amp; currentContainer.$container.websites.length &gt; 0" class="navbar-debug-item"><a ng-href="{{ (currentContainer.$container.websites[0]).getUrlWithParameter() }}" target="_blank">{{ currentContainer.$container.websites[0].url | limitTo: 32 }}{{ currentContainer.$container.websites[0].url.length > 32 ? '...' : '' }}</a></div>
                  <div class="navbar-debug-item">
                          <a class="btn btn-primary btn-sm btn-block btn-navbar" id="top-website-visit" ng-cloak tooltip-class="help-tooltip-wrapper" tooltip-placement="bottom" tooltip="{{'Shows shortcuts to all websites this container is used on.'|translate}}" translate="All websites" ui-sref="debug({containerId: activeContainerId})">
                          </a>
                  </div>
                  <div class="navbar-debug-item">
                          <a class="btn btn-default btn-sm btn-block btn-navbar" id="top-version-restore" ng-cloak tooltip-class="help-tooltip-wrapper" tooltip-placement="bottom" tooltip="{{'Clicking on this button discards all the changes that have been made in the current draft version and reverts back to the last published version.'|translate}}" ng-disabled="!currentContainer.canRestore()" translate="Discard draft changes" ng-click="currentContainer.canRestore() ? currentContainer.restore() : ''">
                          </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header><!--[if lt IE 10]>
      <p class="browserhappy">
        {{ 'You are using <strong>outdated</strong> browser.' | translate }}
        {{ 'Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience' | translate }}
      </p><![endif]-->
      <aside id="wrapper-sidebar" ng-show="animateSidebarReady" ng-class="{slideInLeft: isContainerView(), slideOutLeft: !isContainerView()}" ng-cloak class="sidebar animated ng-hide">
        <ul role="navigation" ng-style="{ 'padding-top' : (isContainerView() &amp;&amp; currentContainer &amp;&amp; currentContainer.isDirty() ? 140 : 85) + 'px' }" class="sidebar-nav">
          <li ng-class="{'active': $state.includes('tags') || $state.includes('tagCreate') || $state.includes('tagEdit')}"><a id="sidebar-nav-links-tags" ui-sref="tags({containerId: activeContainerId})"><i class="icon-tag"></i><span translate="Tags"></span></a></li>
          <li ng-class="{'active': $state.includes('triggers') || $state.includes('triggerCreate') || $state.includes('triggerEdit')}"><a id="sidebar-nav-links-triggers" ui-sref="triggers({containerId: activeContainerId})"><i class="icon-trigger"></i><span translate="Triggers"></span></a></li>
          <li ng-class="{'active': $state.includes('variables') || $state.includes('variableCreate') || $state.includes('variableEdit')}"><a id="sidebar-nav-links-variables" ui-sref="variables({containerId: activeContainerId})"><i class="icon-variable"></i><span translate="Variables"></span></a></li>
          <li ng-class="{'active': $state.includes('debug')}"><a id="sidebar-nav-links-debug" ui-sref="debug({containerId: activeContainerId})"><i class="icon-debug"></i><span translate="Debug"></span></a></li>
          <li ng-class="{'active': $state.includes('containerEdit')}"><a id="sidebar-nav-links-options" ui-sref="containerEdit({containerId: activeContainerId})"><i class="icon-options"></i><span translate="Options"></span></a></li>
        </ul>
      </aside>
      <article id="wrapper-page" ng-class="{'content-with-sidebar': isContainerView()}" class="content">
        <cc-notification></cc-notification>
        <div class="container{{ isContainerView() ? '-fluid' : ''}}">
          <div ng-if="!security.isChecked()" class="loader text-center"><img src="app/images/loader.svg" class="loader-spinner"></div>
          <div ng-show="security.isChecked()" class="page-content col-lg-12{{ isContainerView() ? ' page-content-limited' : ''}}">
            <div ui-view></div>
          </div>
        </div>
      </article>
    </section>
    <div stg-set-version stg-version="1.3.3" ng-if="security.isAuthenticated()" class="stg-footer">
      <div ng-controller="clearcode.tm.update.VersionController as versionCtrl" class="container">
        <div ng-cloak class="row">
          <div class="col-md-6 col-md-offset-3 stg-standalone-text"><span translate="7tag version"></span> 1.3.3.<span ng-if="versionCtrl.updateAvailable()"> (<a ng-click="versionCtrl.startUpdate()" translate="a new version available"></a>)</span></div>
        </div>
      </div>
    </div>
    <!-- build:js vendor.js--><!-- vendors:js -->
    <script src="vendor.js"></script>
    <!-- endinject -->
    <!-- endbuild-->
    <?php $path = __DIR__.'/../../var/cache/OAuthClientSettings.php'; if(is_file($path)) { require_once $path; } ?>
    <!-- build:js scripts.js--><!-- inject:js -->
    <script src="/app.js"></script>
    <!-- endinject -->
    <!-- endbuild-->
    <?php $pathBottom = __DIR__.'/../../var/cache/seventagPluginsJavascriptBottom.php'; if(is_file($pathBottom)) { require_once $pathBottom; } ?>
  </body>
  <script type="text/ng-template" id="st-pagination.html">
    <div class="text-center">
      <div ng-show="params.settings().$loading" class="text-center"><img src="app/images/loader.svg" class="loader-spinner"></div>
    </div>
    <div ng-show="!params.settings().$loading &amp;&amp; params.total() &gt; 0" class="text-center">
      <ul ng-hide="params.count() &gt;= params.data.length &amp;&amp; (params.total()/params.count()) &lt;= 1" class="pagination">
        <li ng-class="{disabled: params.page() === 1}"><a id="pagination-first-button" href aria-label="First" ng-click="params.page() === 1 ? '' : params.page(1)"><<</a></li>
        <li ng-class="{disabled: params.page() === 1}"><a id="pagination-prev-button" href aria-label="Previous" ng-click="params.page() === 1 ? '' : params.page(params.page() - 1)">< {{'Prev'|translate}}</a></li>
        <li class="disabled"><a id="pagination-total-counter" href>{{params.total() ? (params.page() - 1) * params.count() + 1 : '0'}}-{{ params.page() * params.count() >= params.total() ? params.total() : params.page() * params.count() }} {{'of'|translate}} {{ params.total() }}</a></li>
        <li ng-class="{disabled: params.count() &gt; params.data.length ? true : (params.total()/params.count() | tmCeil) === params.page()}"><a id="pagination-next-button" href ng-click="params.count() &gt; params.data.length || (params.total()/params.count() | tmCeil) === params.page() ? '' : params.page(params.page() + 1)">{{'Next'|translate}} ></a></li>
        <li ng-class="{disabled: params.count() &gt; params.data.length ? true : (params.total()/params.count() | tmCeil) === params.page()}"><a id="pagination-last-button" href ng-click="params.count() &gt; params.data.length ? '' : params.page((params.total()/params.count() | tmCeil))">>></a></li>
      </ul>
    </div>
  </script>
  <script type="text/ng-template" id="st-header.html">
    <tr ng-if="$data.length &gt; 0">
      <th ng-repeat="column in $columns" ng-if="column.title() !== 'actions'" ng-class="{'sort-asc': tableParams.isSortBy(column.field, 'asc'), 'sort-desc': tableParams.isSortBy(column.field, 'desc')}" ng-click="tableParams.sorting(column.field, tableParams.isSortBy(column.field, 'asc') ? 'desc' : 'asc')" class="sortable">{{ column.title()|translate }}</th>
    </tr>
  </script>
  <script type="text/ng-template" id="container-list-st-header.html ">
    <tr ng-if="$data.length &gt; 0">
      <th class="sortable"><span translate="Name"></span></th>
      <th class="sortable"><span translate="Permissions"></span></th>
      <th class="sortable"><span translate="Container ID"></span>
        <cc-help placement="top" content="{{'Every container has a unique ID which is inserted into the snippet code.'|translate}}"></cc-help>
      </th>
    </tr>
  </script>
  <script type="text/ng-template" id="trigger-list-st-header.html ">
    <tr ng-if="$data.length &gt; 0">
      <th class="sortable"><span translate="Name"></span></th>
      <th class="sortable"><span translate="Type"></span>
        <cc-help placement="right" content="{{'A Trigger specifies how and when the tag should fire.'|translate}} {{'E.g. “Page view” should fire when a page loads according to the set conditions'|translate}}"></cc-help>
      </th>
      <th class="sortable"><span translate="Tags"></span>
        <cc-help placement="right" content="{{'The number of tags where the trigger is being used.'|translate}}"></cc-help>
      </th>
      <th class="sortable"><span translate="Last edit"></span></th>
    </tr>
  </script>
  <script type="text/ng-template" id="user-list-st-header.html ">
    <tr ng-if="$data.length &gt; 0">
      <th class="sortable"><span translate="User"></span></th>
      <th class="sortable"><span translate="Email"></span></th>
      <th class="sortable"><span translate="Role"></span></th>
      <th class="sortable"><span translate="Status"></span></th>
      <th class="sortable"><span translate="Create date"></span></th>
    </tr>
  </script>
  <script type="text/ng-template" id="variable-list-st-header.html">
    <tr ng-if="$data.length &gt; 0">
      <th class="sortable"><span translate="Name"></span></th>
      <th class="sortable"><span translate="Type"></span></th>
      <th class="sortable"><span translate="Last edit"></span></th>
    </tr>
  </script>
  <script type="text/ng-template" id="integration-list-st-header.html">
    <tr ng-if="$data.length &gt; 0">
      <th class="sortable"><span translate="Name"></span></th>
      <th class="sortable"><span translate="Created at"></span></th>
    </tr>
  </script>
  <script type="text/ng-template" id="permission-list-st-header.html ">
    <tr ng-if="$data.length &gt; 0">
      <th class="sortable"><span translate="User"></span></th>
      <th class="sortable"><span translate="No access"></span>
        <cc-help placement="top" content="{{'A user has no access to this container.'|translate}}&lt;br /&gt;"></cc-help>
      </th>
      <th class="sortable"><span translate="View"></span>
        <cc-help placement="top" content="{{'A user has an access to'|translate}}:&lt;br /&gt;{{'- view tags'|translate}}&lt;br /&gt;{{'- view triggers'|translate}}&lt;br /&gt;{{'- view container options'|translate}}&lt;br /&gt;{{'- open debug mode.'|translate}}"></cc-help>
      </th>
      <th class="sortable"><span translate="Edit"></span>
        <cc-help placement="top" content="{{'User can'|translate}}:&lt;br /&gt;{{'- edit tags'|translate}}&lt;br /&gt;{{'- edit triggers'|translate}}&lt;br /&gt;{{'- discard changes'|translate}}&lt;br /&gt;{{'- change container options (not users permissions)'|translate}}&lt;br /&gt;{{'- open debug mode.'|translate}}"></cc-help>
      </th>
      <th class="sortable"><span translate="Publish"></span>
        <cc-help placement="top" content="{{'User can'|translate}}:&lt;br /&gt;{{'- edit tags'|translate}}&lt;br /&gt;{{'- edit triggers'|translate}}&lt;br /&gt;{{'- discard changes'|translate}}&lt;br /&gt;{{'- change container options (with no setting permissions)'|translate}}&lt;br /&gt;{{'- open debug mode'|translate}}&lt;br /&gt;{{'- publish container'|translate}}"></cc-help>
      </th>
      <th class="sortable"><span translate="Owner"></span>
        <cc-help placement="right" content="{{'User can'|translate}}:&lt;br /&gt;{{'- edit tags'|translate}}&lt;br /&gt;{{'- edit triggers'|translate}}&lt;br /&gt;{{'- discard changes'|translate}}&lt;br /&gt;{{'- change container options'|translate}}&lt;br /&gt;{{'- set permissions'|translate}}&lt;br /&gt;{{'- open debug mode'|translate}}&lt;br /&gt;{{'- publish container.'|translate}}&lt;br /&gt;&lt;br /&gt;{{'Note that all application administrators has an owner role in all containers.'|translate}}"></cc-help>
      </th>
    </tr>
  </script>
  <script type="text/ng-template" id="select-template.html">
    <div dropdown on-toggle="toggled(open)" id="{{ id }}-dropdown" class="dropdown">
      <button dropdown-toggle aria-expanded="true" class="btn btn-select dropdown-toggle">{{ getActiveOptionLabel() }}<strong class="pull-right"><i class="icon-arrow-down"></i></strong></button>
      <ul role="menu" class="dropdown-menu">
        <li ng-repeat="element in ccSelectOptions" id="{{ id }}-{{ $index }}-options" ng-click="changeSelection(element)">{{ element[ccSelectLabel] }}</li>
      </ul>
    </div>
  </script>
  <script type="text/ng-template" id="variables-list.html">
    <div dropdown class="dropdown insert-variables">
      <ul role="menu" class="dropdown-menu">
        <li ng-repeat="variable in selectorCtrl.variables" id="{{ $index }}-options" ng-click="selectorCtrl.addVariable(variable)">{{ variable.name }}</li>
      </ul>
    </div>
  </script>
  <script type="text/ng-template" id="clipboard.html">
    <button clip-copy="copyToClipboard()" class="btn btn-copyToClipboard"><i class="icon-copy"></i><span translate="Copy code"></span></button>
  </script>
  <script>
      // Include the UserVoice JavaScript SDK (only needed once on a page)
      UserVoice=window.UserVoice || [];(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/HxQ9Wunt93Wg71K1vA.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})();
      //
      // UserVoice Javascript SDK developer documentation:
      // https://www.uservoice.com/o/javascript-sdk
      //
       // Set colors
      UserVoice.push(['set', {
          accent_color: '#2e9354',
          trigger_color: 'white',
          trigger_background_color: '#2e9354'
      }]);
       // Identify the user and pass traits
      // To enable, replace sample data with actual user traits and uncomment the line
      UserVoice.push(['identify', {
      //email:      'john.doe@example.com', // User’s email address
      //name:       'John Doe', // User’s real name
      //created_at: 1364406966, // Unix timestamp for the date the user signed up
      //id:         123, // Optional: Unique id of the user (if set, this should not change)
      //type:       'Owner', // Optional: segment your users by type
      //account: {
      //  id:           123, // Optional: associate multiple users with a single account
      //  name:         'Acme, Co.', // Account name
      //  created_at:   1364406966, // Unix timestamp for the date the account was created
      //  monthly_rate: 9.99, // Decimal; monthly rate of the account
      //  ltv:          1495.00, // Decimal; lifetime value of the account
      //  plan:         'Enhanced' // Plan name for the account
      //}
      }]);
       // Add default trigger to the bottom-right corner of the window:
      UserVoice.push(['addTrigger', {trigger_position: 'bottom-right' }]);
      // Or, use your own custom trigger:
      //UserVoice.push(['addTrigger', '#id']);
       // Autoprompt for Satisfaction and SmartVote (only displayed under certain conditions)
      UserVoice.push(['autoprompt', {}]);
  </script>
</html>