<?php

/* SevenTagInstallerBundle::checkEnvironment.html.twig */
class __TwigTemplate_a47aeaf331340f3ff4a56920ee2f4a50e3f38ff5a1861da7cc8740c1876fee4f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "SevenTagInstallerBundle::checkEnvironment.html.twig", 1);
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
                    <h4>7Tag Manager installer</h4>

                    ";
        // line 10
        $this->loadTemplate("SevenTagInstallerBundle::partials/environmentStep.html.twig", "SevenTagInstallerBundle::checkEnvironment.html.twig", 10)->display(array_merge($context, array("name" => "System", "hasFailedRequirements" => $this->getAttribute(        // line 12
(isset($context["requirements"]) ? $context["requirements"] : null), "hasFailedSystemRequirements", array(), "method"), "failedRequirements" => $this->getAttribute(        // line 13
(isset($context["requirements"]) ? $context["requirements"] : null), "getFailedSystemRequirements", array(), "method"))));
        // line 15
        echo "                    ";
        $this->loadTemplate("SevenTagInstallerBundle::partials/environmentStep.html.twig", "SevenTagInstallerBundle::checkEnvironment.html.twig", 15)->display(array_merge($context, array("name" => "PHP version", "hasFailedRequirements" => $this->getAttribute(        // line 17
(isset($context["requirements"]) ? $context["requirements"] : null), "hasFailedPhpRequirements", array(), "method"), "failedRequirements" => $this->getAttribute(        // line 18
(isset($context["requirements"]) ? $context["requirements"] : null), "getFailedPhpRequirements", array(), "method"))));
        // line 20
        echo "                    ";
        $this->loadTemplate("SevenTagInstallerBundle::partials/environmentStep.html.twig", "SevenTagInstallerBundle::checkEnvironment.html.twig", 20)->display(array_merge($context, array("name" => "Database", "hasFailedRequirements" => $this->getAttribute(        // line 22
(isset($context["requirements"]) ? $context["requirements"] : null), "hasFailedDatabaseRequirements", array(), "method"), "failedRequirements" => $this->getAttribute(        // line 23
(isset($context["requirements"]) ? $context["requirements"] : null), "getFailedDatabaseRequirements", array(), "method"))));
        // line 25
        echo "
                    ";
        // line 26
        if ( !twig_test_empty($this->getAttribute((isset($context["requirements"]) ? $context["requirements"] : null), "getFailedRequirements", array(), "method"))) {
            // line 27
            echo "                      <button class=\"btn btn-success disabled\">Continue</button>
                    ";
        } else {
            // line 29
            echo "                      <a href=\"";
            echo $this->env->getExtension('routing')->getPath("configuration");
            echo "\" class=\"btn btn-success\">Continue</a>
                    ";
        }
        // line 31
        echo "                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SevenTagInstallerBundle::checkEnvironment.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 31,  62 => 29,  58 => 27,  56 => 26,  53 => 25,  51 => 23,  50 => 22,  48 => 20,  46 => 18,  45 => 17,  43 => 15,  41 => 13,  40 => 12,  39 => 10,  31 => 4,  28 => 3,  11 => 1,);
    }
}
