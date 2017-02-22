<?php

/* modifierTaille.html */
class __TwigTemplate_a626fe2c3344d752d9440371ac6fc18e19edeab3051e48b66289e67ca994d990 extends Twig_Template
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
    <h1>Modifier la taille du sandwich n° ";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["taille"]) ? $context["taille"] : null), "id", array()), "html", null, true);
        echo "</h1>
    <ul>
        <form method= \"post\" action=\"http://localhost/LeBonSandwich/LP_CISIIE_LeBonSandwich/projet1_le_bon_sandwich/private/taille/\">
            <li> <span>description : ";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["taille"]) ? $context["taille"] : null), "description", array()), "html", null, true);
        echo "</span><span><input type=\"text\" name=\"description\"/></span></li>
            <li><span>prix : ";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["taille"]) ? $context["taille"] : null), "prix", array()), "html", null, true);
        echo "</span><span><input type=\"text\" name=\"prix\"/></li> 
            <li><button value=\"submit\">modifier</button></li>   
        <form>
    </ul>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "modifierTaille.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 11,  33 => 10,  27 => 7,  19 => 1,);
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
    <h1>Modifier la taille du sandwich n° {{taille.id}}</h1>
    <ul>
        <form method= \"post\" action=\"http://localhost/LeBonSandwich/LP_CISIIE_LeBonSandwich/projet1_le_bon_sandwich/private/taille/\">
            <li> <span>description : {{ taille.description }}</span><span><input type=\"text\" name=\"description\"/></span></li>
            <li><span>prix : {{ taille.prix }}</span><span><input type=\"text\" name=\"prix\"/></li> 
            <li><button value=\"submit\">modifier</button></li>   
        <form>
    </ul>
</body>
</html>", "modifierTaille.html", "C:\\wamp\\www\\LeBonSandwich\\LP_CISIIE_LeBonSandwich\\projet1_le_bon_sandwich\\src\\templates\\modifierTaille.html");
    }
}
