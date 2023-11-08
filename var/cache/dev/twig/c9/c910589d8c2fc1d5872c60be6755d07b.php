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

/* /default/view_review.html.twig */
class __TwigTemplate_ae258715a03baf97c08267db3f4ba808 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "/default/view_review.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "/default/view_review.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "/default/view_review.html.twig", 1);
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
        <div class=\"col\">
            <div class=\"row\">
                <div class=\"col\">
                    <h5>Movie: </h5><p>";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["review"]) || array_key_exists("review", $context) ? $context["review"] : (function () { throw new RuntimeError('Variable "review" does not exist.', 8, $this->source); })()), "movie", [], "any", false, false, false, 8), "name", [], "any", false, false, false, 8), "html", null, true);
        echo "</p>
                </div>
                <div class=\"col\">
                    <h6>Rating: </h6><p>";
        // line 11
        echo (isset($context["stars"]) || array_key_exists("stars", $context) ? $context["stars"] : (function () { throw new RuntimeError('Variable "stars" does not exist.', 11, $this->source); })());
        echo "</p>
                </div>
            </div>
            <div class=\"row\">
                <h6>Comment: </h6><p>";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["review"]) || array_key_exists("review", $context) ? $context["review"] : (function () { throw new RuntimeError('Variable "review" does not exist.', 15, $this->source); })()), "comment", [], "any", false, false, false, 15), "html", null, true);
        echo "</p>
            </div>
            <div class=\"row\">
                <div class=\"col\">
                    <a href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("create-report", ["id" => twig_get_attribute($this->env, $this->source, (isset($context["review"]) || array_key_exists("review", $context) ? $context["review"] : (function () { throw new RuntimeError('Variable "review" does not exist.', 19, $this->source); })()), "id", [], "any", false, false, false, 19)]), "html", null, true);
        echo "\"><button class=\"btn btn-danger\">Report</button></a>
                </div>
            </div>
        </div>
    </div>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "/default/view_review.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 19,  87 => 15,  80 => 11,  74 => 8,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <div class=\"container container-pad\">
        <div class=\"col\">
            <div class=\"row\">
                <div class=\"col\">
                    <h5>Movie: </h5><p>{{ review.movie.name }}</p>
                </div>
                <div class=\"col\">
                    <h6>Rating: </h6><p>{{ stars | raw }}</p>
                </div>
            </div>
            <div class=\"row\">
                <h6>Comment: </h6><p>{{ review.comment }}</p>
            </div>
            <div class=\"row\">
                <div class=\"col\">
                    <a href=\"{{ path('create-report', {'id' : review.id }) }}\"><button class=\"btn btn-danger\">Report</button></a>
                </div>
            </div>
        </div>
    </div>

{% endblock %}", "/default/view_review.html.twig", "C:\\Users\\danie\\PhpStorm\\awd\\templates\\default\\view_review.html.twig");
    }
}
