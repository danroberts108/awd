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
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["movie"]) || array_key_exists("movie", $context) ? $context["movie"] : (function () { throw new RuntimeError('Variable "movie" does not exist.', 8, $this->source); })()), "imagepath", [], "any", false, false, false, 8), "html", null, true);
        echo "\" alt=\"Movie Image\">
                </div>
            </div>
            <div class=\"col-4\">
                <div class=\"row\">
                    <h5>Name: </h5><p>";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["movie"]) || array_key_exists("movie", $context) ? $context["movie"] : (function () { throw new RuntimeError('Variable "movie" does not exist.', 13, $this->source); })()), "name", [], "any", false, false, false, 13), "html", null, true);
        echo "</p>
                </div>
                <div class=\"row\">
                    <h5>Studio: </h5><p>";
        // line 16
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["movie"]) || array_key_exists("movie", $context) ? $context["movie"] : (function () { throw new RuntimeError('Variable "movie" does not exist.', 16, $this->source); })()), "studio", [], "any", false, false, false, 16), "html", null, true);
        echo "</p>
                </div>
            </div>
            <div class=\"col-2\">
                <div class=\"row\">
                    <h5>Average Rating:</h5><p>";
        // line 21
        echo (isset($context["moviestars"]) || array_key_exists("moviestars", $context) ? $context["moviestars"] : (function () { throw new RuntimeError('Variable "moviestars" does not exist.', 21, $this->source); })());
        echo "</p>
                </div>
                <div class=\"row\">
                    <a href=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("create-review", ["id" => twig_get_attribute($this->env, $this->source, (isset($context["movie"]) || array_key_exists("movie", $context) ? $context["movie"] : (function () { throw new RuntimeError('Variable "movie" does not exist.', 24, $this->source); })()), "id", [], "any", false, false, false, 24)]), "html", null, true);
        echo "\"><button class=\"btn btn-primary\" type=\"button\">Review this movie</button></a>
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
                        <th scope=\"col\">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["reviews"]) || array_key_exists("reviews", $context) ? $context["reviews"] : (function () { throw new RuntimeError('Variable "reviews" does not exist.', 39, $this->source); })()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["review"]) {
            // line 40
            echo "                        <tr>
                            <th scope=\"row\">";
            // line 41
            echo twig_get_attribute($this->env, $this->source, (isset($context["stars"]) || array_key_exists("stars", $context) ? $context["stars"] : (function () { throw new RuntimeError('Variable "stars" does not exist.', 41, $this->source); })()), (twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 41) - 1), [], "any", false, false, false, 41);
            echo "</th>
                            <th>";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["review"], "comment", [], "any", false, false, false, 42), "html", null, true);
            echo "</th>
                            <th>";
            // line 43
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["review"], "author", [], "any", false, false, false, 43), "fname", [], "any", false, false, false, 43), "html", null, true);
            echo "</th>
                            <th>
                                <div class=\"container\">
                                    <div class=\"row\">
                                        <div class=\"col\">
                                            <a href=\"";
            // line 48
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("view-review", ["id" => twig_get_attribute($this->env, $this->source, $context["review"], "id", [], "any", false, false, false, 48)]), "html", null, true);
            echo "\"><button class=\"btn btn-outline-secondary\">View</button></a>
                                        </div>
                                        <div class=\"col\">
                                            <a href=\"";
            // line 51
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("create-report", ["id" => twig_get_attribute($this->env, $this->source, $context["review"], "id", [], "any", false, false, false, 51)]), "html", null, true);
            echo "\"><button class=\"btn btn-outline-danger\">Report</button></a>
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['review'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
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
        return array (  183 => 58,  162 => 51,  156 => 48,  148 => 43,  144 => 42,  140 => 41,  137 => 40,  120 => 39,  102 => 24,  96 => 21,  88 => 16,  82 => 13,  74 => 8,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <div class=\"container container-pad\">
        <div class=\"row\">
            <div class=\"col-2\">
                <div class=\"row\">
                    <img src=\"{{ movie.imagepath }}\" alt=\"Movie Image\">
                </div>
            </div>
            <div class=\"col-4\">
                <div class=\"row\">
                    <h5>Name: </h5><p>{{ movie.name }}</p>
                </div>
                <div class=\"row\">
                    <h5>Studio: </h5><p>{{ movie.studio }}</p>
                </div>
            </div>
            <div class=\"col-2\">
                <div class=\"row\">
                    <h5>Average Rating:</h5><p>{{ moviestars | raw }}</p>
                </div>
                <div class=\"row\">
                    <a href=\"{{ path('create-review', {'id' : movie.id}) }}\"><button class=\"btn btn-primary\" type=\"button\">Review this movie</button></a>
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
                        <th scope=\"col\">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {% for review in reviews %}
                        <tr>
                            <th scope=\"row\">{{ attribute(stars, loop.index-1) | raw}}</th>
                            <th>{{ review.comment }}</th>
                            <th>{{ review.author.fname }}</th>
                            <th>
                                <div class=\"container\">
                                    <div class=\"row\">
                                        <div class=\"col\">
                                            <a href=\"{{ path('view-review', {'id' : review.id}) }}\"><button class=\"btn btn-outline-secondary\">View</button></a>
                                        </div>
                                        <div class=\"col\">
                                            <a href=\"{{ path('create-report', {'id' : review.id}) }}\"><button class=\"btn btn-outline-danger\">Report</button></a>
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
{% endblock %}", "/default/view_movie.html.twig", "C:\\Users\\danie\\PhpStorm\\awd\\templates\\default\\view_movie.html.twig");
    }
}
