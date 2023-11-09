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

/* login/index.html.twig */
class __TwigTemplate_11c87614dd48f953c1a7309a6ce8d6eb extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "login/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "login/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "login/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Hello LoginController!";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "

    <div class=\"container px-5 my-5\">
        <div class=\"row justify-content-md-center text-center\">
            <h2>Movie Review</h2>
        </div>
        ";
        // line 12
        if ((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 12, $this->source); })())) {
            // line 13
            echo "            <div class=\"row justify-content-md-center text-center\">
                <div>";
            // line 14
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 14, $this->source); })()), "messageKey", [], "any", false, false, false, 14), twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 14, $this->source); })()), "messageData", [], "any", false, false, false, 14), "security"), "html", null, true);
            echo "</div>
            </div>
        ";
        }
        // line 17
        echo "        <div class=\"row justify-content-md-center\">
            <div class=\"col col-4\">
                <form action=\"";
        // line 19
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        echo "\" method=\"post\">
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"email\" id=\"username\" name=\"_username\" value=\"";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 21, $this->source); })()), "html", null, true);
        echo "\" placeholder=\"Email Address\">
                        <label for=\"username\">Email Address</label>
                    </div>
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"password\" id=\"password\" name=\"_password\" placeholder=\"Password\">
                        <label for=\"password\">Password</label>
                    </div>

                    <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        echo "\">

                    <div class=\"d-grid gap-2\">
                        <button type=\"submit\" class=\"btn btn-primary\" id=\"submitButton\" disabled>Login</button>
                    </div>


                </form>
                <div class=\"text-center justify-content-md-center my-3\">
                    <p><a href=\"#\" class=\"link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover\">Forgot password?</a></p>
                </div>
                <div class=\"text-center justify-content-md-center my-3\">
                    <p><a href=\"";
        // line 41
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        echo "\" class=\"link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover\">Not got an account? Register</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/login.js"), "html", null, true);
        echo "\"></script>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "login/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  151 => 47,  142 => 41,  127 => 29,  116 => 21,  111 => 19,  107 => 17,  101 => 14,  98 => 13,  96 => 12,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Hello LoginController!{% endblock %}

{% block body %}


    <div class=\"container px-5 my-5\">
        <div class=\"row justify-content-md-center text-center\">
            <h2>Movie Review</h2>
        </div>
        {% if error %}
            <div class=\"row justify-content-md-center text-center\">
                <div>{{ error.messageKey|trans(error.messageData, 'security') }}</div>
            </div>
        {% endif %}
        <div class=\"row justify-content-md-center\">
            <div class=\"col col-4\">
                <form action=\"{{  path('app_login') }}\" method=\"post\">
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"email\" id=\"username\" name=\"_username\" value=\"{{  last_username }}\" placeholder=\"Email Address\">
                        <label for=\"username\">Email Address</label>
                    </div>
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"password\" id=\"password\" name=\"_password\" placeholder=\"Password\">
                        <label for=\"password\">Password</label>
                    </div>

                    <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\">

                    <div class=\"d-grid gap-2\">
                        <button type=\"submit\" class=\"btn btn-primary\" id=\"submitButton\" disabled>Login</button>
                    </div>


                </form>
                <div class=\"text-center justify-content-md-center my-3\">
                    <p><a href=\"#\" class=\"link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover\">Forgot password?</a></p>
                </div>
                <div class=\"text-center justify-content-md-center my-3\">
                    <p><a href=\"{{ path('app_register') }}\" class=\"link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover\">Not got an account? Register</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src=\"{{ asset('js/login.js') }}\"></script>

{% endblock %}
", "login/index.html.twig", "/Users/danroberts/PhpstormProjects/awd/templates/login/index.html.twig");
    }
}
