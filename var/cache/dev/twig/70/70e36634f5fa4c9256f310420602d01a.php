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
class __TwigTemplate_c857f113d80f5c979e6d250176d92676 extends Template
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
        echo "    <div class=\"container px-5 my-5\">
        <div class=\"row justify-content-md-center text-center\">
            <h2>Register</h2>
        </div>
        <div class=\"row justify-content-md-center\">
            <div class=\"col col-4\">
                ";
        // line 12
        if ((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 12, $this->source); })())) {
            // line 13
            echo "                    <div class=\"row justify-content-md-center text-center\">
                        <div class=\"alert alert-danger\" role=\"alert\">
                            ";
            // line 15
            echo twig_escape_filter($this->env, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 15, $this->source); })()), "html", null, true);
            echo "
                        </div>
                    </div>
                ";
        }
        // line 19
        echo "                <div class=\"row\">
                    ";
        // line 20
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 20, $this->source); })()), 'form_start');
        echo "
                        <div class=\"form-floating mb-3\">
                            <input class=\"form-control\" type=\"email\" id=\"registration_form_email\" name=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldName(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 22, $this->source); })()), "email", [], "any", false, false, false, 22)), "html", null, true);
        echo "\" placeholder=\"Email Address\" required=\"required\" maxlength=\"180\">
                            <label for=\"registration_form_email\">";
        // line 23
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldLabel(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 23, $this->source); })()), "email", [], "any", false, false, false, 23)), "html", null, true);
        echo "</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input class=\"form-control\" type=\"text\" id=\"registration_form_fname\" name=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldName(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 26, $this->source); })()), "fname", [], "any", false, false, false, 26)), "html", null, true);
        echo "\" placeholder=\"First Name\" required=\"required\">
                            <label for=\"registration_form_fname\">";
        // line 27
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldLabel(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 27, $this->source); })()), "fname", [], "any", false, false, false, 27)), "html", null, true);
        echo "</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input class=\"form-control\" type=\"text\" id=\"registration_form_lname\" name=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldName(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 30, $this->source); })()), "lname", [], "any", false, false, false, 30)), "html", null, true);
        echo "\" placeholder=\"Last Name\" required=\"required\">
                            <label for=\"registration_form_lname\">";
        // line 31
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldLabel(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 31, $this->source); })()), "lname", [], "any", false, false, false, 31)), "html", null, true);
        echo "</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input class=\"form-control\" type=\"password\" id=\"registration_form_plainPassword\" name=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldName(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 34, $this->source); })()), "plainPassword", [], "any", false, false, false, 34)), "html", null, true);
        echo "\" placeholder=\"Password\" required=\"required\" autocomplete=\"new-password\">
                            <label for=\"registration_form_plainPassword\">";
        // line 35
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldLabel(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 35, $this->source); })()), "plainPassword", [], "any", false, false, false, 35)), "html", null, true);
        echo "</label>
                        </div>

                        ";
        // line 38
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 38, $this->source); })()), "agreeTerms", [], "any", false, false, false, 38), 'row');
        echo "

                        <div class=\"d-grid gap-2\">
                            <button type=\"submit\" class=\"btn btn-primary\" id=\"submitButton\" name=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldName(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 41, $this->source); })()), "submit", [], "any", false, false, false, 41)), "html", null, true);
        echo "\" disabled>";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldLabel(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 41, $this->source); })()), "submit", [], "any", false, false, false, 41)), "html", null, true);
        echo "</button>
                        </div>


                    ";
        // line 45
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 45, $this->source); })()), 'form_end');
        echo "

                    <div class=\"text-center justify-content-md-center my-3\">
                        <p><a href=\"";
        // line 48
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        echo "\" class=\"link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover\">Already got an account? Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src=\"";
        // line 55
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/register.js"), "html", null, true);
        echo "\"></script>

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
        return array (  188 => 55,  178 => 48,  172 => 45,  163 => 41,  157 => 38,  151 => 35,  147 => 34,  141 => 31,  137 => 30,  131 => 27,  127 => 26,  121 => 23,  117 => 22,  112 => 20,  109 => 19,  102 => 15,  98 => 13,  96 => 12,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Register{% endblock %}

{% block body %}
    <div class=\"container px-5 my-5\">
        <div class=\"row justify-content-md-center text-center\">
            <h2>Register</h2>
        </div>
        <div class=\"row justify-content-md-center\">
            <div class=\"col col-4\">
                {% if error %}
                    <div class=\"row justify-content-md-center text-center\">
                        <div class=\"alert alert-danger\" role=\"alert\">
                            {{ error }}
                        </div>
                    </div>
                {% endif %}
                <div class=\"row\">
                    {{ form_start(registrationForm) }}
                        <div class=\"form-floating mb-3\">
                            <input class=\"form-control\" type=\"email\" id=\"registration_form_email\" name=\"{{ field_name(registrationForm.email) }}\" placeholder=\"Email Address\" required=\"required\" maxlength=\"180\">
                            <label for=\"registration_form_email\">{{ field_label(registrationForm.email) }}</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input class=\"form-control\" type=\"text\" id=\"registration_form_fname\" name=\"{{ field_name(registrationForm.fname) }}\" placeholder=\"First Name\" required=\"required\">
                            <label for=\"registration_form_fname\">{{ field_label(registrationForm.fname) }}</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input class=\"form-control\" type=\"text\" id=\"registration_form_lname\" name=\"{{ field_name(registrationForm.lname) }}\" placeholder=\"Last Name\" required=\"required\">
                            <label for=\"registration_form_lname\">{{ field_label(registrationForm.lname) }}</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input class=\"form-control\" type=\"password\" id=\"registration_form_plainPassword\" name=\"{{ field_name(registrationForm.plainPassword) }}\" placeholder=\"Password\" required=\"required\" autocomplete=\"new-password\">
                            <label for=\"registration_form_plainPassword\">{{ field_label(registrationForm.plainPassword) }}</label>
                        </div>

                        {{ form_row(registrationForm.agreeTerms) }}

                        <div class=\"d-grid gap-2\">
                            <button type=\"submit\" class=\"btn btn-primary\" id=\"submitButton\" name=\"{{ field_name(registrationForm.submit) }}\" disabled>{{ field_label(registrationForm.submit) }}</button>
                        </div>


                    {{ form_end(registrationForm) }}

                    <div class=\"text-center justify-content-md-center my-3\">
                        <p><a href=\"{{ path('app_login') }}\" class=\"link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover\">Already got an account? Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src=\"{{ asset('js/register.js') }}\"></script>

{% endblock %}
", "registration/register.html.twig", "/Users/danroberts/PhpstormProjects/awd/templates/registration/register.html.twig");
    }
}
