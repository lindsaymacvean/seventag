<?php

/* SevenTagInstallerBundle::partials/environmentStep.html.twig */
class __TwigTemplate_ee916e4f0a00da661f655aff89644adb8e69f34605d21137289f7f3da7a29107 extends Twig_Template
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
        echo "<div class=\"stg-step stg-";
        if (((isset($context["hasFailedRequirements"]) ? $context["hasFailedRequirements"] : null) == false)) {
            echo "success";
        } else {
            echo "danger";
        }
        echo "\">
    <hr>
    <span>";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo "</span>
    <span class=\"pull-right glyphicon glyphicon-";
        // line 4
        if (((isset($context["hasFailedRequirements"]) ? $context["hasFailedRequirements"] : null) == false)) {
            echo "ok";
        } else {
            echo "remove";
        }
        echo "\"></span>

    ";
        // line 6
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["failedRequirements"]) ? $context["failedRequirements"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["requirement"]) {
            // line 7
            echo "    <span class=\"stg-info\">
        ";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($context["requirement"], "getTestMessage", array(), "method"), "html", null, true);
            echo "
        ";
            // line 9
            echo $this->getAttribute($context["requirement"], "getHelpHTML", array(), "method");
            echo "
    </span>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['requirement'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "    <hr>
</div>
";
    }

    public function getTemplateName()
    {
        return "SevenTagInstallerBundle::partials/environmentStep.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 12,  53 => 9,  49 => 8,  46 => 7,  42 => 6,  33 => 4,  29 => 3,  19 => 1,);
    }
}
