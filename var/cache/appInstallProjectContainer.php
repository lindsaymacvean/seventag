<?php
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
class appInstallProjectContainer extends Container
{
    private $parameters;
    private $targetDirs = array();
    public function __construct()
    {
        $dir = __DIR__;
        for ($i = 1; $i <= 4; ++$i) {
            $this->targetDirs[$i] = $dir = dirname($dir);
        }
        $this->parameters = $this->getDefaultParameters();
        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();
        $this->scopes = array('request' => 'container');
        $this->scopeChildren = array('request' => array());
        $this->methodMap = array(
            'annotation_reader' => 'getAnnotationReaderService',
            'assetic.asset_factory' => 'getAssetic_AssetFactoryService',
            'assetic.asset_manager' => 'getAssetic_AssetManagerService',
            'assetic.filter.cssrewrite' => 'getAssetic_Filter_CssrewriteService',
            'assetic.filter_manager' => 'getAssetic_FilterManagerService',
            'assets.context' => 'getAssets_ContextService',
            'assets.packages' => 'getAssets_PackagesService',
            'cache_clearer' => 'getCacheClearerService',
            'cache_warmer' => 'getCacheWarmerService',
            'controller_name_converter' => 'getControllerNameConverterService',
            'debug.debug_handlers_listener' => 'getDebug_DebugHandlersListenerService',
            'debug.stopwatch' => 'getDebug_StopwatchService',
            'doctrine' => 'getDoctrineService',
            'doctrine.dbal.connection_factory' => 'getDoctrine_Dbal_ConnectionFactoryService',
            'doctrine.dbal.default_connection' => 'getDoctrine_Dbal_DefaultConnectionService',
            'doctrine.orm.default_entity_listener_resolver' => 'getDoctrine_Orm_DefaultEntityListenerResolverService',
            'doctrine.orm.default_entity_manager' => 'getDoctrine_Orm_DefaultEntityManagerService',
            'doctrine.orm.default_manager_configurator' => 'getDoctrine_Orm_DefaultManagerConfiguratorService',
            'doctrine.orm.validator.unique' => 'getDoctrine_Orm_Validator_UniqueService',
            'doctrine.orm.validator_initializer' => 'getDoctrine_Orm_ValidatorInitializerService',
            'doctrine_cache.providers.doctrine.orm.default_metadata_cache' => 'getDoctrineCache_Providers_Doctrine_Orm_DefaultMetadataCacheService',
            'doctrine_cache.providers.doctrine.orm.default_query_cache' => 'getDoctrineCache_Providers_Doctrine_Orm_DefaultQueryCacheService',
            'doctrine_cache.providers.doctrine.orm.default_result_cache' => 'getDoctrineCache_Providers_Doctrine_Orm_DefaultResultCacheService',
            'event_dispatcher' => 'getEventDispatcherService',
            'file_locator' => 'getFileLocatorService',
            'filesystem' => 'getFilesystemService',
            'form.csrf_provider' => 'getForm_CsrfProviderService',
            'form.factory' => 'getForm_FactoryService',
            'form.registry' => 'getForm_RegistryService',
            'form.resolved_type_factory' => 'getForm_ResolvedTypeFactoryService',
            'form.type.birthday' => 'getForm_Type_BirthdayService',
            'form.type.button' => 'getForm_Type_ButtonService',
            'form.type.checkbox' => 'getForm_Type_CheckboxService',
            'form.type.choice' => 'getForm_Type_ChoiceService',
            'form.type.collection' => 'getForm_Type_CollectionService',
            'form.type.country' => 'getForm_Type_CountryService',
            'form.type.currency' => 'getForm_Type_CurrencyService',
            'form.type.date' => 'getForm_Type_DateService',
            'form.type.datetime' => 'getForm_Type_DatetimeService',
            'form.type.email' => 'getForm_Type_EmailService',
            'form.type.entity' => 'getForm_Type_EntityService',
            'form.type.file' => 'getForm_Type_FileService',
            'form.type.form' => 'getForm_Type_FormService',
            'form.type.hidden' => 'getForm_Type_HiddenService',
            'form.type.integer' => 'getForm_Type_IntegerService',
            'form.type.language' => 'getForm_Type_LanguageService',
            'form.type.locale' => 'getForm_Type_LocaleService',
            'form.type.money' => 'getForm_Type_MoneyService',
            'form.type.number' => 'getForm_Type_NumberService',
            'form.type.password' => 'getForm_Type_PasswordService',
            'form.type.percent' => 'getForm_Type_PercentService',
            'form.type.radio' => 'getForm_Type_RadioService',
            'form.type.repeated' => 'getForm_Type_RepeatedService',
            'form.type.reset' => 'getForm_Type_ResetService',
            'form.type.search' => 'getForm_Type_SearchService',
            'form.type.submit' => 'getForm_Type_SubmitService',
            'form.type.text' => 'getForm_Type_TextService',
            'form.type.textarea' => 'getForm_Type_TextareaService',
            'form.type.time' => 'getForm_Type_TimeService',
            'form.type.timezone' => 'getForm_Type_TimezoneService',
            'form.type.url' => 'getForm_Type_UrlService',
            'form.type_extension.csrf' => 'getForm_TypeExtension_CsrfService',
            'form.type_extension.form.http_foundation' => 'getForm_TypeExtension_Form_HttpFoundationService',
            'form.type_extension.form.validator' => 'getForm_TypeExtension_Form_ValidatorService',
            'form.type_extension.repeated.validator' => 'getForm_TypeExtension_Repeated_ValidatorService',
            'form.type_extension.submit.validator' => 'getForm_TypeExtension_Submit_ValidatorService',
            'form.type_guesser.doctrine' => 'getForm_TypeGuesser_DoctrineService',
            'form.type_guesser.validator' => 'getForm_TypeGuesser_ValidatorService',
            'fos_oauth_server.access_token_manager.default' => 'getFosOauthServer_AccessTokenManager_DefaultService',
            'fos_oauth_server.auth_code_manager.default' => 'getFosOauthServer_AuthCodeManager_DefaultService',
            'fos_oauth_server.authorize.form' => 'getFosOauthServer_Authorize_FormService',
            'fos_oauth_server.authorize.form.handler.default' => 'getFosOauthServer_Authorize_Form_Handler_DefaultService',
            'fos_oauth_server.authorize.form.type' => 'getFosOauthServer_Authorize_Form_TypeService',
            'fos_oauth_server.client_manager.default' => 'getFosOauthServer_ClientManager_DefaultService',
            'fos_oauth_server.controller.token' => 'getFosOauthServer_Controller_TokenService',
            'fos_oauth_server.entity_manager' => 'getFosOauthServer_EntityManagerService',
            'fos_oauth_server.refresh_token_manager.default' => 'getFosOauthServer_RefreshTokenManager_DefaultService',
            'fos_oauth_server.security.authentication.listener' => 'getFosOauthServer_Security_Authentication_ListenerService',
            'fos_oauth_server.security.entry_point' => 'getFosOauthServer_Security_EntryPointService',
            'fos_oauth_server.server' => 'getFosOauthServer_ServerService',
            'fos_oauth_server.storage' => 'getFosOauthServer_StorageService',
            'fos_rest.body_listener' => 'getFosRest_BodyListenerService',
            'fos_rest.converter.request_body' => 'getFosRest_Converter_RequestBodyService',
            'fos_rest.decoder.json' => 'getFosRest_Decoder_JsonService',
            'fos_rest.decoder.jsontoform' => 'getFosRest_Decoder_JsontoformService',
            'fos_rest.decoder.xml' => 'getFosRest_Decoder_XmlService',
            'fos_rest.decoder_provider' => 'getFosRest_DecoderProviderService',
            'fos_rest.exception_format_negotiator' => 'getFosRest_ExceptionFormatNegotiatorService',
            'fos_rest.format_negotiator' => 'getFosRest_FormatNegotiatorService',
            'fos_rest.inflector.doctrine' => 'getFosRest_Inflector_DoctrineService',
            'fos_rest.normalizer.camel_keys' => 'getFosRest_Normalizer_CamelKeysService',
            'fos_rest.param_fetcher_listener' => 'getFosRest_ParamFetcherListenerService',
            'fos_rest.request.param_fetcher' => 'getFosRest_Request_ParamFetcherService',
            'fos_rest.request.param_fetcher.reader' => 'getFosRest_Request_ParamFetcher_ReaderService',
            'fos_rest.routing.loader.controller' => 'getFosRest_Routing_Loader_ControllerService',
            'fos_rest.routing.loader.processor' => 'getFosRest_Routing_Loader_ProcessorService',
            'fos_rest.routing.loader.reader.action' => 'getFosRest_Routing_Loader_Reader_ActionService',
            'fos_rest.routing.loader.reader.controller' => 'getFosRest_Routing_Loader_Reader_ControllerService',
            'fos_rest.routing.loader.xml_collection' => 'getFosRest_Routing_Loader_XmlCollectionService',
            'fos_rest.routing.loader.yaml_collection' => 'getFosRest_Routing_Loader_YamlCollectionService',
            'fos_rest.serializer.exception_wrapper_serialize_handler' => 'getFosRest_Serializer_ExceptionWrapperSerializeHandlerService',
            'fos_rest.view.exception_wrapper_handler' => 'getFosRest_View_ExceptionWrapperHandlerService',
            'fos_rest.view_handler' => 'getFosRest_ViewHandlerService',
            'fos_rest.view_response_listener' => 'getFosRest_ViewResponseListenerService',
            'fos_rest.violation_formatter' => 'getFosRest_ViolationFormatterService',
            'fos_user.change_password.form.factory' => 'getFosUser_ChangePassword_Form_FactoryService',
            'fos_user.change_password.form.type' => 'getFosUser_ChangePassword_Form_TypeService',
            'fos_user.entity_manager' => 'getFosUser_EntityManagerService',
            'fos_user.group.form.factory' => 'getFosUser_Group_Form_FactoryService',
            'fos_user.group.form.type' => 'getFosUser_Group_Form_TypeService',
            'fos_user.group_manager' => 'getFosUser_GroupManagerService',
            'fos_user.listener.authentication' => 'getFosUser_Listener_AuthenticationService',
            'fos_user.listener.flash' => 'getFosUser_Listener_FlashService',
            'fos_user.listener.resetting' => 'getFosUser_Listener_ResettingService',
            'fos_user.profile.form.factory' => 'getFosUser_Profile_Form_FactoryService',
            'fos_user.profile.form.type' => 'getFosUser_Profile_Form_TypeService',
            'fos_user.registration.form.factory' => 'getFosUser_Registration_Form_FactoryService',
            'fos_user.registration.form.type' => 'getFosUser_Registration_Form_TypeService',
            'fos_user.resetting.form.factory' => 'getFosUser_Resetting_Form_FactoryService',
            'fos_user.resetting.form.type' => 'getFosUser_Resetting_Form_TypeService',
            'fos_user.security.interactive_login_listener' => 'getFosUser_Security_InteractiveLoginListenerService',
            'fos_user.security.login_manager' => 'getFosUser_Security_LoginManagerService',
            'fos_user.user_manager' => 'getFosUser_UserManagerService',
            'fos_user.username_form_type' => 'getFosUser_UsernameFormTypeService',
            'fos_user.util.email_canonicalizer' => 'getFosUser_Util_EmailCanonicalizerService',
            'fos_user.util.token_generator' => 'getFosUser_Util_TokenGeneratorService',
            'fos_user.util.user_manipulator' => 'getFosUser_Util_UserManipulatorService',
            'fragment.handler' => 'getFragment_HandlerService',
            'fragment.listener' => 'getFragment_ListenerService',
            'fragment.renderer.esi' => 'getFragment_Renderer_EsiService',
            'fragment.renderer.hinclude' => 'getFragment_Renderer_HincludeService',
            'fragment.renderer.inline' => 'getFragment_Renderer_InlineService',
            'fragment.renderer.ssi' => 'getFragment_Renderer_SsiService',
            'gaufrette.container_library' => 'getGaufrette_ContainerLibraryService',
            'gaufrette.container_library_mock' => 'getGaufrette_ContainerLibraryMockService',
            'http_kernel' => 'getHttpKernelService',
            'jms_serializer' => 'getJmsSerializerService',
            'jms_serializer.array_collection_handler' => 'getJmsSerializer_ArrayCollectionHandlerService',
            'jms_serializer.constraint_violation_handler' => 'getJmsSerializer_ConstraintViolationHandlerService',
            'jms_serializer.datetime_handler' => 'getJmsSerializer_DatetimeHandlerService',
            'jms_serializer.doctrine_proxy_subscriber' => 'getJmsSerializer_DoctrineProxySubscriberService',
            'jms_serializer.form_error_handler' => 'getJmsSerializer_FormErrorHandlerService',
            'jms_serializer.handler_registry' => 'getJmsSerializer_HandlerRegistryService',
            'jms_serializer.json_deserialization_visitor' => 'getJmsSerializer_JsonDeserializationVisitorService',
            'jms_serializer.json_serialization_visitor' => 'getJmsSerializer_JsonSerializationVisitorService',
            'jms_serializer.metadata_driver' => 'getJmsSerializer_MetadataDriverService',
            'jms_serializer.metadata_factory' => 'getJmsSerializer_MetadataFactoryService',
            'jms_serializer.naming_strategy' => 'getJmsSerializer_NamingStrategyService',
            'jms_serializer.object_constructor' => 'getJmsSerializer_ObjectConstructorService',
            'jms_serializer.php_collection_handler' => 'getJmsSerializer_PhpCollectionHandlerService',
            'jms_serializer.templating.helper.serializer' => 'getJmsSerializer_Templating_Helper_SerializerService',
            'jms_serializer.unserialize_object_constructor' => 'getJmsSerializer_UnserializeObjectConstructorService',
            'jms_serializer.xml_deserialization_visitor' => 'getJmsSerializer_XmlDeserializationVisitorService',
            'jms_serializer.xml_serialization_visitor' => 'getJmsSerializer_XmlSerializationVisitorService',
            'jms_serializer.yaml_serialization_visitor' => 'getJmsSerializer_YamlSerializationVisitorService',
            'kernel' => 'getKernelService',
            'knp_gaufrette.filesystem_map' => 'getKnpGaufrette_FilesystemMapService',
            'liip_monitor.helper.console_reporter' => 'getLiipMonitor_Helper_ConsoleReporterService',
            'liip_monitor.helper.raw_console_reporter' => 'getLiipMonitor_Helper_RawConsoleReporterService',
            'liip_monitor.helper.runner_manager' => 'getLiipMonitor_Helper_RunnerManagerService',
            'liip_monitor.runner_default' => 'getLiipMonitor_RunnerDefaultService',
            'locale_listener' => 'getLocaleListenerService',
            'logger' => 'getLoggerService',
            'monolog.logger.assetic' => 'getMonolog_Logger_AsseticService',
            'monolog.logger.doctrine' => 'getMonolog_Logger_DoctrineService',
            'monolog.logger.php' => 'getMonolog_Logger_PhpService',
            'monolog.logger.request' => 'getMonolog_Logger_RequestService',
            'monolog.logger.router' => 'getMonolog_Logger_RouterService',
            'monolog.logger.security' => 'getMonolog_Logger_SecurityService',
            'monolog.logger.translation' => 'getMonolog_Logger_TranslationService',
            'nelmio_api_doc.doc_comment_extractor' => 'getNelmioApiDoc_DocCommentExtractorService',
            'nelmio_api_doc.event_listener.request' => 'getNelmioApiDoc_EventListener_RequestService',
            'nelmio_api_doc.extractor.api_doc_extractor' => 'getNelmioApiDoc_Extractor_ApiDocExtractorService',
            'nelmio_api_doc.form.extension.description_form_type_extension' => 'getNelmioApiDoc_Form_Extension_DescriptionFormTypeExtensionService',
            'nelmio_api_doc.formatter.html_formatter' => 'getNelmioApiDoc_Formatter_HtmlFormatterService',
            'nelmio_api_doc.formatter.markdown_formatter' => 'getNelmioApiDoc_Formatter_MarkdownFormatterService',
            'nelmio_api_doc.formatter.simple_formatter' => 'getNelmioApiDoc_Formatter_SimpleFormatterService',
            'nelmio_api_doc.formatter.swagger_formatter' => 'getNelmioApiDoc_Formatter_SwaggerFormatterService',
            'nelmio_api_doc.parser.collection_parser' => 'getNelmioApiDoc_Parser_CollectionParserService',
            'nelmio_api_doc.parser.form_errors_parser' => 'getNelmioApiDoc_Parser_FormErrorsParserService',
            'nelmio_api_doc.parser.form_type_parser' => 'getNelmioApiDoc_Parser_FormTypeParserService',
            'nelmio_api_doc.parser.jms_metadata_parser' => 'getNelmioApiDoc_Parser_JmsMetadataParserService',
            'nelmio_api_doc.parser.json_serializable_parser' => 'getNelmioApiDoc_Parser_JsonSerializableParserService',
            'nelmio_api_doc.parser.validation_parser' => 'getNelmioApiDoc_Parser_ValidationParserService',
            'nelmio_api_doc.twig.extension.extra_markdown' => 'getNelmioApiDoc_Twig_Extension_ExtraMarkdownService',
            'property_accessor' => 'getPropertyAccessorService',
            'request' => 'getRequestService',
            'request_stack' => 'getRequestStackService',
            'response_listener' => 'getResponseListenerService',
            'router' => 'getRouterService',
            'router.request_context' => 'getRouter_RequestContextService',
            'router_listener' => 'getRouterListenerService',
            'routing.loader' => 'getRouting_LoaderService',
            'security.access.decision_manager' => 'getSecurity_Access_DecisionManagerService',
            'security.access_listener' => 'getSecurity_AccessListenerService',
            'security.access_map' => 'getSecurity_AccessMapService',
            'security.authentication.listener.fos_oauth_server.admin_tools' => 'getSecurity_Authentication_Listener_FosOauthServer_AdminToolsService',
            'security.authentication.listener.fos_oauth_server.api' => 'getSecurity_Authentication_Listener_FosOauthServer_ApiService',
            'security.authentication.manager' => 'getSecurity_Authentication_ManagerService',
            'security.authentication.trust_resolver' => 'getSecurity_Authentication_TrustResolverService',
            'security.authentication_utils' => 'getSecurity_AuthenticationUtilsService',
            'security.authorization_checker' => 'getSecurity_AuthorizationCheckerService',
            'security.channel_listener' => 'getSecurity_ChannelListenerService',
            'security.context' => 'getSecurity_ContextService',
            'security.csrf.token_manager' => 'getSecurity_Csrf_TokenManagerService',
            'security.encoder_factory' => 'getSecurity_EncoderFactoryService',
            'security.firewall' => 'getSecurity_FirewallService',
            'security.firewall.map.context.admin_tools' => 'getSecurity_Firewall_Map_Context_AdminToolsService',
            'security.firewall.map.context.api' => 'getSecurity_Firewall_Map_Context_ApiService',
            'security.firewall.map.context.dev' => 'getSecurity_Firewall_Map_Context_DevService',
            'security.firewall.map.context.oauth_token' => 'getSecurity_Firewall_Map_Context_OauthTokenService',
            'security.http_utils' => 'getSecurity_HttpUtilsService',
            'security.logout_url_generator' => 'getSecurity_LogoutUrlGeneratorService',
            'security.password_encoder' => 'getSecurity_PasswordEncoderService',
            'security.rememberme.response_listener' => 'getSecurity_Rememberme_ResponseListenerService',
            'security.role_hierarchy' => 'getSecurity_RoleHierarchyService',
            'security.secure_random' => 'getSecurity_SecureRandomService',
            'security.token_storage' => 'getSecurity_TokenStorageService',
            'security.user_checker' => 'getSecurity_UserCheckerService',
            'security.validator.user_password' => 'getSecurity_Validator_UserPasswordService',
            'sensio_framework_extra.cache.listener' => 'getSensioFrameworkExtra_Cache_ListenerService',
            'sensio_framework_extra.controller.listener' => 'getSensioFrameworkExtra_Controller_ListenerService',
            'sensio_framework_extra.converter.datetime' => 'getSensioFrameworkExtra_Converter_DatetimeService',
            'sensio_framework_extra.converter.doctrine.orm' => 'getSensioFrameworkExtra_Converter_Doctrine_OrmService',
            'sensio_framework_extra.converter.listener' => 'getSensioFrameworkExtra_Converter_ListenerService',
            'sensio_framework_extra.converter.manager' => 'getSensioFrameworkExtra_Converter_ManagerService',
            'sensio_framework_extra.security.listener' => 'getSensioFrameworkExtra_Security_ListenerService',
            'sensio_framework_extra.view.guesser' => 'getSensioFrameworkExtra_View_GuesserService',
            'service_container' => 'getServiceContainerService',
            'session' => 'getSessionService',
            'session.save_listener' => 'getSession_SaveListenerService',
            'session.storage.filesystem' => 'getSession_Storage_FilesystemService',
            'session.storage.metadata_bag' => 'getSession_Storage_MetadataBagService',
            'session.storage.native' => 'getSession_Storage_NativeService',
            'session.storage.php_bridge' => 'getSession_Storage_PhpBridgeService',
            'session_listener' => 'getSessionListenerService',
            'seven_tag.language.language_provider' => 'getSevenTag_Language_LanguageProviderService',
            'seven_tag.listener.allow_origin' => 'getSevenTag_Listener_AllowOriginService',
            'seven_tag.listener.condition_update_at_chain_listener' => 'getSevenTag_Listener_ConditionUpdateAtChainListenerService',
            'seven_tag.listener.trigger_strategy_resolver_listener' => 'getSevenTag_Listener_TriggerStrategyResolverListenerService',
            'seven_tag.locale.locale_finder' => 'getSevenTag_Locale_LocaleFinderService',
            'seven_tag.locale.locale_provider' => 'getSevenTag_Locale_LocaleProviderService',
            'seven_tag.locale_listener' => 'getSevenTag_LocaleListenerService',
            'seven_tag.manifest_containerjs_code_provider' => 'getSevenTag_ManifestContainerjsCodeProviderService',
            'seven_tag.manifest_registry' => 'getSevenTag_ManifestRegistryService',
            'seven_tag.repository.trigger_repository' => 'getSevenTag_Repository_TriggerRepositoryService',
            'seven_tag.trigger_type.click_type' => 'getSevenTag_TriggerType_ClickTypeService',
            'seven_tag.trigger_type.condition_preparator' => 'getSevenTag_TriggerType_ConditionPreparatorService',
            'seven_tag.trigger_type.event_type' => 'getSevenTag_TriggerType_EventTypeService',
            'seven_tag.trigger_type.form_submission_type' => 'getSevenTag_TriggerType_FormSubmissionTypeService',
            'seven_tag.trigger_type.holder' => 'getSevenTag_TriggerType_HolderService',
            'seven_tag.trigger_type.page_view_type' => 'getSevenTag_TriggerType_PageViewTypeService',
            'seven_tag.validator.trigger_strategy_validator' => 'getSevenTag_Validator_TriggerStrategyValidatorService',
            'seven_tag.validator.trigger_type_validator' => 'getSevenTag_Validator_TriggerTypeValidatorService',
            'seven_tag.warmer.assets_warmer' => 'getSevenTag_Warmer_AssetsWarmerService',
            'seven_tag_app.copy_manager' => 'getSevenTagApp_CopyManagerService',
            'seven_tag_app.deep_persister' => 'getSevenTagApp_DeepPersisterService',
            'seven_tag_app.version_manager' => 'getSevenTagApp_VersionManagerService',
            'seven_tag_app.version_manager_handler.publish_handler' => 'getSevenTagApp_VersionManagerHandler_PublishHandlerService',
            'seven_tag_app.version_manager_handler.restore_handler' => 'getSevenTagApp_VersionManagerHandler_RestoreHandlerService',
            'seven_tag_app.versionable.form.type.accessible' => 'getSevenTagApp_Versionable_Form_Type_AccessibleService',
            'seven_tag_app.versionable.subscriber.accessible_form' => 'getSevenTagApp_Versionable_Subscriber_AccessibleFormService',
            'seven_tag_app.versionable.subscriber.accessid_subscriber' => 'getSevenTagApp_Versionable_Subscriber_AccessidSubscriberService',
            'seven_tag_app.versionable.subscriber.versionid_subscriber' => 'getSevenTagApp_Versionable_Subscriber_VersionidSubscriberService',
            'seven_tag_app.versionable.vesionable_param_converter' => 'getSevenTagApp_Versionable_VesionableParamConverterService',
            'seven_tag_container.code_provider.cdn_url_generator' => 'getSevenTagContainer_CodeProvider_CdnUrlGeneratorService',
            'seven_tag_container.code_provider.snippet_provider' => 'getSevenTagContainer_CodeProvider_SnippetProviderService',
            'seven_tag_container.command.javascript_generator' => 'getSevenTagContainer_Command_JavascriptGeneratorService',
            'seven_tag_container.command.republish_container_command' => 'getSevenTagContainer_Command_RepublishContainerCommandService',
            'seven_tag_container.command.tagtree_generator' => 'getSevenTagContainer_Command_TagtreeGeneratorService',
            'seven_tag_container.container_library.generator' => 'getSevenTagContainer_ContainerLibrary_GeneratorService',
            'seven_tag_container.container_library.strategy.filesystem_strategy' => 'getSevenTagContainer_ContainerLibrary_Strategy_FilesystemStrategyService',
            'seven_tag_container.container_library.template_handler' => 'getSevenTagContainer_ContainerLibrary_TemplateHandlerService',
            'seven_tag_container.container_library.template_loader' => 'getSevenTagContainer_ContainerLibrary_TemplateLoaderService',
            'seven_tag_container.creator' => 'getSevenTagContainer_CreatorService',
            'seven_tag_container.form_type.container_form_type' => 'getSevenTagContainer_FormType_ContainerFormTypeService',
            'seven_tag_container.form_type.container_permissions_type' => 'getSevenTagContainer_FormType_ContainerPermissionsTypeService',
            'seven_tag_container.form_type.container_websites_type' => 'getSevenTagContainer_FormType_ContainerWebsitesTypeService',
            'seven_tag_container.form_type.website_type' => 'getSevenTagContainer_FormType_WebsiteTypeService',
            'seven_tag_container.listener.remove_container_permissons_listener' => 'getSevenTagContainer_Listener_RemoveContainerPermissonsListenerService',
            'seven_tag_container.mode_resolver' => 'getSevenTagContainer_ModeResolverService',
            'seven_tag_container.no_script.consumer.no_script_consumer' => 'getSevenTagContainer_NoScript_Consumer_NoScriptConsumerService',
            'seven_tag_container.no_script.consumer.request_consumer' => 'getSevenTagContainer_NoScript_Consumer_RequestConsumerService',
            'seven_tag_container.no_script.factory.guzzle' => 'getSevenTagContainer_NoScript_Factory_GuzzleService',
            'seven_tag_container.no_script.handler.no_script_handler' => 'getSevenTagContainer_NoScript_Handler_NoScriptHandlerService',
            'seven_tag_container.no_script.request.guzzle' => 'getSevenTagContainer_NoScript_Request_GuzzleService',
            'seven_tag_container.privacy.code_provider.snippet' => 'getSevenTagContainer_Privacy_CodeProvider_SnippetService',
            'seven_tag_container.privacy.form_type.optout_type' => 'getSevenTagContainer_Privacy_FormType_OptoutTypeService',
            'seven_tag_container.repository.container_permissions_repository' => 'getSevenTagContainer_Repository_ContainerPermissionsRepositoryService',
            'seven_tag_container.repository.container_repository' => 'getSevenTagContainer_Repository_ContainerRepositoryService',
            'seven_tag_container.serializer.code_subscriber' => 'getSevenTagContainer_Serializer_CodeSubscriberService',
            'seven_tag_container.service.previewmode_converter' => 'getSevenTagContainer_Service_PreviewmodeConverterService',
            'seven_tag_container.service.republish_container' => 'getSevenTagContainer_Service_RepublishContainerService',
            'seven_tag_container.subscriber.storage_javascript_in_filesystem_subscriber' => 'getSevenTagContainer_Subscriber_StorageJavascriptInFilesystemSubscriberService',
            'seven_tag_container.subscriber.storage_tagtree_in_filesystem_subscriber' => 'getSevenTagContainer_Subscriber_StorageTagtreeInFilesystemSubscriberService',
            'seven_tag_container.tag_tree_builder' => 'getSevenTagContainer_TagTreeBuilderService',
            'seven_tag_container.tag_tree_handler.conditions_handler' => 'getSevenTagContainer_TagTreeHandler_ConditionsHandlerService',
            'seven_tag_container.tag_tree_handler.container_handler' => 'getSevenTagContainer_TagTreeHandler_ContainerHandlerService',
            'seven_tag_container.tag_tree_handler.tags_handler' => 'getSevenTagContainer_TagTreeHandler_TagsHandlerService',
            'seven_tag_container.tag_tree_handler.triggers_handler' => 'getSevenTagContainer_TagTreeHandler_TriggersHandlerService',
            'seven_tag_container.validator.grant_permissions_user' => 'getSevenTagContainer_Validator_GrantPermissionsUserService',
            'seven_tag_plugin_click_tale_custom_template.form_type.click_tale' => 'getSevenTagPluginClickTaleCustomTemplate_FormType_ClickTaleService',
            'seven_tag_plugin_crazy_egg_custom_template.form_type.crazy_egg' => 'getSevenTagPluginCrazyEggCustomTemplate_FormType_CrazyEggService',
            'seven_tag_plugin_facebook_retargeting_pixel_custom_template.form_type.facebook_retargeting_pixel' => 'getSevenTagPluginFacebookRetargetingPixelCustomTemplate_FormType_FacebookRetargetingPixelService',
            'seven_tag_plugin_google_adwords_custom_template.form_type.google_adwords' => 'getSevenTagPluginGoogleAdwordsCustomTemplate_FormType_GoogleAdwordsService',
            'seven_tag_plugin_google_analytics_custom_template.form_type.google_analytics' => 'getSevenTagPluginGoogleAnalyticsCustomTemplate_FormType_GoogleAnalyticsService',
            'seven_tag_plugin_marketo_custom_template.form_type.marketo' => 'getSevenTagPluginMarketoCustomTemplate_FormType_MarketoService',
            'seven_tag_plugin_piwik_custom_template.form_type.piwik' => 'getSevenTagPluginPiwikCustomTemplate_FormType_PiwikService',
            'seven_tag_plugin_piwik_custom_template.form_type.track_event' => 'getSevenTagPluginPiwikCustomTemplate_FormType_TrackEventService',
            'seven_tag_plugin_piwik_custom_template.form_type.track_goal' => 'getSevenTagPluginPiwikCustomTemplate_FormType_TrackGoalService',
            'seven_tag_plugin_qualaroo_custom_template.form_type.qualaroo' => 'getSevenTagPluginQualarooCustomTemplate_FormType_QualarooService',
            'seven_tag_plugin_sales_manago_custom_template.form_type.sales_manago' => 'getSevenTagPluginSalesManagoCustomTemplate_FormType_SalesManagoService',
            'seven_tag_plugin_sentry.listener.sentry_asset_modify' => 'getSevenTagPluginSentry_Listener_SentryAssetModifyService',
            'seven_tag_plugin_sentry.provider.sentry' => 'getSevenTagPluginSentry_Provider_SentryService',
            'seven_tag_security.form_type.create_integration_form_type' => 'getSevenTagSecurity_FormType_CreateIntegrationFormTypeService',
            'seven_tag_security.form_type.edit_integration_form_type' => 'getSevenTagSecurity_FormType_EditIntegrationFormTypeService',
            'seven_tag_security.integration.integration_user_subscriber' => 'getSevenTagSecurity_Integration_IntegrationUserSubscriberService',
            'seven_tag_security.integration.user_manipulator' => 'getSevenTagSecurity_Integration_UserManipulatorService',
            'seven_tag_security.logout_handler.rest_logout' => 'getSevenTagSecurity_LogoutHandler_RestLogoutService',
            'seven_tag_security.oauth_server_exception_to_response_transformer' => 'getSevenTagSecurity_OauthServerExceptionToResponseTransformerService',
            'seven_tag_security.repository.access_token_repository' => 'getSevenTagSecurity_Repository_AccessTokenRepositoryService',
            'seven_tag_security.repository.integration_repository' => 'getSevenTagSecurity_Repository_IntegrationRepositoryService',
            'seven_tag_security.security.oauth_token_user_resolver' => 'getSevenTagSecurity_Security_OauthTokenUserResolverService',
            'seven_tag_security.serializer.admin_containers_permissions_subscriber' => 'getSevenTagSecurity_Serializer_AdminContainersPermissionsSubscriberService',
            'seven_tag_security.serializer.container_permissions_subscriber' => 'getSevenTagSecurity_Serializer_ContainerPermissionsSubscriberService',
            'seven_tag_security.serializer.non_admin_containers_permissions_subscriber' => 'getSevenTagSecurity_Serializer_NonAdminContainersPermissionsSubscriberService',
            'seven_tag_security.utils.bitmask_to_permissions_mapper' => 'getSevenTagSecurity_Utils_BitmaskToPermissionsMapperService',
            'seven_tag_security.utils.user_mask_resolver' => 'getSevenTagSecurity_Utils_UserMaskResolverService',
            'seven_tag_security.utils.user_permissions_map_provider' => 'getSevenTagSecurity_Utils_UserPermissionsMapProviderService',
            'seven_tag_security.warmer.oauth_client_settings_warmer' => 'getSevenTagSecurity_Warmer_OauthClientSettingsWarmerService',
            'seven_tag_tag.form_type.tag_form_type' => 'getSevenTagTag_FormType_TagFormTypeService',
            'seven_tag_tag.repository.tag_repository' => 'getSevenTagTag_Repository_TagRepositoryService',
            'seven_tag_tag.subscriber.tag_template_code_resolver_subscriber' => 'getSevenTagTag_Subscriber_TagTemplateCodeResolverSubscriberService',
            'seven_tag_tag.template_holder' => 'getSevenTagTag_TemplateHolderService',
            'seven_tag_tag.validator.tag_template_validator' => 'getSevenTagTag_Validator_TagTemplateValidatorService',
            'seven_tag_trigger.form_type.trigger_form_type' => 'getSevenTagTrigger_FormType_TriggerFormTypeService',
            'seven_tag_user.form_type.create_form_type' => 'getSevenTagUser_FormType_CreateFormTypeService',
            'seven_tag_user.form_type.edit_form_type' => 'getSevenTagUser_FormType_EditFormTypeService',
            'seven_tag_user.form_type.me_form_type' => 'getSevenTagUser_FormType_MeFormTypeService',
            'seven_tag_user.form_type.others_settings_form_type' => 'getSevenTagUser_FormType_OthersSettingsFormTypeService',
            'seven_tag_user.permissions_provider' => 'getSevenTagUser_PermissionsProviderService',
            'seven_tag_user.repository.user_repository' => 'getSevenTagUser_Repository_UserRepositoryService',
            'seven_tag_user.reset_password.request' => 'getSevenTagUser_ResetPassword_RequestService',
            'seven_tag_user.reset_password.token' => 'getSevenTagUser_ResetPassword_TokenService',
            'seven_tag_user.role_list_provider' => 'getSevenTagUser_RoleListProviderService',
            'seven_tag_user.user_manipulator' => 'getSevenTagUser_UserManipulatorService',
            'seven_tag_user.validator.roles_validator' => 'getSevenTagUser_Validator_RolesValidatorService',
            'seven_tag_variable.form_type.variable_form_type' => 'getSevenTagVariable_FormType_VariableFormTypeService',
            'seven_tag_variable.repository.variable_repository' => 'getSevenTagVariable_Repository_VariableRepositoryService',
            'seven_tag_variable.repository.variable_type_repository' => 'getSevenTagVariable_Repository_VariableTypeRepositoryService',
            'seven_tag_variable.variable_manager' => 'getSevenTagVariable_VariableManagerService',
            'seven_tag_variable.variable_provider' => 'getSevenTagVariable_VariableProviderService',
            'seven_tag_variable.variable_type_provider' => 'getSevenTagVariable_VariableTypeProviderService',
            'seventag.user.mailer.mailer' => 'getSeventag_User_Mailer_MailerService',
            'sonata.notification.backend.doctrine' => 'getSonata_Notification_Backend_DoctrineService',
            'sonata.notification.backend.heath_check' => 'getSonata_Notification_Backend_HeathCheckService',
            'sonata.notification.backend.postpone' => 'getSonata_Notification_Backend_PostponeService',
            'sonata.notification.backend.runtime' => 'getSonata_Notification_Backend_RuntimeService',
            'sonata.notification.consumer.logger' => 'getSonata_Notification_Consumer_LoggerService',
            'sonata.notification.consumer.metadata' => 'getSonata_Notification_Consumer_MetadataService',
            'sonata.notification.consumer.swift_mailer' => 'getSonata_Notification_Consumer_SwiftMailerService',
            'sonata.notification.controller.api.message' => 'getSonata_Notification_Controller_Api_MessageService',
            'sonata.notification.dispatcher' => 'getSonata_Notification_DispatcherService',
            'sonata.notification.erroneous_messages_selector' => 'getSonata_Notification_ErroneousMessagesSelectorService',
            'sonata.notification.event.doctrine_backend_optimize' => 'getSonata_Notification_Event_DoctrineBackendOptimizeService',
            'sonata.notification.event.doctrine_optimize' => 'getSonata_Notification_Event_DoctrineOptimizeService',
            'sonata.notification.manager.message.default' => 'getSonata_Notification_Manager_Message_DefaultService',
            'stof_doctrine_extensions.uploadable.manager' => 'getStofDoctrineExtensions_Uploadable_ManagerService',
            'streamed_response_listener' => 'getStreamedResponseListenerService',
            'swiftmailer.email_sender.listener' => 'getSwiftmailer_EmailSender_ListenerService',
            'swiftmailer.mailer.default' => 'getSwiftmailer_Mailer_DefaultService',
            'swiftmailer.mailer.default.spool' => 'getSwiftmailer_Mailer_Default_SpoolService',
            'swiftmailer.mailer.default.transport' => 'getSwiftmailer_Mailer_Default_TransportService',
            'swiftmailer.mailer.default.transport.eventdispatcher' => 'getSwiftmailer_Mailer_Default_Transport_EventdispatcherService',
            'swiftmailer.mailer.default.transport.real' => 'getSwiftmailer_Mailer_Default_Transport_RealService',
            'symfony.finder' => 'getSymfony_FinderService',
            'templating' => 'getTemplatingService',
            'templating.filename_parser' => 'getTemplating_FilenameParserService',
            'templating.helper.assets' => 'getTemplating_Helper_AssetsService',
            'templating.helper.logout_url' => 'getTemplating_Helper_LogoutUrlService',
            'templating.helper.router' => 'getTemplating_Helper_RouterService',
            'templating.helper.security' => 'getTemplating_Helper_SecurityService',
            'templating.loader' => 'getTemplating_LoaderService',
            'templating.locator' => 'getTemplating_LocatorService',
            'templating.name_parser' => 'getTemplating_NameParserService',
            'translation.dumper.csv' => 'getTranslation_Dumper_CsvService',
            'translation.dumper.ini' => 'getTranslation_Dumper_IniService',
            'translation.dumper.json' => 'getTranslation_Dumper_JsonService',
            'translation.dumper.mo' => 'getTranslation_Dumper_MoService',
            'translation.dumper.php' => 'getTranslation_Dumper_PhpService',
            'translation.dumper.po' => 'getTranslation_Dumper_PoService',
            'translation.dumper.qt' => 'getTranslation_Dumper_QtService',
            'translation.dumper.res' => 'getTranslation_Dumper_ResService',
            'translation.dumper.xliff' => 'getTranslation_Dumper_XliffService',
            'translation.dumper.yml' => 'getTranslation_Dumper_YmlService',
            'translation.extractor' => 'getTranslation_ExtractorService',
            'translation.extractor.php' => 'getTranslation_Extractor_PhpService',
            'translation.loader' => 'getTranslation_LoaderService',
            'translation.loader.csv' => 'getTranslation_Loader_CsvService',
            'translation.loader.dat' => 'getTranslation_Loader_DatService',
            'translation.loader.ini' => 'getTranslation_Loader_IniService',
            'translation.loader.json' => 'getTranslation_Loader_JsonService',
            'translation.loader.mo' => 'getTranslation_Loader_MoService',
            'translation.loader.php' => 'getTranslation_Loader_PhpService',
            'translation.loader.po' => 'getTranslation_Loader_PoService',
            'translation.loader.qt' => 'getTranslation_Loader_QtService',
            'translation.loader.res' => 'getTranslation_Loader_ResService',
            'translation.loader.xliff' => 'getTranslation_Loader_XliffService',
            'translation.loader.yml' => 'getTranslation_Loader_YmlService',
            'translation.writer' => 'getTranslation_WriterService',
            'translator.default' => 'getTranslator_DefaultService',
            'translator_listener' => 'getTranslatorListenerService',
            'twig' => 'getTwigService',
            'twig.controller.exception' => 'getTwig_Controller_ExceptionService',
            'twig.controller.preview_error' => 'getTwig_Controller_PreviewErrorService',
            'twig.exception_listener' => 'getTwig_ExceptionListenerService',
            'twig.loader' => 'getTwig_LoaderService',
            'twig.profile' => 'getTwig_ProfileService',
            'twig.translation.extractor' => 'getTwig_Translation_ExtractorService',
            'uri_signer' => 'getUriSignerService',
            'validator' => 'getValidatorService',
            'validator.builder' => 'getValidator_BuilderService',
            'validator.email' => 'getValidator_EmailService',
            'validator.expression' => 'getValidator_ExpressionService',
        );
        $this->aliases = array(
            'console.command.seventag_api_containerbundle_command_javascriptgeneratorcommand' => 'seven_tag_container.command.javascript_generator',
            'console.command.seventag_api_containerbundle_command_republishcontainercommand' => 'seven_tag_container.command.republish_container_command',
            'console.command.seventag_api_containerbundle_command_tagtreegeneratorcommand' => 'seven_tag_container.command.tagtree_generator',
            'database_connection' => 'doctrine.dbal.default_connection',
            'doctrine.orm.default_metadata_cache' => 'doctrine_cache.providers.doctrine.orm.default_metadata_cache',
            'doctrine.orm.default_query_cache' => 'doctrine_cache.providers.doctrine.orm.default_query_cache',
            'doctrine.orm.default_result_cache' => 'doctrine_cache.providers.doctrine.orm.default_result_cache',
            'doctrine.orm.entity_manager' => 'doctrine.orm.default_entity_manager',
            'fos_oauth_server.access_token_manager' => 'fos_oauth_server.access_token_manager.default',
            'fos_oauth_server.auth_code_manager' => 'fos_oauth_server.auth_code_manager.default',
            'fos_oauth_server.authorize.form.handler' => 'fos_oauth_server.authorize.form.handler.default',
            'fos_oauth_server.client_manager' => 'fos_oauth_server.client_manager.default',
            'fos_oauth_server.refresh_token_manager' => 'fos_oauth_server.refresh_token_manager.default',
            'fos_rest.exception_handler' => 'fos_rest.view.exception_wrapper_handler',
            'fos_rest.inflector' => 'fos_rest.inflector.doctrine',
            'fos_rest.router' => 'router',
            'fos_rest.serializer' => 'jms_serializer',
            'fos_rest.templating' => 'templating',
            'fos_user.mailer' => 'seventag.user.mailer.mailer',
            'fos_user.util.username_canonicalizer' => 'fos_user.util.email_canonicalizer',
            'liip_monitor.runner' => 'liip_monitor.runner_default',
            'mailer' => 'swiftmailer.mailer.default',
            'serializer' => 'jms_serializer',
            'session.storage' => 'session.storage.native',
            'sonata.notification.backend' => 'sonata.notification.backend.runtime',
            'sonata.notification.manager.message' => 'sonata.notification.manager.message.default',
            'swiftmailer.mailer' => 'swiftmailer.mailer.default',
            'swiftmailer.spool' => 'swiftmailer.mailer.default.spool',
            'swiftmailer.transport' => 'swiftmailer.mailer.default.transport',
            'swiftmailer.transport.real' => 'swiftmailer.mailer.default.transport.real',
            'translator' => 'translator.default',
        );
    }
    public function compile()
    {
        throw new LogicException('You cannot compile a dumped frozen container.');
    }
    protected function getAnnotationReaderService()
    {
        return $this->services['annotation_reader'] = new \Doctrine\Common\Annotations\FileCacheReader(new \Doctrine\Common\Annotations\AnnotationReader(), (__DIR__.'/annotations'), false);
    }
    protected function getAssetic_AssetManagerService()
    {
        $this->services['assetic.asset_manager'] = $instance = new \Assetic\Factory\LazyAssetManager($this->get('assetic.asset_factory'), array('twig' => new \Assetic\Factory\Loader\CachedFormulaLoader(new \Assetic\Extension\Twig\TwigFormulaLoader($this->get('twig'), $this->get('monolog.logger.assetic', ContainerInterface::NULL_ON_INVALID_REFERENCE)), new \Assetic\Cache\ConfigCache((__DIR__.'/assetic/config')), false)));
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($this->get('templating.loader'), '', ($this->targetDirs[2].'/app/Resources/views'), '/\\.[^.]+\\.twig$/'), 'twig');
        return $instance;
    }
    protected function getAssetic_Filter_CssrewriteService()
    {
        return $this->services['assetic.filter.cssrewrite'] = new \Assetic\Filter\CssRewriteFilter();
    }
    protected function getAssetic_FilterManagerService()
    {
        return $this->services['assetic.filter_manager'] = new \Symfony\Bundle\AsseticBundle\FilterManager($this, array('cssrewrite' => 'assetic.filter.cssrewrite'));
    }
    protected function getAssets_ContextService()
    {
        return $this->services['assets.context'] = new \Symfony\Component\Asset\Context\RequestStackContext($this->get('request_stack'));
    }
    protected function getAssets_PackagesService()
    {
        return $this->services['assets.packages'] = new \Symfony\Component\Asset\Packages(new \Symfony\Component\Asset\PathPackage('', new \Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy(), $this->get('assets.context')), array());
    }
    protected function getCacheClearerService()
    {
        return $this->services['cache_clearer'] = new \Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer(array());
    }
    protected function getCacheWarmerService()
    {
        $a = $this->get('kernel');
        $b = $this->get('templating.filename_parser');
        $c = new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplateFinder($a, $b, ($this->targetDirs[2].'/app/Resources'));
        return $this->services['cache_warmer'] = new \Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate(array(0 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplatePathsCacheWarmer($c, $this->get('templating.locator')), 1 => new \Symfony\Bundle\AsseticBundle\CacheWarmer\AssetManagerCacheWarmer($this), 2 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TranslationsCacheWarmer($this->get('translator.default')), 3 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\RouterCacheWarmer($this->get('router')), 4 => new \Symfony\Bundle\TwigBundle\CacheWarmer\TemplateCacheCacheWarmer($this, $c), 5 => new \Symfony\Bridge\Doctrine\CacheWarmer\ProxyCacheWarmer($this->get('doctrine')), 6 => $this->get('seven_tag_security.warmer.oauth_client_settings_warmer'), 7 => $this->get('seven_tag.warmer.assets_warmer')));
    }
    protected function getDebug_DebugHandlersListenerService()
    {
        return $this->services['debug.debug_handlers_listener'] = new \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener(NULL, $this->get('monolog.logger.php', ContainerInterface::NULL_ON_INVALID_REFERENCE), 85, NULL, true, NULL);
    }
    protected function getDebug_StopwatchService()
    {
        return $this->services['debug.stopwatch'] = new \Symfony\Component\Stopwatch\Stopwatch();
    }
    protected function getDoctrineService()
    {
        return $this->services['doctrine'] = new \Doctrine\Bundle\DoctrineBundle\Registry($this, array('default' => 'doctrine.dbal.default_connection'), array('default' => 'doctrine.orm.default_entity_manager'), 'default', 'default');
    }
    protected function getDoctrine_Dbal_ConnectionFactoryService()
    {
        return $this->services['doctrine.dbal.connection_factory'] = new \Doctrine\Bundle\DoctrineBundle\ConnectionFactory(array('datetime' => array('class' => 'SevenTag\\Api\\AppBundle\\DBAL\\Types\\UTCDateTimeType', 'commented' => true), 'json' => array('class' => 'Sonata\\Doctrine\\Types\\JsonType', 'commented' => true)));
    }
    protected function getDoctrine_Dbal_DefaultConnectionService()
    {
        $a = new \Gedmo\Timestampable\TimestampableListener();
        $a->setAnnotationReader($this->get('annotation_reader'));
        $b = new \Symfony\Bridge\Doctrine\ContainerAwareEventManager($this);
        $b->addEventSubscriber($this->get('seven_tag_app.versionable.subscriber.accessid_subscriber'));
        $b->addEventSubscriber($a);
        $b->addEventSubscriber(new \FOS\UserBundle\Doctrine\Orm\UserListener($this));
        $b->addEventSubscriber($this->get('seven_tag_tag.subscriber.tag_template_code_resolver_subscriber'));
        $b->addEventSubscriber($this->get('seven_tag_app.versionable.subscriber.versionid_subscriber'));
        $b->addEventListener(array(0 => 'onFlush'), $this->get('seven_tag.listener.condition_update_at_chain_listener'));
        $b->addEventListener(array(0 => 'prePersist'), $this->get('seven_tag.listener.trigger_strategy_resolver_listener'));
        return $this->services['doctrine.dbal.default_connection'] = $this->get('doctrine.dbal.connection_factory')->createConnection(array('driver' => 'pdo_mysql', 'host' => 'localhost', 'port' => NULL, 'dbname' => 'seventag', 'user' => 'root', 'password' => NULL, 'charset' => 'UTF8', 'driverOptions' => array()), new \Doctrine\DBAL\Configuration(), $b, array());
    }
    protected function getDoctrine_Orm_DefaultEntityListenerResolverService()
    {
        return $this->services['doctrine.orm.default_entity_listener_resolver'] = new \Doctrine\ORM\Mapping\DefaultEntityListenerResolver();
    }
    protected function getDoctrine_Orm_DefaultEntityManagerService()
    {
        $a = new \Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver(array(($this->targetDirs[2].'/vendor/sonata-project/notification-bundle/Resources/config/doctrine') => 'Sonata\\NotificationBundle\\Entity', ($this->targetDirs[2].'/vendor/friendsofsymfony/oauth-server-bundle/FOS/OAuthServerBundle/Resources/config/doctrine') => 'FOS\\OAuthServerBundle\\Entity'));
        $a->setGlobalBasename('mapping');
        $b = new \Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver(array(($this->targetDirs[2].'/src/SevenTag/Api/ContainerBundle/Resources/config/doctrine') => 'SevenTag\\Api\\ContainerBundle\\Entity', ($this->targetDirs[2].'/src/SevenTag/Api/TagBundle/Resources/config/doctrine') => 'SevenTag\\Api\\TagBundle\\Entity', ($this->targetDirs[2].'/src/SevenTag/Api/UserBundle/Resources/config/doctrine') => 'SevenTag\\Api\\UserBundle\\Entity', ($this->targetDirs[2].'/src/SevenTag/Api/SecurityBundle/Resources/config/doctrine') => 'SevenTag\\Api\\SecurityBundle\\Entity', ($this->targetDirs[2].'/src/SevenTag/Api/TriggerBundle/Resources/config/doctrine') => 'SevenTag\\Api\\TriggerBundle\\Entity', ($this->targetDirs[2].'/src/SevenTag/Api/AppBundle/Resources/config/doctrine') => 'SevenTag\\Api\\AppBundle\\Entity', ($this->targetDirs[2].'/src/SevenTag/Api/VariableBundle/Resources/config/doctrine') => 'SevenTag\\Api\\VariableBundle\\Entity'));
        $b->setGlobalBasename('mapping');
        $c = new \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain();
        $c->addDriver($a, 'Sonata\\NotificationBundle\\Entity');
        $c->addDriver($a, 'FOS\\OAuthServerBundle\\Entity');
        $c->addDriver($b, 'SevenTag\\Api\\ContainerBundle\\Entity');
        $c->addDriver($b, 'SevenTag\\Api\\TagBundle\\Entity');
        $c->addDriver($b, 'SevenTag\\Api\\UserBundle\\Entity');
        $c->addDriver($b, 'SevenTag\\Api\\SecurityBundle\\Entity');
        $c->addDriver($b, 'SevenTag\\Api\\TriggerBundle\\Entity');
        $c->addDriver($b, 'SevenTag\\Api\\AppBundle\\Entity');
        $c->addDriver($b, 'SevenTag\\Api\\VariableBundle\\Entity');
        $c->addDriver(new \Doctrine\ORM\Mapping\Driver\XmlDriver(new \Doctrine\Common\Persistence\Mapping\Driver\SymfonyFileLocator(array(($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/config/doctrine-mapping') => 'FOS\\UserBundle\\Model'), '.orm.xml')), 'FOS\\UserBundle\\Model');
        $d = new \Doctrine\ORM\Configuration();
        $d->setEntityNamespaces(array('SonataNotificationBundle' => 'Sonata\\NotificationBundle\\Entity', 'FOSOAuthServerBundle' => 'FOS\\OAuthServerBundle\\Entity', 'SevenTagContainerBundle' => 'SevenTag\\Api\\ContainerBundle\\Entity', 'SevenTagTagBundle' => 'SevenTag\\Api\\TagBundle\\Entity', 'SevenTagUserBundle' => 'SevenTag\\Api\\UserBundle\\Entity', 'SevenTagSecurityBundle' => 'SevenTag\\Api\\SecurityBundle\\Entity', 'SevenTagTriggerBundle' => 'SevenTag\\Api\\TriggerBundle\\Entity', 'SevenTagAppBundle' => 'SevenTag\\Api\\AppBundle\\Entity', 'SevenTagVariableBundle' => 'SevenTag\\Api\\VariableBundle\\Entity'));
        $d->setMetadataCacheImpl($this->get('doctrine_cache.providers.doctrine.orm.default_metadata_cache'));
        $d->setQueryCacheImpl($this->get('doctrine_cache.providers.doctrine.orm.default_query_cache'));
        $d->setResultCacheImpl($this->get('doctrine_cache.providers.doctrine.orm.default_result_cache'));
        $d->setMetadataDriverImpl($c);
        $d->setProxyDir((__DIR__.'/doctrine/orm/Proxies'));
        $d->setProxyNamespace('Proxies');
        $d->setAutoGenerateProxyClasses(false);
        $d->setClassMetadataFactoryName('Doctrine\\ORM\\Mapping\\ClassMetadataFactory');
        $d->setDefaultRepositoryClassName('Doctrine\\ORM\\EntityRepository');
        $d->setNamingStrategy(new \Doctrine\ORM\Mapping\DefaultNamingStrategy());
        $d->setQuoteStrategy(new \Doctrine\ORM\Mapping\DefaultQuoteStrategy());
        $d->setEntityListenerResolver($this->get('doctrine.orm.default_entity_listener_resolver'));
        $this->services['doctrine.orm.default_entity_manager'] = $instance = \Doctrine\ORM\EntityManager::create($this->get('doctrine.dbal.default_connection'), $d);
        $this->get('doctrine.orm.default_manager_configurator')->configure($instance);
        return $instance;
    }
    protected function getDoctrine_Orm_DefaultManagerConfiguratorService()
    {
        return $this->services['doctrine.orm.default_manager_configurator'] = new \Doctrine\Bundle\DoctrineBundle\ManagerConfigurator(array(), array());
    }
    protected function getDoctrine_Orm_Validator_UniqueService()
    {
        return $this->services['doctrine.orm.validator.unique'] = new \Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator($this->get('doctrine'));
    }
    protected function getDoctrine_Orm_ValidatorInitializerService()
    {
        return $this->services['doctrine.orm.validator_initializer'] = new \Symfony\Bridge\Doctrine\Validator\DoctrineInitializer($this->get('doctrine'));
    }
    protected function getDoctrineCache_Providers_Doctrine_Orm_DefaultMetadataCacheService()
    {
        $this->services['doctrine_cache.providers.doctrine.orm.default_metadata_cache'] = $instance = new \Doctrine\Common\Cache\ArrayCache();
        $instance->setNamespace('sf2orm_default_47caadc6d37e7c81ef547210587f2158b362c473b5243313ff07599e9f1ff27b');
        return $instance;
    }
    protected function getDoctrineCache_Providers_Doctrine_Orm_DefaultQueryCacheService()
    {
        $this->services['doctrine_cache.providers.doctrine.orm.default_query_cache'] = $instance = new \Doctrine\Common\Cache\ArrayCache();
        $instance->setNamespace('sf2orm_default_47caadc6d37e7c81ef547210587f2158b362c473b5243313ff07599e9f1ff27b');
        return $instance;
    }
    protected function getDoctrineCache_Providers_Doctrine_Orm_DefaultResultCacheService()
    {
        $this->services['doctrine_cache.providers.doctrine.orm.default_result_cache'] = $instance = new \Doctrine\Common\Cache\ArrayCache();
        $instance->setNamespace('sf2orm_default_47caadc6d37e7c81ef547210587f2158b362c473b5243313ff07599e9f1ff27b');
        return $instance;
    }
    protected function getEventDispatcherService()
    {
        $this->services['event_dispatcher'] = $instance = new \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher($this);
        $instance->addListenerService('kernel.controller', array(0 => 'fos_rest.view_response_listener', 1 => 'onKernelController'), -10);
        $instance->addListenerService('kernel.view', array(0 => 'fos_rest.view_response_listener', 1 => 'onKernelView'), 100);
        $instance->addListenerService('kernel.request', array(0 => 'fos_rest.body_listener', 1 => 'onKernelRequest'), 10);
        $instance->addListenerService('kernel.controller', array(0 => 'fos_rest.param_fetcher_listener', 1 => 'onKernelController'), 5);
        $instance->addListenerService('kernel.request', array(0 => 'nelmio_api_doc.event_listener.request', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('kernel.terminate', array(0 => 'sonata.notification.backend.postpone', 1 => 'onEvent'), 0);
        $instance->addListenerService('sonata.notification.event.message_iterate_event', array(0 => 'sonata.notification.event.doctrine_optimize', 1 => 'iterate'), 0);
        $instance->addListenerService('seventag_container_library_event.container_removed', array(0 => 'seven_tag_container.listener.remove_container_permissons_listener', 1 => 'onRemoveContainer'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'seven_tag.listener.allow_origin', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('asset.event.scripts_warmed_up', array(0 => 'seven_tag_plugin_sentry.listener.sentry_asset_modify', 1 => 'appendSentryTrackingCode'), 0);
        $instance->addSubscriberService('response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener');
        $instance->addSubscriberService('streamed_response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener');
        $instance->addSubscriberService('locale_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener');
        $instance->addSubscriberService('translator_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\TranslatorListener');
        $instance->addSubscriberService('session_listener', 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\SessionListener');
        $instance->addSubscriberService('session.save_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\SaveSessionListener');
        $instance->addSubscriberService('fragment.listener', 'Symfony\\Component\\HttpKernel\\EventListener\\FragmentListener');
        $instance->addSubscriberService('router_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener');
        $instance->addSubscriberService('debug.debug_handlers_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\DebugHandlersListener');
        $instance->addSubscriberService('security.firewall', 'Symfony\\Component\\Security\\Http\\Firewall');
        $instance->addSubscriberService('security.rememberme.response_listener', 'Symfony\\Component\\Security\\Http\\RememberMe\\ResponseListener');
        $instance->addSubscriberService('twig.exception_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener');
        $instance->addSubscriberService('swiftmailer.email_sender.listener', 'Symfony\\Bundle\\SwiftmailerBundle\\EventListener\\EmailSenderListener');
        $instance->addSubscriberService('sensio_framework_extra.controller.listener', 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ControllerListener');
        $instance->addSubscriberService('sensio_framework_extra.converter.listener', 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ParamConverterListener');
        $instance->addSubscriberService('sensio_framework_extra.cache.listener', 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\HttpCacheListener');
        $instance->addSubscriberService('sensio_framework_extra.security.listener', 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\SecurityListener');
        $instance->addSubscriberService('fos_user.security.interactive_login_listener', 'FOS\\UserBundle\\EventListener\\LastLoginListener');
        $instance->addSubscriberService('fos_user.listener.authentication', 'FOS\\UserBundle\\EventListener\\AuthenticationListener');
        $instance->addSubscriberService('fos_user.listener.flash', 'FOS\\UserBundle\\EventListener\\FlashListener');
        $instance->addSubscriberService('fos_user.listener.resetting', 'FOS\\UserBundle\\EventListener\\ResettingListener');
        $instance->addSubscriberService('seven_tag_container.subscriber.storage_javascript_in_filesystem_subscriber', 'SevenTag\\Api\\ContainerBundle\\ContainerLibrary\\Subscriber\\StorageJavascriptInFilesystemSubscriber');
        $instance->addSubscriberService('seven_tag_container.subscriber.storage_tagtree_in_filesystem_subscriber', 'SevenTag\\Api\\ContainerBundle\\ContainerLibrary\\Subscriber\\StorageTagTreeInFilesystemSubscriber');
        $instance->addSubscriberService('seven_tag_security.integration.integration_user_subscriber', 'SevenTag\\Api\\SecurityBundle\\Integration\\Listener\\IntegrationSubscriber');
        $instance->addSubscriberService('seven_tag.locale_listener', 'SevenTag\\Api\\AppBundle\\EventListener\\LocaleListener');
        return $instance;
    }
    protected function getFileLocatorService()
    {
        return $this->services['file_locator'] = new \Symfony\Component\HttpKernel\Config\FileLocator($this->get('kernel'), ($this->targetDirs[2].'/app/Resources'));
    }
    protected function getFilesystemService()
    {
        return $this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem();
    }
    protected function getForm_CsrfProviderService()
    {
        return $this->services['form.csrf_provider'] = new \Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfTokenManagerAdapter($this->get('security.csrf.token_manager'));
    }
    protected function getForm_FactoryService()
    {
        return $this->services['form.factory'] = new \Symfony\Component\Form\FormFactory($this->get('form.registry'), $this->get('form.resolved_type_factory'));
    }
    protected function getForm_RegistryService()
    {
        return $this->services['form.registry'] = new \Symfony\Component\Form\FormRegistry(array(0 => new \Symfony\Component\Form\Extension\DependencyInjection\DependencyInjectionExtension($this, array('form' => 'form.type.form', 'birthday' => 'form.type.birthday', 'checkbox' => 'form.type.checkbox', 'choice' => 'form.type.choice', 'collection' => 'form.type.collection', 'country' => 'form.type.country', 'date' => 'form.type.date', 'datetime' => 'form.type.datetime', 'email' => 'form.type.email', 'file' => 'form.type.file', 'hidden' => 'form.type.hidden', 'integer' => 'form.type.integer', 'language' => 'form.type.language', 'locale' => 'form.type.locale', 'money' => 'form.type.money', 'number' => 'form.type.number', 'password' => 'form.type.password', 'percent' => 'form.type.percent', 'radio' => 'form.type.radio', 'repeated' => 'form.type.repeated', 'search' => 'form.type.search', 'textarea' => 'form.type.textarea', 'text' => 'form.type.text', 'time' => 'form.type.time', 'timezone' => 'form.type.timezone', 'url' => 'form.type.url', 'button' => 'form.type.button', 'submit' => 'form.type.submit', 'reset' => 'form.type.reset', 'currency' => 'form.type.currency', 'entity' => 'form.type.entity', 'fos_user_username' => 'fos_user.username_form_type', 'fos_user_profile' => 'fos_user.profile.form.type', 'fos_user_registration' => 'fos_user.registration.form.type', 'fos_user_change_password' => 'fos_user.change_password.form.type', 'fos_user_resetting' => 'fos_user.resetting.form.type', 'fos_user_group' => 'fos_user.group.form.type', 'fos_oauth_server_authorize' => 'fos_oauth_server.authorize.form.type', 'seven_tag_container.form_type.container_form_type' => 'seven_tag_container.form_type.container_form_type', 'seventag_container_container_website_type' => 'seven_tag_container.form_type.container_websites_type', 'seventag_container_website_type' => 'seven_tag_container.form_type.website_type', 'seven_tag_container.form_type.container_permissions_type' => 'seven_tag_container.form_type.container_permissions_type', 'seven_tag_container.privacy.form_type.optout_type' => 'seven_tag_container.privacy.form_type.optout_type', 'seven_tag_tag.form_type.tag_form_type' => 'seven_tag_tag.form_type.tag_form_type', 'seven_tag_user.form_type.create_form_type' => 'seven_tag_user.form_type.create_form_type', 'seven_tag_user.form_type.edit_form_type' => 'seven_tag_user.form_type.edit_form_type', 'seven_tag_user.form_type.others_settings_form_type' => 'seven_tag_user.form_type.others_settings_form_type', 'seven_tag_user.form_type.me_form_type' => 'seven_tag_user.form_type.me_form_type', 'seven_tag_security.form_type.create_integration_form_type' => 'seven_tag_security.form_type.create_integration_form_type', 'seven_tag_security.form_type.edit_integration_form_type' => 'seven_tag_security.form_type.edit_integration_form_type', 'seven_tag_trigger.form_type.trigger_form_type' => 'seven_tag_trigger.form_type.trigger_form_type', 'accessible' => 'seven_tag_app.versionable.form.type.accessible', 'seven_tag_variable.form_type.variable_form_type' => 'seven_tag_variable.form_type.variable_form_type', 'piwik_template_form_type' => 'seven_tag_plugin_piwik_custom_template.form_type.piwik', 'piwik_track_event_form_type' => 'seven_tag_plugin_piwik_custom_template.form_type.track_event', 'piwik_track_goal_form_type' => 'seven_tag_plugin_piwik_custom_template.form_type.track_goal', 'click_tale_template_form_type' => 'seven_tag_plugin_click_tale_custom_template.form_type.click_tale', 'crazy_egg_template_form_type' => 'seven_tag_plugin_crazy_egg_custom_template.form_type.crazy_egg', 'facebook_retargeting_pixel_form_type' => 'seven_tag_plugin_facebook_retargeting_pixel_custom_template.form_type.facebook_retargeting_pixel', 'sales_manago_form_type' => 'seven_tag_plugin_sales_manago_custom_template.form_type.sales_manago', 'marketo_form_type' => 'seven_tag_plugin_marketo_custom_template.form_type.marketo', 'google_adwords_template_form_type' => 'seven_tag_plugin_google_adwords_custom_template.form_type.google_adwords', 'qualaroo_template_form_type' => 'seven_tag_plugin_qualaroo_custom_template.form_type.qualaroo', 'google_analytics_template_form_type' => 'seven_tag_plugin_google_analytics_custom_template.form_type.google_analytics'), array('form' => array(0 => 'form.type_extension.form.http_foundation', 1 => 'form.type_extension.form.validator', 2 => 'form.type_extension.csrf', 3 => 'nelmio_api_doc.form.extension.description_form_type_extension'), 'repeated' => array(0 => 'form.type_extension.repeated.validator'), 'submit' => array(0 => 'form.type_extension.submit.validator')), array(0 => 'form.type_guesser.validator', 1 => 'form.type_guesser.doctrine'))), $this->get('form.resolved_type_factory'));
    }
    protected function getForm_ResolvedTypeFactoryService()
    {
        return $this->services['form.resolved_type_factory'] = new \Symfony\Component\Form\ResolvedFormTypeFactory();
    }
    protected function getForm_Type_BirthdayService()
    {
        return $this->services['form.type.birthday'] = new \Symfony\Component\Form\Extension\Core\Type\BirthdayType();
    }
    protected function getForm_Type_ButtonService()
    {
        return $this->services['form.type.button'] = new \Symfony\Component\Form\Extension\Core\Type\ButtonType();
    }
    protected function getForm_Type_CheckboxService()
    {
        return $this->services['form.type.checkbox'] = new \Symfony\Component\Form\Extension\Core\Type\CheckboxType();
    }
    protected function getForm_Type_ChoiceService()
    {
        return $this->services['form.type.choice'] = new \Symfony\Component\Form\Extension\Core\Type\ChoiceType();
    }
    protected function getForm_Type_CollectionService()
    {
        return $this->services['form.type.collection'] = new \Symfony\Component\Form\Extension\Core\Type\CollectionType();
    }
    protected function getForm_Type_CountryService()
    {
        return $this->services['form.type.country'] = new \Symfony\Component\Form\Extension\Core\Type\CountryType();
    }
    protected function getForm_Type_CurrencyService()
    {
        return $this->services['form.type.currency'] = new \Symfony\Component\Form\Extension\Core\Type\CurrencyType();
    }
    protected function getForm_Type_DateService()
    {
        return $this->services['form.type.date'] = new \Symfony\Component\Form\Extension\Core\Type\DateType();
    }
    protected function getForm_Type_DatetimeService()
    {
        return $this->services['form.type.datetime'] = new \Symfony\Component\Form\Extension\Core\Type\DateTimeType();
    }
    protected function getForm_Type_EmailService()
    {
        return $this->services['form.type.email'] = new \Symfony\Component\Form\Extension\Core\Type\EmailType();
    }
    protected function getForm_Type_EntityService()
    {
        return $this->services['form.type.entity'] = new \Symfony\Bridge\Doctrine\Form\Type\EntityType($this->get('doctrine'));
    }
    protected function getForm_Type_FileService()
    {
        return $this->services['form.type.file'] = new \Symfony\Component\Form\Extension\Core\Type\FileType();
    }
    protected function getForm_Type_FormService()
    {
        return $this->services['form.type.form'] = new \Symfony\Component\Form\Extension\Core\Type\FormType($this->get('property_accessor'));
    }
    protected function getForm_Type_HiddenService()
    {
        return $this->services['form.type.hidden'] = new \Symfony\Component\Form\Extension\Core\Type\HiddenType();
    }
    protected function getForm_Type_IntegerService()
    {
        return $this->services['form.type.integer'] = new \Symfony\Component\Form\Extension\Core\Type\IntegerType();
    }
    protected function getForm_Type_LanguageService()
    {
        return $this->services['form.type.language'] = new \Symfony\Component\Form\Extension\Core\Type\LanguageType();
    }
    protected function getForm_Type_LocaleService()
    {
        return $this->services['form.type.locale'] = new \Symfony\Component\Form\Extension\Core\Type\LocaleType();
    }
    protected function getForm_Type_MoneyService()
    {
        return $this->services['form.type.money'] = new \Symfony\Component\Form\Extension\Core\Type\MoneyType();
    }
    protected function getForm_Type_NumberService()
    {
        return $this->services['form.type.number'] = new \Symfony\Component\Form\Extension\Core\Type\NumberType();
    }
    protected function getForm_Type_PasswordService()
    {
        return $this->services['form.type.password'] = new \Symfony\Component\Form\Extension\Core\Type\PasswordType();
    }
    protected function getForm_Type_PercentService()
    {
        return $this->services['form.type.percent'] = new \Symfony\Component\Form\Extension\Core\Type\PercentType();
    }
    protected function getForm_Type_RadioService()
    {
        return $this->services['form.type.radio'] = new \Symfony\Component\Form\Extension\Core\Type\RadioType();
    }
    protected function getForm_Type_RepeatedService()
    {
        return $this->services['form.type.repeated'] = new \Symfony\Component\Form\Extension\Core\Type\RepeatedType();
    }
    protected function getForm_Type_ResetService()
    {
        return $this->services['form.type.reset'] = new \Symfony\Component\Form\Extension\Core\Type\ResetType();
    }
    protected function getForm_Type_SearchService()
    {
        return $this->services['form.type.search'] = new \Symfony\Component\Form\Extension\Core\Type\SearchType();
    }
    protected function getForm_Type_SubmitService()
    {
        return $this->services['form.type.submit'] = new \Symfony\Component\Form\Extension\Core\Type\SubmitType();
    }
    protected function getForm_Type_TextService()
    {
        return $this->services['form.type.text'] = new \Symfony\Component\Form\Extension\Core\Type\TextType();
    }
    protected function getForm_Type_TextareaService()
    {
        return $this->services['form.type.textarea'] = new \Symfony\Component\Form\Extension\Core\Type\TextareaType();
    }
    protected function getForm_Type_TimeService()
    {
        return $this->services['form.type.time'] = new \Symfony\Component\Form\Extension\Core\Type\TimeType();
    }
    protected function getForm_Type_TimezoneService()
    {
        return $this->services['form.type.timezone'] = new \Symfony\Component\Form\Extension\Core\Type\TimezoneType();
    }
    protected function getForm_Type_UrlService()
    {
        return $this->services['form.type.url'] = new \Symfony\Component\Form\Extension\Core\Type\UrlType();
    }
    protected function getForm_TypeExtension_CsrfService()
    {
        return $this->services['form.type_extension.csrf'] = new \Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension($this->get('security.csrf.token_manager'), true, '_token', $this->get('translator.default'), 'validators');
    }
    protected function getForm_TypeExtension_Form_HttpFoundationService()
    {
        return $this->services['form.type_extension.form.http_foundation'] = new \Symfony\Component\Form\Extension\HttpFoundation\Type\FormTypeHttpFoundationExtension(new \Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationRequestHandler(new \Symfony\Component\Form\Util\ServerParams($this->get('request_stack'))));
    }
    protected function getForm_TypeExtension_Form_ValidatorService()
    {
        return $this->services['form.type_extension.form.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension($this->get('validator'));
    }
    protected function getForm_TypeExtension_Repeated_ValidatorService()
    {
        return $this->services['form.type_extension.repeated.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\RepeatedTypeValidatorExtension();
    }
    protected function getForm_TypeExtension_Submit_ValidatorService()
    {
        return $this->services['form.type_extension.submit.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\SubmitTypeValidatorExtension();
    }
    protected function getForm_TypeGuesser_DoctrineService()
    {
        return $this->services['form.type_guesser.doctrine'] = new \Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser($this->get('doctrine'));
    }
    protected function getForm_TypeGuesser_ValidatorService()
    {
        return $this->services['form.type_guesser.validator'] = new \Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser($this->get('validator'));
    }
    protected function getFosOauthServer_AccessTokenManager_DefaultService()
    {
        return $this->services['fos_oauth_server.access_token_manager.default'] = new \FOS\OAuthServerBundle\Entity\AccessTokenManager($this->get('fos_oauth_server.entity_manager'), 'SevenTag\\Api\\SecurityBundle\\Entity\\AccessToken');
    }
    protected function getFosOauthServer_AuthCodeManager_DefaultService()
    {
        return $this->services['fos_oauth_server.auth_code_manager.default'] = new \FOS\OAuthServerBundle\Entity\AuthCodeManager($this->get('fos_oauth_server.entity_manager'), 'SevenTag\\Api\\SecurityBundle\\Entity\\AuthCode');
    }
    protected function getFosOauthServer_Authorize_FormService()
    {
        return $this->services['fos_oauth_server.authorize.form'] = $this->get('form.factory')->createNamed('fos_oauth_server_authorize_form', 'fos_oauth_server_authorize', NULL, array('validation_groups' => array(0 => 'Authorize', 1 => 'Default')));
    }
    protected function getFosOauthServer_Authorize_Form_Handler_DefaultService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_oauth_server.authorize.form.handler.default', 'request');
        }
        return $this->services['fos_oauth_server.authorize.form.handler.default'] = $this->scopedServices['request']['fos_oauth_server.authorize.form.handler.default'] = new \FOS\OAuthServerBundle\Form\Handler\AuthorizeFormHandler($this->get('fos_oauth_server.authorize.form'), $this->get('request'));
    }
    protected function getFosOauthServer_Authorize_Form_TypeService()
    {
        return $this->services['fos_oauth_server.authorize.form.type'] = new \FOS\OAuthServerBundle\Form\Type\AuthorizeFormType();
    }
    protected function getFosOauthServer_ClientManager_DefaultService()
    {
        return $this->services['fos_oauth_server.client_manager.default'] = new \FOS\OAuthServerBundle\Entity\ClientManager($this->get('fos_oauth_server.entity_manager'), 'SevenTag\\Api\\SecurityBundle\\Entity\\Client');
    }
    protected function getFosOauthServer_Controller_TokenService()
    {
        return $this->services['fos_oauth_server.controller.token'] = new \FOS\OAuthServerBundle\Controller\TokenController($this->get('fos_oauth_server.server'));
    }
    protected function getFosOauthServer_RefreshTokenManager_DefaultService()
    {
        return $this->services['fos_oauth_server.refresh_token_manager.default'] = new \FOS\OAuthServerBundle\Entity\RefreshTokenManager($this->get('fos_oauth_server.entity_manager'), 'SevenTag\\Api\\SecurityBundle\\Entity\\RefreshToken');
    }
    protected function getFosOauthServer_Security_Authentication_ListenerService()
    {
        return $this->services['fos_oauth_server.security.authentication.listener'] = new \SevenTag\Api\SecurityBundle\Security\Firewall\OAuthListener($this->get('security.context'), $this->get('security.authentication.manager'), $this->get('fos_oauth_server.server'), $this->get('seven_tag_security.security.oauth_token_user_resolver'));
    }
    protected function getFosOauthServer_ServerService()
    {
        return $this->services['fos_oauth_server.server'] = new \OAuth2\OAuth2($this->get('fos_oauth_server.storage'), array('supported_scopes' => 'user'));
    }
    protected function getFosOauthServer_StorageService()
    {
        $this->services['fos_oauth_server.storage'] = $instance = new \SevenTag\Api\SecurityBundle\OAuth\Storage\UserCheckerStorage($this->get('fos_oauth_server.client_manager.default'), $this->get('fos_oauth_server.access_token_manager.default'), $this->get('fos_oauth_server.refresh_token_manager.default'), $this->get('fos_oauth_server.auth_code_manager.default'), new \SevenTag\Api\UserBundle\Security\EmailProvider($this->get('fos_user.user_manager')), $this->get('security.encoder_factory'));
        $instance->setUserChecker($this->get('security.user_checker'));
        return $instance;
    }
    protected function getFosRest_BodyListenerService()
    {
        $this->services['fos_rest.body_listener'] = $instance = new \FOS\RestBundle\EventListener\BodyListener($this->get('fos_rest.decoder_provider'), false);
        $instance->setDefaultFormat(NULL);
        return $instance;
    }
    protected function getFosRest_Converter_RequestBodyService()
    {
        return $this->services['fos_rest.converter.request_body'] = new \FOS\RestBundle\Request\RequestBodyParamConverter($this->get('jms_serializer'), '', '', NULL, 'validationErrors');
    }
    protected function getFosRest_Decoder_JsonService()
    {
        return $this->services['fos_rest.decoder.json'] = new \FOS\RestBundle\Decoder\JsonDecoder();
    }
    protected function getFosRest_Decoder_JsontoformService()
    {
        return $this->services['fos_rest.decoder.jsontoform'] = new \FOS\RestBundle\Decoder\JsonToFormDecoder();
    }
    protected function getFosRest_Decoder_XmlService()
    {
        return $this->services['fos_rest.decoder.xml'] = new \FOS\RestBundle\Decoder\XmlDecoder();
    }
    protected function getFosRest_DecoderProviderService()
    {
        $this->services['fos_rest.decoder_provider'] = $instance = new \FOS\RestBundle\Decoder\ContainerDecoderProvider(array('json' => 'fos_rest.decoder.json'));
        $instance->setContainer($this);
        return $instance;
    }
    protected function getFosRest_ExceptionFormatNegotiatorService()
    {
        return $this->services['fos_rest.exception_format_negotiator'] = new \FOS\RestBundle\Util\FormatNegotiator();
    }
    protected function getFosRest_FormatNegotiatorService()
    {
        return $this->services['fos_rest.format_negotiator'] = new \FOS\RestBundle\Util\FormatNegotiator();
    }
    protected function getFosRest_Inflector_DoctrineService()
    {
        return $this->services['fos_rest.inflector.doctrine'] = new \FOS\RestBundle\Util\Inflector\DoctrineInflector();
    }
    protected function getFosRest_Normalizer_CamelKeysService()
    {
        return $this->services['fos_rest.normalizer.camel_keys'] = new \FOS\RestBundle\Normalizer\CamelKeysNormalizer();
    }
    protected function getFosRest_ParamFetcherListenerService()
    {
        return $this->services['fos_rest.param_fetcher_listener'] = new \FOS\RestBundle\EventListener\ParamFetcherListener($this, false);
    }
    protected function getFosRest_Request_ParamFetcherService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_rest.request.param_fetcher', 'request');
        }
        return $this->services['fos_rest.request.param_fetcher'] = $this->scopedServices['request']['fos_rest.request.param_fetcher'] = new \FOS\RestBundle\Request\ParamFetcher($this->get('fos_rest.request.param_fetcher.reader'), $this->get('request'), $this->get('fos_rest.violation_formatter'), $this->get('validator', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getFosRest_Request_ParamFetcher_ReaderService()
    {
        return $this->services['fos_rest.request.param_fetcher.reader'] = new \FOS\RestBundle\Request\ParamReader($this->get('annotation_reader'));
    }
    protected function getFosRest_Routing_Loader_ControllerService()
    {
        return $this->services['fos_rest.routing.loader.controller'] = new \FOS\RestBundle\Routing\Loader\RestRouteLoader($this, $this->get('file_locator'), $this->get('controller_name_converter'), $this->get('fos_rest.routing.loader.reader.controller'), 'json');
    }
    protected function getFosRest_Routing_Loader_ProcessorService()
    {
        return $this->services['fos_rest.routing.loader.processor'] = new \FOS\RestBundle\Routing\Loader\RestRouteProcessor();
    }
    protected function getFosRest_Routing_Loader_Reader_ActionService()
    {
        return $this->services['fos_rest.routing.loader.reader.action'] = new \FOS\RestBundle\Routing\Loader\Reader\RestActionReader($this->get('annotation_reader'), $this->get('fos_rest.request.param_fetcher.reader'), $this->get('fos_rest.inflector.doctrine'), true, array('json' => false, 'html' => true));
    }
    protected function getFosRest_Routing_Loader_Reader_ControllerService()
    {
        return $this->services['fos_rest.routing.loader.reader.controller'] = new \FOS\RestBundle\Routing\Loader\Reader\RestControllerReader($this->get('fos_rest.routing.loader.reader.action'), $this->get('annotation_reader'));
    }
    protected function getFosRest_Routing_Loader_XmlCollectionService()
    {
        return $this->services['fos_rest.routing.loader.xml_collection'] = new \FOS\RestBundle\Routing\Loader\RestXmlCollectionLoader($this->get('file_locator'), $this->get('fos_rest.routing.loader.processor'), true, array('json' => false, 'html' => true), 'json');
    }
    protected function getFosRest_Routing_Loader_YamlCollectionService()
    {
        return $this->services['fos_rest.routing.loader.yaml_collection'] = new \FOS\RestBundle\Routing\Loader\RestYamlCollectionLoader($this->get('file_locator'), $this->get('fos_rest.routing.loader.processor'), true, array('json' => false, 'html' => true), 'json');
    }
    protected function getFosRest_Serializer_ExceptionWrapperSerializeHandlerService()
    {
        return $this->services['fos_rest.serializer.exception_wrapper_serialize_handler'] = new \FOS\RestBundle\Serializer\ExceptionWrapperSerializeHandler();
    }
    protected function getFosRest_View_ExceptionWrapperHandlerService()
    {
        return $this->services['fos_rest.view.exception_wrapper_handler'] = new \FOS\RestBundle\View\ExceptionWrapperHandler();
    }
    protected function getFosRest_ViewHandlerService()
    {
        $this->services['fos_rest.view_handler'] = $instance = new \FOS\RestBundle\View\ViewHandler(array('json' => false, 'html' => true), 400, 204, false, array('html' => 302), 'twig');
        $instance->setExclusionStrategyGroups('');
        $instance->setExclusionStrategyVersion('');
        $instance->setSerializeNullStrategy(true);
        $instance->setContainer($this);
        return $instance;
    }
    protected function getFosRest_ViewResponseListenerService()
    {
        return $this->services['fos_rest.view_response_listener'] = new \FOS\RestBundle\EventListener\ViewResponseListener($this);
    }
    protected function getFosRest_ViolationFormatterService()
    {
        return $this->services['fos_rest.violation_formatter'] = new \FOS\RestBundle\Util\ViolationFormatter();
    }
    protected function getFosUser_ChangePassword_Form_FactoryService()
    {
        return $this->services['fos_user.change_password.form.factory'] = new \FOS\UserBundle\Form\Factory\FormFactory($this->get('form.factory'), 'fos_user_change_password_form', 'fos_user_change_password', array(0 => 'ChangePassword', 1 => 'Default'));
    }
    protected function getFosUser_ChangePassword_Form_TypeService()
    {
        return $this->services['fos_user.change_password.form.type'] = new \FOS\UserBundle\Form\Type\ChangePasswordFormType('SevenTag\\Api\\UserBundle\\Entity\\User');
    }
    protected function getFosUser_Group_Form_FactoryService()
    {
        return $this->services['fos_user.group.form.factory'] = new \FOS\UserBundle\Form\Factory\FormFactory($this->get('form.factory'), 'fos_user_group_form', 'fos_user_group', array(0 => 'Registration', 1 => 'Default'));
    }
    protected function getFosUser_Group_Form_TypeService()
    {
        return $this->services['fos_user.group.form.type'] = new \FOS\UserBundle\Form\Type\GroupFormType('SevenTag\\Api\\UserBundle\\Entity\\Group');
    }
    protected function getFosUser_GroupManagerService()
    {
        return $this->services['fos_user.group_manager'] = new \FOS\UserBundle\Doctrine\GroupManager($this->get('fos_user.entity_manager'), 'SevenTag\\Api\\UserBundle\\Entity\\Group');
    }
    protected function getFosUser_Listener_AuthenticationService()
    {
        return $this->services['fos_user.listener.authentication'] = new \FOS\UserBundle\EventListener\AuthenticationListener($this->get('fos_user.security.login_manager'), 'api');
    }
    protected function getFosUser_Listener_FlashService()
    {
        return $this->services['fos_user.listener.flash'] = new \FOS\UserBundle\EventListener\FlashListener($this->get('session'), $this->get('translator.default'));
    }
    protected function getFosUser_Listener_ResettingService()
    {
        return $this->services['fos_user.listener.resetting'] = new \FOS\UserBundle\EventListener\ResettingListener($this->get('router'), 86400);
    }
    protected function getFosUser_Profile_Form_FactoryService()
    {
        return $this->services['fos_user.profile.form.factory'] = new \FOS\UserBundle\Form\Factory\FormFactory($this->get('form.factory'), 'fos_user_profile_form', 'fos_user_profile', array(0 => 'Profile', 1 => 'Default'));
    }
    protected function getFosUser_Profile_Form_TypeService()
    {
        return $this->services['fos_user.profile.form.type'] = new \FOS\UserBundle\Form\Type\ProfileFormType('SevenTag\\Api\\UserBundle\\Entity\\User');
    }
    protected function getFosUser_Registration_Form_FactoryService()
    {
        return $this->services['fos_user.registration.form.factory'] = new \FOS\UserBundle\Form\Factory\FormFactory($this->get('form.factory'), 'fos_user_registration_form', 'fos_user_registration', array(0 => 'Registration', 1 => 'Default'));
    }
    protected function getFosUser_Registration_Form_TypeService()
    {
        return $this->services['fos_user.registration.form.type'] = new \FOS\UserBundle\Form\Type\RegistrationFormType('SevenTag\\Api\\UserBundle\\Entity\\User');
    }
    protected function getFosUser_Resetting_Form_FactoryService()
    {
        return $this->services['fos_user.resetting.form.factory'] = new \FOS\UserBundle\Form\Factory\FormFactory($this->get('form.factory'), 'fos_user_resetting_form', 'fos_user_resetting', array(0 => 'ResetPassword', 1 => 'Default'));
    }
    protected function getFosUser_Resetting_Form_TypeService()
    {
        return $this->services['fos_user.resetting.form.type'] = new \FOS\UserBundle\Form\Type\ResettingFormType('SevenTag\\Api\\UserBundle\\Entity\\User');
    }
    protected function getFosUser_Security_InteractiveLoginListenerService()
    {
        return $this->services['fos_user.security.interactive_login_listener'] = new \FOS\UserBundle\EventListener\LastLoginListener($this->get('fos_user.user_manager'));
    }
    protected function getFosUser_Security_LoginManagerService()
    {
        return $this->services['fos_user.security.login_manager'] = new \FOS\UserBundle\Security\LoginManager($this->get('security.token_storage'), $this->get('security.user_checker'), new \Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy('migrate'), $this);
    }
    protected function getFosUser_UserManagerService()
    {
        $a = $this->get('fos_user.util.email_canonicalizer');
        return $this->services['fos_user.user_manager'] = new \FOS\UserBundle\Doctrine\UserManager($this->get('security.encoder_factory'), $a, $a, $this->get('fos_user.entity_manager'), 'SevenTag\\Api\\UserBundle\\Entity\\User');
    }
    protected function getFosUser_UsernameFormTypeService()
    {
        return $this->services['fos_user.username_form_type'] = new \FOS\UserBundle\Form\Type\UsernameFormType(new \FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer($this->get('fos_user.user_manager')));
    }
    protected function getFosUser_Util_EmailCanonicalizerService()
    {
        return $this->services['fos_user.util.email_canonicalizer'] = new \FOS\UserBundle\Util\Canonicalizer();
    }
    protected function getFosUser_Util_TokenGeneratorService()
    {
        return $this->services['fos_user.util.token_generator'] = new \FOS\UserBundle\Util\TokenGenerator($this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getFosUser_Util_UserManipulatorService()
    {
        return $this->services['fos_user.util.user_manipulator'] = new \FOS\UserBundle\Util\UserManipulator($this->get('fos_user.user_manager'));
    }
    protected function getFragment_HandlerService()
    {
        $this->services['fragment.handler'] = $instance = new \Symfony\Component\HttpKernel\DependencyInjection\LazyLoadingFragmentHandler($this, false, $this->get('request_stack'));
        $instance->addRendererService('inline', 'fragment.renderer.inline');
        $instance->addRendererService('hinclude', 'fragment.renderer.hinclude');
        $instance->addRendererService('hinclude', 'fragment.renderer.hinclude');
        $instance->addRendererService('esi', 'fragment.renderer.esi');
        $instance->addRendererService('ssi', 'fragment.renderer.ssi');
        return $instance;
    }
    protected function getFragment_ListenerService()
    {
        return $this->services['fragment.listener'] = new \Symfony\Component\HttpKernel\EventListener\FragmentListener($this->get('uri_signer'), '/_fragment');
    }
    protected function getFragment_Renderer_EsiService()
    {
        $this->services['fragment.renderer.esi'] = $instance = new \Symfony\Component\HttpKernel\Fragment\EsiFragmentRenderer(NULL, $this->get('fragment.renderer.inline'), $this->get('uri_signer'));
        $instance->setFragmentPath('/_fragment');
        return $instance;
    }
    protected function getFragment_Renderer_HincludeService()
    {
        $this->services['fragment.renderer.hinclude'] = $instance = new \Symfony\Component\HttpKernel\Fragment\HIncludeFragmentRenderer($this->get('twig'), $this->get('uri_signer'), NULL);
        $instance->setFragmentPath('/_fragment');
        return $instance;
    }
    protected function getFragment_Renderer_InlineService()
    {
        $this->services['fragment.renderer.inline'] = $instance = new \Symfony\Component\HttpKernel\Fragment\InlineFragmentRenderer($this->get('http_kernel'), $this->get('event_dispatcher'));
        $instance->setFragmentPath('/_fragment');
        return $instance;
    }
    protected function getFragment_Renderer_SsiService()
    {
        $this->services['fragment.renderer.ssi'] = $instance = new \Symfony\Component\HttpKernel\Fragment\SsiFragmentRenderer(NULL, $this->get('fragment.renderer.inline'), $this->get('uri_signer'));
        $instance->setFragmentPath('/_fragment');
        return $instance;
    }
    protected function getGaufrette_ContainerLibraryService()
    {
        return $this->services['gaufrette.container_library'] = new \Gaufrette\Filesystem(new \Gaufrette\Adapter\Local(($this->targetDirs[2].'/app/../web/containers'), true));
    }
    protected function getGaufrette_ContainerLibraryMockService()
    {
        return $this->services['gaufrette.container_library_mock'] = new \Gaufrette\Filesystem(new \Gaufrette\Adapter\Local(($this->targetDirs[2].'/app/../tests'), true));
    }
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Component\HttpKernel\DependencyInjection\ContainerAwareHttpKernel($this->get('event_dispatcher'), $this, new \Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver($this, $this->get('controller_name_converter'), $this->get('monolog.logger.request', ContainerInterface::NULL_ON_INVALID_REFERENCE)), $this->get('request_stack'), false);
    }
    protected function getJmsSerializerService()
    {
        $a = new \JMS\Serializer\EventDispatcher\LazyEventDispatcher($this);
        $a->setListeners(array('serializer.pre_serialize' => array(0 => array(0 => array(0 => 'jms_serializer.doctrine_proxy_subscriber', 1 => 'onPreSerialize'), 1 => NULL, 2 => NULL), 1 => array(0 => array(0 => 'seven_tag_container.serializer.code_subscriber', 1 => 'addCodeToContainer'), 1 => NULL, 2 => NULL), 2 => array(0 => array(0 => 'seven_tag_security.serializer.admin_containers_permissions_subscriber', 1 => 'addPermissionsToContainers'), 1 => NULL, 2 => NULL), 3 => array(0 => array(0 => 'seven_tag_security.serializer.non_admin_containers_permissions_subscriber', 1 => 'addPermissionsToContainers'), 1 => NULL, 2 => NULL), 4 => array(0 => array(0 => 'seven_tag_security.serializer.container_permissions_subscriber', 1 => 'addPermissionsToContainer'), 1 => NULL, 2 => NULL))));
        return $this->services['jms_serializer'] = new \JMS\Serializer\Serializer($this->get('jms_serializer.metadata_factory'), $this->get('jms_serializer.handler_registry'), $this->get('jms_serializer.unserialize_object_constructor'), new \PhpCollection\Map(array('json' => $this->get('jms_serializer.json_serialization_visitor'), 'xml' => $this->get('jms_serializer.xml_serialization_visitor'), 'yml' => $this->get('jms_serializer.yaml_serialization_visitor'))), new \PhpCollection\Map(array('json' => $this->get('jms_serializer.json_deserialization_visitor'), 'xml' => $this->get('jms_serializer.xml_deserialization_visitor'))), $a);
    }
    protected function getJmsSerializer_ArrayCollectionHandlerService()
    {
        return $this->services['jms_serializer.array_collection_handler'] = new \JMS\Serializer\Handler\ArrayCollectionHandler();
    }
    protected function getJmsSerializer_ConstraintViolationHandlerService()
    {
        return $this->services['jms_serializer.constraint_violation_handler'] = new \JMS\Serializer\Handler\ConstraintViolationHandler();
    }
    protected function getJmsSerializer_DatetimeHandlerService()
    {
        return $this->services['jms_serializer.datetime_handler'] = new \SevenTag\Api\AppBundle\Serializer\Handler\DateHandler('Y-m-d\\TH:i:sO', 'Europe/London', true);
    }
    protected function getJmsSerializer_DoctrineProxySubscriberService()
    {
        return $this->services['jms_serializer.doctrine_proxy_subscriber'] = new \JMS\Serializer\EventDispatcher\Subscriber\DoctrineProxySubscriber();
    }
    protected function getJmsSerializer_FormErrorHandlerService()
    {
        return $this->services['jms_serializer.form_error_handler'] = new \SevenTag\Api\AppBundle\Serializer\Handler\FormErrorHandler($this->get('translator.default'));
    }
    protected function getJmsSerializer_HandlerRegistryService()
    {
        return $this->services['jms_serializer.handler_registry'] = new \JMS\Serializer\Handler\LazyHandlerRegistry($this, array(1 => array('FOS\\RestBundle\\Util\\ExceptionWrapper' => array('json' => array(0 => 'fos_rest.serializer.exception_wrapper_serialize_handler', 1 => 'serializeToJson'), 'xml' => array(0 => 'fos_rest.serializer.exception_wrapper_serialize_handler', 1 => 'serializeToXml')), 'DateTime' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime')), 'DateInterval' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval')), 'ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\Common\\Collections\\ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\ORM\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\ODM\\MongoDB\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\ODM\\PHPCR\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'PhpCollection\\Sequence' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence')), 'PhpCollection\\Map' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap')), 'Symfony\\Component\\Form\\Form' => array('xml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormToxml'), 'json' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormTojson')), 'Symfony\\Component\\Form\\FormError' => array('xml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormErrorToxml'), 'json' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormErrorTojson')), 'Symfony\\Component\\Validator\\ConstraintViolationList' => array('xml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListToxml'), 'json' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListTojson'), 'yml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListToyml')), 'Symfony\\Component\\Validator\\ConstraintViolation' => array('xml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationToxml'), 'json' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationTojson'), 'yml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationToyml'))), 2 => array('DateTime' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromjson'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromxml'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromyml')), 'ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\Common\\Collections\\ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\ORM\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\ODM\\MongoDB\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\ODM\\PHPCR\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'PhpCollection\\Sequence' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence')), 'PhpCollection\\Map' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap')))));
    }
    protected function getJmsSerializer_JsonDeserializationVisitorService()
    {
        return $this->services['jms_serializer.json_deserialization_visitor'] = new \JMS\Serializer\JsonDeserializationVisitor($this->get('jms_serializer.naming_strategy'), $this->get('jms_serializer.unserialize_object_constructor'));
    }
    protected function getJmsSerializer_JsonSerializationVisitorService()
    {
        $this->services['jms_serializer.json_serialization_visitor'] = $instance = new \JMS\Serializer\JsonSerializationVisitor($this->get('jms_serializer.naming_strategy'));
        $instance->setOptions(0);
        return $instance;
    }
    protected function getJmsSerializer_MetadataDriverService()
    {
        $a = new \Metadata\Driver\FileLocator(array('Symfony\\Bundle\\FrameworkBundle' => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/config/serializer'), 'Symfony\\Bundle\\SecurityBundle' => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Bundle/SecurityBundle/Resources/config/serializer'), 'Symfony\\Bundle\\TwigBundle' => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/config/serializer'), 'Symfony\\Bundle\\MonologBundle' => ($this->targetDirs[2].'/vendor/symfony/monolog-bundle/Resources/config/serializer'), 'Symfony\\Bundle\\SwiftmailerBundle' => ($this->targetDirs[2].'/vendor/symfony/swiftmailer-bundle/Resources/config/serializer'), 'Symfony\\Bundle\\AsseticBundle' => ($this->targetDirs[2].'/vendor/symfony/assetic-bundle/Resources/config/serializer'), 'Sensio\\Bundle\\FrameworkExtraBundle' => ($this->targetDirs[2].'/vendor/sensio/framework-extra-bundle/Resources/config/serializer'), 'Doctrine\\Bundle\\DoctrineBundle' => ($this->targetDirs[2].'/vendor/doctrine/doctrine-bundle/Resources/config/serializer'), 'Doctrine\\Bundle\\MigrationsBundle' => ($this->targetDirs[2].'/vendor/doctrine/doctrine-migrations-bundle/Doctrine/Bundle/MigrationsBundle/Resources/config/serializer'), 'FOS\\RestBundle' => ($this->targetDirs[2].'/vendor/friendsofsymfony/rest-bundle/FOS/RestBundle/Resources/config/serializer'), 'FOS\\UserBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/UserBundle/Resources/config/serializer/fos'), 'FOS\\OAuthServerBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/SecurityBundle/Resources/config/serializer/fos'), 'FOS\\HttpCacheBundle' => ($this->targetDirs[2].'/vendor/friendsofsymfony/http-cache-bundle/Resources/config/serializer'), 'Knp\\Bundle\\GaufretteBundle' => ($this->targetDirs[2].'/vendor/knplabs/knp-gaufrette-bundle/Knp/Bundle/GaufretteBundle/Resources/config/serializer'), 'JMS\\SerializerBundle' => ($this->targetDirs[2].'/vendor/jms/serializer-bundle/JMS/SerializerBundle/Resources/config/serializer'), 'Liip\\MonitorBundle' => ($this->targetDirs[2].'/vendor/liip/monitor-bundle/Resources/config/serializer'), 'Nelmio\\ApiDocBundle' => ($this->targetDirs[2].'/vendor/nelmio/api-doc-bundle/Nelmio/ApiDocBundle/Resources/config/serializer'), 'Stof\\DoctrineExtensionsBundle' => ($this->targetDirs[2].'/vendor/stof/doctrine-extensions-bundle/Stof/DoctrineExtensionsBundle/Resources/config/serializer'), 'Sonata\\NotificationBundle' => ($this->targetDirs[2].'/vendor/sonata-project/notification-bundle/Resources/config/serializer'), 'SevenTag\\Api\\ContainerBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/ContainerBundle/Resources/config/serializer'), 'SevenTag\\Api\\TagBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/TagBundle/Resources/config/serializer'), 'SevenTag\\Api\\TestBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/TestBundle/Resources/config/serializer'), 'SevenTag\\Api\\UserBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/UserBundle/Resources/config/serializer'), 'SevenTag\\Api\\SecurityBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/SecurityBundle/Resources/config/serializer'), 'SevenTag\\Api\\TriggerBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/TriggerBundle/Resources/config/serializer'), 'SevenTag\\Api\\AppBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/AppBundle/Resources/config/serializer'), 'SevenTag\\Api\\VariableBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/VariableBundle/Resources/config/serializer'), 'SevenTag\\Plugin\\PiwikCustomTemplateBundle' => ($this->targetDirs[2].'/src/SevenTag/Plugin/PiwikCustomTemplateBundle/Resources/config/serializer'), 'SevenTag\\Plugin\\ClickTaleCustomTemplateBundle' => ($this->targetDirs[2].'/src/SevenTag/Plugin/ClickTaleCustomTemplateBundle/Resources/config/serializer'), 'SevenTag\\Plugin\\CrazyEggCustomTemplateBundle' => ($this->targetDirs[2].'/src/SevenTag/Plugin/CrazyEggCustomTemplateBundle/Resources/config/serializer'), 'SevenTag\\Plugin\\SentryBundle' => ($this->targetDirs[2].'/src/SevenTag/Plugin/SentryBundle/Resources/config/serializer'), 'SevenTag\\Plugin\\FacebookRetargetingPixelCustomTemplateBundle' => ($this->targetDirs[2].'/src/SevenTag/Plugin/FacebookRetargetingPixelCustomTemplateBundle/Resources/config/serializer'), 'SevenTag\\Plugin\\SalesManagoCustomTemplateBundle' => ($this->targetDirs[2].'/src/SevenTag/Plugin/SalesManagoCustomTemplateBundle/Resources/config/serializer'), 'SevenTag\\Plugin\\MarketoCustomTemplateBundle' => ($this->targetDirs[2].'/src/SevenTag/Plugin/MarketoCustomTemplateBundle/Resources/config/serializer'), 'SevenTag\\Plugin\\GoogleAdwordsCustomTemplateBundle' => ($this->targetDirs[2].'/src/SevenTag/Plugin/GoogleAdwordsCustomTemplateBundle/Resources/config/serializer'), 'SevenTag\\Plugin\\QualarooCustomTemplateBundle' => ($this->targetDirs[2].'/src/SevenTag/Plugin/QualarooCustomTemplateBundle/Resources/config/serializer'), 'SevenTag\\Plugin\\GoogleAnalyticsCustomTemplateBundle' => ($this->targetDirs[2].'/src/SevenTag/Plugin/GoogleAnalyticsCustomTemplateBundle/Resources/config/serializer'), 'SevenTag\\InstallerBundle' => ($this->targetDirs[2].'/src/SevenTag/InstallerBundle/Resources/config/serializer'), 'SevenTag\\Component\\Container' => ($this->targetDirs[2].'/src/SevenTag/Api/ContainerBundle/Resources/config/serializer/component'), 'SevenTag\\Component\\Tag' => ($this->targetDirs[2].'/src/SevenTag/Api/TagBundle/Resources/config/serializer/component'), 'SevenTag\\Component\\Trigger' => ($this->targetDirs[2].'/src/SevenTag/Api/TriggerBundle/Resources/config/serializer'), 'SevenTag\\Component\\Variable' => ($this->targetDirs[2].'/src/SevenTag/Api/VariableBundle/Resources/config/serializer/component'), 'SevenTag\\Component\\Condition' => ($this->targetDirs[2].'/src/SevenTag/Api/TriggerBundle/Resources/config/serializer'), 'SevenTag\\AppBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/AppBundle/Resources/config/serializer'), 'SevenTag\\UserBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/UserBundle/Resources/config/serializer'), 'SevenTag\\ContainerBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/ContainerBundle/Resources/config/serializer'), 'SevenTag\\TagBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/TagBundle/Resources/config/serializer'), 'SevenTag\\SecurityBundle' => ($this->targetDirs[2].'/src/SevenTag/Api/SecurityBundle/Resources/config/serializer')));
        return $this->services['jms_serializer.metadata_driver'] = new \JMS\Serializer\Metadata\Driver\DoctrineTypeDriver(new \Metadata\Driver\DriverChain(array(0 => new \JMS\Serializer\Metadata\Driver\YamlDriver($a), 1 => new \JMS\Serializer\Metadata\Driver\XmlDriver($a), 2 => new \JMS\Serializer\Metadata\Driver\PhpDriver($a), 3 => new \JMS\Serializer\Metadata\Driver\AnnotationDriver($this->get('annotation_reader')))), $this->get('doctrine'));
    }
    protected function getJmsSerializer_NamingStrategyService()
    {
        return $this->services['jms_serializer.naming_strategy'] = new \JMS\Serializer\Naming\CacheNamingStrategy(new \JMS\Serializer\Naming\SerializedNameAnnotationStrategy(new \JMS\Serializer\Naming\CamelCaseNamingStrategy('_', true)));
    }
    protected function getJmsSerializer_ObjectConstructorService()
    {
        return $this->services['jms_serializer.object_constructor'] = new \JMS\Serializer\Construction\DoctrineObjectConstructor($this->get('doctrine'), $this->get('jms_serializer.unserialize_object_constructor'));
    }
    protected function getJmsSerializer_PhpCollectionHandlerService()
    {
        return $this->services['jms_serializer.php_collection_handler'] = new \JMS\Serializer\Handler\PhpCollectionHandler();
    }
    protected function getJmsSerializer_Templating_Helper_SerializerService()
    {
        return $this->services['jms_serializer.templating.helper.serializer'] = new \JMS\SerializerBundle\Templating\SerializerHelper($this->get('jms_serializer'));
    }
    protected function getJmsSerializer_XmlDeserializationVisitorService()
    {
        $this->services['jms_serializer.xml_deserialization_visitor'] = $instance = new \JMS\Serializer\XmlDeserializationVisitor($this->get('jms_serializer.naming_strategy'), $this->get('jms_serializer.unserialize_object_constructor'));
        $instance->setDoctypeWhitelist(array());
        return $instance;
    }
    protected function getJmsSerializer_XmlSerializationVisitorService()
    {
        return $this->services['jms_serializer.xml_serialization_visitor'] = new \JMS\Serializer\XmlSerializationVisitor($this->get('jms_serializer.naming_strategy'));
    }
    protected function getJmsSerializer_YamlSerializationVisitorService()
    {
        return $this->services['jms_serializer.yaml_serialization_visitor'] = new \JMS\Serializer\YamlSerializationVisitor($this->get('jms_serializer.naming_strategy'));
    }
    protected function getKernelService()
    {
        throw new RuntimeException('You have requested a synthetic service ("kernel"). The DIC does not know how to construct this service.');
    }
    protected function getKnpGaufrette_FilesystemMapService()
    {
        return $this->services['knp_gaufrette.filesystem_map'] = new \Knp\Bundle\GaufretteBundle\FilesystemMap(array('container_library' => $this->get('gaufrette.container_library'), 'container_library_mock' => $this->get('gaufrette.container_library_mock')));
    }
    protected function getLiipMonitor_Helper_ConsoleReporterService()
    {
        return $this->services['liip_monitor.helper.console_reporter'] = new \Liip\MonitorBundle\Helper\ConsoleReporter();
    }
    protected function getLiipMonitor_Helper_RawConsoleReporterService()
    {
        return $this->services['liip_monitor.helper.raw_console_reporter'] = new \Liip\MonitorBundle\Helper\RawConsoleReporter();
    }
    protected function getLiipMonitor_Helper_RunnerManagerService()
    {
        return $this->services['liip_monitor.helper.runner_manager'] = new \Liip\MonitorBundle\Helper\RunnerManager($this);
    }
    protected function getLiipMonitor_RunnerDefaultService()
    {
        $this->services['liip_monitor.runner_default'] = $instance = new \Liip\MonitorBundle\Runner();
        $instance->addCheck($this->get('sonata.notification.backend.heath_check'), 'sonata.notification.backend.heath_check');
        $instance->addCheck(new \ZendDiagnostics\Check\DirWritable(array(0 => __DIR__, 1 => ($this->targetDirs[1].'/logs'))), 'writable_directory');
        $instance->addCheck(new \Liip\MonitorBundle\Check\SymfonyRequirements(($this->targetDirs[2].'/app/../var/SymfonyRequirements.php')), 'symfony_requirements');
        return $instance;
    }
    protected function getLocaleListenerService()
    {
        return $this->services['locale_listener'] = new \Symfony\Component\HttpKernel\EventListener\LocaleListener('en', $this->get('router', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('request_stack'));
    }
    protected function getLoggerService()
    {
        return $this->services['logger'] = new \Symfony\Bridge\Monolog\Logger('app');
    }
    protected function getMonolog_Logger_AsseticService()
    {
        return $this->services['monolog.logger.assetic'] = new \Symfony\Bridge\Monolog\Logger('assetic');
    }
    protected function getMonolog_Logger_DoctrineService()
    {
        return $this->services['monolog.logger.doctrine'] = new \Symfony\Bridge\Monolog\Logger('doctrine');
    }
    protected function getMonolog_Logger_PhpService()
    {
        return $this->services['monolog.logger.php'] = new \Symfony\Bridge\Monolog\Logger('php');
    }
    protected function getMonolog_Logger_RequestService()
    {
        return $this->services['monolog.logger.request'] = new \Symfony\Bridge\Monolog\Logger('request');
    }
    protected function getMonolog_Logger_RouterService()
    {
        return $this->services['monolog.logger.router'] = new \Symfony\Bridge\Monolog\Logger('router');
    }
    protected function getMonolog_Logger_SecurityService()
    {
        return $this->services['monolog.logger.security'] = new \Symfony\Bridge\Monolog\Logger('security');
    }
    protected function getMonolog_Logger_TranslationService()
    {
        return $this->services['monolog.logger.translation'] = new \Symfony\Bridge\Monolog\Logger('translation');
    }
    protected function getNelmioApiDoc_DocCommentExtractorService()
    {
        return $this->services['nelmio_api_doc.doc_comment_extractor'] = new \Nelmio\ApiDocBundle\Util\DocCommentExtractor();
    }
    protected function getNelmioApiDoc_EventListener_RequestService()
    {
        return $this->services['nelmio_api_doc.event_listener.request'] = new \Nelmio\ApiDocBundle\EventListener\RequestListener($this->get('nelmio_api_doc.extractor.api_doc_extractor'), $this->get('nelmio_api_doc.formatter.html_formatter'), '_doc');
    }
    protected function getNelmioApiDoc_Extractor_ApiDocExtractorService()
    {
        $a = $this->get('nelmio_api_doc.doc_comment_extractor');
        $this->services['nelmio_api_doc.extractor.api_doc_extractor'] = $instance = new \Nelmio\ApiDocBundle\Extractor\ApiDocExtractor($this, $this->get('router'), $this->get('annotation_reader'), $a, new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($this->get('kernel')), array(0 => new \Nelmio\ApiDocBundle\Extractor\Handler\FosRestHandler(), 1 => new \Nelmio\ApiDocBundle\Extractor\Handler\JmsSecurityExtraHandler(), 2 => new \Nelmio\ApiDocBundle\Extractor\Handler\SensioFrameworkExtraHandler(), 3 => new \Nelmio\ApiDocBundle\Extractor\Handler\PhpDocHandler($a)), array());
        $instance->addParser($this->get('nelmio_api_doc.parser.json_serializable_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.collection_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.form_errors_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.form_type_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.validation_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.jms_metadata_parser'));
        return $instance;
    }
    protected function getNelmioApiDoc_Form_Extension_DescriptionFormTypeExtensionService()
    {
        return $this->services['nelmio_api_doc.form.extension.description_form_type_extension'] = new \Nelmio\ApiDocBundle\Form\Extension\DescriptionFormTypeExtension();
    }
    protected function getNelmioApiDoc_Formatter_HtmlFormatterService()
    {
        $this->services['nelmio_api_doc.formatter.html_formatter'] = $instance = new \Nelmio\ApiDocBundle\Formatter\HtmlFormatter();
        $instance->setTemplatingEngine($this->get('templating'));
        $instance->setMotdTemplate('NelmioApiDocBundle::Components/motd.html.twig');
        $instance->setApiName('API documentation');
        $instance->setEnableSandbox(true);
        $instance->setEndpoint(NULL);
        $instance->setRequestFormatMethod('format_param');
        $instance->setRequestFormats(array('json' => 'application/json'));
        $instance->setDefaultRequestFormat('json');
        $instance->setAcceptType(NULL);
        $instance->setBodyFormats(array(0 => 'json'));
        $instance->setDefaultBodyFormat('form');
        $instance->setAuthentication(array('delivery' => 'http', 'type' => 'bearer', 'name' => 'Authorization', 'custom_endpoint' => false));
        $instance->setDefaultSectionsOpened(true);
        return $instance;
    }
    protected function getNelmioApiDoc_Formatter_MarkdownFormatterService()
    {
        return $this->services['nelmio_api_doc.formatter.markdown_formatter'] = new \Nelmio\ApiDocBundle\Formatter\MarkdownFormatter();
    }
    protected function getNelmioApiDoc_Formatter_SimpleFormatterService()
    {
        return $this->services['nelmio_api_doc.formatter.simple_formatter'] = new \Nelmio\ApiDocBundle\Formatter\SimpleFormatter();
    }
    protected function getNelmioApiDoc_Formatter_SwaggerFormatterService()
    {
        $this->services['nelmio_api_doc.formatter.swagger_formatter'] = $instance = new \Nelmio\ApiDocBundle\Formatter\SwaggerFormatter('dot_notation');
        $instance->setBasePath('/api');
        $instance->setApiVersion('0.1');
        $instance->setSwaggerVersion('1.2');
        $instance->setInfo(array('title' => 'Symfony2', 'description' => 'My awesome Symfony2 app!', 'TermsOfServiceUrl' => NULL, 'contact' => NULL, 'license' => NULL, 'licenseUrl' => NULL));
        $instance->setAuthenticationConfig(array('delivery' => 'http', 'type' => 'bearer', 'name' => 'Authorization', 'custom_endpoint' => false));
        return $instance;
    }
    protected function getNelmioApiDoc_Parser_CollectionParserService()
    {
        return $this->services['nelmio_api_doc.parser.collection_parser'] = new \Nelmio\ApiDocBundle\Parser\CollectionParser();
    }
    protected function getNelmioApiDoc_Parser_FormErrorsParserService()
    {
        return $this->services['nelmio_api_doc.parser.form_errors_parser'] = new \Nelmio\ApiDocBundle\Parser\FormErrorsParser();
    }
    protected function getNelmioApiDoc_Parser_FormTypeParserService()
    {
        return $this->services['nelmio_api_doc.parser.form_type_parser'] = new \Nelmio\ApiDocBundle\Parser\FormTypeParser($this->get('form.factory'), true);
    }
    protected function getNelmioApiDoc_Parser_JmsMetadataParserService()
    {
        return $this->services['nelmio_api_doc.parser.jms_metadata_parser'] = new \Nelmio\ApiDocBundle\Parser\JmsMetadataParser($this->get('jms_serializer.metadata_factory'), $this->get('jms_serializer.naming_strategy'), $this->get('nelmio_api_doc.doc_comment_extractor'));
    }
    protected function getNelmioApiDoc_Parser_JsonSerializableParserService()
    {
        return $this->services['nelmio_api_doc.parser.json_serializable_parser'] = new \Nelmio\ApiDocBundle\Parser\JsonSerializableParser();
    }
    protected function getNelmioApiDoc_Parser_ValidationParserService()
    {
        return $this->services['nelmio_api_doc.parser.validation_parser'] = new \Nelmio\ApiDocBundle\Parser\ValidationParser($this->get('validator'));
    }
    protected function getNelmioApiDoc_Twig_Extension_ExtraMarkdownService()
    {
        return $this->services['nelmio_api_doc.twig.extension.extra_markdown'] = new \Nelmio\ApiDocBundle\Twig\Extension\MarkdownExtension();
    }
    protected function getPropertyAccessorService()
    {
        return $this->services['property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor(false, false);
    }
    protected function getRequestService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('request', 'request');
        }
        throw new RuntimeException('You have requested a synthetic service ("request"). The DIC does not know how to construct this service.');
    }
    protected function getRequestStackService()
    {
        return $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack();
    }
    protected function getResponseListenerService()
    {
        return $this->services['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8');
    }
    protected function getRouterService()
    {
        return $this->services['router'] = new \Symfony\Bundle\FrameworkBundle\Routing\Router($this, ($this->targetDirs[2].'/app/config/routing_install.yml'), array('cache_dir' => __DIR__, 'debug' => false, 'generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper', 'generator_cache_class' => 'appInstallUrlGenerator', 'matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper', 'matcher_cache_class' => 'appInstallUrlMatcher', 'strict_requirements' => NULL), $this->get('router.request_context', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('monolog.logger.router', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getRouterListenerService()
    {
        return $this->services['router_listener'] = new \Symfony\Component\HttpKernel\EventListener\RouterListener($this->get('router'), $this->get('router.request_context', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('monolog.logger.request', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('request_stack'));
    }
    protected function getRouting_LoaderService()
    {
        $a = $this->get('file_locator');
        $b = $this->get('annotation_reader');
        $c = new \Sensio\Bundle\FrameworkExtraBundle\Routing\AnnotatedRouteControllerLoader($b);
        $d = new \Symfony\Component\Config\Loader\LoaderResolver();
        $d->addLoader(new \Symfony\Component\Routing\Loader\XmlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\YamlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($a, $c));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($a, $c));
        $d->addLoader($c);
        $d->addLoader($this->get('fos_rest.routing.loader.controller'));
        $d->addLoader($this->get('fos_rest.routing.loader.yaml_collection'));
        $d->addLoader($this->get('fos_rest.routing.loader.xml_collection'));
        return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader($this->get('controller_name_converter'), $this->get('monolog.logger.router', ContainerInterface::NULL_ON_INVALID_REFERENCE), $d);
    }
    protected function getSecurity_Authentication_Listener_FosOauthServer_AdminToolsService()
    {
        return $this->services['security.authentication.listener.fos_oauth_server.admin_tools'] = new \SevenTag\Api\SecurityBundle\Security\Firewall\OAuthListener($this->get('security.context'), $this->get('security.authentication.manager'), $this->get('fos_oauth_server.server'), $this->get('seven_tag_security.security.oauth_token_user_resolver'));
    }
    protected function getSecurity_Authentication_Listener_FosOauthServer_ApiService()
    {
        return $this->services['security.authentication.listener.fos_oauth_server.api'] = new \SevenTag\Api\SecurityBundle\Security\Firewall\OAuthListener($this->get('security.context'), $this->get('security.authentication.manager'), $this->get('fos_oauth_server.server'), $this->get('seven_tag_security.security.oauth_token_user_resolver'));
    }
    protected function getSecurity_AuthenticationUtilsService()
    {
        return $this->services['security.authentication_utils'] = new \Symfony\Component\Security\Http\Authentication\AuthenticationUtils($this->get('request_stack'));
    }
    protected function getSecurity_AuthorizationCheckerService()
    {
        return $this->services['security.authorization_checker'] = new \Symfony\Component\Security\Core\Authorization\AuthorizationChecker($this->get('security.token_storage'), $this->get('security.authentication.manager'), $this->get('security.access.decision_manager'), false);
    }
    protected function getSecurity_ContextService()
    {
        return $this->services['security.context'] = new \Symfony\Component\Security\Core\SecurityContext($this->get('security.token_storage'), $this->get('security.authorization_checker'));
    }
    protected function getSecurity_Csrf_TokenManagerService()
    {
        return $this->services['security.csrf.token_manager'] = new \Symfony\Component\Security\Csrf\CsrfTokenManager(new \Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator($this->get('security.secure_random')), new \Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage($this->get('session')));
    }
    protected function getSecurity_EncoderFactoryService()
    {
        return $this->services['security.encoder_factory'] = new \Symfony\Component\Security\Core\Encoder\EncoderFactory(array('FOS\\UserBundle\\Model\\UserInterface' => array('class' => 'Symfony\\Component\\Security\\Core\\Encoder\\MessageDigestPasswordEncoder', 'arguments' => array(0 => 'sha512', 1 => true, 2 => 5000))));
    }
    protected function getSecurity_FirewallService()
    {
        return $this->services['security.firewall'] = new \Symfony\Component\Security\Http\Firewall(new \Symfony\Bundle\SecurityBundle\Security\FirewallMap($this, array('security.firewall.map.context.dev' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/(_(profiler|wdt|error)|css|images|js)/'), 'security.firewall.map.context.oauth_token' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/oauth/v2/token'), 'security.firewall.map.context.api' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/api'), 'security.firewall.map.context.admin_tools' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/admin-tools'))), $this->get('event_dispatcher'));
    }
    protected function getSecurity_Firewall_Map_Context_AdminToolsService()
    {
        $a = $this->get('security.token_storage');
        $b = $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        return $this->services['security.firewall.map.context.admin_tools'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(0 => $this->get('security.channel_listener'), 1 => $this->get('security.authentication.listener.fos_oauth_server.admin_tools'), 2 => new \Symfony\Component\Security\Http\Firewall\AnonymousAuthenticationListener($a, '56e6bf5da527c6.43877242', $b, $this->get('security.authentication.manager')), 3 => $this->get('security.access_listener')), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($a, $this->get('security.authentication.trust_resolver'), $this->get('security.http_utils'), 'admin_tools', $this->get('fos_oauth_server.security.entry_point'), NULL, NULL, $b, true));
    }
    protected function getSecurity_Firewall_Map_Context_ApiService()
    {
        $a = $this->get('security.token_storage');
        $b = $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        return $this->services['security.firewall.map.context.api'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(0 => $this->get('security.channel_listener'), 1 => $this->get('security.authentication.listener.fos_oauth_server.api'), 2 => new \Symfony\Component\Security\Http\Firewall\AnonymousAuthenticationListener($a, '56e6bf5da527c6.43877242', $b, $this->get('security.authentication.manager')), 3 => $this->get('security.access_listener')), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($a, $this->get('security.authentication.trust_resolver'), $this->get('security.http_utils'), 'api', $this->get('fos_oauth_server.security.entry_point'), NULL, NULL, $b, true));
    }
    protected function getSecurity_Firewall_Map_Context_DevService()
    {
        return $this->services['security.firewall.map.context.dev'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(), NULL);
    }
    protected function getSecurity_Firewall_Map_Context_OauthTokenService()
    {
        return $this->services['security.firewall.map.context.oauth_token'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(), NULL);
    }
    protected function getSecurity_PasswordEncoderService()
    {
        return $this->services['security.password_encoder'] = new \Symfony\Component\Security\Core\Encoder\UserPasswordEncoder($this->get('security.encoder_factory'));
    }
    protected function getSecurity_Rememberme_ResponseListenerService()
    {
        return $this->services['security.rememberme.response_listener'] = new \Symfony\Component\Security\Http\RememberMe\ResponseListener();
    }
    protected function getSecurity_SecureRandomService()
    {
        return $this->services['security.secure_random'] = new \Symfony\Component\Security\Core\Util\SecureRandom((__DIR__.'/secure_random.seed'), $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSecurity_TokenStorageService()
    {
        return $this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage();
    }
    protected function getSecurity_Validator_UserPasswordService()
    {
        return $this->services['security.validator.user_password'] = new \Symfony\Component\Security\Core\Validator\Constraints\UserPasswordValidator($this->get('security.token_storage'), $this->get('security.encoder_factory'));
    }
    protected function getSensioFrameworkExtra_Cache_ListenerService()
    {
        return $this->services['sensio_framework_extra.cache.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener();
    }
    protected function getSensioFrameworkExtra_Controller_ListenerService()
    {
        return $this->services['sensio_framework_extra.controller.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener($this->get('annotation_reader'));
    }
    protected function getSensioFrameworkExtra_Converter_DatetimeService()
    {
        return $this->services['sensio_framework_extra.converter.datetime'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DateTimeParamConverter();
    }
    protected function getSensioFrameworkExtra_Converter_Doctrine_OrmService()
    {
        return $this->services['sensio_framework_extra.converter.doctrine.orm'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter($this->get('doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSensioFrameworkExtra_Converter_ListenerService()
    {
        return $this->services['sensio_framework_extra.converter.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener($this->get('sensio_framework_extra.converter.manager'), true);
    }
    protected function getSensioFrameworkExtra_Converter_ManagerService()
    {
        $this->services['sensio_framework_extra.converter.manager'] = $instance = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager();
        $instance->add($this->get('sensio_framework_extra.converter.doctrine.orm'), 0, 'doctrine.orm');
        $instance->add($this->get('sensio_framework_extra.converter.datetime'), 0, 'datetime');
        $instance->add($this->get('fos_rest.converter.request_body'), 0, 'fos_rest.request_body');
        $instance->add($this->get('seven_tag_container.service.previewmode_converter'), 0, 'previewmode_converter');
        $instance->add($this->get('seven_tag_app.versionable.vesionable_param_converter'), 0, 'versionable_converter');
        return $instance;
    }
    protected function getSensioFrameworkExtra_Security_ListenerService()
    {
        return $this->services['sensio_framework_extra.security.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\SecurityListener(NULL, new \Sensio\Bundle\FrameworkExtraBundle\Security\ExpressionLanguage(), $this->get('security.authentication.trust_resolver', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('security.role_hierarchy', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('security.token_storage', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('security.authorization_checker', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSensioFrameworkExtra_View_GuesserService()
    {
        return $this->services['sensio_framework_extra.view.guesser'] = new \Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser($this->get('kernel'));
    }
    protected function getServiceContainerService()
    {
        throw new RuntimeException('You have requested a synthetic service ("service_container"). The DIC does not know how to construct this service.');
    }
    protected function getSessionService()
    {
        return $this->services['session'] = new \Symfony\Component\HttpFoundation\Session\Session($this->get('session.storage.native'), new \Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag(), new \Symfony\Component\HttpFoundation\Session\Flash\FlashBag());
    }
    protected function getSession_SaveListenerService()
    {
        return $this->services['session.save_listener'] = new \Symfony\Component\HttpKernel\EventListener\SaveSessionListener();
    }
    protected function getSession_Storage_FilesystemService()
    {
        return $this->services['session.storage.filesystem'] = new \Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage((__DIR__.'/sessions'), 'MOCKSESSID', $this->get('session.storage.metadata_bag'));
    }
    protected function getSession_Storage_NativeService()
    {
        return $this->services['session.storage.native'] = new \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage(array('gc_probability' => 1), NULL, $this->get('session.storage.metadata_bag'));
    }
    protected function getSession_Storage_PhpBridgeService()
    {
        return $this->services['session.storage.php_bridge'] = new \Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage(NULL, $this->get('session.storage.metadata_bag'));
    }
    protected function getSessionListenerService()
    {
        return $this->services['session_listener'] = new \Symfony\Bundle\FrameworkBundle\EventListener\SessionListener($this);
    }
    protected function getSevenTag_Language_LanguageProviderService()
    {
        return $this->services['seven_tag.language.language_provider'] = new \SevenTag\Api\AppBundle\Language\LanguageProvider($this->get('seven_tag.locale.locale_provider'));
    }
    protected function getSevenTag_Listener_AllowOriginService()
    {
        return $this->services['seven_tag.listener.allow_origin'] = new \SevenTag\Api\AppBundle\EventListener\AllowOriginListener();
    }
    protected function getSevenTag_Listener_ConditionUpdateAtChainListenerService()
    {
        return $this->services['seven_tag.listener.condition_update_at_chain_listener'] = new \SevenTag\Api\TriggerBundle\Listener\ConditionUpdatedAtChainListener();
    }
    protected function getSevenTag_Listener_TriggerStrategyResolverListenerService()
    {
        return $this->services['seven_tag.listener.trigger_strategy_resolver_listener'] = new \SevenTag\Api\TriggerBundle\Listener\TriggerStrategyResolverListener();
    }
    protected function getSevenTag_Locale_LocaleFinderService()
    {
        return $this->services['seven_tag.locale.locale_finder'] = new \SevenTag\Api\AppBundle\Locale\LocaleFinder($this->get('symfony.finder'), ($this->targetDirs[2].'/app'), array(0 => ($this->targetDirs[2].'/app/../src/SevenTag/Plugin')));
    }
    protected function getSevenTag_Locale_LocaleProviderService()
    {
        return $this->services['seven_tag.locale.locale_provider'] = new \SevenTag\Api\AppBundle\Locale\LocaleProvider($this->get('seven_tag.locale.locale_finder'));
    }
    protected function getSevenTag_LocaleListenerService()
    {
        return $this->services['seven_tag.locale_listener'] = new \SevenTag\Api\AppBundle\EventListener\LocaleListener('en');
    }
    protected function getSevenTag_ManifestContainerjsCodeProviderService()
    {
        return $this->services['seven_tag.manifest_containerjs_code_provider'] = new \SevenTag\Api\AppBundle\Plugin\ManifestContainerjsCodeProvider($this->get('seven_tag.manifest_registry'), ($this->targetDirs[2].'/app/../web'));
    }
    protected function getSevenTag_ManifestRegistryService()
    {
        return $this->services['seven_tag.manifest_registry'] = new \SevenTag\Api\AppBundle\Plugin\ManifestRegistry();
    }
    protected function getSevenTag_Repository_TriggerRepositoryService()
    {
        return $this->services['seven_tag.repository.trigger_repository'] = $this->get('doctrine.orm.default_entity_manager')->getRepository('SevenTag\\Api\\TriggerBundle\\Entity\\Trigger');
    }
    protected function getSevenTag_TriggerType_ClickTypeService()
    {
        return $this->services['seven_tag.trigger_type.click_type'] = new \SevenTag\Api\TriggerBundle\TriggerType\Type\ClickType();
    }
    protected function getSevenTag_TriggerType_ConditionPreparatorService()
    {
        return $this->services['seven_tag.trigger_type.condition_preparator'] = new \SevenTag\Api\TriggerBundle\TriggerType\ViewPreparator\ConditionViewPreparator($this->get('seven_tag_variable.repository.variable_repository'), $this->get('seven_tag_variable.variable_provider'));
    }
    protected function getSevenTag_TriggerType_EventTypeService()
    {
        return $this->services['seven_tag.trigger_type.event_type'] = new \SevenTag\Api\TriggerBundle\TriggerType\Type\EventType();
    }
    protected function getSevenTag_TriggerType_FormSubmissionTypeService()
    {
        return $this->services['seven_tag.trigger_type.form_submission_type'] = new \SevenTag\Api\TriggerBundle\TriggerType\Type\FormSubmissionType();
    }
    protected function getSevenTag_TriggerType_HolderService()
    {
        $this->services['seven_tag.trigger_type.holder'] = $instance = new \SevenTag\Api\TriggerBundle\TriggerType\Holder\Holder();
        $instance->add($this->get('seven_tag.trigger_type.page_view_type'));
        $instance->add($this->get('seven_tag.trigger_type.click_type'));
        $instance->add($this->get('seven_tag.trigger_type.form_submission_type'));
        $instance->add($this->get('seven_tag.trigger_type.event_type'));
        return $instance;
    }
    protected function getSevenTag_TriggerType_PageViewTypeService()
    {
        return $this->services['seven_tag.trigger_type.page_view_type'] = new \SevenTag\Api\TriggerBundle\TriggerType\Type\PageViewType();
    }
    protected function getSevenTag_Validator_TriggerStrategyValidatorService()
    {
        return $this->services['seven_tag.validator.trigger_strategy_validator'] = new \SevenTag\Api\TriggerBundle\Validator\Constraints\TriggerStrategyValidator($this->get('seven_tag.trigger_type.holder'));
    }
    protected function getSevenTag_Validator_TriggerTypeValidatorService()
    {
        return $this->services['seven_tag.validator.trigger_type_validator'] = new \SevenTag\Api\TriggerBundle\Validator\Constraints\TriggerTypeValidator($this->get('seven_tag.trigger_type.holder'));
    }
    protected function getSevenTag_Warmer_AssetsWarmerService()
    {
        return $this->services['seven_tag.warmer.assets_warmer'] = new \SevenTag\Api\AppBundle\Plugin\AssetsWarmer($this->get('kernel'));
    }
    protected function getSevenTagApp_CopyManagerService()
    {
        return $this->services['seven_tag_app.copy_manager'] = new \SevenTag\Api\AppBundle\Versionable\CopyManager\CopyManager();
    }
    protected function getSevenTagApp_DeepPersisterService()
    {
        return $this->services['seven_tag_app.deep_persister'] = new \SevenTag\Api\AppBundle\Versionable\DeepPersister\DeepPersister($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getSevenTagApp_VersionManagerService()
    {
        return $this->services['seven_tag_app.version_manager'] = new \SevenTag\Api\AppBundle\Versionable\VersionManager\VersionManager($this->get('seven_tag_app.version_manager_handler.publish_handler'), $this->get('seven_tag_app.version_manager_handler.restore_handler'));
    }
    protected function getSevenTagApp_VersionManagerHandler_PublishHandlerService()
    {
        $this->services['seven_tag_app.version_manager_handler.publish_handler'] = $instance = new \SevenTag\Api\AppBundle\Versionable\VersionManager\Handler\PublishHandler();
        $instance->setCopyManager($this->get('seven_tag_app.copy_manager'));
        $instance->setDeepPersister($this->get('seven_tag_app.deep_persister'));
        $instance->setEntityManager($this->get('doctrine.orm.default_entity_manager'));
        return $instance;
    }
    protected function getSevenTagApp_VersionManagerHandler_RestoreHandlerService()
    {
        $this->services['seven_tag_app.version_manager_handler.restore_handler'] = $instance = new \SevenTag\Api\AppBundle\Versionable\VersionManager\Handler\RestoreHandler();
        $instance->setCopyManager($this->get('seven_tag_app.copy_manager'));
        $instance->setDeepPersister($this->get('seven_tag_app.deep_persister'));
        $instance->setEntityManager($this->get('doctrine.orm.default_entity_manager'));
        return $instance;
    }
    protected function getSevenTagApp_Versionable_Form_Type_AccessibleService()
    {
        $this->services['seven_tag_app.versionable.form.type.accessible'] = $instance = new \SevenTag\Api\AppBundle\Versionable\Form\Type\AccessibleType($this->get('doctrine'));
        $instance->setSubscriber($this->get('seven_tag_app.versionable.subscriber.accessible_form'));
        return $instance;
    }
    protected function getSevenTagApp_Versionable_Subscriber_AccessibleFormService()
    {
        return $this->services['seven_tag_app.versionable.subscriber.accessible_form'] = new \SevenTag\Api\AppBundle\Versionable\Listener\AccessibleFormSubscriber($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getSevenTagApp_Versionable_Subscriber_AccessidSubscriberService()
    {
        return $this->services['seven_tag_app.versionable.subscriber.accessid_subscriber'] = new \SevenTag\Api\AppBundle\Versionable\Listener\AccessIdSubscriber();
    }
    protected function getSevenTagApp_Versionable_Subscriber_VersionidSubscriberService()
    {
        return $this->services['seven_tag_app.versionable.subscriber.versionid_subscriber'] = new \SevenTag\Api\AppBundle\Versionable\Listener\VersionIdSubscriber();
    }
    protected function getSevenTagApp_Versionable_VesionableParamConverterService()
    {
        return $this->services['seven_tag_app.versionable.vesionable_param_converter'] = new \SevenTag\Api\AppBundle\Versionable\VersionableParamConverter($this->get('doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSevenTagContainer_CodeProvider_CdnUrlGeneratorService()
    {
        return $this->services['seven_tag_container.code_provider.cdn_url_generator'] = new \SevenTag\Api\ContainerBundle\Cdn\CdnUrlGenerator($this->get('router'), NULL);
    }
    protected function getSevenTagContainer_CodeProvider_SnippetProviderService()
    {
        return $this->services['seven_tag_container.code_provider.snippet_provider'] = new \SevenTag\Api\ContainerBundle\CodeProvider\SnippetCodeProvider($this->get('router'), $this->get('templating'));
    }
    protected function getSevenTagContainer_Command_JavascriptGeneratorService()
    {
        return $this->services['seven_tag_container.command.javascript_generator'] = new \SevenTag\Api\ContainerBundle\Command\JavascriptGeneratorCommand($this->get('gaufrette.container_library_mock'), $this->get('seven_tag_container.container_library.generator'), $this->get('seven_tag_container.repository.container_repository'));
    }
    protected function getSevenTagContainer_Command_RepublishContainerCommandService()
    {
        return $this->services['seven_tag_container.command.republish_container_command'] = new \SevenTag\Api\ContainerBundle\Command\RepublishContainerCommand($this->get('seven_tag_container.service.republish_container'));
    }
    protected function getSevenTagContainer_Command_TagtreeGeneratorService()
    {
        return $this->services['seven_tag_container.command.tagtree_generator'] = new \SevenTag\Api\ContainerBundle\Command\TagtreeGeneratorCommand($this->get('gaufrette.container_library_mock'), $this->get('seven_tag_container.tag_tree_builder'), $this->get('seven_tag_container.repository.container_repository'), $this->get('templating'));
    }
    protected function getSevenTagContainer_ContainerLibrary_GeneratorService()
    {
        return $this->services['seven_tag_container.container_library.generator'] = new \SevenTag\Api\ContainerBundle\ContainerLibrary\Generator\TemplateGenerator($this->get('seven_tag_container.container_library.template_loader'), $this->get('seven_tag_container.container_library.template_handler'));
    }
    protected function getSevenTagContainer_ContainerLibrary_Strategy_FilesystemStrategyService()
    {
        return $this->services['seven_tag_container.container_library.strategy.filesystem_strategy'] = new \SevenTag\Api\ContainerBundle\ContainerLibrary\Strategy\GaufretteStrategy($this->get('seven_tag_container.container_library.generator'), $this->get('gaufrette.container_library'));
    }
    protected function getSevenTagContainer_ContainerLibrary_TemplateHandlerService()
    {
        $this->services['seven_tag_container.container_library.template_handler'] = $instance = new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Handler\ChainHandler();
        $instance->add(new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Handler\DebuggerHandler($this->get('seven_tag_container.mode_resolver')), 1);
        $instance->add(new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Handler\TagTreeHandler($this->get('seven_tag_container.tag_tree_builder')), 2);
        $instance->add(new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Handler\ContainerJsHandler(NULL), 1);
        $instance->add(new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Handler\VariablesHandler($this->get('seven_tag_variable.variable_manager'), $this->get('jms_serializer')), 1);
        $instance->add(new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Handler\ContainerjsConfigHandler($this->get('seven_tag.manifest_containerjs_code_provider')), 1);
        return $instance;
    }
    protected function getSevenTagContainer_ContainerLibrary_TemplateLoaderService()
    {
        $this->services['seven_tag_container.container_library.template_loader'] = $instance = new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Loader\ChainLoader();
        $instance->add(new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Loader\FileLoader(($this->targetDirs[2].'/app/Resources/container-lib/licence.dist')), 5);
        $instance->add(new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Loader\FileLoader(($this->targetDirs[2].'/app/Resources/container-lib/tagTree.js.dist')), 4);
        $instance->add(new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Loader\FileLoader(($this->targetDirs[2].'/app/Resources/container-lib/library.js.dist')), 3);
        $instance->add(new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Loader\FileLoader(($this->targetDirs[2].'/app/Resources/container-lib/containerjsConfig.js.dist')), 2);
        $instance->add(new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Loader\FileLoader(($this->targetDirs[2].'/app/Resources/container-lib/bootstrap.js.dist')), 1);
        $instance->add(new \SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Loader\FileLoader(($this->targetDirs[2].'/app/../web/container-debugger/debug.js')), 0);
        return $instance;
    }
    protected function getSevenTagContainer_CreatorService()
    {
        return $this->services['seven_tag_container.creator'] = new \SevenTag\Api\ContainerBundle\Creator\Creator($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getSevenTagContainer_FormType_ContainerFormTypeService()
    {
        return $this->services['seven_tag_container.form_type.container_form_type'] = new \SevenTag\Api\ContainerBundle\Form\ContainerType();
    }
    protected function getSevenTagContainer_FormType_ContainerPermissionsTypeService()
    {
        return $this->services['seven_tag_container.form_type.container_permissions_type'] = new \SevenTag\Api\ContainerBundle\Form\ContainerPermissionType();
    }
    protected function getSevenTagContainer_FormType_ContainerWebsitesTypeService()
    {
        return $this->services['seven_tag_container.form_type.container_websites_type'] = new \SevenTag\Api\ContainerBundle\Form\ContainerWebsiteType();
    }
    protected function getSevenTagContainer_FormType_WebsiteTypeService()
    {
        return $this->services['seven_tag_container.form_type.website_type'] = new \SevenTag\Api\ContainerBundle\Form\WebsiteType();
    }
    protected function getSevenTagContainer_Listener_RemoveContainerPermissonsListenerService()
    {
        return $this->services['seven_tag_container.listener.remove_container_permissons_listener'] = new \SevenTag\Api\ContainerBundle\Listener\RemoveContainerPermissionsListener($this->get('seven_tag_container.repository.container_permissions_repository'));
    }
    protected function getSevenTagContainer_ModeResolverService()
    {
        return $this->services['seven_tag_container.mode_resolver'] = new \SevenTag\Api\ContainerBundle\ModeResolver\RequestModeResolver($this->get('request_stack'));
    }
    protected function getSevenTagContainer_NoScript_Consumer_NoScriptConsumerService()
    {
        return $this->services['seven_tag_container.no_script.consumer.no_script_consumer'] = new \SevenTag\Api\ContainerBundle\NoScript\Consumer\NoScriptConsumer($this->get('seven_tag_container.no_script.request.guzzle'));
    }
    protected function getSevenTagContainer_NoScript_Consumer_RequestConsumerService()
    {
        return $this->services['seven_tag_container.no_script.consumer.request_consumer'] = new \SevenTag\Api\ContainerBundle\NoScript\Consumer\RequestConsumer($this->get('seven_tag_tag.repository.tag_repository'), $this->get('sonata.notification.backend.runtime'), 'noScript');
    }
    protected function getSevenTagContainer_NoScript_Factory_GuzzleService()
    {
        return $this->services['seven_tag_container.no_script.factory.guzzle'] = new \SevenTag\Api\ContainerBundle\NoScript\Factory\GuzzleNoScriptFactory();
    }
    protected function getSevenTagContainer_NoScript_Handler_NoScriptHandlerService()
    {
        return $this->services['seven_tag_container.no_script.handler.no_script_handler'] = new \SevenTag\Api\ContainerBundle\NoScript\Handler\NoScriptHandler($this->get('sonata.notification.backend.runtime'), 'request');
    }
    protected function getSevenTagContainer_NoScript_Request_GuzzleService()
    {
        return $this->services['seven_tag_container.no_script.request.guzzle'] = $this->get('seven_tag_container.no_script.factory.guzzle')->createClient();
    }
    protected function getSevenTagContainer_Privacy_CodeProvider_SnippetService()
    {
        return $this->services['seven_tag_container.privacy.code_provider.snippet'] = new \SevenTag\Api\ContainerBundle\Privacy\CodeProvider\SnippetProvider($this->get('templating'));
    }
    protected function getSevenTagContainer_Privacy_FormType_OptoutTypeService()
    {
        return $this->services['seven_tag_container.privacy.form_type.optout_type'] = new \SevenTag\Api\ContainerBundle\Privacy\Form\OptOutType();
    }
    protected function getSevenTagContainer_Repository_ContainerPermissionsRepositoryService()
    {
        return $this->services['seven_tag_container.repository.container_permissions_repository'] = $this->get('doctrine.orm.default_entity_manager')->getRepository('SevenTag\\Api\\ContainerBundle\\Entity\\ContainerPermission');
    }
    protected function getSevenTagContainer_Repository_ContainerRepositoryService()
    {
        return $this->services['seven_tag_container.repository.container_repository'] = $this->get('doctrine.orm.default_entity_manager')->getRepository('SevenTag\\Api\\ContainerBundle\\Entity\\Container');
    }
    protected function getSevenTagContainer_Serializer_CodeSubscriberService()
    {
        return $this->services['seven_tag_container.serializer.code_subscriber'] = new \SevenTag\Api\ContainerBundle\Serializer\Subsriber\CodeSubscriber($this->get('seven_tag_container.code_provider.snippet_provider'));
    }
    protected function getSevenTagContainer_Service_PreviewmodeConverterService()
    {
        return $this->services['seven_tag_container.service.previewmode_converter'] = new \SevenTag\Api\ContainerBundle\ParamConverter\PreviewModeConverter($this->get('doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('seven_tag_container.mode_resolver'));
    }
    protected function getSevenTagContainer_Service_RepublishContainerService()
    {
        return $this->services['seven_tag_container.service.republish_container'] = new \SevenTag\Api\ContainerBundle\Service\RepublishContainer($this->get('seven_tag_container.repository.container_repository'), $this->get('event_dispatcher'));
    }
    protected function getSevenTagContainer_Subscriber_StorageJavascriptInFilesystemSubscriberService()
    {
        return $this->services['seven_tag_container.subscriber.storage_javascript_in_filesystem_subscriber'] = new \SevenTag\Api\ContainerBundle\ContainerLibrary\Subscriber\StorageJavascriptInFilesystemSubscriber($this->get('seven_tag_container.container_library.generator'), $this->get('gaufrette.container_library'), NULL);
    }
    protected function getSevenTagContainer_Subscriber_StorageTagtreeInFilesystemSubscriberService()
    {
        return $this->services['seven_tag_container.subscriber.storage_tagtree_in_filesystem_subscriber'] = new \SevenTag\Api\ContainerBundle\ContainerLibrary\Subscriber\StorageTagTreeInFilesystemSubscriber($this->get('seven_tag_container.tag_tree_builder'), $this->get('gaufrette.container_library'));
    }
    protected function getSevenTagContainer_TagTreeBuilderService()
    {
        return $this->services['seven_tag_container.tag_tree_builder'] = new \SevenTag\Api\ContainerBundle\TagTree\Builder\TagTreeBuilder($this->get('seven_tag_container.tag_tree_handler.container_handler'));
    }
    protected function getSevenTagContainer_TagTreeHandler_ConditionsHandlerService()
    {
        return $this->services['seven_tag_container.tag_tree_handler.conditions_handler'] = new \SevenTag\Api\ContainerBundle\TagTree\Handler\ConditionsHandler();
    }
    protected function getSevenTagContainer_TagTreeHandler_ContainerHandlerService()
    {
        $this->services['seven_tag_container.tag_tree_handler.container_handler'] = $instance = new \SevenTag\Api\ContainerBundle\TagTree\Handler\ContainerHandler($this->get('seven_tag_container.repository.container_repository'));
        $instance->setNextHandler($this->get('seven_tag_container.tag_tree_handler.tags_handler'));
        return $instance;
    }
    protected function getSevenTagContainer_TagTreeHandler_TagsHandlerService()
    {
        $this->services['seven_tag_container.tag_tree_handler.tags_handler'] = $instance = new \SevenTag\Api\ContainerBundle\TagTree\Handler\TagsHandler();
        $instance->setNextHandler($this->get('seven_tag_container.tag_tree_handler.triggers_handler'));
        return $instance;
    }
    protected function getSevenTagContainer_TagTreeHandler_TriggersHandlerService()
    {
        $this->services['seven_tag_container.tag_tree_handler.triggers_handler'] = $instance = new \SevenTag\Api\ContainerBundle\TagTree\Handler\TriggersHandler();
        $instance->setNextHandler($this->get('seven_tag_container.tag_tree_handler.conditions_handler'));
        return $instance;
    }
    protected function getSevenTagContainer_Validator_GrantPermissionsUserService()
    {
        return $this->services['seven_tag_container.validator.grant_permissions_user'] = new \SevenTag\Api\ContainerBundle\Validator\Constraints\GrantPermissionsUserValidator($this->get('security.token_storage'));
    }
    protected function getSevenTagPluginClickTaleCustomTemplate_FormType_ClickTaleService()
    {
        return $this->services['seven_tag_plugin_click_tale_custom_template.form_type.click_tale'] = new \SevenTag\Plugin\ClickTaleCustomTemplateBundle\Form\ClickTaleTemplateFormType();
    }
    protected function getSevenTagPluginCrazyEggCustomTemplate_FormType_CrazyEggService()
    {
        return $this->services['seven_tag_plugin_crazy_egg_custom_template.form_type.crazy_egg'] = new \SevenTag\Plugin\CrazyEggCustomTemplateBundle\Form\CrazyEggTemplateFormType();
    }
    protected function getSevenTagPluginFacebookRetargetingPixelCustomTemplate_FormType_FacebookRetargetingPixelService()
    {
        return $this->services['seven_tag_plugin_facebook_retargeting_pixel_custom_template.form_type.facebook_retargeting_pixel'] = new \SevenTag\Plugin\FacebookRetargetingPixelCustomTemplateBundle\Form\FacebookRetargetingPixelFormType();
    }
    protected function getSevenTagPluginGoogleAdwordsCustomTemplate_FormType_GoogleAdwordsService()
    {
        return $this->services['seven_tag_plugin_google_adwords_custom_template.form_type.google_adwords'] = new \SevenTag\Plugin\GoogleAdwordsCustomTemplateBundle\Form\GoogleAdwordsTemplateFormType();
    }
    protected function getSevenTagPluginGoogleAnalyticsCustomTemplate_FormType_GoogleAnalyticsService()
    {
        return $this->services['seven_tag_plugin_google_analytics_custom_template.form_type.google_analytics'] = new \SevenTag\Plugin\GoogleAnalyticsCustomTemplateBundle\Form\GoogleAnalyticsTemplateFormType();
    }
    protected function getSevenTagPluginMarketoCustomTemplate_FormType_MarketoService()
    {
        return $this->services['seven_tag_plugin_marketo_custom_template.form_type.marketo'] = new \SevenTag\Plugin\MarketoCustomTemplateBundle\Form\MarketoFormType();
    }
    protected function getSevenTagPluginPiwikCustomTemplate_FormType_PiwikService()
    {
        return $this->services['seven_tag_plugin_piwik_custom_template.form_type.piwik'] = new \SevenTag\Plugin\PiwikCustomTemplateBundle\Form\PiwikTemplateFormType();
    }
    protected function getSevenTagPluginPiwikCustomTemplate_FormType_TrackEventService()
    {
        return $this->services['seven_tag_plugin_piwik_custom_template.form_type.track_event'] = new \SevenTag\Plugin\PiwikCustomTemplateBundle\Form\PiwikTrackEventFormType();
    }
    protected function getSevenTagPluginPiwikCustomTemplate_FormType_TrackGoalService()
    {
        return $this->services['seven_tag_plugin_piwik_custom_template.form_type.track_goal'] = new \SevenTag\Plugin\PiwikCustomTemplateBundle\Form\PiwikTrackGoalFormType();
    }
    protected function getSevenTagPluginQualarooCustomTemplate_FormType_QualarooService()
    {
        return $this->services['seven_tag_plugin_qualaroo_custom_template.form_type.qualaroo'] = new \SevenTag\Plugin\QualarooCustomTemplateBundle\Form\QualarooTemplateFormType();
    }
    protected function getSevenTagPluginSalesManagoCustomTemplate_FormType_SalesManagoService()
    {
        return $this->services['seven_tag_plugin_sales_manago_custom_template.form_type.sales_manago'] = new \SevenTag\Plugin\SalesManagoCustomTemplateBundle\Form\SalesManagoFormType();
    }
    protected function getSevenTagPluginSentry_Listener_SentryAssetModifyService()
    {
        return $this->services['seven_tag_plugin_sentry.listener.sentry_asset_modify'] = new \SevenTag\Plugin\SentryBundle\Listener\SentryAssetModifyListener($this->get('seven_tag_plugin_sentry.provider.sentry'));
    }
    protected function getSevenTagPluginSentry_Provider_SentryService()
    {
        return $this->services['seven_tag_plugin_sentry.provider.sentry'] = new \SevenTag\Plugin\SentryBundle\Provider\SentryProvider(NULL, $this->get('templating'));
    }
    protected function getSevenTagSecurity_FormType_CreateIntegrationFormTypeService()
    {
        return $this->services['seven_tag_security.form_type.create_integration_form_type'] = new \SevenTag\Api\SecurityBundle\Form\Type\CreateIntegrationType();
    }
    protected function getSevenTagSecurity_FormType_EditIntegrationFormTypeService()
    {
        return $this->services['seven_tag_security.form_type.edit_integration_form_type'] = new \SevenTag\Api\SecurityBundle\Form\Type\EditIntegrationType();
    }
    protected function getSevenTagSecurity_Integration_IntegrationUserSubscriberService()
    {
        return $this->services['seven_tag_security.integration.integration_user_subscriber'] = new \SevenTag\Api\SecurityBundle\Integration\Listener\IntegrationSubscriber($this->get('seven_tag_security.integration.user_manipulator'));
    }
    protected function getSevenTagSecurity_Integration_UserManipulatorService()
    {
        return $this->services['seven_tag_security.integration.user_manipulator'] = new \SevenTag\Api\SecurityBundle\Integration\UserManipulator\UserManipulator();
    }
    protected function getSevenTagSecurity_LogoutHandler_RestLogoutService()
    {
        return $this->services['seven_tag_security.logout_handler.rest_logout'] = new \SevenTag\Api\SecurityBundle\Http\Logout\RestLogoutHandler($this->get('security.token_storage'), $this->get('seven_tag_security.repository.access_token_repository'));
    }
    protected function getSevenTagSecurity_OauthServerExceptionToResponseTransformerService()
    {
        return $this->services['seven_tag_security.oauth_server_exception_to_response_transformer'] = new \SevenTag\Api\SecurityBundle\Utils\OAuth2ServerExceptionToResponseTransformer();
    }
    protected function getSevenTagSecurity_Repository_AccessTokenRepositoryService()
    {
        return $this->services['seven_tag_security.repository.access_token_repository'] = $this->get('doctrine.orm.default_entity_manager')->getRepository('SevenTag\\Api\\SecurityBundle\\Entity\\AccessToken');
    }
    protected function getSevenTagSecurity_Repository_IntegrationRepositoryService()
    {
        return $this->services['seven_tag_security.repository.integration_repository'] = $this->get('doctrine.orm.default_entity_manager')->getRepository('SevenTag\\Api\\SecurityBundle\\Entity\\Integration');
    }
    protected function getSevenTagSecurity_Security_OauthTokenUserResolverService()
    {
        return $this->services['seven_tag_security.security.oauth_token_user_resolver'] = new \SevenTag\Api\SecurityBundle\Security\Firewall\OAuthTokenUserResolver($this->get('fos_oauth_server.access_token_manager.default'));
    }
    protected function getSevenTagSecurity_Serializer_AdminContainersPermissionsSubscriberService()
    {
        $this->services['seven_tag_security.serializer.admin_containers_permissions_subscriber'] = $instance = new \SevenTag\Api\SecurityBundle\Serializer\Subscriber\AdminUserPermissionsSubscriber();
        $instance->setTokenStorage($this->get('security.token_storage'));
        $instance->setBitMaskToPermissionsMapper($this->get('seven_tag_security.utils.bitmask_to_permissions_mapper'));
        return $instance;
    }
    protected function getSevenTagSecurity_Serializer_ContainerPermissionsSubscriberService()
    {
        return $this->services['seven_tag_security.serializer.container_permissions_subscriber'] = new \SevenTag\Api\SecurityBundle\Serializer\Subscriber\ContainerPermissionsSubscriber($this->get('security.token_storage'), $this->get('seven_tag_security.utils.bitmask_to_permissions_mapper'), $this->get('seven_tag_security.utils.user_mask_resolver'));
    }
    protected function getSevenTagSecurity_Serializer_NonAdminContainersPermissionsSubscriberService()
    {
        $this->services['seven_tag_security.serializer.non_admin_containers_permissions_subscriber'] = $instance = new \SevenTag\Api\SecurityBundle\Serializer\Subscriber\NonAdminUserSubscriber($this->get('seven_tag_security.utils.user_permissions_map_provider'));
        $instance->setTokenStorage($this->get('security.token_storage'));
        $instance->setBitMaskToPermissionsMapper($this->get('seven_tag_security.utils.bitmask_to_permissions_mapper'));
        return $instance;
    }
    protected function getSevenTagSecurity_Utils_BitmaskToPermissionsMapperService()
    {
        return $this->services['seven_tag_security.utils.bitmask_to_permissions_mapper'] = new \SevenTag\Api\SecurityBundle\Utils\BitMaskToPermissionsMapper();
    }
    protected function getSevenTagSecurity_Utils_UserMaskResolverService()
    {
        return $this->services['seven_tag_security.utils.user_mask_resolver'] = new \SevenTag\Api\SecurityBundle\Utils\UserMaskResolver($this->get('seven_tag_container.repository.container_permissions_repository'));
    }
    protected function getSevenTagSecurity_Utils_UserPermissionsMapProviderService()
    {
        return $this->services['seven_tag_security.utils.user_permissions_map_provider'] = new \SevenTag\Api\SecurityBundle\Utils\UserPermissionsMapProvider($this->get('seven_tag_container.repository.container_permissions_repository'), $this->get('seven_tag_security.utils.bitmask_to_permissions_mapper'));
    }
    protected function getSevenTagSecurity_Warmer_OauthClientSettingsWarmerService()
    {
        return $this->services['seven_tag_security.warmer.oauth_client_settings_warmer'] = new \SevenTag\Api\SecurityBundle\Warmer\OAuthClientSettingsWarmer($this);
    }
    protected function getSevenTagTag_FormType_TagFormTypeService()
    {
        return $this->services['seven_tag_tag.form_type.tag_form_type'] = new \SevenTag\Api\TagBundle\Form\TagType($this->get('seven_tag_tag.template_holder'));
    }
    protected function getSevenTagTag_Repository_TagRepositoryService()
    {
        return $this->services['seven_tag_tag.repository.tag_repository'] = $this->get('doctrine.orm.default_entity_manager')->getRepository('SevenTag\\Api\\TagBundle\\Entity\\Tag');
    }
    protected function getSevenTagTag_Subscriber_TagTemplateCodeResolverSubscriberService()
    {
        return $this->services['seven_tag_tag.subscriber.tag_template_code_resolver_subscriber'] = new \SevenTag\Api\TagBundle\Listener\TagTemplateCodeResolverSubscriber($this->get('seven_tag_tag.template_holder'));
    }
    protected function getSevenTagTag_TemplateHolderService()
    {
        $a = new \SevenTag\Plugin\PiwikCustomTemplateBundle\Template\PiwikProvider();
        $a->setContainer($this);
        $b = new \SevenTag\Plugin\ClickTaleCustomTemplateBundle\Template\ClickTaleProvider();
        $b->setContainer($this);
        $c = new \SevenTag\Plugin\CrazyEggCustomTemplateBundle\Template\CrazyEggProvider();
        $c->setContainer($this);
        $d = new \SevenTag\Plugin\FacebookRetargetingPixelCustomTemplateBundle\Template\FacebookRetargetingPixelProvider();
        $d->setContainer($this);
        $e = new \SevenTag\Plugin\SalesManagoCustomTemplateBundle\Template\SalesManagoProvider();
        $e->setContainer($this);
        $f = new \SevenTag\Plugin\MarketoCustomTemplateBundle\Template\MarketoProvider();
        $f->setContainer($this);
        $g = new \SevenTag\Plugin\GoogleAdwordsCustomTemplateBundle\Template\GoogleAdwordsProvider();
        $g->setContainer($this);
        $h = new \SevenTag\Plugin\QualarooCustomTemplateBundle\Template\QualarooProvider();
        $h->setContainer($this);
        $i = new \SevenTag\Plugin\GoogleAnalyticsCustomTemplateBundle\Template\GoogleAnalyticsProvider();
        $i->setContainer($this);
        $this->services['seven_tag_tag.template_holder'] = $instance = new \SevenTag\Api\TagBundle\Template\Holder();
        $instance->add($a);
        $instance->add($b);
        $instance->add($c);
        $instance->add($d);
        $instance->add($e);
        $instance->add($f);
        $instance->add($g);
        $instance->add($h);
        $instance->add($i);
        return $instance;
    }
    protected function getSevenTagTag_Validator_TagTemplateValidatorService()
    {
        return $this->services['seven_tag_tag.validator.tag_template_validator'] = new \SevenTag\Api\TagBundle\Validator\Constraints\TagTemplateValidator($this->get('seven_tag_tag.template_holder'));
    }
    protected function getSevenTagTrigger_FormType_TriggerFormTypeService()
    {
        return $this->services['seven_tag_trigger.form_type.trigger_form_type'] = new \SevenTag\Api\TriggerBundle\Form\Type\TriggerType();
    }
    protected function getSevenTagUser_FormType_CreateFormTypeService()
    {
        return $this->services['seven_tag_user.form_type.create_form_type'] = new \SevenTag\Api\UserBundle\Form\CreateType($this->get('seven_tag_user.role_list_provider'));
    }
    protected function getSevenTagUser_FormType_EditFormTypeService()
    {
        return $this->services['seven_tag_user.form_type.edit_form_type'] = new \SevenTag\Api\UserBundle\Form\EditType($this->get('seven_tag_user.role_list_provider'));
    }
    protected function getSevenTagUser_FormType_MeFormTypeService()
    {
        return $this->services['seven_tag_user.form_type.me_form_type'] = new \SevenTag\Api\UserBundle\Form\MeType();
    }
    protected function getSevenTagUser_FormType_OthersSettingsFormTypeService()
    {
        return $this->services['seven_tag_user.form_type.others_settings_form_type'] = new \SevenTag\Api\UserBundle\Form\OthersSettingsType($this->get('seven_tag.language.language_provider'));
    }
    protected function getSevenTagUser_PermissionsProviderService()
    {
        return $this->services['seven_tag_user.permissions_provider'] = new \SevenTag\Api\UserBundle\PermissionsProvider\PermissionsProvider($this->get('seven_tag_user.repository.user_repository'), $this->get('seven_tag_security.utils.bitmask_to_permissions_mapper'), $this->get('seven_tag_security.utils.user_mask_resolver'));
    }
    protected function getSevenTagUser_Repository_UserRepositoryService()
    {
        return $this->services['seven_tag_user.repository.user_repository'] = $this->get('doctrine.orm.default_entity_manager')->getRepository('SevenTag\\Api\\UserBundle\\Entity\\User');
    }
    protected function getSevenTagUser_ResetPassword_RequestService()
    {
        return $this->services['seven_tag_user.reset_password.request'] = new \SevenTag\Api\UserBundle\ResetPassword\ResetPasswordRequest($this->get('fos_user.user_manager'), $this->get('fos_user.util.token_generator'), $this->get('seventag.user.mailer.mailer'));
    }
    protected function getSevenTagUser_ResetPassword_TokenService()
    {
        return $this->services['seven_tag_user.reset_password.token'] = new \SevenTag\Api\UserBundle\ResetPassword\ResetPasswordToken($this->get('fos_user.user_manager'));
    }
    protected function getSevenTagUser_RoleListProviderService()
    {
        return $this->services['seven_tag_user.role_list_provider'] = new \SevenTag\Api\UserBundle\RoleListProvider\RoleListProvider(array('ROLE_CONTAINERS_CREATE' => array(), 'ROLE_SUPER_ADMIN' => array(0 => 'ROLE_USER', 1 => 'ROLE_CONTAINERS_CREATE'), 'ROLE_API' => array(0 => 'ROLE_USER')));
    }
    protected function getSevenTagUser_UserManipulatorService()
    {
        return $this->services['seven_tag_user.user_manipulator'] = new \SevenTag\Api\UserBundle\UserManipulator\UserManipulator($this->get('fos_user.util.token_generator'), $this->get('fos_user.user_manager'), $this->get('seventag.user.mailer.mailer'));
    }
    protected function getSevenTagUser_Validator_RolesValidatorService()
    {
        return $this->services['seven_tag_user.validator.roles_validator'] = new \SevenTag\Api\UserBundle\Validator\RolesValidator($this->get('seven_tag_user.role_list_provider'));
    }
    protected function getSevenTagVariable_FormType_VariableFormTypeService()
    {
        return $this->services['seven_tag_variable.form_type.variable_form_type'] = new \SevenTag\Api\VariableBundle\Form\Type\VariableType();
    }
    protected function getSevenTagVariable_Repository_VariableRepositoryService()
    {
        return $this->services['seven_tag_variable.repository.variable_repository'] = $this->get('doctrine.orm.default_entity_manager')->getRepository('SevenTag\\Api\\VariableBundle\\Entity\\Variable');
    }
    protected function getSevenTagVariable_Repository_VariableTypeRepositoryService()
    {
        return $this->services['seven_tag_variable.repository.variable_type_repository'] = $this->get('doctrine.orm.default_entity_manager')->getRepository('SevenTag\\Api\\VariableBundle\\Entity\\VariableType');
    }
    protected function getSevenTagVariable_VariableManagerService()
    {
        return $this->services['seven_tag_variable.variable_manager'] = new \SevenTag\Api\VariableBundle\Manager\VariableManager($this->get('seven_tag_variable.repository.variable_repository'), $this->get('seven_tag_variable.variable_provider'), $this->get('seven_tag_variable.variable_type_provider'));
    }
    protected function getSevenTagVariable_VariableProviderService()
    {
        return $this->services['seven_tag_variable.variable_provider'] = new \SevenTag\Api\VariableBundle\Provider\VariableProvider(array('pageUrl' => array('name' => 'Page Url', 'type' => 'url', 'value' => 'href'), 'referrer' => array('name' => 'Referrer', 'type' => 'document', 'value' => 'referrer'), 'path' => array('name' => 'Page Path', 'type' => 'url', 'value' => 'hostname'), 'hostname' => array('name' => 'Page Hostname', 'type' => 'url', 'value' => 'hostname'), 'clickClasses' => array('name' => 'Click Classes', 'type' => 'dataLayer', 'value' => 'elementClasses'), 'clickId' => array('name' => 'Click ID', 'type' => 'dataLayer', 'value' => 'elementId'), 'clickUrl' => array('name' => 'Click Url', 'type' => 'dataLayer', 'value' => 'elementUrl'), 'formId' => array('name' => 'Form ID', 'type' => 'dataLayer', 'value' => 'elementId'), 'formClasses' => array('name' => 'Form Classes', 'type' => 'dataLayer', 'value' => 'elementClasses'), 'formUrl' => array('name' => 'Form Url', 'type' => 'dataLayer', 'value' => 'elementClasses'), 'event' => array('name' => 'Event', 'type' => 'dataLayer', 'value' => 'event')));
    }
    protected function getSevenTagVariable_VariableTypeProviderService()
    {
        return $this->services['seven_tag_variable.variable_type_provider'] = new \SevenTag\Api\VariableBundle\Provider\VariableTypeProvider($this->get('translator.default'), array('url' => array('name' => 'Url', 'collectorName' => 'url', 'helper' => 'To configure you need to set one of property of this object like hash or protocol'), 'cookie' => array('name' => 'Cookie', 'collectorName' => 'cookie', 'helper' => 'To configure you need to put cookie name and as a value you will have value of that cookie'), 'document' => array('name' => 'Document', 'collectorName' => 'document', 'helper' => 'To configure you need to set one of property of this object like referrer'), 'dataLayer' => array('name' => 'Data Layer', 'collectorName' => 'dataLayer', 'helper' => 'To configure you need to set name of dataLayer event property'), 'constant' => array('name' => 'Constant', 'collectorName' => 'constant', 'helper' => 'To configure you need to write value of your constant for example unique id of application'), 'random' => array('name' => 'Random Number', 'collectorName' => 'random', 'helper' => 'When set it will always return random number as value of variable')), $this->get('event_dispatcher'));
    }
    protected function getSeventag_User_Mailer_MailerService()
    {
        return $this->services['seventag.user.mailer.mailer'] = new \SevenTag\Api\UserBundle\Mailer\Mailer($this->get('request_stack'), $this->get('swiftmailer.mailer.default'), $this->get('templating'), array('confirmation.template' => 'SevenTagUserBundle:Registering:email.txt.twig', 'resetting.template' => 'SevenTagUserBundle:Registering:resetting.txt.twig', 'from_email' => array('confirmation' => array('example@example.com' => '7tag'), 'resetting' => array('example@example.com' => '7tag'))));
    }
    protected function getSonata_Notification_Backend_DoctrineService()
    {
        return $this->services['sonata.notification.backend.doctrine'] = new \Sonata\NotificationBundle\Backend\MessageManagerBackendDispatcher($this->get('sonata.notification.manager.message.default'), '', '', '');
    }
    protected function getSonata_Notification_Backend_HeathCheckService()
    {
        return $this->services['sonata.notification.backend.heath_check'] = new \Sonata\NotificationBundle\Backend\BackendHealthCheck($this->get('sonata.notification.backend.runtime'));
    }
    protected function getSonata_Notification_Backend_PostponeService()
    {
        return $this->services['sonata.notification.backend.postpone'] = new \Sonata\NotificationBundle\Backend\PostponeRuntimeBackend($this->get('sonata.notification.dispatcher'));
    }
    protected function getSonata_Notification_Backend_RuntimeService()
    {
        return $this->services['sonata.notification.backend.runtime'] = new \Sonata\NotificationBundle\Backend\RuntimeBackend($this->get('sonata.notification.dispatcher'));
    }
    protected function getSonata_Notification_Consumer_LoggerService()
    {
        return $this->services['sonata.notification.consumer.logger'] = new \Sonata\NotificationBundle\Consumer\LoggerConsumer($this->get('logger'));
    }
    protected function getSonata_Notification_Consumer_MetadataService()
    {
        return $this->services['sonata.notification.consumer.metadata'] = new \Sonata\NotificationBundle\Consumer\Metadata(array('mailer' => array(0 => 'sonata.notification.consumer.swift_mailer'), 'logger' => array(0 => 'sonata.notification.consumer.logger'), 'noScript' => array(0 => 'seven_tag_container.no_script.consumer.no_script_consumer'), 'request' => array(0 => 'seven_tag_container.no_script.consumer.request_consumer')));
    }
    protected function getSonata_Notification_Consumer_SwiftMailerService()
    {
        return $this->services['sonata.notification.consumer.swift_mailer'] = new \Sonata\NotificationBundle\Consumer\SwiftMailerConsumer($this->get('swiftmailer.mailer.default'));
    }
    protected function getSonata_Notification_Controller_Api_MessageService()
    {
        return $this->services['sonata.notification.controller.api.message'] = new \Sonata\NotificationBundle\Controller\Api\MessageController($this->get('sonata.notification.manager.message.default'));
    }
    protected function getSonata_Notification_DispatcherService()
    {
        $this->services['sonata.notification.dispatcher'] = $instance = new \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher($this);
        $instance->addListenerService('mailer', array(0 => 'sonata.notification.consumer.swift_mailer', 1 => 'process'), 0);
        $instance->addListenerService('logger', array(0 => 'sonata.notification.consumer.logger', 1 => 'process'), 0);
        $instance->addListenerService('noScript', array(0 => 'seven_tag_container.no_script.consumer.no_script_consumer', 1 => 'process'), 0);
        $instance->addListenerService('request', array(0 => 'seven_tag_container.no_script.consumer.request_consumer', 1 => 'process'), 0);
        return $instance;
    }
    protected function getSonata_Notification_ErroneousMessagesSelectorService()
    {
        return $this->services['sonata.notification.erroneous_messages_selector'] = new \Sonata\NotificationBundle\Selector\ErroneousMessagesSelector($this->get('doctrine'), 'Application\\Sonata\\NotificationBundle\\Entity\\Message');
    }
    protected function getSonata_Notification_Event_DoctrineBackendOptimizeService()
    {
        return $this->services['sonata.notification.event.doctrine_backend_optimize'] = new \Sonata\NotificationBundle\Event\DoctrineBackendOptimizeListener($this->get('doctrine'));
    }
    protected function getSonata_Notification_Event_DoctrineOptimizeService()
    {
        return $this->services['sonata.notification.event.doctrine_optimize'] = new \Sonata\NotificationBundle\Event\DoctrineOptimizeListener($this->get('doctrine'));
    }
    protected function getSonata_Notification_Manager_Message_DefaultService()
    {
        return $this->services['sonata.notification.manager.message.default'] = new \Sonata\NotificationBundle\Entity\MessageManager('Application\\Sonata\\NotificationBundle\\Entity\\Message', $this->get('doctrine'));
    }
    protected function getStofDoctrineExtensions_Uploadable_ManagerService()
    {
        $a = new \Gedmo\Uploadable\UploadableListener(new \Stof\DoctrineExtensionsBundle\Uploadable\MimeTypeGuesserAdapter());
        $a->setAnnotationReader($this->get('annotation_reader'));
        $a->setDefaultFileInfoClass('Stof\\DoctrineExtensionsBundle\\Uploadable\\UploadedFileInfo');
        return $this->services['stof_doctrine_extensions.uploadable.manager'] = new \Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager($a, 'Stof\\DoctrineExtensionsBundle\\Uploadable\\UploadedFileInfo');
    }
    protected function getStreamedResponseListenerService()
    {
        return $this->services['streamed_response_listener'] = new \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener();
    }
    protected function getSwiftmailer_EmailSender_ListenerService()
    {
        return $this->services['swiftmailer.email_sender.listener'] = new \Symfony\Bundle\SwiftmailerBundle\EventListener\EmailSenderListener($this, $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSwiftmailer_Mailer_DefaultService()
    {
        return $this->services['swiftmailer.mailer.default'] = new \Swift_Mailer($this->get('swiftmailer.mailer.default.transport'));
    }
    protected function getSwiftmailer_Mailer_Default_SpoolService()
    {
        return $this->services['swiftmailer.mailer.default.spool'] = new \Swift_FileSpool(($this->targetDirs[2].'/app/spool/default'));
    }
    protected function getSwiftmailer_Mailer_Default_TransportService()
    {
        return $this->services['swiftmailer.mailer.default.transport'] = new \Swift_Transport_SpoolTransport($this->get('swiftmailer.mailer.default.transport.eventdispatcher'), $this->get('swiftmailer.mailer.default.spool'));
    }
    protected function getSwiftmailer_Mailer_Default_Transport_RealService()
    {
        $a = new \Swift_Transport_Esmtp_AuthHandler(array(0 => new \Swift_Transport_Esmtp_Auth_CramMd5Authenticator(), 1 => new \Swift_Transport_Esmtp_Auth_LoginAuthenticator(), 2 => new \Swift_Transport_Esmtp_Auth_PlainAuthenticator()));
        $a->setUsername(NULL);
        $a->setPassword(NULL);
        $a->setAuthMode(NULL);
        $this->services['swiftmailer.mailer.default.transport.real'] = $instance = new \Swift_Transport_EsmtpTransport(new \Swift_Transport_StreamBuffer(new \Swift_StreamFilters_StringReplacementFilterFactory()), array(0 => $a), $this->get('swiftmailer.mailer.default.transport.eventdispatcher'));
        $instance->setHost('127.0.0.1');
        $instance->setPort(25);
        $instance->setEncryption(NULL);
        $instance->setTimeout(30);
        $instance->setSourceIp(NULL);
        return $instance;
    }
    protected function getSymfony_FinderService()
    {
        return $this->services['symfony.finder'] = \Symfony\Component\Finder\Finder::create();
    }
    protected function getTemplatingService()
    {
        return $this->services['templating'] = new \Symfony\Bundle\TwigBundle\TwigEngine($this->get('twig'), $this->get('templating.name_parser'), $this->get('templating.locator'));
    }
    protected function getTemplating_FilenameParserService()
    {
        return $this->services['templating.filename_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateFilenameParser();
    }
    protected function getTemplating_Helper_AssetsService()
    {
        return $this->services['templating.helper.assets'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\AssetsHelper($this->get('assets.packages'), array());
    }
    protected function getTemplating_Helper_LogoutUrlService()
    {
        return $this->services['templating.helper.logout_url'] = new \Symfony\Bundle\SecurityBundle\Templating\Helper\LogoutUrlHelper($this->get('security.logout_url_generator'));
    }
    protected function getTemplating_Helper_RouterService()
    {
        return $this->services['templating.helper.router'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper($this->get('router'));
    }
    protected function getTemplating_Helper_SecurityService()
    {
        return $this->services['templating.helper.security'] = new \Symfony\Bundle\SecurityBundle\Templating\Helper\SecurityHelper($this->get('security.authorization_checker', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getTemplating_LoaderService()
    {
        return $this->services['templating.loader'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader($this->get('templating.locator'));
    }
    protected function getTemplating_NameParserService()
    {
        return $this->services['templating.name_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser($this->get('kernel'));
    }
    protected function getTranslation_Dumper_CsvService()
    {
        return $this->services['translation.dumper.csv'] = new \Symfony\Component\Translation\Dumper\CsvFileDumper();
    }
    protected function getTranslation_Dumper_IniService()
    {
        return $this->services['translation.dumper.ini'] = new \Symfony\Component\Translation\Dumper\IniFileDumper();
    }
    protected function getTranslation_Dumper_JsonService()
    {
        return $this->services['translation.dumper.json'] = new \Symfony\Component\Translation\Dumper\JsonFileDumper();
    }
    protected function getTranslation_Dumper_MoService()
    {
        return $this->services['translation.dumper.mo'] = new \Symfony\Component\Translation\Dumper\MoFileDumper();
    }
    protected function getTranslation_Dumper_PhpService()
    {
        return $this->services['translation.dumper.php'] = new \Symfony\Component\Translation\Dumper\PhpFileDumper();
    }
    protected function getTranslation_Dumper_PoService()
    {
        return $this->services['translation.dumper.po'] = new \Symfony\Component\Translation\Dumper\PoFileDumper();
    }
    protected function getTranslation_Dumper_QtService()
    {
        return $this->services['translation.dumper.qt'] = new \Symfony\Component\Translation\Dumper\QtFileDumper();
    }
    protected function getTranslation_Dumper_ResService()
    {
        return $this->services['translation.dumper.res'] = new \Symfony\Component\Translation\Dumper\IcuResFileDumper();
    }
    protected function getTranslation_Dumper_XliffService()
    {
        return $this->services['translation.dumper.xliff'] = new \Symfony\Component\Translation\Dumper\XliffFileDumper();
    }
    protected function getTranslation_Dumper_YmlService()
    {
        return $this->services['translation.dumper.yml'] = new \Symfony\Component\Translation\Dumper\YamlFileDumper();
    }
    protected function getTranslation_ExtractorService()
    {
        $this->services['translation.extractor'] = $instance = new \Symfony\Component\Translation\Extractor\ChainExtractor();
        $instance->addExtractor('php', $this->get('translation.extractor.php'));
        $instance->addExtractor('twig', $this->get('twig.translation.extractor'));
        return $instance;
    }
    protected function getTranslation_Extractor_PhpService()
    {
        return $this->services['translation.extractor.php'] = new \Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor();
    }
    protected function getTranslation_LoaderService()
    {
        $a = $this->get('translation.loader.xliff');
        $this->services['translation.loader'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader();
        $instance->addLoader('php', $this->get('translation.loader.php'));
        $instance->addLoader('yml', $this->get('translation.loader.yml'));
        $instance->addLoader('xlf', $a);
        $instance->addLoader('xliff', $a);
        $instance->addLoader('po', $this->get('translation.loader.po'));
        $instance->addLoader('mo', $this->get('translation.loader.mo'));
        $instance->addLoader('ts', $this->get('translation.loader.qt'));
        $instance->addLoader('csv', $this->get('translation.loader.csv'));
        $instance->addLoader('res', $this->get('translation.loader.res'));
        $instance->addLoader('dat', $this->get('translation.loader.dat'));
        $instance->addLoader('ini', $this->get('translation.loader.ini'));
        $instance->addLoader('json', $this->get('translation.loader.json'));
        return $instance;
    }
    protected function getTranslation_Loader_CsvService()
    {
        return $this->services['translation.loader.csv'] = new \Symfony\Component\Translation\Loader\CsvFileLoader();
    }
    protected function getTranslation_Loader_DatService()
    {
        return $this->services['translation.loader.dat'] = new \Symfony\Component\Translation\Loader\IcuDatFileLoader();
    }
    protected function getTranslation_Loader_IniService()
    {
        return $this->services['translation.loader.ini'] = new \Symfony\Component\Translation\Loader\IniFileLoader();
    }
    protected function getTranslation_Loader_JsonService()
    {
        return $this->services['translation.loader.json'] = new \Symfony\Component\Translation\Loader\JsonFileLoader();
    }
    protected function getTranslation_Loader_MoService()
    {
        return $this->services['translation.loader.mo'] = new \Symfony\Component\Translation\Loader\MoFileLoader();
    }
    protected function getTranslation_Loader_PhpService()
    {
        return $this->services['translation.loader.php'] = new \Symfony\Component\Translation\Loader\PhpFileLoader();
    }
    protected function getTranslation_Loader_PoService()
    {
        return $this->services['translation.loader.po'] = new \Symfony\Component\Translation\Loader\PoFileLoader();
    }
    protected function getTranslation_Loader_QtService()
    {
        return $this->services['translation.loader.qt'] = new \Symfony\Component\Translation\Loader\QtFileLoader();
    }
    protected function getTranslation_Loader_ResService()
    {
        return $this->services['translation.loader.res'] = new \Symfony\Component\Translation\Loader\IcuResFileLoader();
    }
    protected function getTranslation_Loader_XliffService()
    {
        return $this->services['translation.loader.xliff'] = new \Symfony\Component\Translation\Loader\XliffFileLoader();
    }
    protected function getTranslation_Loader_YmlService()
    {
        return $this->services['translation.loader.yml'] = new \Symfony\Component\Translation\Loader\YamlFileLoader();
    }
    protected function getTranslation_WriterService()
    {
        $this->services['translation.writer'] = $instance = new \Symfony\Component\Translation\Writer\TranslationWriter();
        $instance->addDumper('php', $this->get('translation.dumper.php'));
        $instance->addDumper('xlf', $this->get('translation.dumper.xliff'));
        $instance->addDumper('po', $this->get('translation.dumper.po'));
        $instance->addDumper('mo', $this->get('translation.dumper.mo'));
        $instance->addDumper('yml', $this->get('translation.dumper.yml'));
        $instance->addDumper('ts', $this->get('translation.dumper.qt'));
        $instance->addDumper('csv', $this->get('translation.dumper.csv'));
        $instance->addDumper('ini', $this->get('translation.dumper.ini'));
        $instance->addDumper('json', $this->get('translation.dumper.json'));
        $instance->addDumper('res', $this->get('translation.dumper.res'));
        return $instance;
    }
    protected function getTranslator_DefaultService()
    {
        $this->services['translator.default'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\Translator($this, new \Symfony\Component\Translation\MessageSelector(), array('translation.loader.php' => array(0 => 'php'), 'translation.loader.yml' => array(0 => 'yml'), 'translation.loader.xliff' => array(0 => 'xlf', 1 => 'xliff'), 'translation.loader.po' => array(0 => 'po'), 'translation.loader.mo' => array(0 => 'mo'), 'translation.loader.qt' => array(0 => 'ts'), 'translation.loader.csv' => array(0 => 'csv'), 'translation.loader.res' => array(0 => 'res'), 'translation.loader.dat' => array(0 => 'dat'), 'translation.loader.ini' => array(0 => 'ini'), 'translation.loader.json' => array(0 => 'json')), array('cache_dir' => (__DIR__.'/translations'), 'debug' => false, 'resource_files' => array('fr' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fr.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fr.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.fr.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.fr.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.fr.yml'), 5 => ($this->targetDirs[2].'/vendor/friendsofsymfony/oauth-server-bundle/FOS/OAuthServerBundle/Resources/translations/FOSOAuthServerBundle.fr.yml'), 6 => ($this->targetDirs[2].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.fr.xliff')), 'ro' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ro.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ro.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.ro.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.ro.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.ro.yml')), 'ru' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ru.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ru.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.ru.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.ru.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.ru.yml')), 'sr_Latn' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sr_Latn.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sr_Latn.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.sr_Latn.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.sr_Latn.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.sr_Latn.yml')), 'th' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.th.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.th.xlf'), 2 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.th.yml'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.th.yml')), 'de' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.de.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.de.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.de.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.de.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.de.yml'), 5 => ($this->targetDirs[2].'/vendor/friendsofsymfony/oauth-server-bundle/FOS/OAuthServerBundle/Resources/translations/FOSOAuthServerBundle.de.yml'), 6 => ($this->targetDirs[2].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.de.xliff')), 'az' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.az.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.az.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.az.xlf')), 'nb' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.nb.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.nb.xlf'), 2 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.nb.yml'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.nb.yml')), 'es' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.es.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.es.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.es.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.es.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.es.yml'), 5 => ($this->targetDirs[2].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.es.xliff')), 'el' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.el.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.el.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.el.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.el.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.el.yml')), 'zh_TW' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.zh_TW.xlf')), 'sl' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sl.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sl.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.sl.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.sl.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.sl.yml'), 5 => ($this->targetDirs[2].'/vendor/friendsofsymfony/oauth-server-bundle/FOS/OAuthServerBundle/Resources/translations/FOSOAuthServerBundle.sl.yml'), 6 => ($this->targetDirs[2].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.sl.xliff')), 'da' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.da.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.da.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.da.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.da.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.da.yml')), 'nl' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.nl.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.nl.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.nl.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.nl.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.nl.yml'), 5 => ($this->targetDirs[2].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.nl.xliff')), 'mn' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.mn.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.mn.xlf')), 'pt' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pt.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pt.xlf'), 2 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.pt.yml'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.pt.yml')), 'hr' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hr.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hr.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.hr.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.hr.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.hr.yml')), 'bg' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.bg.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.bg.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.bg.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.bg.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.bg.yml')), 'hy' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hy.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hy.xlf')), 'lt' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.lt.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.lt.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.lt.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.lt.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.lt.yml')), 'fa' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fa.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fa.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.fa.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.fa.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.fa.yml')), 'tr' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.tr.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.tr.xlf'), 2 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.tr.yml'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.tr.yml')), 'ar' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ar.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ar.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.ar.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.ar.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.ar.yml')), 'pt_BR' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pt_BR.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pt_BR.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.pt_BR.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.pt_BR.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.pt_BR.yml')), 'zh_CN' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.zh_CN.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.zh_CN.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.zh_CN.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.zh_CN.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.zh_CN.yml')), 'fi' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fi.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fi.xlf'), 2 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.fi.yml'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.fi.yml')), 'sk' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sk.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sk.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.sk.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.sk.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.sk.yml'), 5 => ($this->targetDirs[2].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.sk.xliff')), 'he' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.he.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.he.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.he.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.he.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.he.yml')), 'uk' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.uk.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.uk.xlf'), 2 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.uk.yml'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.uk.yml')), 'hu' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hu.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hu.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.hu.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.hu.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.hu.yml')), 'sv' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sv.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sv.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.sv.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.sv.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.sv.yml')), 'ja' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ja.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ja.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.ja.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.ja.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.ja.yml')), 'it' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.it.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.it.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.it.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.it.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.it.yml')), 'en' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.en.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.en.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.en.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.en.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.en.yml'), 5 => ($this->targetDirs[2].'/vendor/friendsofsymfony/oauth-server-bundle/FOS/OAuthServerBundle/Resources/translations/FOSOAuthServerBundle.en.yml'), 6 => ($this->targetDirs[2].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.en.xliff'), 7 => ($this->targetDirs[2].'/app/Resources/translations/emails.en.yml'), 8 => ($this->targetDirs[2].'/app/Resources/translations/messages.en.yml')), 'no' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.no.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.no.xlf')), 'lb' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.lb.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.lb.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.lb.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.lb.yml')), 'pl' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pl.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pl.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.pl.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.pl.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.pl.yml'), 5 => ($this->targetDirs[2].'/app/Resources/translations/messages.pl.yml'), 6 => ($this->targetDirs[2].'/app/Resources/translations/emails.pl.yml')), 'id' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.id.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.id.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.id.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.id.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.id.yml')), 'af' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.af.xlf')), 'eu' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.eu.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.eu.xlf'), 2 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.eu.yml'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.eu.yml')), 'sr_Cyrl' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sr_Cyrl.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sr_Cyrl.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.sr_Cyrl.xlf')), 'sq' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sq.xlf')), 'ca' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ca.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ca.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.ca.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.ca.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.ca.yml')), 'et' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.et.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.et.xlf'), 2 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.et.yml')), 'cs' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.cs.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.cs.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.cs.xlf'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.cs.yml'), 4 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.cs.yml'), 5 => ($this->targetDirs[2].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.cs.xliff')), 'gl' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.gl.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.gl.xlf'), 2 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.gl.xlf')), 'vi' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.vi.xlf'), 1 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.vi.xlf'), 2 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.vi.yml'), 3 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.vi.yml')), 'cy' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.cy.xlf')), 'lv' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.lv.xlf'), 1 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/FOSUserBundle.lv.yml'), 2 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/translations/validators.lv.yml')), 'pt_PT' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.pt_PT.xlf')), 'ua' => array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.ua.xlf')))), array());
        $instance->setFallbackLocales(array(0 => 'en'));
        return $instance;
    }
    protected function getTranslatorListenerService()
    {
        return $this->services['translator_listener'] = new \Symfony\Component\HttpKernel\EventListener\TranslatorListener($this->get('translator.default'), $this->get('request_stack'));
    }
    protected function getTwigService()
    {
        $a = $this->get('request_stack');
        $b = $this->get('fragment.handler');
        $c = new \Symfony\Bridge\Twig\Extension\HttpFoundationExtension($a);
        $d = new \Symfony\Bridge\Twig\AppVariable();
        $d->setEnvironment('install');
        $d->setDebug(false);
        if ($this->has('security.token_storage')) {
            $d->setTokenStorage($this->get('security.token_storage', ContainerInterface::NULL_ON_INVALID_REFERENCE));
        }
        if ($this->has('request_stack')) {
            $d->setRequestStack($a);
        }
        $d->setContainer($this);
        $this->services['twig'] = $instance = new \Twig_Environment($this->get('twig.loader'), array('debug' => false, 'strict_variables' => false, 'exception_controller' => 'twig.controller.exception:showAction', 'form_themes' => array(0 => 'form_div_layout.html.twig', 1 => 'bootstrap_3_layout.html.twig'), 'autoescape' => 'filename', 'cache' => (__DIR__.'/twig'), 'charset' => 'UTF-8', 'paths' => array(), 'date' => array('format' => 'F j, Y H:i', 'interval_format' => '%d days', 'timezone' => NULL), 'number_format' => array('decimals' => 0, 'decimal_point' => '.', 'thousands_separator' => ',')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\LogoutUrlExtension($this->get('security.logout_url_generator')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\SecurityExtension($this->get('security.authorization_checker', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\TranslationExtension($this->get('translator.default')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\AssetExtension($this->get('assets.packages'), $c));
        $instance->addExtension(new \Symfony\Bundle\TwigBundle\Extension\ActionsExtension($b));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\CodeExtension(NULL, ($this->targetDirs[2].'/app'), 'UTF-8'));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\RoutingExtension($this->get('router')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\YamlExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\StopwatchExtension($this->get('debug.stopwatch', ContainerInterface::NULL_ON_INVALID_REFERENCE), false));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\ExpressionExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\HttpKernelExtension($b));
        $instance->addExtension($c);
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\FormExtension(new \Symfony\Bridge\Twig\Form\TwigRenderer(new \Symfony\Bridge\Twig\Form\TwigRendererEngine(array(0 => 'form_div_layout.html.twig', 1 => 'bootstrap_3_layout.html.twig')), $this->get('security.csrf.token_manager', ContainerInterface::NULL_ON_INVALID_REFERENCE))));
        $instance->addExtension(new \Symfony\Bundle\AsseticBundle\Twig\AsseticExtension($this->get('assetic.asset_factory'), $this->get('templating.name_parser'), false, array(), array(), new \Symfony\Bundle\AsseticBundle\DefaultValueSupplier($this)));
        $instance->addExtension(new \Doctrine\Bundle\DoctrineBundle\Twig\DoctrineExtension());
        $instance->addExtension(new \JMS\Serializer\Twig\SerializerExtension($this->get('jms_serializer')));
        $instance->addExtension($this->get('nelmio_api_doc.twig.extension.extra_markdown'));
        $instance->addExtension(new \SevenTag\Api\AppBundle\Twig\VariableExtension());
        $instance->addExtension(new \SevenTag\Plugin\CrazyEggCustomTemplateBundle\Twig\CrazyEggAccountNumberExtension());
        $instance->addGlobal('app', $d);
        call_user_func(array(new \Symfony\Bundle\TwigBundle\DependencyInjection\Configurator\EnvironmentConfigurator('F j, Y H:i', '%d days', NULL, 0, '.', ','), 'configure'), $instance);
        return $instance;
    }
    protected function getTwig_Controller_ExceptionService()
    {
        return $this->services['twig.controller.exception'] = new \Symfony\Bundle\TwigBundle\Controller\ExceptionController($this->get('twig'), false);
    }
    protected function getTwig_Controller_PreviewErrorService()
    {
        return $this->services['twig.controller.preview_error'] = new \Symfony\Bundle\TwigBundle\Controller\PreviewErrorController($this->get('http_kernel'), 'twig.controller.exception:showAction');
    }
    protected function getTwig_ExceptionListenerService()
    {
        return $this->services['twig.exception_listener'] = new \Symfony\Component\HttpKernel\EventListener\ExceptionListener('twig.controller.exception:showAction', $this->get('monolog.logger.request', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getTwig_LoaderService()
    {
        $this->services['twig.loader'] = $instance = new \Symfony\Bundle\TwigBundle\Loader\FilesystemLoader($this->get('templating.locator'), $this->get('templating.name_parser'));
        $instance->addPath(($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/views'), 'Framework');
        $instance->addPath(($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Bundle/SecurityBundle/Resources/views'), 'Security');
        $instance->addPath(($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/views'), 'Twig');
        $instance->addPath(($this->targetDirs[2].'/vendor/symfony/swiftmailer-bundle/Resources/views'), 'Swiftmailer');
        $instance->addPath(($this->targetDirs[2].'/vendor/doctrine/doctrine-bundle/Resources/views'), 'Doctrine');
        $instance->addPath(($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/views'), 'FOSUser');
        $instance->addPath(($this->targetDirs[2].'/vendor/friendsofsymfony/oauth-server-bundle/FOS/OAuthServerBundle/Resources/views'), 'FOSOAuthServer');
        $instance->addPath(($this->targetDirs[2].'/vendor/liip/monitor-bundle/Resources/views'), 'LiipMonitor');
        $instance->addPath(($this->targetDirs[2].'/vendor/nelmio/api-doc-bundle/Nelmio/ApiDocBundle/Resources/views'), 'NelmioApiDoc');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Api/ContainerBundle/Resources/views'), 'SevenTagContainer');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Api/UserBundle/Resources/views'), 'SevenTagUser');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Api/AppBundle/Resources/views'), 'SevenTagApp');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Plugin/PiwikCustomTemplateBundle/Resources/views'), 'SevenTagPluginPiwikCustomTemplate');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Plugin/ClickTaleCustomTemplateBundle/Resources/views'), 'SevenTagPluginClickTaleCustomTemplate');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Plugin/CrazyEggCustomTemplateBundle/Resources/views'), 'SevenTagPluginCrazyEggCustomTemplate');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Plugin/SentryBundle/Resources/views'), 'SevenTagPluginSentry');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Plugin/FacebookRetargetingPixelCustomTemplateBundle/Resources/views'), 'SevenTagPluginFacebookRetargetingPixelCustomTemplate');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Plugin/SalesManagoCustomTemplateBundle/Resources/views'), 'SevenTagPluginSalesManagoCustomTemplate');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Plugin/MarketoCustomTemplateBundle/Resources/views'), 'SevenTagPluginMarketoCustomTemplate');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Plugin/GoogleAdwordsCustomTemplateBundle/Resources/views'), 'SevenTagPluginGoogleAdwordsCustomTemplate');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Plugin/QualarooCustomTemplateBundle/Resources/views'), 'SevenTagPluginQualarooCustomTemplate');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/Plugin/GoogleAnalyticsCustomTemplateBundle/Resources/views'), 'SevenTagPluginGoogleAnalyticsCustomTemplate');
        $instance->addPath(($this->targetDirs[2].'/src/SevenTag/InstallerBundle/Resources/views'), 'SevenTagInstaller');
        $instance->addPath(($this->targetDirs[2].'/app/Resources/views'));
        $instance->addPath(($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Bridge/Twig/Resources/views/Form'));
        return $instance;
    }
    protected function getTwig_ProfileService()
    {
        return $this->services['twig.profile'] = new \Twig_Profiler_Profile();
    }
    protected function getTwig_Translation_ExtractorService()
    {
        return $this->services['twig.translation.extractor'] = new \Symfony\Bridge\Twig\Translation\TwigExtractor($this->get('twig'));
    }
    protected function getUriSignerService()
    {
        return $this->services['uri_signer'] = new \Symfony\Component\HttpKernel\UriSigner('&-2_W\\$/N=auNLuE?NM6:G:w-V{5,_');
    }
    protected function getValidatorService()
    {
        return $this->services['validator'] = $this->get('validator.builder')->getValidator();
    }
    protected function getValidator_BuilderService()
    {
        $this->services['validator.builder'] = $instance = \Symfony\Component\Validator\Validation::createValidatorBuilder();
        $instance->setConstraintValidatorFactory(new \Symfony\Bundle\FrameworkBundle\Validator\ConstraintValidatorFactory($this, array('validator.expression' => 'validator.expression', 'Symfony\\Component\\Validator\\Constraints\\EmailValidator' => 'validator.email', 'security.validator.user_password' => 'security.validator.user_password', 'doctrine.orm.validator.unique' => 'doctrine.orm.validator.unique', 'seven_tag_container_grant_permissions_user' => 'seven_tag_container.validator.grant_permissions_user', 'seven_tag_tag_template_validator' => 'seven_tag_tag.validator.tag_template_validator', 'seven_tag_user_roles_validator' => 'seven_tag_user.validator.roles_validator', 'trigger_type_validator' => 'seven_tag.validator.trigger_type_validator', 'trigger_strategy_validator' => 'seven_tag.validator.trigger_strategy_validator')));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setTranslationDomain('validators');
        $instance->addXmlMappings(array(0 => ($this->targetDirs[2].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/config/validation.xml'), 1 => ($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/Resources/config/validation.xml'), 2 => ($this->targetDirs[2].'/vendor/friendsofsymfony/oauth-server-bundle/FOS/OAuthServerBundle/Resources/config/validation.xml')));
        $instance->addYamlMappings(array(0 => ($this->targetDirs[2].'/src/SevenTag/Api/ContainerBundle/Resources/config/validation.yml'), 1 => ($this->targetDirs[2].'/src/SevenTag/Api/TagBundle/Resources/config/validation.yml'), 2 => ($this->targetDirs[2].'/src/SevenTag/Api/UserBundle/Resources/config/validation.yml'), 3 => ($this->targetDirs[2].'/src/SevenTag/Api/SecurityBundle/Resources/config/validation.yml'), 4 => ($this->targetDirs[2].'/src/SevenTag/Api/TriggerBundle/Resources/config/validation.yml'), 5 => ($this->targetDirs[2].'/src/SevenTag/Api/VariableBundle/Resources/config/validation.yml')));
        $instance->enableAnnotationMapping($this->get('annotation_reader'));
        $instance->addMethodMapping('loadValidatorMetadata');
        $instance->addObjectInitializers(array(0 => $this->get('doctrine.orm.validator_initializer'), 1 => new \FOS\UserBundle\Validator\Initializer($this->get('fos_user.user_manager'))));
        $instance->addXmlMapping(($this->targetDirs[2].'/vendor/friendsofsymfony/user-bundle/DependencyInjection/Compiler/../../Resources/config/storage-validation/orm.xml'));
        return $instance;
    }
    protected function getValidator_EmailService()
    {
        return $this->services['validator.email'] = new \Symfony\Component\Validator\Constraints\EmailValidator(false);
    }
    protected function getValidator_ExpressionService()
    {
        return $this->services['validator.expression'] = new \Symfony\Component\Validator\Constraints\ExpressionValidator($this->get('property_accessor'));
    }
    protected function getAssetic_AssetFactoryService()
    {
        return $this->services['assetic.asset_factory'] = new \Symfony\Bundle\AsseticBundle\Factory\AssetFactory($this->get('kernel'), $this, $this->getParameterBag(), ($this->targetDirs[2].'/app/../web'), false);
    }
    protected function getControllerNameConverterService()
    {
        return $this->services['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($this->get('kernel'));
    }
    protected function getFosOauthServer_EntityManagerService()
    {
        return $this->services['fos_oauth_server.entity_manager'] = $this->get('doctrine')->getManager(NULL);
    }
    protected function getFosOauthServer_Security_EntryPointService()
    {
        return $this->services['fos_oauth_server.security.entry_point'] = new \FOS\OAuthServerBundle\Security\EntryPoint\OAuthEntryPoint($this->get('fos_oauth_server.server'));
    }
    protected function getFosUser_EntityManagerService()
    {
        return $this->services['fos_user.entity_manager'] = $this->get('doctrine')->getManager(NULL);
    }
    protected function getJmsSerializer_MetadataFactoryService()
    {
        $this->services['jms_serializer.metadata_factory'] = $instance = new \Metadata\MetadataFactory(new \Metadata\Driver\LazyLoadingDriver($this, 'jms_serializer.metadata_driver'), 'Metadata\\ClassHierarchyMetadata', false);
        $instance->setCache(new \Metadata\Cache\FileCache((__DIR__.'/jms_serializer')));
        return $instance;
    }
    protected function getJmsSerializer_UnserializeObjectConstructorService()
    {
        return $this->services['jms_serializer.unserialize_object_constructor'] = new \JMS\Serializer\Construction\UnserializeObjectConstructor();
    }
    protected function getRouter_RequestContextService()
    {
        return $this->services['router.request_context'] = new \Symfony\Component\Routing\RequestContext('', 'GET', 'localhost', 'http', 80, 443);
    }
    protected function getSecurity_Access_DecisionManagerService()
    {
        $a = $this->get('security.authentication.trust_resolver');
        $b = $this->get('security.role_hierarchy');
        return $this->services['security.access.decision_manager'] = new \Symfony\Component\Security\Core\Authorization\AccessDecisionManager(array(0 => new \SevenTag\Api\SecurityBundle\Voter\ContainerPermissionsVoter($this->get('seven_tag_container.repository.container_permissions_repository')), 1 => new \Symfony\Component\Security\Core\Authorization\Voter\ExpressionVoter(new \Symfony\Component\Security\Core\Authorization\ExpressionLanguage(), $a, $b), 2 => new \Symfony\Component\Security\Core\Authorization\Voter\RoleHierarchyVoter($b), 3 => new \Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter($a)), 'affirmative', false, true);
    }
    protected function getSecurity_AccessListenerService()
    {
        return $this->services['security.access_listener'] = new \Symfony\Component\Security\Http\Firewall\AccessListener($this->get('security.token_storage'), $this->get('security.access.decision_manager'), $this->get('security.access_map'), $this->get('security.authentication.manager'));
    }
    protected function getSecurity_AccessMapService()
    {
        $this->services['security.access_map'] = $instance = new \Symfony\Component\Security\Http\AccessMap();
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/containers/(\\d+)/noscript.html'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/containers/tagtree/(\\d+).jsonp'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/doc'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/oauth'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/translations'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/reset-password'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/containers/(\\d+).js'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/users/me', NULL, array(0 => 'PUT', 1 => 'GET')), array(0 => 'ROLE_USER'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/users/me/change-password', NULL, array(0 => 'POST')), array(0 => 'ROLE_USER'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/users/(\\d+)/reset-password', NULL, array(0 => 'POST')), array(0 => 'ROLE_SUPER_ADMIN'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/users/(\\d+)', NULL, array(0 => 'DELETE', 1 => 'PUT', 2 => 'GET')), array(0 => 'ROLE_SUPER_ADMIN'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/users', NULL, array(0 => 'GET', 1 => 'POST')), array(0 => 'ROLE_SUPER_ADMIN'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/integration/(\\d+)'), array(0 => 'ROLE_SUPER_ADMIN'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/integration'), array(0 => 'ROLE_SUPER_ADMIN'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api/containers$', NULL, array(0 => 'POST')), array(0 => 'ROLE_CONTAINERS_CREATE'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/api'), array(0 => 'ROLE_USER'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/admin-tools'), array(0 => 'ROLE_SUPER_ADMIN'), NULL);
        return $instance;
    }
    protected function getSecurity_Authentication_ManagerService()
    {
        $a = $this->get('fos_user.user_manager');
        $b = $this->get('fos_oauth_server.server');
        $c = $this->get('security.user_checker');
        $d = new \FOS\UserBundle\Security\EmailUserProvider($a);
        $this->services['security.authentication.manager'] = $instance = new \Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager(array(0 => new \FOS\OAuthServerBundle\Security\Authentication\Provider\OAuthProvider($d, $b, $c), 1 => new \Symfony\Component\Security\Core\Authentication\Provider\AnonymousAuthenticationProvider('56e6bf5da527c6.43877242'), 2 => new \FOS\OAuthServerBundle\Security\Authentication\Provider\OAuthProvider($d, $b, $c), 3 => new \Symfony\Component\Security\Core\Authentication\Provider\AnonymousAuthenticationProvider('56e6bf5da527c6.43877242')), true);
        $instance->setEventDispatcher($this->get('event_dispatcher'));
        return $instance;
    }
    protected function getSecurity_Authentication_TrustResolverService()
    {
        return $this->services['security.authentication.trust_resolver'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver('Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken', 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken');
    }
    protected function getSecurity_ChannelListenerService()
    {
        return $this->services['security.channel_listener'] = new \Symfony\Component\Security\Http\Firewall\ChannelListener($this->get('security.access_map'), new \Symfony\Component\Security\Http\EntryPoint\RetryAuthenticationEntryPoint(80, 443), $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSecurity_HttpUtilsService()
    {
        $a = $this->get('router', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        return $this->services['security.http_utils'] = new \Symfony\Component\Security\Http\HttpUtils($a, $a);
    }
    protected function getSecurity_LogoutUrlGeneratorService()
    {
        return $this->services['security.logout_url_generator'] = new \Symfony\Component\Security\Http\Logout\LogoutUrlGenerator($this->get('request_stack', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('router', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('security.token_storage', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSecurity_RoleHierarchyService()
    {
        return $this->services['security.role_hierarchy'] = new \Symfony\Component\Security\Core\Role\RoleHierarchy(array('ROLE_CONTAINERS_CREATE' => array(), 'ROLE_SUPER_ADMIN' => array(0 => 'ROLE_USER', 1 => 'ROLE_CONTAINERS_CREATE'), 'ROLE_API' => array(0 => 'ROLE_USER')));
    }
    protected function getSecurity_UserCheckerService()
    {
        return $this->services['security.user_checker'] = new \Symfony\Component\Security\Core\User\UserChecker();
    }
    protected function getSession_Storage_MetadataBagService()
    {
        return $this->services['session.storage.metadata_bag'] = new \Symfony\Component\HttpFoundation\Session\Storage\MetadataBag('_sf2_meta', '0');
    }
    protected function getSwiftmailer_Mailer_Default_Transport_EventdispatcherService()
    {
        return $this->services['swiftmailer.mailer.default.transport.eventdispatcher'] = new \Swift_Events_SimpleEventDispatcher();
    }
    protected function getTemplating_LocatorService()
    {
        return $this->services['templating.locator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator($this->get('file_locator'), __DIR__);
    }
    public function getParameter($name)
    {
        $name = strtolower($name);
        if (!(isset($this->parameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        return $this->parameters[$name];
    }
    public function hasParameter($name)
    {
        $name = strtolower($name);
        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters);
    }
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }
        return $this->parameterBag;
    }
    protected function getDefaultParameters()
    {
        return array(
            'kernel.root_dir' => ($this->targetDirs[2].'/app'),
            'kernel.environment' => 'install',
            'kernel.debug' => false,
            'kernel.name' => 'app',
            'kernel.cache_dir' => __DIR__,
            'kernel.logs_dir' => ($this->targetDirs[1].'/logs'),
            'kernel.bundles' => array(
                'FrameworkBundle' => 'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
                'SecurityBundle' => 'Symfony\\Bundle\\SecurityBundle\\SecurityBundle',
                'TwigBundle' => 'Symfony\\Bundle\\TwigBundle\\TwigBundle',
                'MonologBundle' => 'Symfony\\Bundle\\MonologBundle\\MonologBundle',
                'SwiftmailerBundle' => 'Symfony\\Bundle\\SwiftmailerBundle\\SwiftmailerBundle',
                'AsseticBundle' => 'Symfony\\Bundle\\AsseticBundle\\AsseticBundle',
                'SensioFrameworkExtraBundle' => 'Sensio\\Bundle\\FrameworkExtraBundle\\SensioFrameworkExtraBundle',
                'DoctrineBundle' => 'Doctrine\\Bundle\\DoctrineBundle\\DoctrineBundle',
                'DoctrineMigrationsBundle' => 'Doctrine\\Bundle\\MigrationsBundle\\DoctrineMigrationsBundle',
                'FOSRestBundle' => 'FOS\\RestBundle\\FOSRestBundle',
                'FOSUserBundle' => 'FOS\\UserBundle\\FOSUserBundle',
                'FOSOAuthServerBundle' => 'FOS\\OAuthServerBundle\\FOSOAuthServerBundle',
                'FOSHttpCacheBundle' => 'FOS\\HttpCacheBundle\\FOSHttpCacheBundle',
                'KnpGaufretteBundle' => 'Knp\\Bundle\\GaufretteBundle\\KnpGaufretteBundle',
                'JMSSerializerBundle' => 'JMS\\SerializerBundle\\JMSSerializerBundle',
                'LiipMonitorBundle' => 'Liip\\MonitorBundle\\LiipMonitorBundle',
                'NelmioApiDocBundle' => 'Nelmio\\ApiDocBundle\\NelmioApiDocBundle',
                'StofDoctrineExtensionsBundle' => 'Stof\\DoctrineExtensionsBundle\\StofDoctrineExtensionsBundle',
                'SonataNotificationBundle' => 'Sonata\\NotificationBundle\\SonataNotificationBundle',
                'SevenTagContainerBundle' => 'SevenTag\\Api\\ContainerBundle\\SevenTagContainerBundle',
                'SevenTagTagBundle' => 'SevenTag\\Api\\TagBundle\\SevenTagTagBundle',
                'SevenTagTestBundle' => 'SevenTag\\Api\\TestBundle\\SevenTagTestBundle',
                'SevenTagUserBundle' => 'SevenTag\\Api\\UserBundle\\SevenTagUserBundle',
                'SevenTagSecurityBundle' => 'SevenTag\\Api\\SecurityBundle\\SevenTagSecurityBundle',
                'SevenTagTriggerBundle' => 'SevenTag\\Api\\TriggerBundle\\SevenTagTriggerBundle',
                'SevenTagAppBundle' => 'SevenTag\\Api\\AppBundle\\SevenTagAppBundle',
                'SevenTagVariableBundle' => 'SevenTag\\Api\\VariableBundle\\SevenTagVariableBundle',
                'SevenTagPluginPiwikCustomTemplateBundle' => 'SevenTag\\Plugin\\PiwikCustomTemplateBundle\\SevenTagPluginPiwikCustomTemplateBundle',
                'SevenTagPluginClickTaleCustomTemplateBundle' => 'SevenTag\\Plugin\\ClickTaleCustomTemplateBundle\\SevenTagPluginClickTaleCustomTemplateBundle',
                'SevenTagPluginCrazyEggCustomTemplateBundle' => 'SevenTag\\Plugin\\CrazyEggCustomTemplateBundle\\SevenTagPluginCrazyEggCustomTemplateBundle',
                'SevenTagPluginSentryBundle' => 'SevenTag\\Plugin\\SentryBundle\\SevenTagPluginSentryBundle',
                'SevenTagPluginFacebookRetargetingPixelCustomTemplateBundle' => 'SevenTag\\Plugin\\FacebookRetargetingPixelCustomTemplateBundle\\SevenTagPluginFacebookRetargetingPixelCustomTemplateBundle',
                'SevenTagPluginSalesManagoCustomTemplateBundle' => 'SevenTag\\Plugin\\SalesManagoCustomTemplateBundle\\SevenTagPluginSalesManagoCustomTemplateBundle',
                'SevenTagPluginMarketoCustomTemplateBundle' => 'SevenTag\\Plugin\\MarketoCustomTemplateBundle\\SevenTagPluginMarketoCustomTemplateBundle',
                'SevenTagPluginGoogleAdwordsCustomTemplateBundle' => 'SevenTag\\Plugin\\GoogleAdwordsCustomTemplateBundle\\SevenTagPluginGoogleAdwordsCustomTemplateBundle',
                'SevenTagPluginQualarooCustomTemplateBundle' => 'SevenTag\\Plugin\\QualarooCustomTemplateBundle\\SevenTagPluginQualarooCustomTemplateBundle',
                'SevenTagPluginGoogleAnalyticsCustomTemplateBundle' => 'SevenTag\\Plugin\\GoogleAnalyticsCustomTemplateBundle\\SevenTagPluginGoogleAnalyticsCustomTemplateBundle',
                'SevenTagInstallerBundle' => 'SevenTag\\InstallerBundle\\SevenTagInstallerBundle',
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'appInstallProjectContainer',
            'seventag_domain' => NULL,
            'mailer_sender' => 'example@example.com',
            'database_driver' => 'pdo_mysql',
            'database_host' => 'localhost',
            'database_port' => NULL,
            'database_name' => 'seventag',
            'database_user' => 'root',
            'database_password' => NULL,
            'mailer_transport' => 'smtp',
            'mailer_host' => '127.0.0.1',
            'mailer_user' => NULL,
            'mailer_password' => NULL,
            'mailer_spool' => array(
                'type' => 'file',
                'path' => ($this->targetDirs[2].'/app/spool'),
            ),
            'mailer_delivery_address' => NULL,
            'locale' => 'en',
            'secret' => '&-2_W\\$/N=auNLuE?NM6:G:w-V{5,_',
            'datetime_default_format' => 'Y-m-d\\TH:i:sO',
            'seventag_licence_template_path' => ($this->targetDirs[2].'/app/Resources/container-lib/licence.dist'),
            'seventag_tagtree_template_path' => ($this->targetDirs[2].'/app/Resources/container-lib/tagTree.js.dist'),
            'seventag_containerjs_config_path' => ($this->targetDirs[2].'/app/Resources/container-lib/containerjsConfig.js.dist'),
            'seventag_javascript_library_path' => ($this->targetDirs[2].'/app/Resources/container-lib/library.js.dist'),
            'seventag_javascript_debugger_path' => ($this->targetDirs[2].'/app/../web/container-debugger/debug.js'),
            'seventag_javascript_debugger_hostname' => 'http://yourhostname.com',
            'seventag_javascript_cache_dir' => ($this->targetDirs[2].'/app/../web/containers'),
            'seventag_javascript_bootstrap_path' => ($this->targetDirs[2].'/app/Resources/container-lib/bootstrap.js.dist'),
            'sentry_dsn' => NULL,
            'web_dir' => ($this->targetDirs[2].'/app/../web'),
            'seventag_noscript_backend' => 'sonata.notification.backend.runtime',
            'seventag_javascript_url_template' => NULL,
            'controller_resolver.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerResolver',
            'controller_name_converter.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerNameParser',
            'response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener',
            'streamed_response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener',
            'locale_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener',
            'event_dispatcher.class' => 'Symfony\\Component\\EventDispatcher\\ContainerAwareEventDispatcher',
            'http_kernel.class' => 'Symfony\\Component\\HttpKernel\\DependencyInjection\\ContainerAwareHttpKernel',
            'filesystem.class' => 'Symfony\\Component\\Filesystem\\Filesystem',
            'cache_warmer.class' => 'Symfony\\Component\\HttpKernel\\CacheWarmer\\CacheWarmerAggregate',
            'cache_clearer.class' => 'Symfony\\Component\\HttpKernel\\CacheClearer\\ChainCacheClearer',
            'file_locator.class' => 'Symfony\\Component\\HttpKernel\\Config\\FileLocator',
            'uri_signer.class' => 'Symfony\\Component\\HttpKernel\\UriSigner',
            'request_stack.class' => 'Symfony\\Component\\HttpFoundation\\RequestStack',
            'fragment.handler.class' => 'Symfony\\Component\\HttpKernel\\DependencyInjection\\LazyLoadingFragmentHandler',
            'fragment.renderer.inline.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\InlineFragmentRenderer',
            'fragment.renderer.hinclude.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\HIncludeFragmentRenderer',
            'fragment.renderer.hinclude.global_template' => NULL,
            'fragment.renderer.esi.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\EsiFragmentRenderer',
            'fragment.path' => '/_fragment',
            'translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\Translator',
            'translator.identity.class' => 'Symfony\\Component\\Translation\\IdentityTranslator',
            'translator.selector.class' => 'Symfony\\Component\\Translation\\MessageSelector',
            'translation.loader.php.class' => 'Symfony\\Component\\Translation\\Loader\\PhpFileLoader',
            'translation.loader.yml.class' => 'Symfony\\Component\\Translation\\Loader\\YamlFileLoader',
            'translation.loader.xliff.class' => 'Symfony\\Component\\Translation\\Loader\\XliffFileLoader',
            'translation.loader.po.class' => 'Symfony\\Component\\Translation\\Loader\\PoFileLoader',
            'translation.loader.mo.class' => 'Symfony\\Component\\Translation\\Loader\\MoFileLoader',
            'translation.loader.qt.class' => 'Symfony\\Component\\Translation\\Loader\\QtFileLoader',
            'translation.loader.csv.class' => 'Symfony\\Component\\Translation\\Loader\\CsvFileLoader',
            'translation.loader.res.class' => 'Symfony\\Component\\Translation\\Loader\\IcuResFileLoader',
            'translation.loader.dat.class' => 'Symfony\\Component\\Translation\\Loader\\IcuDatFileLoader',
            'translation.loader.ini.class' => 'Symfony\\Component\\Translation\\Loader\\IniFileLoader',
            'translation.loader.json.class' => 'Symfony\\Component\\Translation\\Loader\\JsonFileLoader',
            'translation.dumper.php.class' => 'Symfony\\Component\\Translation\\Dumper\\PhpFileDumper',
            'translation.dumper.xliff.class' => 'Symfony\\Component\\Translation\\Dumper\\XliffFileDumper',
            'translation.dumper.po.class' => 'Symfony\\Component\\Translation\\Dumper\\PoFileDumper',
            'translation.dumper.mo.class' => 'Symfony\\Component\\Translation\\Dumper\\MoFileDumper',
            'translation.dumper.yml.class' => 'Symfony\\Component\\Translation\\Dumper\\YamlFileDumper',
            'translation.dumper.qt.class' => 'Symfony\\Component\\Translation\\Dumper\\QtFileDumper',
            'translation.dumper.csv.class' => 'Symfony\\Component\\Translation\\Dumper\\CsvFileDumper',
            'translation.dumper.ini.class' => 'Symfony\\Component\\Translation\\Dumper\\IniFileDumper',
            'translation.dumper.json.class' => 'Symfony\\Component\\Translation\\Dumper\\JsonFileDumper',
            'translation.dumper.res.class' => 'Symfony\\Component\\Translation\\Dumper\\IcuResFileDumper',
            'translation.extractor.php.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\PhpExtractor',
            'translation.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\TranslationLoader',
            'translation.extractor.class' => 'Symfony\\Component\\Translation\\Extractor\\ChainExtractor',
            'translation.writer.class' => 'Symfony\\Component\\Translation\\Writer\\TranslationWriter',
            'property_accessor.class' => 'Symfony\\Component\\PropertyAccess\\PropertyAccessor',
            'kernel.secret' => '&-2_W\\$/N=auNLuE?NM6:G:w-V{5,_',
            'kernel.http_method_override' => true,
            'kernel.trusted_hosts' => array(
            ),
            'kernel.trusted_proxies' => array(
            ),
            'kernel.default_locale' => 'en',
            'session.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Session',
            'session.flashbag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Flash\\FlashBag',
            'session.attribute_bag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Attribute\\AttributeBag',
            'session.storage.metadata_bag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\MetadataBag',
            'session.metadata.storage_key' => '_sf2_meta',
            'session.storage.native.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\NativeSessionStorage',
            'session.storage.php_bridge.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\PhpBridgeSessionStorage',
            'session.storage.mock_file.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\MockFileSessionStorage',
            'session.handler.native_file.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\Handler\\NativeFileSessionHandler',
            'session.handler.write_check.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\Handler\\WriteCheckSessionHandler',
            'session_listener.class' => 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\SessionListener',
            'session.storage.options' => array(
                'gc_probability' => 1,
            ),
            'session.save_path' => (__DIR__.'/sessions'),
            'session.metadata.update_threshold' => '0',
            'security.secure_random.class' => 'Symfony\\Component\\Security\\Core\\Util\\SecureRandom',
            'form.resolved_type_factory.class' => 'Symfony\\Component\\Form\\ResolvedFormTypeFactory',
            'form.registry.class' => 'Symfony\\Component\\Form\\FormRegistry',
            'form.factory.class' => 'Symfony\\Component\\Form\\FormFactory',
            'form.extension.class' => 'Symfony\\Component\\Form\\Extension\\DependencyInjection\\DependencyInjectionExtension',
            'form.type_guesser.validator.class' => 'Symfony\\Component\\Form\\Extension\\Validator\\ValidatorTypeGuesser',
            'form.type_extension.form.request_handler.class' => 'Symfony\\Component\\Form\\Extension\\HttpFoundation\\HttpFoundationRequestHandler',
            'form.type_extension.csrf.enabled' => true,
            'form.type_extension.csrf.field_name' => '_token',
            'security.csrf.token_generator.class' => 'Symfony\\Component\\Security\\Csrf\\TokenGenerator\\UriSafeTokenGenerator',
            'security.csrf.token_storage.class' => 'Symfony\\Component\\Security\\Csrf\\TokenStorage\\SessionTokenStorage',
            'security.csrf.token_manager.class' => 'Symfony\\Component\\Security\\Csrf\\CsrfTokenManager',
            'templating.engine.delegating.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\DelegatingEngine',
            'templating.name_parser.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\TemplateNameParser',
            'templating.filename_parser.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\TemplateFilenameParser',
            'templating.cache_warmer.template_paths.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplatePathsCacheWarmer',
            'templating.locator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\TemplateLocator',
            'templating.loader.filesystem.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\FilesystemLoader',
            'templating.loader.cache.class' => 'Symfony\\Component\\Templating\\Loader\\CacheLoader',
            'templating.loader.chain.class' => 'Symfony\\Component\\Templating\\Loader\\ChainLoader',
            'templating.finder.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplateFinder',
            'templating.helper.assets.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\AssetsHelper',
            'templating.helper.router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\RouterHelper',
            'templating.helper.code.file_link_format' => NULL,
            'templating.loader.cache.path' => NULL,
            'templating.engines' => array(
                0 => 'twig',
            ),
            'validator.class' => 'Symfony\\Component\\Validator\\Validator\\ValidatorInterface',
            'validator.builder.class' => 'Symfony\\Component\\Validator\\ValidatorBuilderInterface',
            'validator.builder.factory.class' => 'Symfony\\Component\\Validator\\Validation',
            'validator.mapping.cache.apc.class' => 'Symfony\\Component\\Validator\\Mapping\\Cache\\ApcCache',
            'validator.mapping.cache.prefix' => '',
            'validator.validator_factory.class' => 'Symfony\\Bundle\\FrameworkBundle\\Validator\\ConstraintValidatorFactory',
            'validator.expression.class' => 'Symfony\\Component\\Validator\\Constraints\\ExpressionValidator',
            'validator.email.class' => 'Symfony\\Component\\Validator\\Constraints\\EmailValidator',
            'validator.translation_domain' => 'validators',
            'validator.api' => '2.5-bc',
            'fragment.listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\FragmentListener',
            'translator.logging' => false,
            'data_collector.templates' => array(
            ),
            'router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\Router',
            'router.request_context.class' => 'Symfony\\Component\\Routing\\RequestContext',
            'routing.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\DelegatingLoader',
            'routing.resolver.class' => 'Symfony\\Component\\Config\\Loader\\LoaderResolver',
            'routing.loader.xml.class' => 'Symfony\\Component\\Routing\\Loader\\XmlFileLoader',
            'routing.loader.yml.class' => 'Symfony\\Component\\Routing\\Loader\\YamlFileLoader',
            'routing.loader.php.class' => 'Symfony\\Component\\Routing\\Loader\\PhpFileLoader',
            'router.options.generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper',
            'router.options.matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper',
            'router.cache_warmer.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\RouterCacheWarmer',
            'router.options.matcher.cache_class' => 'appInstallUrlMatcher',
            'router.options.generator.cache_class' => 'appInstallUrlGenerator',
            'router_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener',
            'router.request_context.host' => 'localhost',
            'router.request_context.scheme' => 'http',
            'router.request_context.base_url' => '',
            'router.resource' => ($this->targetDirs[2].'/app/config/routing_install.yml'),
            'router.cache_class_prefix' => 'appInstall',
            'request_listener.http_port' => 80,
            'request_listener.https_port' => 443,
            'annotations.reader.class' => 'Doctrine\\Common\\Annotations\\AnnotationReader',
            'annotations.cached_reader.class' => 'Doctrine\\Common\\Annotations\\CachedReader',
            'annotations.file_cache_reader.class' => 'Doctrine\\Common\\Annotations\\FileCacheReader',
            'debug.debug_handlers_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\DebugHandlersListener',
            'debug.stopwatch.class' => 'Symfony\\Component\\Stopwatch\\Stopwatch',
            'debug.error_handler.throw_at' => 0,
            'security.context.class' => 'Symfony\\Component\\Security\\Core\\SecurityContext',
            'security.user_checker.class' => 'Symfony\\Component\\Security\\Core\\User\\UserChecker',
            'security.encoder_factory.generic.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\EncoderFactory',
            'security.encoder.digest.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\MessageDigestPasswordEncoder',
            'security.encoder.plain.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\PlaintextPasswordEncoder',
            'security.encoder.pbkdf2.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\Pbkdf2PasswordEncoder',
            'security.encoder.bcrypt.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\BCryptPasswordEncoder',
            'security.user.provider.in_memory.class' => 'Symfony\\Component\\Security\\Core\\User\\InMemoryUserProvider',
            'security.user.provider.in_memory.user.class' => 'Symfony\\Component\\Security\\Core\\User\\User',
            'security.user.provider.chain.class' => 'Symfony\\Component\\Security\\Core\\User\\ChainUserProvider',
            'security.authentication.trust_resolver.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationTrustResolver',
            'security.authentication.trust_resolver.anonymous_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken',
            'security.authentication.trust_resolver.rememberme_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken',
            'security.authentication.manager.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationProviderManager',
            'security.authentication.session_strategy.class' => 'Symfony\\Component\\Security\\Http\\Session\\SessionAuthenticationStrategy',
            'security.access.decision_manager.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\AccessDecisionManager',
            'security.access.simple_role_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\RoleVoter',
            'security.access.authenticated_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\AuthenticatedVoter',
            'security.access.role_hierarchy_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\RoleHierarchyVoter',
            'security.access.expression_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\ExpressionVoter',
            'security.firewall.class' => 'Symfony\\Component\\Security\\Http\\Firewall',
            'security.firewall.map.class' => 'Symfony\\Bundle\\SecurityBundle\\Security\\FirewallMap',
            'security.firewall.context.class' => 'Symfony\\Bundle\\SecurityBundle\\Security\\FirewallContext',
            'security.matcher.class' => 'Symfony\\Component\\HttpFoundation\\RequestMatcher',
            'security.expression_matcher.class' => 'Symfony\\Component\\HttpFoundation\\ExpressionRequestMatcher',
            'security.role_hierarchy.class' => 'Symfony\\Component\\Security\\Core\\Role\\RoleHierarchy',
            'security.http_utils.class' => 'Symfony\\Component\\Security\\Http\\HttpUtils',
            'security.validator.user_password.class' => 'Symfony\\Component\\Security\\Core\\Validator\\Constraints\\UserPasswordValidator',
            'security.expression_language.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\ExpressionLanguage',
            'security.authentication.retry_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\RetryAuthenticationEntryPoint',
            'security.channel_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ChannelListener',
            'security.authentication.form_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\FormAuthenticationEntryPoint',
            'security.authentication.listener.form.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\UsernamePasswordFormAuthenticationListener',
            'security.authentication.listener.simple_form.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\SimpleFormAuthenticationListener',
            'security.authentication.listener.simple_preauth.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\SimplePreAuthenticationListener',
            'security.authentication.listener.basic.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\BasicAuthenticationListener',
            'security.authentication.basic_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\BasicAuthenticationEntryPoint',
            'security.authentication.listener.digest.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\DigestAuthenticationListener',
            'security.authentication.digest_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\DigestAuthenticationEntryPoint',
            'security.authentication.listener.x509.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\X509AuthenticationListener',
            'security.authentication.listener.anonymous.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\AnonymousAuthenticationListener',
            'security.authentication.switchuser_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\SwitchUserListener',
            'security.logout_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\LogoutListener',
            'security.logout.handler.session.class' => 'Symfony\\Component\\Security\\Http\\Logout\\SessionLogoutHandler',
            'security.logout.handler.cookie_clearing.class' => 'Symfony\\Component\\Security\\Http\\Logout\\CookieClearingLogoutHandler',
            'security.logout.success_handler.class' => 'Symfony\\Component\\Security\\Http\\Logout\\DefaultLogoutSuccessHandler',
            'security.access_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\AccessListener',
            'security.access_map.class' => 'Symfony\\Component\\Security\\Http\\AccessMap',
            'security.exception_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ExceptionListener',
            'security.context_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ContextListener',
            'security.authentication.provider.dao.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\DaoAuthenticationProvider',
            'security.authentication.provider.simple.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\SimpleAuthenticationProvider',
            'security.authentication.provider.pre_authenticated.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\PreAuthenticatedAuthenticationProvider',
            'security.authentication.provider.anonymous.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\AnonymousAuthenticationProvider',
            'security.authentication.success_handler.class' => 'Symfony\\Component\\Security\\Http\\Authentication\\DefaultAuthenticationSuccessHandler',
            'security.authentication.failure_handler.class' => 'Symfony\\Component\\Security\\Http\\Authentication\\DefaultAuthenticationFailureHandler',
            'security.authentication.simple_success_failure_handler.class' => 'Symfony\\Component\\Security\\Http\\Authentication\\SimpleAuthenticationHandler',
            'security.authentication.provider.rememberme.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\RememberMeAuthenticationProvider',
            'security.authentication.listener.rememberme.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\RememberMeListener',
            'security.rememberme.token.provider.in_memory.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\RememberMe\\InMemoryTokenProvider',
            'security.authentication.rememberme.services.persistent.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\PersistentTokenBasedRememberMeServices',
            'security.authentication.rememberme.services.simplehash.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\TokenBasedRememberMeServices',
            'security.rememberme.response_listener.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\ResponseListener',
            'templating.helper.logout_url.class' => 'Symfony\\Bundle\\SecurityBundle\\Templating\\Helper\\LogoutUrlHelper',
            'templating.helper.security.class' => 'Symfony\\Bundle\\SecurityBundle\\Templating\\Helper\\SecurityHelper',
            'twig.extension.logout_url.class' => 'Symfony\\Bridge\\Twig\\Extension\\LogoutUrlExtension',
            'twig.extension.security.class' => 'Symfony\\Bridge\\Twig\\Extension\\SecurityExtension',
            'data_collector.security.class' => 'Symfony\\Bundle\\SecurityBundle\\DataCollector\\SecurityDataCollector',
            'security.access.denied_url' => NULL,
            'security.authentication.manager.erase_credentials' => true,
            'security.authentication.session_strategy.strategy' => 'migrate',
            'security.access.always_authenticate_before_granting' => false,
            'security.authentication.hide_user_not_found' => true,
            'security.role_hierarchy.roles' => array(
                'ROLE_CONTAINERS_CREATE' => array(
                ),
                'ROLE_SUPER_ADMIN' => array(
                    0 => 'ROLE_USER',
                    1 => 'ROLE_CONTAINERS_CREATE',
                ),
                'ROLE_API' => array(
                    0 => 'ROLE_USER',
                ),
            ),
            'twig.class' => 'Twig_Environment',
            'twig.loader.filesystem.class' => 'Symfony\\Bundle\\TwigBundle\\Loader\\FilesystemLoader',
            'twig.loader.chain.class' => 'Twig_Loader_Chain',
            'templating.engine.twig.class' => 'Symfony\\Bundle\\TwigBundle\\TwigEngine',
            'twig.cache_warmer.class' => 'Symfony\\Bundle\\TwigBundle\\CacheWarmer\\TemplateCacheCacheWarmer',
            'twig.extension.trans.class' => 'Symfony\\Bridge\\Twig\\Extension\\TranslationExtension',
            'twig.extension.actions.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\ActionsExtension',
            'twig.extension.code.class' => 'Symfony\\Bridge\\Twig\\Extension\\CodeExtension',
            'twig.extension.routing.class' => 'Symfony\\Bridge\\Twig\\Extension\\RoutingExtension',
            'twig.extension.yaml.class' => 'Symfony\\Bridge\\Twig\\Extension\\YamlExtension',
            'twig.extension.form.class' => 'Symfony\\Bridge\\Twig\\Extension\\FormExtension',
            'twig.extension.httpkernel.class' => 'Symfony\\Bridge\\Twig\\Extension\\HttpKernelExtension',
            'twig.extension.debug.stopwatch.class' => 'Symfony\\Bridge\\Twig\\Extension\\StopwatchExtension',
            'twig.extension.expression.class' => 'Symfony\\Bridge\\Twig\\Extension\\ExpressionExtension',
            'twig.form.engine.class' => 'Symfony\\Bridge\\Twig\\Form\\TwigRendererEngine',
            'twig.form.renderer.class' => 'Symfony\\Bridge\\Twig\\Form\\TwigRenderer',
            'twig.translation.extractor.class' => 'Symfony\\Bridge\\Twig\\Translation\\TwigExtractor',
            'twig.exception_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener',
            'twig.controller.exception.class' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController',
            'twig.controller.preview_error.class' => 'Symfony\\Bundle\\TwigBundle\\Controller\\PreviewErrorController',
            'twig.exception_listener.controller' => 'twig.controller.exception:showAction',
            'twig.form.resources' => array(
                0 => 'form_div_layout.html.twig',
                1 => 'bootstrap_3_layout.html.twig',
            ),
            'monolog.logger.class' => 'Symfony\\Bridge\\Monolog\\Logger',
            'monolog.gelf.publisher.class' => 'Gelf\\MessagePublisher',
            'monolog.gelfphp.publisher.class' => 'Gelf\\Publisher',
            'monolog.handler.stream.class' => 'Monolog\\Handler\\StreamHandler',
            'monolog.handler.console.class' => 'Symfony\\Bridge\\Monolog\\Handler\\ConsoleHandler',
            'monolog.handler.group.class' => 'Monolog\\Handler\\GroupHandler',
            'monolog.handler.buffer.class' => 'Monolog\\Handler\\BufferHandler',
            'monolog.handler.rotating_file.class' => 'Monolog\\Handler\\RotatingFileHandler',
            'monolog.handler.syslog.class' => 'Monolog\\Handler\\SyslogHandler',
            'monolog.handler.syslogudp.class' => 'Monolog\\Handler\\SyslogUdpHandler',
            'monolog.handler.null.class' => 'Monolog\\Handler\\NullHandler',
            'monolog.handler.test.class' => 'Monolog\\Handler\\TestHandler',
            'monolog.handler.gelf.class' => 'Monolog\\Handler\\GelfHandler',
            'monolog.handler.rollbar.class' => 'Monolog\\Handler\\RollbarHandler',
            'monolog.handler.flowdock.class' => 'Monolog\\Handler\\FlowdockHandler',
            'monolog.handler.browser_console.class' => 'Monolog\\Handler\\BrowserConsoleHandler',
            'monolog.handler.firephp.class' => 'Symfony\\Bridge\\Monolog\\Handler\\FirePHPHandler',
            'monolog.handler.chromephp.class' => 'Symfony\\Bridge\\Monolog\\Handler\\ChromePhpHandler',
            'monolog.handler.debug.class' => 'Symfony\\Bridge\\Monolog\\Handler\\DebugHandler',
            'monolog.handler.swift_mailer.class' => 'Symfony\\Bridge\\Monolog\\Handler\\SwiftMailerHandler',
            'monolog.handler.native_mailer.class' => 'Monolog\\Handler\\NativeMailerHandler',
            'monolog.handler.socket.class' => 'Monolog\\Handler\\SocketHandler',
            'monolog.handler.pushover.class' => 'Monolog\\Handler\\PushoverHandler',
            'monolog.handler.raven.class' => 'Monolog\\Handler\\RavenHandler',
            'monolog.handler.newrelic.class' => 'Monolog\\Handler\\NewRelicHandler',
            'monolog.handler.hipchat.class' => 'Monolog\\Handler\\HipChatHandler',
            'monolog.handler.slack.class' => 'Monolog\\Handler\\SlackHandler',
            'monolog.handler.cube.class' => 'Monolog\\Handler\\CubeHandler',
            'monolog.handler.amqp.class' => 'Monolog\\Handler\\AmqpHandler',
            'monolog.handler.error_log.class' => 'Monolog\\Handler\\ErrorLogHandler',
            'monolog.handler.loggly.class' => 'Monolog\\Handler\\LogglyHandler',
            'monolog.handler.logentries.class' => 'Monolog\\Handler\\LogEntriesHandler',
            'monolog.handler.whatfailuregroup.class' => 'Monolog\\Handler\\WhatFailureGroupHandler',
            'monolog.activation_strategy.not_found.class' => 'Symfony\\Bundle\\MonologBundle\\NotFoundActivationStrategy',
            'monolog.handler.fingers_crossed.class' => 'Monolog\\Handler\\FingersCrossedHandler',
            'monolog.handler.fingers_crossed.error_level_activation_strategy.class' => 'Monolog\\Handler\\FingersCrossed\\ErrorLevelActivationStrategy',
            'monolog.handler.filter.class' => 'Monolog\\Handler\\FilterHandler',
            'monolog.handler.mongo.class' => 'Monolog\\Handler\\MongoDBHandler',
            'monolog.mongo.client.class' => 'MongoClient',
            'monolog.handler.elasticsearch.class' => 'Monolog\\Handler\\ElasticSearchHandler',
            'monolog.elastica.client.class' => 'Elastica\\Client',
            'monolog.swift_mailer.handlers' => array(
            ),
            'monolog.handlers_to_channels' => array(
            ),
            'swiftmailer.class' => 'Swift_Mailer',
            'swiftmailer.transport.sendmail.class' => 'Swift_Transport_SendmailTransport',
            'swiftmailer.transport.mail.class' => 'Swift_Transport_MailTransport',
            'swiftmailer.transport.failover.class' => 'Swift_Transport_FailoverTransport',
            'swiftmailer.plugin.redirecting.class' => 'Swift_Plugins_RedirectingPlugin',
            'swiftmailer.plugin.impersonate.class' => 'Swift_Plugins_ImpersonatePlugin',
            'swiftmailer.plugin.messagelogger.class' => 'Swift_Plugins_MessageLogger',
            'swiftmailer.plugin.antiflood.class' => 'Swift_Plugins_AntiFloodPlugin',
            'swiftmailer.transport.smtp.class' => 'Swift_Transport_EsmtpTransport',
            'swiftmailer.plugin.blackhole.class' => 'Swift_Plugins_BlackholePlugin',
            'swiftmailer.spool.file.class' => 'Swift_FileSpool',
            'swiftmailer.spool.memory.class' => 'Swift_MemorySpool',
            'swiftmailer.email_sender.listener.class' => 'Symfony\\Bundle\\SwiftmailerBundle\\EventListener\\EmailSenderListener',
            'swiftmailer.data_collector.class' => 'Symfony\\Bundle\\SwiftmailerBundle\\DataCollector\\MessageDataCollector',
            'swiftmailer.mailer.default.transport.name' => 'smtp',
            'swiftmailer.mailer.default.delivery.enabled' => true,
            'swiftmailer.mailer.default.transport.smtp.encryption' => NULL,
            'swiftmailer.mailer.default.transport.smtp.port' => 25,
            'swiftmailer.mailer.default.transport.smtp.host' => '127.0.0.1',
            'swiftmailer.mailer.default.transport.smtp.username' => NULL,
            'swiftmailer.mailer.default.transport.smtp.password' => NULL,
            'swiftmailer.mailer.default.transport.smtp.auth_mode' => NULL,
            'swiftmailer.mailer.default.transport.smtp.timeout' => 30,
            'swiftmailer.mailer.default.transport.smtp.source_ip' => NULL,
            'swiftmailer.spool.default.file.path' => ($this->targetDirs[2].'/app/spool/default'),
            'swiftmailer.mailer.default.spool.enabled' => true,
            'swiftmailer.mailer.default.plugin.impersonate' => NULL,
            'swiftmailer.mailer.default.single_address' => NULL,
            'swiftmailer.spool.enabled' => true,
            'swiftmailer.delivery.enabled' => true,
            'swiftmailer.single_address' => NULL,
            'swiftmailer.mailers' => array(
                'default' => 'swiftmailer.mailer.default',
            ),
            'swiftmailer.default_mailer' => 'default',
            'assetic.asset_factory.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\AssetFactory',
            'assetic.asset_manager.class' => 'Assetic\\Factory\\LazyAssetManager',
            'assetic.asset_manager_cache_warmer.class' => 'Symfony\\Bundle\\AsseticBundle\\CacheWarmer\\AssetManagerCacheWarmer',
            'assetic.cached_formula_loader.class' => 'Assetic\\Factory\\Loader\\CachedFormulaLoader',
            'assetic.config_cache.class' => 'Assetic\\Cache\\ConfigCache',
            'assetic.config_loader.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Loader\\ConfigurationLoader',
            'assetic.config_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\ConfigurationResource',
            'assetic.coalescing_directory_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\CoalescingDirectoryResource',
            'assetic.directory_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\DirectoryResource',
            'assetic.filter_manager.class' => 'Symfony\\Bundle\\AsseticBundle\\FilterManager',
            'assetic.worker.ensure_filter.class' => 'Assetic\\Factory\\Worker\\EnsureFilterWorker',
            'assetic.worker.cache_busting.class' => 'Assetic\\Factory\\Worker\\CacheBustingWorker',
            'assetic.value_supplier.class' => 'Symfony\\Bundle\\AsseticBundle\\DefaultValueSupplier',
            'assetic.node.paths' => array(
            ),
            'assetic.cache_dir' => (__DIR__.'/assetic'),
            'assetic.bundles' => array(
            ),
            'assetic.twig_extension.class' => 'Symfony\\Bundle\\AsseticBundle\\Twig\\AsseticExtension',
            'assetic.twig_formula_loader.class' => 'Assetic\\Extension\\Twig\\TwigFormulaLoader',
            'assetic.helper.dynamic.class' => 'Symfony\\Bundle\\AsseticBundle\\Templating\\DynamicAsseticHelper',
            'assetic.helper.static.class' => 'Symfony\\Bundle\\AsseticBundle\\Templating\\StaticAsseticHelper',
            'assetic.php_formula_loader.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Loader\\AsseticHelperFormulaLoader',
            'assetic.debug' => false,
            'assetic.use_controller' => false,
            'assetic.enable_profiler' => false,
            'assetic.read_from' => ($this->targetDirs[2].'/app/../web'),
            'assetic.write_to' => ($this->targetDirs[2].'/app/../web'),
            'assetic.variables' => array(
            ),
            'assetic.java.bin' => '/usr/bin/java',
            'assetic.node.bin' => '/usr/bin/node',
            'assetic.ruby.bin' => '/usr/bin/ruby',
            'assetic.sass.bin' => '/usr/bin/sass',
            'assetic.reactjsx.bin' => '/usr/bin/jsx',
            'assetic.filter.cssrewrite.class' => 'Assetic\\Filter\\CssRewriteFilter',
            'assetic.twig_extension.functions' => array(
            ),
            'sensio_framework_extra.view.guesser.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Templating\\TemplateGuesser',
            'sensio_framework_extra.controller.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ControllerListener',
            'sensio_framework_extra.routing.loader.annot_dir.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationDirectoryLoader',
            'sensio_framework_extra.routing.loader.annot_file.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationFileLoader',
            'sensio_framework_extra.routing.loader.annot_class.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Routing\\AnnotatedRouteControllerLoader',
            'sensio_framework_extra.converter.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ParamConverterListener',
            'sensio_framework_extra.converter.manager.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\ParamConverterManager',
            'sensio_framework_extra.converter.doctrine.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DoctrineParamConverter',
            'sensio_framework_extra.converter.datetime.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DateTimeParamConverter',
            'doctrine_cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine_cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine_cache.file_system.class' => 'Doctrine\\Common\\Cache\\FilesystemCache',
            'doctrine_cache.php_file.class' => 'Doctrine\\Common\\Cache\\PhpFileCache',
            'doctrine_cache.mongodb.class' => 'Doctrine\\Common\\Cache\\MongoDBCache',
            'doctrine_cache.mongodb.collection.class' => 'MongoCollection',
            'doctrine_cache.mongodb.connection.class' => 'MongoClient',
            'doctrine_cache.mongodb.server' => 'localhost:27017',
            'doctrine_cache.riak.class' => 'Doctrine\\Common\\Cache\\RiakCache',
            'doctrine_cache.riak.bucket.class' => 'Riak\\Bucket',
            'doctrine_cache.riak.connection.class' => 'Riak\\Connection',
            'doctrine_cache.riak.bucket_property_list.class' => 'Riak\\BucketPropertyList',
            'doctrine_cache.riak.host' => 'localhost',
            'doctrine_cache.riak.port' => 8087,
            'doctrine_cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine_cache.memcache.connection.class' => 'Memcache',
            'doctrine_cache.memcache.host' => 'localhost',
            'doctrine_cache.memcache.port' => 11211,
            'doctrine_cache.memcached.class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
            'doctrine_cache.memcached.connection.class' => 'Memcached',
            'doctrine_cache.memcached.host' => 'localhost',
            'doctrine_cache.memcached.port' => 11211,
            'doctrine_cache.redis.class' => 'Doctrine\\Common\\Cache\\RedisCache',
            'doctrine_cache.redis.connection.class' => 'Redis',
            'doctrine_cache.redis.host' => 'localhost',
            'doctrine_cache.redis.port' => 6379,
            'doctrine_cache.couchbase.class' => 'Doctrine\\Common\\Cache\\CouchbaseCache',
            'doctrine_cache.couchbase.connection.class' => 'Couchbase',
            'doctrine_cache.couchbase.hostnames' => 'localhost:8091',
            'doctrine_cache.wincache.class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
            'doctrine_cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine_cache.zenddata.class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
            'doctrine_cache.security.acl.cache.class' => 'Doctrine\\Bundle\\DoctrineCacheBundle\\Acl\\Model\\AclCache',
            'doctrine.dbal.logger.chain.class' => 'Doctrine\\DBAL\\Logging\\LoggerChain',
            'doctrine.dbal.logger.profiling.class' => 'Doctrine\\DBAL\\Logging\\DebugStack',
            'doctrine.dbal.logger.class' => 'Symfony\\Bridge\\Doctrine\\Logger\\DbalLogger',
            'doctrine.dbal.configuration.class' => 'Doctrine\\DBAL\\Configuration',
            'doctrine.data_collector.class' => 'Doctrine\\Bundle\\DoctrineBundle\\DataCollector\\DoctrineDataCollector',
            'doctrine.dbal.connection.event_manager.class' => 'Symfony\\Bridge\\Doctrine\\ContainerAwareEventManager',
            'doctrine.dbal.connection_factory.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ConnectionFactory',
            'doctrine.dbal.events.mysql_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\MysqlSessionInit',
            'doctrine.dbal.events.oracle_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\OracleSessionInit',
            'doctrine.class' => 'Doctrine\\Bundle\\DoctrineBundle\\Registry',
            'doctrine.entity_managers' => array(
                'default' => 'doctrine.orm.default_entity_manager',
            ),
            'doctrine.default_entity_manager' => 'default',
            'doctrine.dbal.connection_factory.types' => array(
                'datetime' => array(
                    'class' => 'SevenTag\\Api\\AppBundle\\DBAL\\Types\\UTCDateTimeType',
                    'commented' => true,
                ),
                'json' => array(
                    'class' => 'Sonata\\Doctrine\\Types\\JsonType',
                    'commented' => true,
                ),
            ),
            'doctrine.connections' => array(
                'default' => 'doctrine.dbal.default_connection',
            ),
            'doctrine.default_connection' => 'default',
            'doctrine.orm.configuration.class' => 'Doctrine\\ORM\\Configuration',
            'doctrine.orm.entity_manager.class' => 'Doctrine\\ORM\\EntityManager',
            'doctrine.orm.manager_configurator.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ManagerConfigurator',
            'doctrine.orm.cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine.orm.cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine.orm.cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine.orm.cache.memcache_host' => 'localhost',
            'doctrine.orm.cache.memcache_port' => 11211,
            'doctrine.orm.cache.memcache_instance.class' => 'Memcache',
            'doctrine.orm.cache.memcached.class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
            'doctrine.orm.cache.memcached_host' => 'localhost',
            'doctrine.orm.cache.memcached_port' => 11211,
            'doctrine.orm.cache.memcached_instance.class' => 'Memcached',
            'doctrine.orm.cache.redis.class' => 'Doctrine\\Common\\Cache\\RedisCache',
            'doctrine.orm.cache.redis_host' => 'localhost',
            'doctrine.orm.cache.redis_port' => 6379,
            'doctrine.orm.cache.redis_instance.class' => 'Redis',
            'doctrine.orm.cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine.orm.cache.wincache.class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
            'doctrine.orm.cache.zenddata.class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
            'doctrine.orm.metadata.driver_chain.class' => 'Doctrine\\Common\\Persistence\\Mapping\\Driver\\MappingDriverChain',
            'doctrine.orm.metadata.annotation.class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
            'doctrine.orm.metadata.xml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedXmlDriver',
            'doctrine.orm.metadata.yml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedYamlDriver',
            'doctrine.orm.metadata.php.class' => 'Doctrine\\ORM\\Mapping\\Driver\\PHPDriver',
            'doctrine.orm.metadata.staticphp.class' => 'Doctrine\\ORM\\Mapping\\Driver\\StaticPHPDriver',
            'doctrine.orm.proxy_cache_warmer.class' => 'Symfony\\Bridge\\Doctrine\\CacheWarmer\\ProxyCacheWarmer',
            'form.type_guesser.doctrine.class' => 'Symfony\\Bridge\\Doctrine\\Form\\DoctrineOrmTypeGuesser',
            'doctrine.orm.validator.unique.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator',
            'doctrine.orm.validator_initializer.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\DoctrineInitializer',
            'doctrine.orm.security.user.provider.class' => 'Symfony\\Bridge\\Doctrine\\Security\\User\\EntityUserProvider',
            'doctrine.orm.listeners.resolve_target_entity.class' => 'Doctrine\\ORM\\Tools\\ResolveTargetEntityListener',
            'doctrine.orm.listeners.attach_entity_listeners.class' => 'Doctrine\\ORM\\Tools\\AttachEntityListenersListener',
            'doctrine.orm.naming_strategy.default.class' => 'Doctrine\\ORM\\Mapping\\DefaultNamingStrategy',
            'doctrine.orm.naming_strategy.underscore.class' => 'Doctrine\\ORM\\Mapping\\UnderscoreNamingStrategy',
            'doctrine.orm.quote_strategy.default.class' => 'Doctrine\\ORM\\Mapping\\DefaultQuoteStrategy',
            'doctrine.orm.quote_strategy.ansi.class' => 'Doctrine\\ORM\\Mapping\\AnsiQuoteStrategy',
            'doctrine.orm.entity_listener_resolver.class' => 'Doctrine\\ORM\\Mapping\\DefaultEntityListenerResolver',
            'doctrine.orm.second_level_cache.default_cache_factory.class' => 'Doctrine\\ORM\\Cache\\DefaultCacheFactory',
            'doctrine.orm.second_level_cache.default_region.class' => 'Doctrine\\ORM\\Cache\\Region\\DefaultRegion',
            'doctrine.orm.second_level_cache.filelock_region.class' => 'Doctrine\\ORM\\Cache\\Region\\FileLockRegion',
            'doctrine.orm.second_level_cache.logger_chain.class' => 'Doctrine\\ORM\\Cache\\Logging\\CacheLoggerChain',
            'doctrine.orm.second_level_cache.logger_statistics.class' => 'Doctrine\\ORM\\Cache\\Logging\\StatisticsCacheLogger',
            'doctrine.orm.second_level_cache.cache_configuration.class' => 'Doctrine\\ORM\\Cache\\CacheConfiguration',
            'doctrine.orm.second_level_cache.regions_configuration.class' => 'Doctrine\\ORM\\Cache\\RegionsConfiguration',
            'doctrine.orm.auto_generate_proxy_classes' => false,
            'doctrine.orm.proxy_dir' => (__DIR__.'/doctrine/orm/Proxies'),
            'doctrine.orm.proxy_namespace' => 'Proxies',
            'doctrine_migrations.dir_name' => ($this->targetDirs[2].'/app/DoctrineMigrations'),
            'doctrine_migrations.namespace' => 'Application\\Migrations',
            'doctrine_migrations.table_name' => 'migration_versions',
            'doctrine_migrations.name' => 'Application Migrations',
            'fos_rest.serializer.exclusion_strategy.version' => '',
            'fos_rest.serializer.exclusion_strategy.groups' => '',
            'fos_rest.view_handler.jsonp.callback_param' => '',
            'fos_rest.view.exception_wrapper_handler' => 'FOS\\RestBundle\\View\\ExceptionWrapperHandler',
            'fos_rest.view_handler.default.class' => 'FOS\\RestBundle\\View\\ViewHandler',
            'fos_rest.view_handler.jsonp.class' => 'FOS\\RestBundle\\View\\JsonpHandler',
            'fos_rest.serializer.exception_wrapper_serialize_handler.class' => 'FOS\\RestBundle\\Serializer\\ExceptionWrapperSerializeHandler',
            'fos_rest.routing.loader.controller.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestRouteLoader',
            'fos_rest.routing.loader.yaml_collection.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestYamlCollectionLoader',
            'fos_rest.routing.loader.xml_collection.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestXmlCollectionLoader',
            'fos_rest.routing.loader.processor.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestRouteProcessor',
            'fos_rest.routing.loader.reader.controller.class' => 'FOS\\RestBundle\\Routing\\Loader\\Reader\\RestControllerReader',
            'fos_rest.routing.loader.reader.action.class' => 'FOS\\RestBundle\\Routing\\Loader\\Reader\\RestActionReader',
            'fos_rest.format_negotiator.class' => 'FOS\\RestBundle\\Util\\FormatNegotiator',
            'fos_rest.inflector.class' => 'FOS\\RestBundle\\Util\\Inflector\\DoctrineInflector',
            'fos_rest.request_matcher.class' => 'Symfony\\Component\\HttpFoundation\\RequestMatcher',
            'fos_rest.violation_formatter.class' => 'FOS\\RestBundle\\Util\\ViolationFormatter',
            'fos_rest.request.param_fetcher.class' => 'FOS\\RestBundle\\Request\\ParamFetcher',
            'fos_rest.request.param_fetcher.reader.class' => 'FOS\\RestBundle\\Request\\ParamReader',
            'fos_rest.cache_dir' => (__DIR__.'/fos_rest'),
            'fos_rest.routing.loader.default_format' => 'json',
            'fos_rest.routing.loader.include_format' => true,
            'fos_rest.serializer.serialize_null' => true,
            'fos_rest.exception.codes' => array(
            ),
            'fos_rest.exception.messages' => array(
            ),
            'fos_rest.converter.request_body.class' => 'FOS\\RestBundle\\Request\\RequestBodyParamConverter',
            'fos_rest.converter.request_body.validation_errors_argument' => 'validationErrors',
            'fos_rest.mime_types' => array(
            ),
            'fos_rest.view_response_listener.class' => 'FOS\\RestBundle\\EventListener\\ViewResponseListener',
            'fos_rest.view_response_listener.force_view' => true,
            'fos_rest.formats' => array(
                'json' => false,
                'html' => true,
            ),
            'fos_rest.force_redirects' => array(
                'html' => 302,
            ),
            'fos_rest.failed_validation' => 400,
            'fos_rest.empty_content' => 204,
            'fos_rest.serialize_null' => false,
            'fos_rest.default_engine' => 'twig',
            'fos_rest.normalizer.camel_keys.class' => 'FOS\\RestBundle\\Normalizer\\CamelKeysNormalizer',
            'fos_rest.decoder.json.class' => 'FOS\\RestBundle\\Decoder\\JsonDecoder',
            'fos_rest.decoder.jsontoform.class' => 'FOS\\RestBundle\\Decoder\\JsonToFormDecoder',
            'fos_rest.decoder.xml.class' => 'FOS\\RestBundle\\Decoder\\XmlDecoder',
            'fos_rest.decoder_provider.class' => 'FOS\\RestBundle\\Decoder\\ContainerDecoderProvider',
            'fos_rest.body_listener.class' => 'FOS\\RestBundle\\EventListener\\BodyListener',
            'fos_rest.throw_exception_on_unsupported_content_type' => false,
            'fos_rest.body_default_format' => NULL,
            'fos_rest.decoders' => array(
                'json' => 'fos_rest.decoder.json',
            ),
            'fos_rest.param_fetcher_listener.class' => 'FOS\\RestBundle\\EventListener\\ParamFetcherListener',
            'fos_rest.param_fetcher_listener.set_params_as_attributes' => false,
            'fos_user.backend_type_orm' => true,
            'fos_user.security.interactive_login_listener.class' => 'FOS\\UserBundle\\EventListener\\LastLoginListener',
            'fos_user.security.login_manager.class' => 'FOS\\UserBundle\\Security\\LoginManager',
            'fos_user.resetting.email.template' => 'FOSUserBundle:Resetting:email.txt.twig',
            'fos_user.registration.confirmation.template' => 'FOSUserBundle:Registration:email.txt.twig',
            'fos_user.storage' => 'orm',
            'fos_user.firewall_name' => 'api',
            'fos_user.model_manager_name' => NULL,
            'fos_user.model.user.class' => 'SevenTag\\Api\\UserBundle\\Entity\\User',
            'fos_user.profile.form.type' => 'fos_user_profile',
            'fos_user.profile.form.name' => 'fos_user_profile_form',
            'fos_user.profile.form.validation_groups' => array(
                0 => 'Profile',
                1 => 'Default',
            ),
            'fos_user.registration.confirmation.from_email' => array(
                'example@example.com' => '7tag',
            ),
            'fos_user.registration.confirmation.enabled' => false,
            'fos_user.registration.form.type' => 'fos_user_registration',
            'fos_user.registration.form.name' => 'fos_user_registration_form',
            'fos_user.registration.form.validation_groups' => array(
                0 => 'Registration',
                1 => 'Default',
            ),
            'fos_user.change_password.form.type' => 'fos_user_change_password',
            'fos_user.change_password.form.name' => 'fos_user_change_password_form',
            'fos_user.change_password.form.validation_groups' => array(
                0 => 'ChangePassword',
                1 => 'Default',
            ),
            'fos_user.resetting.email.from_email' => array(
                'example@example.com' => '7tag',
            ),
            'fos_user.resetting.token_ttl' => 86400,
            'fos_user.resetting.form.type' => 'fos_user_resetting',
            'fos_user.resetting.form.name' => 'fos_user_resetting_form',
            'fos_user.resetting.form.validation_groups' => array(
                0 => 'ResetPassword',
                1 => 'Default',
            ),
            'fos_user.group_manager.class' => 'FOS\\UserBundle\\Doctrine\\GroupManager',
            'fos_user.model.group.class' => 'SevenTag\\Api\\UserBundle\\Entity\\Group',
            'fos_user.group.form.type' => 'fos_user_group',
            'fos_user.group.form.name' => 'fos_user_group_form',
            'fos_user.group.form.validation_groups' => array(
                0 => 'Registration',
                1 => 'Default',
            ),
            'fos_oauth_server.server.class' => 'OAuth2\\OAuth2',
            'fos_oauth_server.security.authentication.provider.class' => 'FOS\\OAuthServerBundle\\Security\\Authentication\\Provider\\OAuthProvider',
            'fos_oauth_server.security.authentication.listener.class' => 'SevenTag\\Api\\SecurityBundle\\Security\\Firewall\\OAuthListener',
            'fos_oauth_server.security.entry_point.class' => 'FOS\\OAuthServerBundle\\Security\\EntryPoint\\OAuthEntryPoint',
            'fos_oauth_server.server.options' => array(
                'supported_scopes' => 'user',
            ),
            'fos_oauth_server.model_manager_name' => NULL,
            'fos_oauth_server.model.client.class' => 'SevenTag\\Api\\SecurityBundle\\Entity\\Client',
            'fos_oauth_server.model.access_token.class' => 'SevenTag\\Api\\SecurityBundle\\Entity\\AccessToken',
            'fos_oauth_server.model.refresh_token.class' => 'SevenTag\\Api\\SecurityBundle\\Entity\\RefreshToken',
            'fos_oauth_server.model.auth_code.class' => 'SevenTag\\Api\\SecurityBundle\\Entity\\AuthCode',
            'fos_oauth_server.template.engine' => 'twig',
            'fos_oauth_server.authorize.form.type' => 'fos_oauth_server_authorize',
            'fos_oauth_server.authorize.form.name' => 'fos_oauth_server_authorize_form',
            'fos_oauth_server.authorize.form.validation_groups' => array(
                0 => 'Authorize',
                1 => 'Default',
            ),
            'fos_http_cache.request_matcher.class' => 'Symfony\\Component\\HttpFoundation\\RequestMatcher',
            'fos_http_cache.rule_matcher.class' => 'FOS\\HttpCacheBundle\\Http\\RuleMatcher',
            'fos_http_cache.compiler_pass.tag_annotations' => false,
            'knp_gaufrette.filesystem_map.class' => 'Knp\\Bundle\\GaufretteBundle\\FilesystemMap',
            'jms_serializer.metadata.file_locator.class' => 'Metadata\\Driver\\FileLocator',
            'jms_serializer.metadata.annotation_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\AnnotationDriver',
            'jms_serializer.metadata.chain_driver.class' => 'Metadata\\Driver\\DriverChain',
            'jms_serializer.metadata.yaml_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\YamlDriver',
            'jms_serializer.metadata.xml_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\XmlDriver',
            'jms_serializer.metadata.php_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\PhpDriver',
            'jms_serializer.metadata.doctrine_type_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\DoctrineTypeDriver',
            'jms_serializer.metadata.doctrine_phpcr_type_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\DoctrinePHPCRTypeDriver',
            'jms_serializer.metadata.lazy_loading_driver.class' => 'Metadata\\Driver\\LazyLoadingDriver',
            'jms_serializer.metadata.metadata_factory.class' => 'Metadata\\MetadataFactory',
            'jms_serializer.metadata.cache.file_cache.class' => 'Metadata\\Cache\\FileCache',
            'jms_serializer.event_dispatcher.class' => 'JMS\\Serializer\\EventDispatcher\\LazyEventDispatcher',
            'jms_serializer.camel_case_naming_strategy.class' => 'JMS\\Serializer\\Naming\\CamelCaseNamingStrategy',
            'jms_serializer.serialized_name_annotation_strategy.class' => 'JMS\\Serializer\\Naming\\SerializedNameAnnotationStrategy',
            'jms_serializer.cache_naming_strategy.class' => 'JMS\\Serializer\\Naming\\CacheNamingStrategy',
            'jms_serializer.doctrine_object_constructor.class' => 'JMS\\Serializer\\Construction\\DoctrineObjectConstructor',
            'jms_serializer.unserialize_object_constructor.class' => 'JMS\\Serializer\\Construction\\UnserializeObjectConstructor',
            'jms_serializer.version_exclusion_strategy.class' => 'JMS\\Serializer\\Exclusion\\VersionExclusionStrategy',
            'jms_serializer.serializer.class' => 'JMS\\Serializer\\Serializer',
            'jms_serializer.twig_extension.class' => 'JMS\\Serializer\\Twig\\SerializerExtension',
            'jms_serializer.templating.helper.class' => 'JMS\\SerializerBundle\\Templating\\SerializerHelper',
            'jms_serializer.json_serialization_visitor.class' => 'JMS\\Serializer\\JsonSerializationVisitor',
            'jms_serializer.json_serialization_visitor.options' => 0,
            'jms_serializer.json_deserialization_visitor.class' => 'JMS\\Serializer\\JsonDeserializationVisitor',
            'jms_serializer.xml_serialization_visitor.class' => 'JMS\\Serializer\\XmlSerializationVisitor',
            'jms_serializer.xml_deserialization_visitor.class' => 'JMS\\Serializer\\XmlDeserializationVisitor',
            'jms_serializer.xml_deserialization_visitor.doctype_whitelist' => array(
            ),
            'jms_serializer.yaml_serialization_visitor.class' => 'JMS\\Serializer\\YamlSerializationVisitor',
            'jms_serializer.handler_registry.class' => 'JMS\\Serializer\\Handler\\LazyHandlerRegistry',
            'jms_serializer.datetime_handler.class' => 'JMS\\Serializer\\Handler\\DateHandler',
            'jms_serializer.array_collection_handler.class' => 'JMS\\Serializer\\Handler\\ArrayCollectionHandler',
            'jms_serializer.php_collection_handler.class' => 'JMS\\Serializer\\Handler\\PhpCollectionHandler',
            'jms_serializer.form_error_handler.class' => 'JMS\\Serializer\\Handler\\FormErrorHandler',
            'jms_serializer.constraint_violation_handler.class' => 'JMS\\Serializer\\Handler\\ConstraintViolationHandler',
            'jms_serializer.doctrine_proxy_subscriber.class' => 'JMS\\Serializer\\EventDispatcher\\Subscriber\\DoctrineProxySubscriber',
            'jms_serializer.stopwatch_subscriber.class' => 'JMS\\SerializerBundle\\Serializer\\StopwatchEventSubscriber',
            'jms_serializer.infer_types_from_doctrine_metadata' => true,
            'liip_monitor.runner.class' => 'Liip\\MonitorBundle\\Runner',
            'liip_monitor.helper.raw_console_reporter.class' => 'Liip\\MonitorBundle\\Helper\\RawConsoleReporter',
            'liip_monitor.helper.console_reporter.class' => 'Liip\\MonitorBundle\\Helper\\ConsoleReporter',
            'liip_monitor.helper.runner_manager.class' => 'Liip\\MonitorBundle\\Helper\\RunnerManager',
            'liip_monitor.default_group' => 'default',
            'liip_monitor.check.writable_directory.default' => array(
                0 => __DIR__,
                1 => ($this->targetDirs[1].'/logs'),
            ),
            'liip_monitor.check.writable_directory.0.default' => __DIR__,
            'liip_monitor.check.writable_directory.1.default' => ($this->targetDirs[1].'/logs'),
            'liip_monitor.check.writable_directory.class' => 'ZendDiagnostics\\Check\\DirWritable',
            'liip_monitor.check.symfony_requirements.file.default' => ($this->targetDirs[2].'/app/../var/SymfonyRequirements.php'),
            'liip_monitor.check.symfony_requirements.class' => 'Liip\\MonitorBundle\\Check\\SymfonyRequirements',
            'liip_monitor.checks' => array(
                'groups' => array(
                    'default' => array(
                        'writable_directory' => array(
                            0 => __DIR__,
                            1 => ($this->targetDirs[1].'/logs'),
                        ),
                        'symfony_requirements' => array(
                            'file' => ($this->targetDirs[2].'/app/../var/SymfonyRequirements.php'),
                        ),
                    ),
                ),
            ),
            'nelmio_api_doc.motd.template' => 'NelmioApiDocBundle::Components/motd.html.twig',
            'nelmio_api_doc.exclude_sections' => array(
            ),
            'nelmio_api_doc.default_sections_opened' => true,
            'nelmio_api_doc.api_name' => 'API documentation',
            'nelmio_api_doc.sandbox.enabled' => true,
            'nelmio_api_doc.sandbox.endpoint' => NULL,
            'nelmio_api_doc.sandbox.accept_type' => NULL,
            'nelmio_api_doc.sandbox.body_format.formats' => array(
                0 => 'json',
            ),
            'nelmio_api_doc.sandbox.body_format.default_format' => 'form',
            'nelmio_api_doc.sandbox.request_format.method' => 'format_param',
            'nelmio_api_doc.sandbox.request_format.default_format' => 'json',
            'nelmio_api_doc.sandbox.request_format.formats' => array(
                'json' => 'application/json',
            ),
            'nelmio_api_doc.sandbox.entity_to_choice' => true,
            'nelmio_api_doc.formatter.abstract_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\AbstractFormatter',
            'nelmio_api_doc.formatter.markdown_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\MarkdownFormatter',
            'nelmio_api_doc.formatter.simple_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\SimpleFormatter',
            'nelmio_api_doc.formatter.html_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\HtmlFormatter',
            'nelmio_api_doc.formatter.swagger_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\SwaggerFormatter',
            'nelmio_api_doc.sandbox.authentication' => array(
                'delivery' => 'http',
                'type' => 'bearer',
                'name' => 'Authorization',
                'custom_endpoint' => false,
            ),
            'nelmio_api_doc.extractor.api_doc_extractor.class' => 'Nelmio\\ApiDocBundle\\Extractor\\ApiDocExtractor',
            'nelmio_api_doc.form.extension.description_form_type_extension.class' => 'Nelmio\\ApiDocBundle\\Form\\Extension\\DescriptionFormTypeExtension',
            'nelmio_api_doc.twig.extension.extra_markdown.class' => 'Nelmio\\ApiDocBundle\\Twig\\Extension\\MarkdownExtension',
            'nelmio_api_doc.doc_comment_extractor.class' => 'Nelmio\\ApiDocBundle\\Util\\DocCommentExtractor',
            'nelmio_api_doc.extractor.handler.fos_rest.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\FosRestHandler',
            'nelmio_api_doc.extractor.handler.jms_security.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\JmsSecurityExtraHandler',
            'nelmio_api_doc.extractor.handler.sensio_framework_extra.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\SensioFrameworkExtraHandler',
            'nelmio_api_doc.extractor.handler.phpdoc.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\PhpDocHandler',
            'nelmio_api_doc.parser.collection_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\CollectionParser',
            'nelmio_api_doc.parser.form_errors_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\FormErrorsParser',
            'nelmio_api_doc.parser.json_serializable_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\JsonSerializableParser',
            'nelmio_api_doc.request_listener.parameter' => '_doc',
            'nelmio_api_doc.event_listener.request.class' => 'Nelmio\\ApiDocBundle\\EventListener\\RequestListener',
            'nelmio_api_doc.swagger.base_path' => '/api',
            'nelmio_api_doc.swagger.swagger_version' => '1.2',
            'nelmio_api_doc.swagger.api_version' => '0.1',
            'nelmio_api_doc.swagger.info' => array(
                'title' => 'Symfony2',
                'description' => 'My awesome Symfony2 app!',
                'TermsOfServiceUrl' => NULL,
                'contact' => NULL,
                'license' => NULL,
                'licenseUrl' => NULL,
            ),
            'nelmio_api_doc.swagger.model_naming_strategy' => 'dot_notation',
            'stof_doctrine_extensions.event_listener.locale.class' => 'Stof\\DoctrineExtensionsBundle\\EventListener\\LocaleListener',
            'stof_doctrine_extensions.event_listener.logger.class' => 'Stof\\DoctrineExtensionsBundle\\EventListener\\LoggerListener',
            'stof_doctrine_extensions.event_listener.blame.class' => 'Stof\\DoctrineExtensionsBundle\\EventListener\\BlameListener',
            'stof_doctrine_extensions.uploadable.manager.class' => 'Stof\\DoctrineExtensionsBundle\\Uploadable\\UploadableManager',
            'stof_doctrine_extensions.uploadable.mime_type_guesser.class' => 'Stof\\DoctrineExtensionsBundle\\Uploadable\\MimeTypeGuesserAdapter',
            'stof_doctrine_extensions.uploadable.default_file_info.class' => 'Stof\\DoctrineExtensionsBundle\\Uploadable\\UploadedFileInfo',
            'stof_doctrine_extensions.default_locale' => 'en_US',
            'stof_doctrine_extensions.default_file_path' => NULL,
            'stof_doctrine_extensions.translation_fallback' => false,
            'stof_doctrine_extensions.persist_default_translation' => false,
            'stof_doctrine_extensions.skip_translation_on_load' => false,
            'stof_doctrine_extensions.uploadable.validate_writable_directory' => true,
            'stof_doctrine_extensions.listener.translatable.class' => 'Gedmo\\Translatable\\TranslatableListener',
            'stof_doctrine_extensions.listener.timestampable.class' => 'Gedmo\\Timestampable\\TimestampableListener',
            'stof_doctrine_extensions.listener.blameable.class' => 'Gedmo\\Blameable\\BlameableListener',
            'stof_doctrine_extensions.listener.sluggable.class' => 'Gedmo\\Sluggable\\SluggableListener',
            'stof_doctrine_extensions.listener.tree.class' => 'Gedmo\\Tree\\TreeListener',
            'stof_doctrine_extensions.listener.loggable.class' => 'Gedmo\\Loggable\\LoggableListener',
            'stof_doctrine_extensions.listener.sortable.class' => 'Gedmo\\Sortable\\SortableListener',
            'stof_doctrine_extensions.listener.softdeleteable.class' => 'Gedmo\\SoftDeleteable\\SoftDeleteableListener',
            'stof_doctrine_extensions.listener.uploadable.class' => 'Gedmo\\Uploadable\\UploadableListener',
            'stof_doctrine_extensions.listener.reference_integrity.class' => 'Gedmo\\ReferenceIntegrity\\ReferenceIntegrityListener',
            'sonata.notification.backend' => 'sonata.notification.backend.runtime',
            'sonata.notification.message.class' => 'Application\\Sonata\\NotificationBundle\\Entity\\Message',
            'sonata.notification.admin.message.entity' => 'Application\\Sonata\\NotificationBundle\\Entity\\Message',
            'sonata.notification.manager.message.entity' => 'Application\\Sonata\\NotificationBundle\\Entity\\Message',
            'sonata.notification.event.iteration_listeners' => array(
                0 => 'sonata.notification.event.doctrine_optimize',
            ),
            'sonata.notification.admin.message.class' => 'Sonata\\NotificationBundle\\Admin\\MessageAdmin',
            'sonata.notification.admin.message.controller' => 'SonataNotificationBundle:MessageAdmin',
            'sonata.notification.admin.message.translation_domain' => 'SonataNotificationBundle',
            'seven_tag_container.no_script.consumer.request.name' => 'request',
            'seven_tag_container.no_script.consumer.no_script.name' => 'noScript',
            'seven_tag_app.plugins_dir' => array(
                0 => ($this->targetDirs[2].'/app/../src/SevenTag/Plugin'),
            ),
            'seven_tag_app.updater.auto_republish' => true,
            'variable_types' => array(
                'url' => array(
                    'name' => 'Url',
                    'collectorName' => 'url',
                    'helper' => 'To configure you need to set one of property of this object like hash or protocol',
                ),
                'cookie' => array(
                    'name' => 'Cookie',
                    'collectorName' => 'cookie',
                    'helper' => 'To configure you need to put cookie name and as a value you will have value of that cookie',
                ),
                'document' => array(
                    'name' => 'Document',
                    'collectorName' => 'document',
                    'helper' => 'To configure you need to set one of property of this object like referrer',
                ),
                'dataLayer' => array(
                    'name' => 'Data Layer',
                    'collectorName' => 'dataLayer',
                    'helper' => 'To configure you need to set name of dataLayer event property',
                ),
                'constant' => array(
                    'name' => 'Constant',
                    'collectorName' => 'constant',
                    'helper' => 'To configure you need to write value of your constant for example unique id of application',
                ),
                'random' => array(
                    'name' => 'Random Number',
                    'collectorName' => 'random',
                    'helper' => 'When set it will always return random number as value of variable',
                ),
            ),
            'variables' => array(
                'pageUrl' => array(
                    'name' => 'Page Url',
                    'type' => 'url',
                    'value' => 'href',
                ),
                'referrer' => array(
                    'name' => 'Referrer',
                    'type' => 'document',
                    'value' => 'referrer',
                ),
                'path' => array(
                    'name' => 'Page Path',
                    'type' => 'url',
                    'value' => 'hostname',
                ),
                'hostname' => array(
                    'name' => 'Page Hostname',
                    'type' => 'url',
                    'value' => 'hostname',
                ),
                'clickClasses' => array(
                    'name' => 'Click Classes',
                    'type' => 'dataLayer',
                    'value' => 'elementClasses',
                ),
                'clickId' => array(
                    'name' => 'Click ID',
                    'type' => 'dataLayer',
                    'value' => 'elementId',
                ),
                'clickUrl' => array(
                    'name' => 'Click Url',
                    'type' => 'dataLayer',
                    'value' => 'elementUrl',
                ),
                'formId' => array(
                    'name' => 'Form ID',
                    'type' => 'dataLayer',
                    'value' => 'elementId',
                ),
                'formClasses' => array(
                    'name' => 'Form Classes',
                    'type' => 'dataLayer',
                    'value' => 'elementClasses',
                ),
                'formUrl' => array(
                    'name' => 'Form Url',
                    'type' => 'dataLayer',
                    'value' => 'elementClasses',
                ),
                'event' => array(
                    'name' => 'Event',
                    'type' => 'dataLayer',
                    'value' => 'event',
                ),
            ),
            'console.command.ids' => array(
                0 => 'seven_tag_container.command.javascript_generator',
                1 => 'seven_tag_container.command.tagtree_generator',
                2 => 'seven_tag_container.command.republish_container_command',
            ),
            'liip_monitor.runners' => array(
                0 => 'liip_monitor.runner_default',
            ),
            'nelmio_api_doc.parser.form_type_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\FormTypeParser',
            'nelmio_api_doc.parser.validation_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\ValidationParser',
            'nelmio_api_doc.parser.jms_metadata_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\JmsMetadataParser',
        );
    }
}
