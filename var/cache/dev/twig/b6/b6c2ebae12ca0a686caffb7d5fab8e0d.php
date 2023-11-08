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

/* registration/register.html.twig */
class __TwigTemplate_04e57a7fdf070b5bd314e20508c20a23 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "registration/register.html.twig", 1);
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

        echo "Register";
        
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
";
        // line 28
        echo "    <div class=\"container px-5 my-5\">
        <div class=\"row justify-content-md-center text-center\">
            <h2>Register</h2>
        </div>
        <div class=\"row justify-content-md-center\">
            <div class=\"col col-4\">
                ";
        // line 34
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 34, $this->source); })()), 'form_start');
        echo "
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"email\" id=\"registration_form_email\" name=\"registration_form[email]\" placeholder=\"Email Address\" required=\"required\" maxlength=\"180\">
                        <label for=\"registration_form_email\">Email Address</label>
                    </div>
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"text\" id=\"registration_form_fname\" name=\"registration_form[fname]\" placeholder=\"First Name\" required=\"required\">
                        <label for=\"registration_form_fname\">First Name</label>
                    </div>
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"text\" id=\"registration_form_lname\" name=\"registration_form[lname]\" placeholder=\"Last Name\" required=\"required\">
                        <label for=\"registration_form_lname\">Last Name</label>
                    </div>
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"password\" id=\"registration_form_plainPassword\" name=\"registration_form[plainPassword]\" placeholder=\"Password\" required=\"required\" autocomplete=\"new-password\">
                        <label for=\"password\">Password</label>
                    </div>

                    ";
        // line 52
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 52, $this->source); })()), "agreeTerms", [], "any", false, false, false, 52), 'row');
        echo "

                    <div class=\"d-grid gap-2\">
                        <button type=\"submit\" class=\"btn btn-primary\" id=\"submitButton\" disabled>Login</button>
                    </div>


                ";
        // line 59
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 59, $this->source); })()), 'form_end', ["render_rest" => false]);
        echo "

                <div class=\"text-center justify-content-md-center my-3\">
                    <p><a href=\"";
        // line 62
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        echo "\" class=\"link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover\">Already got an account? Login</a></p>
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
        return "registration/register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  136 => 62,  130 => 59,  120 => 52,  99 => 34,  91 => 28,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Register{% endblock %}

{% block body %}

{#{{ form_errors(registrationForm) }}

    <div class=\"container\">
    {{ form_start(registrationForm) }}
        {{ form_row(registrationForm.email) }}
        {{ form_row(registrationForm.fname, {
            label: 'First name'
        })
        }}
        {{ form_row(registrationForm.lname, {
            label: 'Last name'
        }) }}
        {{ form_row(registrationForm.plainPassword, {
            label: 'Password'
        }) }}
        {{ form_row(registrationForm.agreeTerms) }}

        <button type=\"submit\" class=\"btn\">Register</button>
    {{ form_end(registrationForm) }}
    </div>
#}
    <div class=\"container px-5 my-5\">
        <div class=\"row justify-content-md-center text-center\">
            <h2>Register</h2>
        </div>
        <div class=\"row justify-content-md-center\">
            <div class=\"col col-4\">
                {{ form_start(registrationForm) }}
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"email\" id=\"registration_form_email\" name=\"registration_form[email]\" placeholder=\"Email Address\" required=\"required\" maxlength=\"180\">
                        <label for=\"registration_form_email\">Email Address</label>
                    </div>
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"text\" id=\"registration_form_fname\" name=\"registration_form[fname]\" placeholder=\"First Name\" required=\"required\">
                        <label for=\"registration_form_fname\">First Name</label>
                    </div>
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"text\" id=\"registration_form_lname\" name=\"registration_form[lname]\" placeholder=\"Last Name\" required=\"required\">
                        <label for=\"registration_form_lname\">Last Name</label>
                    </div>
                    <div class=\"form-floating mb-3\">
                        <input class=\"form-control\" type=\"password\" id=\"registration_form_plainPassword\" name=\"registration_form[plainPassword]\" placeholder=\"Password\" required=\"required\" autocomplete=\"new-password\">
                        <label for=\"password\">Password</label>
                    </div>

                    {{ form_row(registrationForm.agreeTerms) }}

                    <div class=\"d-grid gap-2\">
                        <button type=\"submit\" class=\"btn btn-primary\" id=\"submitButton\" disabled>Login</button>
                    </div>


                {{ form_end(registrationForm, {'render_rest': false}) }}

                <div class=\"text-center justify-content-md-center my-3\">
                    <p><a href=\"{{ path('app_login') }}\" class=\"link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover\">Already got an account? Login</a></p>
                </div>
            </div>
        </div>
    </div>

{% endblock %}
", "registration/register.html.twig", "C:\\Users\\danie\\PhpStorm\\awd\\templates\\registration\\register.html.twig");
    }
}
