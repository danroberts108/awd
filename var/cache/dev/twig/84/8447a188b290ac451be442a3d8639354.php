<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /default/view_movie.html.twig */
class __TwigTemplate_3783f73de842d6a3cf29ed1e0e222b41 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "/default/view_movie.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "/default/view_movie.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "/default/view_movie.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <div class=\"container container-pad\">
        <div class=\"row\">
            <div class=\"col-2\">
                <div class=\"row\">
                    <img src=\"";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["imagepath"]) || array_key_exists("imagepath", $context) ? $context["imagepath"] : (function () { throw new RuntimeError('Variable "imagepath" does not exist.', 8, $this->source); })()), "html", null, true);
        echo "\" alt=\"Movie Image\">
                </div>
            </div>
            <div class=\"col-4\">
                <div class=\"row\">
                    <h5>Name: </h5><p>";
        // line 13
        echo twig_escape_filter($this->env, (isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 13, $this->source); })()), "html", null, true);
        echo "</p>
                </div>
                <div class=\"row\">
                    <h5>Studio: </h5><p>";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["studio"]) || array_key_exists("studio", $context) ? $context["studio"] : (function () { throw new RuntimeError('Variable "studio" does not exist.', 16, $this->source); })()), "html", null, true);
        echo "</p>
                </div>
            </div>
            <div class=\"col-2\">
                <div class=\"row\">
                    <a href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("create-review", ["id" => (isset($context["id"]) || array_key_exists("id", $context) ? $context["id"] : (function () { throw new RuntimeError('Variable "id" does not exist.', 21, $this->source); })())]), "html", null, true);
        echo "\"><button class=\"btn btn-primary\" type=\"button\">Rate this movie</button></a>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <table class=\"table\">
                <thead>
                    <tr>
                        <th scope=\"col\">Rating</th>
                        <th scope=\"col\">Comment</th>
                        <th scope=\"col\">Author</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["ratings"]) || array_key_exists("ratings", $context) ? $context["ratings"] : (function () { throw new RuntimeError('Variable "ratings" does not exist.', 35, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["rating"]) {
            // line 36
            echo "                        <tr>
                            <th scope=\"row\">";
            // line 37
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rating"], "rating", [], "any", false, false, false, 37), "html", null, true);
            echo "</th>
                            <th>";
            // line 38
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rating"], "comment", [], "any", false, false, false, 38), "html", null, true);
            echo "</th>
                            <th>";
            // line 39
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rating"], "author", [], "any", false, false, false, 39), "html", null, true);
            echo "</th>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rating'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "                </tbody>
            </table>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "/default/view_movie.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 42,  128 => 39,  124 => 38,  120 => 37,  117 => 36,  113 => 35,  96 => 21,  88 => 16,  82 => 13,  74 => 8,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <div class=\"container container-pad\">
        <div class=\"row\">
            <div class=\"col-2\">
                <div class=\"row\">
                    <img src=\"{{ imagepath }}\" alt=\"Movie Image\">
                </div>
            </div>
            <div class=\"col-4\">
                <div class=\"row\">
                    <h5>Name: </h5><p>{{ name }}</p>
                </div>
                <div class=\"row\">
                    <h5>Studio: </h5><p>{{ studio }}</p>
                </div>
            </div>
            <div class=\"col-2\">
                <div class=\"row\">
                    <a href=\"{{ path('create-review', {'id' : id}) }}\"><button class=\"btn btn-primary\" type=\"button\">Rate this movie</button></a>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <table class=\"table\">
                <thead>
                    <tr>
                        <th scope=\"col\">Rating</th>
                        <th scope=\"col\">Comment</th>
                        <th scope=\"col\">Author</th>
                    </tr>
                </thead>
                <tbody>
                    {% for rating in ratings %}
                        <tr>
                            <th scope=\"row\">{{ rating.rating }}</th>
                            <th>{{ rating.comment }}</th>
                            <th>{{ rating.author }}</th>
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
{% endblock %}", "/default/view_movie.html.twig", "C:\\Users\\danie\\PhpStorm\\awd\\templates\\default\\view_movie.html.twig");
    }
}
