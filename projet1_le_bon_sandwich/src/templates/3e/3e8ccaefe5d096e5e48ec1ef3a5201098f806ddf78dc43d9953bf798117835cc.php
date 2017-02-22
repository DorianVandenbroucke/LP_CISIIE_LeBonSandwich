<?php

/* commandes.html */
class __TwigTemplate_a4acd92879c7f30bdff45811f8dfb918c4a893dc7c6793307fedb84e9e7ac81e extends Twig_Template
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
    <h1>Ingredients par catégories</h1>
    <ul>
    ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 10
            echo "        <li> <b>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "nom", array()), "html", null, true);
            echo " :</b> <i> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "description", array()), "html", null, true);
            echo "</i></li>
        <ul>
        ";
            // line 12
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["cat"], "getIngredients", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["ingre"]) {
                // line 13
                echo "            <li> 
                <b>";
                // line 14
                echo twig_escape_filter($this->env, $this->getAttribute($context["ingre"], "nom", array()), "html", null, true);
                echo " :</b> <i> ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["ingre"], "description", array()), "html", null, true);
                echo "</i>
                <button click=\"#\">Supprimer</button>
            </li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ingre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "        </ul>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "    </ul>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "commandes.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 20,  60 => 18,  48 => 14,  45 => 13,  41 => 12,  33 => 10,  29 => 9,  19 => 1,);
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
    <h1>Ingredients par catégories</h1>
    <ul>
    {% for cat in categories %}
        <li> <b>{{ cat.nom }} :</b> <i> {{cat.description}}</i></li>
        <ul>
        {%for ingre in cat.getIngredients %}
            <li> 
                <b>{{ ingre.nom }} :</b> <i> {{ingre.description}}</i>
                <button click=\"#\">Supprimer</button>
            </li>
        {% endfor %}
        </ul>
    {% endfor %}
    </ul>
</body>
</html>", "commandes.html", "C:\\wamp64\\www\\sandwichAPI\\LP_CISIIE_LeBonSandwich\\projet1_le_bon_sandwich\\src\\templates\\commandes.html");
    }
}
