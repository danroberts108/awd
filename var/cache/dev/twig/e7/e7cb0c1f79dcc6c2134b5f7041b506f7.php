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
                    <h4>Movie Details:</h4>
                    <div class=\"col\">
                        <img src=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["movie"]) || array_key_exists("movie", $context) ? $context["movie"] : (function () { throw new RuntimeError('Variable "movie" does not exist.', 11, $this->source); })()), "imagePath", [], "any", false, false, false, 11), "html", null, true);
        echo "\">
                    </div>
                    <div class=\"col\">
                        <h5>";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["movie"]) || array_key_exists("movie", $context) ? $context["movie"] : (function () { throw new RuntimeError('Variable "movie" does not exist.', 14, $this->source); })()), "name", [], "any", false, false, false, 14), "html", null, true);
        echo "</h5>
                    </div>
                    <div class=\"col\">
                        <p>Avg Rating:</p>
                        <p>";
        // line 18
        echo (isset($context["stars"]) || array_key_exists("stars", $context) ? $context["stars"] : (function () { throw new RuntimeError('Variable "stars" does not exist.', 18, $this->source); })());
        echo "</p>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col justify-content-md-center container-pad\">
                <div class=\"row\">
                    <!--review details-->
                    <h4>Review Details:</h4>
                    <div class=\"col\">
                        <p>Rating</p>
                        ";
        // line 30
        echo (isset($context["reviewstars"]) || array_key_exists("reviewstars", $context) ? $context["reviewstars"] : (function () { throw new RuntimeError('Variable "reviewstars" does not exist.', 30, $this->source); })());
        echo "
                    </div>
                    <div class=\"col\">
                        <div class=\"row\">
                            <label for=\"reviewComment\">Comment:</label>
                        </div>
                        <div class=\"row\">
                            <p>";
        // line 37
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["review"]) || array_key_exists("review", $context) ? $context["review"] : (function () { throw new RuntimeError('Variable "review" does not exist.', 37, $this->source); })()), "comment", [], "any", false, false, false, 37), "html", null, true);
        echo "</p>
                        </div>
                    </div>
                    <div class=\"col\">
                        <label for=\"reviewUser\">Username </label>
                        <input name=\"reviewUser\" id=\"reviewUser\" type=\"text\" disabled value=\"";
        // line 42
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["review"]) || array_key_exists("review", $context) ? $context["review"] : (function () { throw new RuntimeError('Variable "review" does not exist.', 42, $this->source); })()), "author", [], "any", false, false, false, 42), "email", [], "any", false, false, false, 42), "html", null, true);
        echo "\">
                    </div>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col justify-content-md-center container-pad\">
                <div class=\"row\">
                    <!--report-->
                    <h4>Report details:</h4>
                    <div class=\"col col-3\">
                        <label for=\"reportUser\">Reporter </label>
                        <input id=\"reportUser\" name=\"reportUser\" type=\"text\" disabled value=\"";
        // line 54
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["report"]) || array_key_exists("report", $context) ? $context["report"] : (function () { throw new RuntimeError('Variable "report" does not exist.', 54, $this->source); })()), "user", [], "any", false, false, false, 54), "email", [], "any", false, false, false, 54), "html", null, true);
        echo "\">
                    </div>
                    <div class=\"col\">
                        <label for=\"reportComment\">Report text:</label>
                        <p>";
        // line 58
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["report"]) || array_key_exists("report", $context) ? $context["report"] : (function () { throw new RuntimeError('Variable "report" does not exist.', 58, $this->source); })()), "comment", [], "any", false, false, false, 58), "html", null, true);
        echo "</p>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col justify-content-md-center container-pad\">
                <h4>Decision:</h4>
                <!--report form-->
                ";
        // line 67
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 67, $this->source); })()), 'form_start');
        echo "
                ";
        // line 68
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 68, $this->source); })()), "remove", [], "any", false, false, false, 68), 'row');
        echo "
                <input hidden name=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldName(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 69, $this->source); })()), "report", [], "any", false, false, false, 69)), "html", null, true);
        echo "\" id=\"reportId\" value=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["report"]) || array_key_exists("report", $context) ? $context["report"] : (function () { throw new RuntimeError('Variable "report" does not exist.', 69, $this->source); })()), "review", [], "any", false, false, false, 69), "id", [], "any", false, false, false, 69), "html", null, true);
        echo "\">
                <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Submit</button>
                ";
        // line 71
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 71, $this->source); })()), 'form_end');
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
        return array (  172 => 71,  165 => 69,  161 => 68,  157 => 67,  145 => 58,  138 => 54,  123 => 42,  115 => 37,  105 => 30,  90 => 18,  83 => 14,  77 => 11,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}

    <div class=\"container container-pad\">
        <div class=\"row\">
            <div class=\"col justify-content-md-center\">
                <div class=\"row\">
                    <h4>Movie Details:</h4>
                    <div class=\"col\">
                        <img src=\"{{ movie.imagePath }}\">
                    </div>
                    <div class=\"col\">
                        <h5>{{ movie.name }}</h5>
                    </div>
                    <div class=\"col\">
                        <p>Avg Rating:</p>
                        <p>{{ stars | raw}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col justify-content-md-center container-pad\">
                <div class=\"row\">
                    <!--review details-->
                    <h4>Review Details:</h4>
                    <div class=\"col\">
                        <p>Rating</p>
                        {{ reviewstars | raw }}
                    </div>
                    <div class=\"col\">
                        <div class=\"row\">
                            <label for=\"reviewComment\">Comment:</label>
                        </div>
                        <div class=\"row\">
                            <p>{{ review.comment }}</p>
                        </div>
                    </div>
                    <div class=\"col\">
                        <label for=\"reviewUser\">Username </label>
                        <input name=\"reviewUser\" id=\"reviewUser\" type=\"text\" disabled value=\"{{ review.author.email }}\">
                    </div>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col justify-content-md-center container-pad\">
                <div class=\"row\">
                    <!--report-->
                    <h4>Report details:</h4>
                    <div class=\"col col-3\">
                        <label for=\"reportUser\">Reporter </label>
                        <input id=\"reportUser\" name=\"reportUser\" type=\"text\" disabled value=\"{{ report.user.email }}\">
                    </div>
                    <div class=\"col\">
                        <label for=\"reportComment\">Report text:</label>
                        <p>{{ report.comment }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col justify-content-md-center container-pad\">
                <h4>Decision:</h4>
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
