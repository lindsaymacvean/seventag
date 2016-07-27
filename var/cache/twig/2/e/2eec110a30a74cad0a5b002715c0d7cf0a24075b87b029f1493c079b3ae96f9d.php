<?php

/* SevenTagInstallerBundle:configuration:database.html.twig */
class __TwigTemplate_2eec110a30a74cad0a5b002715c0d7cf0a24075b87b029f1493c079b3ae96f9d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "SevenTagInstallerBundle:configuration:database.html.twig", 1);
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
        echo "Installer - database configuration";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-md-6 col-md-offset-3\">
                ";
        // line 9
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 10
            echo "                <div class=\"stg-notification stg-notification-danger center-block\">
                    Something going wrong with connection to your server!
                    Please verify your user name and password!
                </div>
                ";
        }
        // line 15
        echo "
                ";
        // line 16
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : null), 'form_start', array("attr" => array("id" => "install_database_configuration", "novalidate" => "novalidate")));
        echo "
                <div class=\"stg-installer center-block\">
                    <h4>Database configuration</h4>

                        ";
        // line 20
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
        echo "

                        ";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "hostname", array()), 'row');
        echo "
                        ";
        // line 23
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "name", array()), 'row');
        echo "
                        ";
        // line 24
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "username", array()), 'row');
        echo "
                        ";
        // line 25
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "password", array()), 'row');
        echo "
                        ";
        // line 26
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "createDatabase", array()), 'row');
        echo "

                        <button class=\"btn btn-success\" type=\"submit\">Continue</button>
                </div>
                ";
        // line 30
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : null), 'form_end');
        echo "
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SevenTagInstallerBundle:configuration:database.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 30,  83 => 26,  79 => 25,  75 => 24,  71 => 23,  67 => 22,  62 => 20,  55 => 16,  52 => 15,  45 => 10,  43 => 9,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }
}
