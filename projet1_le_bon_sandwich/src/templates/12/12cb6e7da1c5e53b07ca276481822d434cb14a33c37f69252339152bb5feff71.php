<?php

/* ingredients.html */
class __TwigTemplate_e0e39bf7be55f67d388efacc76ddebd19d8dc7631799fee9412f54e77983d98c extends Twig_Template
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
    <button><a href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("addIngredient"), "html", null, true);
        echo "\">Ajouter</a></button>
    <ul>
    ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 11
            echo "        <li> <b>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "nom", array()), "html", null, true);
            echo " :</b> <i> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "description", array()), "html", null, true);
            echo "</i></li>
        <ul>
        ";
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["cat"], "getIngredients", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["ingre"]) {
                // line 14
                echo "            <li> 
                <b>";
                // line 15
                echo twig_escape_filter($this->env, $this->getAttribute($context["ingre"], "nom", array()), "html", null, true);
                echo " :</b> <i> ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["ingre"], "description", array()), "html", null, true);
                echo "</i>
                <button><a href=\"";
                // line 16
                echo twig_escape_filter($this->env, (isset($context["base_url"]) ? $context["base_url"] : null), "html", null, true);
                echo "/ingredients/delete/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["ingre"], "id", array()), "html", null, true);
                echo "\">Supprimer</a></button>
            </li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ingre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "        </ul>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "    </ul>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "ingredients.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 21,  69 => 19,  58 => 16,  52 => 15,  49 => 14,  45 => 13,  37 => 11,  33 => 10,  28 => 8,  19 => 1,);
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
    <button><a href=\"{{path_for('addIngredient')}}\">Ajouter</a></button>
    <ul>
    {% for cat in categories %}
        <li> <b>{{ cat.nom }} :</b> <i> {{cat.description}}</i></li>
        <ul>
        {%for ingre in cat.getIngredients %}
            <li> 
                <b>{{ ingre.nom }} :</b> <i> {{ingre.description}}</i>
                <button><a href=\"{{base_url}}/ingredients/delete/{{ingre.id}}\">Supprimer</a></button>
            </li>
        {% endfor %}
        </ul>
    {% endfor %}
    </ul>
</body>
</html>", "ingredients.html", "C:\\wamp\\www\\LeBonSandwich\\LP_CISIIE_LeBonSandwich\\projet1_le_bon_sandwich\\src\\templates\\ingredients.html");
    }
}
