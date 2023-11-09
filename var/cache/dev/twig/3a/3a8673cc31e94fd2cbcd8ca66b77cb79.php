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
class __TwigTemplate_7531575a4a9ca24c8d4ffa6013f1eb51 extends Template
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
        <div class=\"row\">
            <div class=\"col\">
                <h1>Movies</h1>
            </div>
            <div class=\"col\">
                <a href=\"";
        // line 10
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("create-movie");
        echo "\"><button class=\"btn btn-primary\">Add Movie</button></a>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col\">
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
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["movies"]) || array_key_exists("movies", $context) ? $context["movies"] : (function () { throw new RuntimeError('Variable "movies" does not exist.', 25, $this->source); })()));
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
            // line 26
            echo "                            <th scope=\"row\"><img src=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["movie"], "imagePath", [], "any", false, false, false, 26), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["movie"], "name", [], "any", false, false, false, 26), "html", null, true);
            echo " image\"></th>
                            <th>";
            // line 27
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["movie"], "name", [], "any", false, false, false, 27), "html", null, true);
            echo "</th>
                            <th>";
            // line 28
            echo twig_get_attribute($this->env, $this->source, (isset($context["stars"]) || array_key_exists("stars", $context) ? $context["stars"] : (function () { throw new RuntimeError('Variable "stars" does not exist.', 28, $this->source); })()), (twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 28) - 1), [], "any", false, false, false, 28);
            echo "</th>
                            <th>
                                <div class=\"container\">
                                    <div class=\"row\">
                                        <div class=\"col\">
                                            <a href=\"";
            // line 33
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("create-review", ["id" => twig_get_attribute($this->env, $this->source, $context["movie"], "id", [], "any", false, false, false, 33)]), "html", null, true);
            echo "\"><button class=\"btn btn-primary\">Review This Movie</button></a>
                                        </div>
                                        <div class=\"col\">
                                            <a href=\"";
            // line 36
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("view-movie", ["id" => twig_get_attribute($this->env, $this->source, $context["movie"], "id", [], "any", false, false, false, 36)]), "html", null, true);
            echo "\"><button class=\"btn btn-secondary\">View Reviews</button></a>
                                        </div>
                                        ";
            // line 38
            if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) {
                // line 39
                echo "                                            <div class=\"col\">
                                                <a href=\"#\"><button class=\"btn btn-danger\">Delete Movie</button></a>
                                            </div>
                                        ";
            }
            // line 43
            echo "                                    </div>
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
        // line 47
        echo "                    </tbody>
                </table>
            </div>
        </div>
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
        return array (  166 => 47,  149 => 43,  143 => 39,  141 => 38,  136 => 36,  130 => 33,  122 => 28,  118 => 27,  111 => 26,  94 => 25,  76 => 10,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <div class=\"container container-pad\">
        <div class=\"row\">
            <div class=\"col\">
                <h1>Movies</h1>
            </div>
            <div class=\"col\">
                <a href=\"{{ path('create-movie') }}\"><button class=\"btn btn-primary\">Add Movie</button></a>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col\">
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
        </div>
    </div>
{% endblock %}

", "default/movies.html.twig", "/Users/danroberts/PhpstormProjects/awd/templates/default/movies.html.twig");
    }
}
