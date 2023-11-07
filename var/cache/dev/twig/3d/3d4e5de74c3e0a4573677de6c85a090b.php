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

/* default/movies.html.twig */
class __TwigTemplate_12b9e391cb7ac15688f9911862212ff1 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "default/movies.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "default/movies.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "default/movies.html.twig", 1);
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
    <h1>Movies</h1>
        <table class=\"table\">
            <thead>
                <tr>
                    <th scope=\"col\"></th>
                    <th scope=\"col\">Name</th>
                    <th scope=\"col\">Avg Rating</th>
                    <th scope=\"col\">Actions</th>
                </tr>
            </thead>
            <tbody>
                ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["movies"]) || array_key_exists("movies", $context) ? $context["movies"] : (function () { throw new RuntimeError('Variable "movies" does not exist.', 16, $this->source); })()));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["movie"]) {
            // line 17
            echo "                    <th scope=\"row\"><img src=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["movie"], "imagePath", [], "any", false, false, false, 17), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["movie"], "name", [], "any", false, false, false, 17), "html", null, true);
            echo " image\"></th>
                    <th>";
            // line 18
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["movie"], "name", [], "any", false, false, false, 18), "html", null, true);
            echo "</th>
                    <th>";
            // line 19
            echo twig_get_attribute($this->env, $this->source, (isset($context["stars"]) || array_key_exists("stars", $context) ? $context["stars"] : (function () { throw new RuntimeError('Variable "stars" does not exist.', 19, $this->source); })()), (twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 19) - 1), [], "any", false, false, false, 19);
            echo "</th>
                    <th>
                        <div class=\"container\">
                            <div class=\"row\">
                                <div class=\"col\">
                                    <a href=\"";
            // line 24
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("create-review", ["id" => twig_get_attribute($this->env, $this->source, $context["movie"], "id", [], "any", false, false, false, 24)]), "html", null, true);
            echo "\"><button class=\"btn btn-primary\">Review This Movie</button></a>
                                </div>
                                <div class=\"col\">
                                    <a href=\"";
            // line 27
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("view-movie", ["id" => twig_get_attribute($this->env, $this->source, $context["movie"], "id", [], "any", false, false, false, 27)]), "html", null, true);
            echo "\"><button class=\"btn btn-secondary\">View Reviews</button></a>
                                </div>
                                ";
            // line 29
            if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) {
                // line 30
                echo "                                    <div class=\"col\">
                                        <a href=\"#\"><button class=\"btn btn-danger\">Delete Movie</button></a>
                                    </div>
                                ";
            }
            // line 34
            echo "                            </div>
                        </div>
                    </th>
                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['movie'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "            </tbody>
        </table>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "default/movies.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 38,  137 => 34,  131 => 30,  129 => 29,  124 => 27,  118 => 24,  110 => 19,  106 => 18,  99 => 17,  82 => 16,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <div class=\"container container-pad\">
    <h1>Movies</h1>
        <table class=\"table\">
            <thead>
                <tr>
                    <th scope=\"col\"></th>
                    <th scope=\"col\">Name</th>
                    <th scope=\"col\">Avg Rating</th>
                    <th scope=\"col\">Actions</th>
                </tr>
            </thead>
            <tbody>
                {% for movie in movies %}
                    <th scope=\"row\"><img src=\"{{ movie.imagePath }}\" alt=\"{{ movie.name }} image\"></th>
                    <th>{{ movie.name }}</th>
                    <th>{{ attribute(stars, loop.index-1) | raw}}</th>
                    <th>
                        <div class=\"container\">
                            <div class=\"row\">
                                <div class=\"col\">
                                    <a href=\"{{ path('create-review', {'id' : movie.id}) }}\"><button class=\"btn btn-primary\">Review This Movie</button></a>
                                </div>
                                <div class=\"col\">
                                    <a href=\"{{ path('view-movie', {'id' : movie.id}) }}\"><button class=\"btn btn-secondary\">View Reviews</button></a>
                                </div>
                                {% if is_granted('ROLE_ADMIN') %}
                                    <div class=\"col\">
                                        <a href=\"#\"><button class=\"btn btn-danger\">Delete Movie</button></a>
                                    </div>
                                {% endif %}
                            </div>
                        </div>
                    </th>
                {% endfor %}
            </tbody>
        </table>
    </div>
{% endblock %}

", "default/movies.html.twig", "C:\\Users\\danie\\PhpStorm\\awd\\templates\\default\\movies.html.twig");
    }
}
