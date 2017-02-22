<?php

/* authentification.html */
class __TwigTemplate_4d94f8dab6934600509c1c2fecdeb72ece2ccce85ebe24257beee302a1b4a058 extends Twig_Template
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
\t<title>Authentification</title>
</head>
<body>
    <h1>Authentification</h1>
\t<form method=\"POST\" action=\"#\">
\t\t<input type=\"text\" name=\"login\" placeholder=\"login\">
\t\t<input type=\"password\" name=\"password\" placeholder=\"mot de passe\">
\t\t<input type=\"hidden\" name=\"valueKey\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute(($context["token"] ?? null), "valueKey", array()), "html", null, true);
        echo "\">
\t\t<button>Connexion</button>
\t</form>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "authentification.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 11,  19 => 1,);
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
\t<title>Authentification</title>
</head>
<body>
    <h1>Authentification</h1>
\t<form method=\"POST\" action=\"#\">
\t\t<input type=\"text\" name=\"login\" placeholder=\"login\">
\t\t<input type=\"password\" name=\"password\" placeholder=\"mot de passe\">
\t\t<input type=\"hidden\" name=\"valueKey\" value=\"{{token.valueKey}}\">
\t\t<button>Connexion</button>
\t</form>
</body>
</html>
", "authentification.html", "C:\\Users\\DorianHa\\Documents\\EasyPHP-Devserver-16.1\\eds-www\\lp_cisiie\\prog_serveur\\le_bon_sandwich\\git\\projet1_le_bon_sandwich\\src\\templates\\authentification.html");
    }
}
