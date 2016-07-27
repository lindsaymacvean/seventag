<?php

/* SevenTagInstallerBundle::finish.html.twig */
class __TwigTemplate_543e8d399314d6df3c7bc9db76d574611476adfbfb09a69598670ddb3e0080ae extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "SevenTagInstallerBundle::finish.html.twig", 1);
        $this->blocks = array(
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
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-md-6 col-md-offset-3\">
                <div class=\"stg-installer center-block\">
                    <h2>7Tag configured!</h2>
                    <p>Before using the application, please read the documentation</p>

                    <div class=\"stg-btn-block center-block\">
                        <a href=\"/\" class=\"btn btn-block btn-success\">Start</a>
                        <a href=\"//7tag.org/docs/introduction/\" target=\"_blank\" class=\"btn btn-block btn-default\">Documentation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SevenTagInstallerBundle::finish.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,  11 => 1,);
    }
}
