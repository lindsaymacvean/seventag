<?php

/* base.html.twig */
class __TwigTemplate_c0446224e12c5b31f6073d3f07190799149fe490f1a9b130e95161af5a37221a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'styles' => array($this, 'block_styles'),
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
            'scripts' => array($this, 'block_scripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <title>";
        // line 4
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 5
        $this->displayBlock('styles', $context, $blocks);
        // line 9
        echo "    </head>
    <body>
        ";
        // line 11
        $this->displayBlock('header', $context, $blocks);
        // line 20
        echo "
        ";
        // line 21
        $this->displayBlock('content', $context, $blocks);
        // line 23
        echo "
        ";
        // line 24
        $this->displayBlock('scripts', $context, $blocks);
        // line 26
        echo "    </body>
</html>
";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        echo "Installer";
    }

    // line 5
    public function block_styles($context, array $blocks = array())
    {
        // line 6
        echo "            <link rel=\"stylesheet\" type=\"text/css\" href=\"/installer/assets/bootstrap/css/bootstrap.css\">
            <link rel=\"stylesheet\" type=\"text/css\" href=\"/installer/styles/main.css\">
        ";
    }

    // line 11
    public function block_header($context, array $blocks = array())
    {
        // line 12
        echo "            <div class=\"container-fluid\">
                <div class=\"row\">
                    <div class=\"stg-top\">
                        <img class=\"stg-logo\" src=\"/installer/images/logo.png\">
                    </div>
                </div>
            </div>
        ";
    }

    // line 21
    public function block_content($context, array $blocks = array())
    {
        // line 22
        echo "        ";
    }

    // line 24
    public function block_scripts($context, array $blocks = array())
    {
        // line 25
        echo "        ";
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  96 => 25,  93 => 24,  89 => 22,  86 => 21,  75 => 12,  72 => 11,  66 => 6,  63 => 5,  57 => 4,  51 => 26,  49 => 24,  46 => 23,  44 => 21,  41 => 20,  39 => 11,  35 => 9,  33 => 5,  29 => 4,  24 => 1,);
    }
}
