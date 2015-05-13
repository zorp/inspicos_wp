<?php

/* galleries.html.twig */
class __TwigTemplate_89dbc9bb1bca44d0d6912c571170a6a0 extends Twig_Template
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
        // line 7
        echo "
<form method=\"post\" action=\"\">
";
        // line 9
        echo (isset($context["list"]) ? $context["list"] : null);
        echo "
</form>
";
    }

    public function getTemplateName()
    {
        return "galleries.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 9,  19 => 7,);
    }
}
