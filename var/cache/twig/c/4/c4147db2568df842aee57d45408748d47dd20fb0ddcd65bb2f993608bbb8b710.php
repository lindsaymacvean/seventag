<?php

/* SevenTagInstallerBundle:configuration:show.html.twig */
class __TwigTemplate_c4147db2568df842aee57d45408748d47dd20fb0ddcd65bb2f993608bbb8b710 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "SevenTagInstallerBundle:configuration:show.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Installer - parameters";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-md-8 col-md-offset-2\">
                <div class=\"stg-notification stg-notification-success center-block\">
                    Please create file inside this path <mark>";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["parametersPath"]) ? $context["parametersPath"] : null), "html", null, true);
        echo "</mark> and paste content dumped below.
                    If everything is correct please click \"Continue\" button.
                </div>

                <textarea class=\"form-control\" readonly rows=\"25\">";
        // line 14
        echo twig_escape_filter($this->env, (isset($context["parameters"]) ? $context["parameters"] : null), "html", null, true);
        echo "</textarea>

                <a href=\"";
        // line 16
        echo $this->env->getExtension('routing')->getPath("admin");
        echo "\" class=\"btn btn-success submitLink\">Continue</a>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SevenTagInstallerBundle:configuration:show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 16,  51 => 14,  44 => 10,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }
}
