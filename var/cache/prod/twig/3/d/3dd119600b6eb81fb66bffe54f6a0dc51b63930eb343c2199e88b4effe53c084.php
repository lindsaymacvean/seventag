<?php

/* @SevenTagContainerBundle/Resources/views/snippet.html.twig */
class __TwigTemplate_3dd119600b6eb81fb66bffe54f6a0dc51b63930eb343c2199e88b4effe53c084 extends Twig_Template
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
        ob_start();
        // line 2
        echo "<!-- Start 7Tag script code -->
<noscript><iframe src=\"";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["noScriptPath"]) ? $context["noScriptPath"] : null), "html", null, true);
        echo "\" height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>
<script type=\"text/javascript\">
(function(window, document, script, dataLayer, id) {
    window[dataLayer] = window[dataLayer] || [];
    window[dataLayer].push({
        '7tag.start': new Date().getTime(),
        'event': '7tag.js'
    });

    var scripts = document.getElementsByTagName(script)[0],
        tags = document.createElement(script),
        dl = dataLayer != 'dataLayer' ? '?dataLayer=' + dataLayer : '';

    tags.async = true;
    tags.src = '";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["path"]) ? $context["path"] : null), "html", null, true);
        echo "' + dl;
    scripts.parentNode.insertBefore(tags, scripts);
})(window, document, 'script', 'dataLayer', ";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo ");
</script>
<!-- End Tag script code -->
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "@SevenTagContainerBundle/Resources/views/snippet.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 19,  41 => 17,  24 => 3,  21 => 2,  19 => 1,);
    }
}
