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

/* mod/reported.html.twig */
class __TwigTemplate_7bf5635287860e88f66518e5eee0171a extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "mod/reported.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "mod/reported.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "mod/reported.html.twig", 1);
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
        echo "
    <div class=\"container container-pad\">
        <div class=\"row\">
            <div class=\"col justify-content-md-center\">
                <div class=\"row\">
                    <img src=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["movie"]) || array_key_exists("movie", $context) ? $context["movie"] : (function () { throw new RuntimeError('Variable "movie" does not exist.', 9, $this->source); })()), "imagePath", [], "any", false, false, false, 9), "html", null, true);
        echo "\">
                </div>
                <div class=\"row\">
                    <h5>";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["movie"]) || array_key_exists("movie", $context) ? $context["movie"] : (function () { throw new RuntimeError('Variable "movie" does not exist.', 12, $this->source); })()), "name", [], "any", false, false, false, 12), "html", null, true);
        echo "</h5>
                </div>
                <div class=\"row\">
                    <p>Avg Rating:</p>
                    <p>";
        // line 16
        echo (isset($context["stars"]) || array_key_exists("stars", $context) ? $context["stars"] : (function () { throw new RuntimeError('Variable "stars" does not exist.', 16, $this->source); })());
        echo "</p>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col justify-content-md-center\">
                <!--review details-->
                <div class=\"col\">
                    ";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["review"]) || array_key_exists("review", $context) ? $context["review"] : (function () { throw new RuntimeError('Variable "review" does not exist.', 24, $this->source); })()), "rating", [], "any", false, false, false, 24), "html", null, true);
        echo "
                </div>
                <div class=\"col\">
                    <label for=\"reviewComment\">Comment </label>
                    <input name=\"reviewComment\" id=\"reviewComment\" type=\"text\" disabled value=\"";
        // line 28
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["review"]) || array_key_exists("review", $context) ? $context["review"] : (function () { throw new RuntimeError('Variable "review" does not exist.', 28, $this->source); })()), "comment", [], "any", false, false, false, 28), "html", null, true);
        echo "\">
                </div>
                <div class=\"col\">
                    <label for=\"reviewUser\">Username </label>
                    <input name=\"reviewUser\" id=\"reviewUser\" type=\"text\" disabled value=\"";
        // line 32
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["review"]) || array_key_exists("review", $context) ? $context["review"] : (function () { throw new RuntimeError('Variable "review" does not exist.', 32, $this->source); })()), "author", [], "any", false, false, false, 32), "email", [], "any", false, false, false, 32), "html", null, true);
        echo "\">
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col justify-content-md-center\">
                <!--report-->
                <div class=\"col\">
                    <label for=\"reportComment\">Report text </label>
                    <input id=\"reportComment\" name=\"reportComment\" type=\"text\" disabled value=\"";
        // line 41
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["report"]) || array_key_exists("report", $context) ? $context["report"] : (function () { throw new RuntimeError('Variable "report" does not exist.', 41, $this->source); })()), "comment", [], "any", false, false, false, 41), "html", null, true);
        echo "\">
                </div>
                <div class=\"col\">
                    <label for=\"reportUser\">Reporter </label>
                    <input id=\"reportUser\" name=\"reportUser\" type=\"text\" disabled value=\"";
        // line 45
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["report"]) || array_key_exists("report", $context) ? $context["report"] : (function () { throw new RuntimeError('Variable "report" does not exist.', 45, $this->source); })()), "user", [], "any", false, false, false, 45), "email", [], "any", false, false, false, 45), "html", null, true);
        echo "\">
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col\">
                <!--report form-->
                ";
        // line 52
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 52, $this->source); })()), 'form_start');
        echo "
                ";
        // line 53
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 53, $this->source); })()), "remove", [], "any", false, false, false, 53), 'row');
        echo "
                <input hidden name=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldName(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 54, $this->source); })()), "report", [], "any", false, false, false, 54)), "html", null, true);
        echo "\" id=\"reportId\" value=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["report"]) || array_key_exists("report", $context) ? $context["report"] : (function () { throw new RuntimeError('Variable "report" does not exist.', 54, $this->source); })()), "review", [], "any", false, false, false, 54), "id", [], "any", false, false, false, 54), "html", null, true);
        echo "\">
                <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Submit</button>
                ";
        // line 56
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 56, $this->source); })()), 'form_end');
        echo "
            </div>
        </div>
    </div>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "mod/reported.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  157 => 56,  150 => 54,  146 => 53,  142 => 52,  132 => 45,  125 => 41,  113 => 32,  106 => 28,  99 => 24,  88 => 16,  81 => 12,  75 => 9,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}

    <div class=\"container container-pad\">
        <div class=\"row\">
            <div class=\"col justify-content-md-center\">
                <div class=\"row\">
                    <img src=\"{{ movie.imagePath }}\">
                </div>
                <div class=\"row\">
                    <h5>{{ movie.name }}</h5>
                </div>
                <div class=\"row\">
                    <p>Avg Rating:</p>
                    <p>{{ stars | raw}}</p>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col justify-content-md-center\">
                <!--review details-->
                <div class=\"col\">
                    {{ review.rating }}
                </div>
                <div class=\"col\">
                    <label for=\"reviewComment\">Comment </label>
                    <input name=\"reviewComment\" id=\"reviewComment\" type=\"text\" disabled value=\"{{ review.comment }}\">
                </div>
                <div class=\"col\">
                    <label for=\"reviewUser\">Username </label>
                    <input name=\"reviewUser\" id=\"reviewUser\" type=\"text\" disabled value=\"{{ review.author.email }}\">
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col justify-content-md-center\">
                <!--report-->
                <div class=\"col\">
                    <label for=\"reportComment\">Report text </label>
                    <input id=\"reportComment\" name=\"reportComment\" type=\"text\" disabled value=\"{{ report.comment }}\">
                </div>
                <div class=\"col\">
                    <label for=\"reportUser\">Reporter </label>
                    <input id=\"reportUser\" name=\"reportUser\" type=\"text\" disabled value=\"{{ report.user.email }}\">
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col\">
                <!--report form-->
                {{ form_start(form) }}
                {{ form_row(form.remove) }}
                <input hidden name=\"{{ field_name(form.report) }}\" id=\"reportId\" value=\"{{ report.review.id }}\">
                <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Submit</button>
                {{ form_end(form) }}
            </div>
        </div>
    </div>

{% endblock %}", "mod/reported.html.twig", "/Users/danroberts/PhpstormProjects/awd/templates/mod/reported.html.twig");
    }
}
