<?php

/* ingredients.html */
class __TwigTemplate_ba491a0f0b8e909c025b1e728b7eda5b9a0c24394b5c638e7ea9c5f652c37d71 extends Twig_Template
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
    <!--<ul>
    ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["data"]) ? $context["data"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["it"]) {
            // line 9
            echo "        <li> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["it"], "name", array()), "html", null, true);
            echo " : <e> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["it"], "description", array()), "html", null, true);
            echo "</e></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['it'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "    </ul>-->
    hello ";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo "
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
        return array (  46 => 12,  43 => 11,  32 => 9,  28 => 8,  19 => 1,);
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
    <!--<ul>
    {% for it in data %}
        <li> {{ it.name }} : <e> {{it.description}}</e></li>
    {% endfor %}
    </ul>-->
    hello {{name}}
</body>
</html>", "ingredients.html", "C:\\wamp64\\www\\sandwichAPI\\LP_CISIIE_LeBonSandwich\\projet1_le_bon_sandwich\\templates\\ingredients.html");
    }
}
