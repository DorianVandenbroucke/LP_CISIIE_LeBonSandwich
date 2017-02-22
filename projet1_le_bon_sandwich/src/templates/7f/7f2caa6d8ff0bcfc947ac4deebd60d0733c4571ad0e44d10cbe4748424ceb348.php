<?php

/* Form_ingredient_add.html */
class __TwigTemplate_3f1ea45e6169a75b1018bb1b90fe7d926d83a40e2ad44c89bbaca9c26d79ba18 extends Twig_Template
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
    <form method=\"POST\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["base_url"]) ? $context["base_url"] : null), "html", null, true);
        echo "/ingredients\">
        <p><label>Categorie :</label>
        <select name=\"cat_id\">
        ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 11
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "nom", array()), "html", null, true);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "        </select></p>
        <p><label>Nom :</label><input name=\"nom\" type=\"text\" required/></p>
        <p><label>Description :</label><input name=\"description\" type=\"text\"/></p>
        <p><label>Fournisseur :</label><input name=\"fournisseur\" type=\"text\"/></p>
        <p><label>Image :</label><input name=\"img\" type=\"file\"/></p>
        <p><input type=\"submit\" name=\"addIngredient\" value=\"Ajouter\"/></p>
    </form>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "Form_ingredient_add.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 13,  37 => 11,  33 => 10,  27 => 7,  19 => 1,);
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
    <form method=\"POST\" action=\"{{base_url}}/ingredients\">
        <p><label>Categorie :</label>
        <select name=\"cat_id\">
        {% for cat in categories %}
            <option value=\"{{ cat.id }}\">{{ cat.nom }}</option>
        {% endfor %}
        </select></p>
        <p><label>Nom :</label><input name=\"nom\" type=\"text\" required/></p>
        <p><label>Description :</label><input name=\"description\" type=\"text\"/></p>
        <p><label>Fournisseur :</label><input name=\"fournisseur\" type=\"text\"/></p>
        <p><label>Image :</label><input name=\"img\" type=\"file\"/></p>
        <p><input type=\"submit\" name=\"addIngredient\" value=\"Ajouter\"/></p>
    </form>
</body>
</html>
", "Form_ingredient_add.html", "C:\\wamp64\\www\\sandwichAPI\\LP_CISIIE_LeBonSandwich\\projet1_le_bon_sandwich\\src\\templates\\Form_ingredient_add.html");
    }
}
