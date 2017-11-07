<?php

/* Web/Login/login.html */
class __TwigTemplate_bf0d11d8b243c1719149d598c4fb9c578da7e817510ca0f300fcbc4ab8f11af8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
<!DOCTYPE html>
<html lang=\"en\" class=\"no-js\">

    <head>

        <meta charset=\"utf-8\">
        <title>Fullscreen Login</title>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta name=\"description\" content=\"\">
        <meta name=\"author\" content=\"\">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel=\"stylesheet\" href=\"/../Static/assets/css/reset.css\">
        <link rel=\"stylesheet\" href=\"/../Static/assets/css/supersized.css\">
        <link rel=\"stylesheet\" href=\"/../Static/assets/css/style.css\">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>
        <![endif]-->

    </head>

    <body>

        <div class=\"page-container\">
            <h1>Login</h1>
            <form action=\"\" method=\"post\">
                <input type=\"text\" name=\"username\" class=\"username\" placeholder=\"Username\">
                <input type=\"password\" name=\"password\" class=\"password\" placeholder=\"Password\">
                <button type=\"submit\">Sign me in</button>
                <div class=\"error\"><span>+</span></div>
            </form>
            <div class=\"connect\">
                <p>Or connect with:</p>
                <p>
                    <a class=\"facebook\" href=\"\"></a>
                    <a class=\"twitter\" href=\"\"></a>
                </p>
            </div>
            
        </div>
        <!-- Javascript -->
        <script src=\"/../Static/assets/js/jquery-1.8.2.min.js\"></script>
        <script src=\"/../Static/assets/js/supersized.3.2.7.min.js\"></script>
        <script src=\"/../Static/assets/js/supersized-init.js\"></script>
        <script src=\"/../Static/assets/js/scripts.js\"></script>

    </body>

</html>

";
    }

    public function getTemplateName()
    {
        return "Web/Login/login.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Web/Login/login.html", "/home/wwwroot/frame/Application/View/Web/Login/login.html");
    }
}
