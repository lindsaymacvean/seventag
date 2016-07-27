<?php

/* SevenTagInstallerBundle::oauthClientSettings.html.twig */
class __TwigTemplate_eb630937ab0bbc7ddd920cfd34e839850ba4b2fa37a24d6d547d1744adc2e689 extends Twig_Template
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
        echo "<script type=\"text/javascript\">
    var OAUTH_CLIENT_ID = '";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["client"]) ? $context["client"] : null), "id", array()), "html", null, true);
        echo "_";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["client"]) ? $context["client"] : null), "randomId", array()), "html", null, true);
        echo "';
    var OAUTH_CLIENT_SECRET = '";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["client"]) ? $context["client"] : null), "secret", array()), "html", null, true);
        echo "';
</script>";
    }

    public function getTemplateName()
    {
        return "SevenTagInstallerBundle::oauthClientSettings.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 3,  22 => 2,  19 => 1,);
    }
}
