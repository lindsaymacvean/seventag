<?php

/* SevenTagPluginPiwikCustomTemplateBundle:Template:PiwikProvider.js.twig */
class __TwigTemplate_aa34d870c35b0b7155cf50b65cb79dd8f75be85d4606da3b866c72513c604058 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!-- Piwik -->
<script type=\"text/javascript\">
    var _paq = _paq || [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);

    (function() {

        var u=";
        // line 9
        echo $this->env->getExtension('variable_extension')->variableFilter((isset($context["piwikUrl"]) ? $context["piwikUrl"] : null));
        echo ";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', ";
        // line 11
        echo $this->env->getExtension('variable_extension')->variableFilter((isset($context["piwikSiteId"]) ? $context["piwikSiteId"] : null));
        echo "]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })()
</script>
<!-- End Piwik Code -->";
    }

    public function getTemplateName()
    {
        return "SevenTagPluginPiwikCustomTemplateBundle:Template:PiwikProvider.js.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 11,  29 => 9,  19 => 1,);
    }
}
