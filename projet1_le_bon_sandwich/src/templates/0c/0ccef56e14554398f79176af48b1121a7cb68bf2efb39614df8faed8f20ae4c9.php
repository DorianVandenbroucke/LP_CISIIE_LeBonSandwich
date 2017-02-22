<?php

/* ingredients.html */
class __TwigTemplate_fa3ff690a4cad3e0ef5e239843928580652498dd78ad8d742455553824b9ac8b extends Twig_Template
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
    <table border=\"1\">
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Fournisseur</th>
            <th>Image</th>
            <th>Categorie</th>        
        </tr>
    ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["ingredients"]) ? $context["ingredients"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["ing"]) {
            echo "  
        <tr>
            <td>";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["ing"], "nom", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["ing"], "description", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($context["ing"], "fournisseur", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute($context["ing"], "img", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 23
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["ing"], "getCategory", array()), "nom", array()), "html", null, true);
            echo "</td>
            <td><button><a href=\"";
            // line 24
            echo twig_escape_filter($this->env, (isset($context["base_url"]) ? $context["base_url"] : null), "html", null, true);
            echo "/ingredients/delete/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["ing"], "id", array()), "html", null, true);
            echo "\">Supprimer</a></button></td>
        </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ing'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "    </table>


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
        return array (  78 => 27,  67 => 24,  63 => 23,  59 => 22,  55 => 21,  51 => 20,  47 => 19,  40 => 17,  28 => 8,  19 => 1,);
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
    <table border=\"1\">
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Fournisseur</th>
            <th>Image</th>
            <th>Categorie</th>        
        </tr>
    {% for ing in ingredients %}  
        <tr>
            <td>{{ing.nom}}</td>
            <td>{{ing.description}}</td>
            <td>{{ing.fournisseur}}</td>
            <td>{{ing.img}}</td>
            <td>{{ing.getCategory.nom}}</td>
            <td><button><a href=\"{{base_url}}/ingredients/delete/{{ing.id}}\">Supprimer</a></button></td>
        </tr>
    {% endfor %}
    </table>


</body>
</html>", "ingredients.html", "C:\\wamp64\\www\\API_LBS\\LP_CISIIE_LeBonSandwich\\projet1_le_bon_sandwich\\src\\templates\\ingredients.html");
    }
}
