<?php

/* ingredient_deleted.html */
class __TwigTemplate_75e021baeeb8529398d440e2fbb71ce5b3f8511218b4aa9104487b4ad7be50a2 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html>
<head>
\t<title></title>
</head>
<body>
    <h1>Ingredients ";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo " Supprimé <a href=\"";
        echo twig_escape_filter($this->env, (isset($context["base_url"]) ? $context["base_url"] : null), "html", null, true);
        echo "/ingredients\">Liste des ingredients</a></h1>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "ingredient_deleted.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 7,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
<head>
\t<title></title>
</head>
<body>
    <h1>Ingredients {{id}} Supprimé <a href=\"{{base_url}}/ingredients\">Liste des ingredients</a></h1>
</body>
</html>", "ingredient_deleted.html", "C:\\wamp64\\www\\API_LBS\\LP_CISIIE_LeBonSandwich\\projet1_le_bon_sandwich\\src\\templates\\ingredient_deleted.html");
    }
}
