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

/* themes/startup_zymphonies_theme/templates/layout/page.html.twig */
class __TwigTemplate_ef6de1b28d165f810dbeedd32fe058c7 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 60
        echo "
<div class=\"header\">
  <div class=\"container\">
    <div class=\"row\">

      <!-- Start: Header -->

      <div class=\"navbar-header col-md-3\">
        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#main-navigation\">
          <i class=\"fas fa-bars\"></i>
        </button>
        ";
        // line 71
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 71)) {
            // line 72
            echo "          ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 72), 72, $this->source), "html", null, true);
            echo "
        ";
        }
        // line 74
        echo "      </div>

      <!-- End: Header -->

      ";
        // line 78
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 78) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "search", [], "any", false, false, true, 78))) {
            // line 79
            echo "        <div class=\"col-md-9\">

          ";
            // line 81
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "search", [], "any", false, false, true, 81)) {
                // line 82
                echo "            ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "search", [], "any", false, false, true, 82), 82, $this->source), "html", null, true);
                echo "
          ";
            }
            // line 84
            echo "
          ";
            // line 85
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 85), 85, $this->source), "html", null, true);
            echo "
          
        </div>
      ";
        }
        // line 89
        echo "
      </div>

    </div>
  </div>
</div>


";
        // line 97
        if ((($context["is_front"] ?? null) && ($context["show_slideshow"] ?? null))) {
            // line 98
            echo "  <div class=\"flexslider\">
    <ul class=\"slides\">
      ";
            // line 100
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["slider_content"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["slider_contents"]) {
                // line 101
                echo "        ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed($context["slider_contents"], 101, $this->source));
                echo "
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['slider_contents'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 103
            echo "    </ul>
  </div>
";
        }
        // line 106
        echo "

<!-- Start: Top widget -->

";
        // line 110
        if (((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "topwidget_first", [], "any", false, false, true, 110) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "topwidget_second", [], "any", false, false, true, 110)) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "topwidget_third", [], "any", false, false, true, 110))) {
            // line 111
            echo "  <div class=\"topwidget\" id=\"topwidget\">
    <div class=\"container\">
        <div class=\"row clearfix\">

          <!-- Start: Top widget first -->          
          ";
            // line 116
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "topwidget_first", [], "any", false, false, true, 116)) {
                // line 117
                echo "            <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["topwidget_class"] ?? null), 117, $this->source), "html", null, true);
                echo ">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "topwidget_first", [], "any", false, false, true, 117), 117, $this->source), "html", null, true);
                echo "</div>
          ";
            }
            // line 118
            echo "          
          <!-- End: Top widget first --> 

          <!-- Start: Top widget second -->          
          ";
            // line 122
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "topwidget_second", [], "any", false, false, true, 122)) {
                // line 123
                echo "            <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["topwidget_class"] ?? null), 123, $this->source), "html", null, true);
                echo ">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "topwidget_second", [], "any", false, false, true, 123), 123, $this->source), "html", null, true);
                echo "</div>
          ";
            }
            // line 124
            echo "          
          <!-- End: Top widget second --> 
          
          <!-- Start: Top widget third -->         
          ";
            // line 128
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "topwidget_third", [], "any", false, false, true, 128)) {
                // line 129
                echo "            <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["topwidget_class"] ?? null), 129, $this->source), "html", null, true);
                echo ">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "topwidget_third", [], "any", false, false, true, 129), 129, $this->source), "html", null, true);
                echo "</div>
          ";
            }
            // line 130
            echo "          
          <!-- End: Top widget third -->

        </div>
    </div>
  </div>
";
        }
        // line 137
        echo "
<!--End: Top widget -->

    
<!--Start: Highlighted -->

";
        // line 143
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 143)) {
            // line 144
            echo "  <div class=\"highlighted\">
    <div class=\"container\">
      ";
            // line 146
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 146), 146, $this->source), "html", null, true);
            echo "
    </div>
  </div>
";
        }
        // line 150
        echo "
<!--End: Highlighted -->

<!--Start: Title -->

";
        // line 155
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "page_title", [], "any", false, false, true, 155) &&  !($context["is_front"] ?? null))) {
            // line 156
            echo "  <div id=\"page-title\">
    <div id=\"page-title-inner\">
      <div class=\"container\">
        ";
            // line 159
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "page_title", [], "any", false, false, true, 159), 159, $this->source), "html", null, true);
            echo "
      </div>
    </div>
  </div>
";
        }
        // line 164
        echo "
<!--End: Title -->

<div class=\"main-content\">
  <div class=\"container\">
    <div class=\"\">

      <!--Start: Breadcrumb -->

      ";
        // line 173
        if ( !($context["is_front"] ?? null)) {
            // line 174
            echo "        <div class=\"row\">
          <div class=\"col-md-12\">";
            // line 175
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 175), 175, $this->source), "html", null, true);
            echo "</div>
        </div>
      ";
        }
        // line 178
        echo "
      <!--End: Breadcrumb -->

      <div class=\"row layout\">

        <!--- Start: Left SideBar -->
        ";
        // line 184
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 184)) {
            // line 185
            echo "          <div class=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebarfirst"] ?? null), 185, $this->source), "html", null, true);
            echo ">
            <div class=\"sidebar\">
              ";
            // line 187
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 187), 187, $this->source), "html", null, true);
            echo "
            </div>
          </div>
        ";
        }
        // line 191
        echo "        <!-- End Left SideBar -->

        <!--- Start Content -->
        ";
        // line 194
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 194)) {
            // line 195
            echo "          <div class=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["contentlayout"] ?? null), 195, $this->source), "html", null, true);
            echo ">
            <div class=\"content_layout\">
              ";
            // line 197
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 197), 197, $this->source), "html", null, true);
            echo "
            </div>              
          </div>
        ";
        }
        // line 201
        echo "        <!-- End: Content -->

        <!-- Start: Right SideBar -->
        ";
        // line 204
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 204)) {
            // line 205
            echo "          <div class=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebarsecond"] ?? null), 205, $this->source), "html", null, true);
            echo ">
            <div class=\"sidebar\">
              ";
            // line 207
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 207), 207, $this->source), "html", null, true);
            echo "
            </div>
          </div>
        ";
        }
        // line 211
        echo "        <!-- End: Right SideBar -->
        
      </div>
    
    </div>
  </div>
</div>

<!-- End: Main content -->


<!-- Start: Features -->

";
        // line 224
        if (((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "features_first", [], "any", false, false, true, 224) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "features_second", [], "any", false, false, true, 224)) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "features_third", [], "any", false, false, true, 224))) {
            // line 225
            echo "
  <div class=\"features\">
    <div class=\"container\">
      <div class=\"row\">

        <!-- Start: Features First -->
        ";
            // line 231
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "features_first", [], "any", false, false, true, 231)) {
                // line 232
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["features_first_class"] ?? null), 232, $this->source), "html", null, true);
                echo ">
            ";
                // line 233
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "features_first", [], "any", false, false, true, 233), 233, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 236
            echo "        <!-- End: Features First -->

        <!-- Start :Features Second -->
        ";
            // line 239
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "features_second", [], "any", false, false, true, 239)) {
                // line 240
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["features_class"] ?? null), 240, $this->source), "html", null, true);
                echo ">
            ";
                // line 241
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "features_second", [], "any", false, false, true, 241), 241, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 244
            echo "        <!-- End: Features Second -->

        <!-- Start: Features third -->
        ";
            // line 247
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "features_third", [], "any", false, false, true, 247)) {
                // line 248
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["features_class"] ?? null), 248, $this->source), "html", null, true);
                echo ">
            ";
                // line 249
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "features_third", [], "any", false, false, true, 249), 249, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 252
            echo "        <!-- End: Features Third -->

      </div>
    </div>
  </div>

";
        }
        // line 259
        echo "
<!--End: Features -->


<!-- Start: Services -->

";
        // line 265
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "services", [], "any", false, false, true, 265)) {
            // line 266
            echo "
  <div class=\"services\" id=\"services\">
    <div class=\"container\">
      ";
            // line 269
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "services", [], "any", false, false, true, 269), 269, $this->source), "html", null, true);
            echo "
    </div>
  </div>

";
        }
        // line 274
        echo "
<!--End: Services -->



<!-- Start: Services -->

";
        // line 281
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "products", [], "any", false, false, true, 281)) {
            // line 282
            echo "
  <!-- <div class=\"products\" id=\"products\">
    <div class=\"container\">
      ";
            // line 285
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "products", [], "any", false, false, true, 285), 285, $this->source), "html", null, true);
            echo "
    </div>
  </div> -->

";
        }
        // line 290
        echo "
<!--End: Services -->


<!-- Start: Price table widgets -->

";
        // line 296
        if (((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "pricetable_first", [], "any", false, false, true, 296) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "pricetable_second", [], "any", false, false, true, 296)) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "pricetable_third", [], "any", false, false, true, 296))) {
            // line 297
            echo "
  <div class=\"price-table\" id=\"price-table\">    
    <div class=\"container\">
      <div class=\"row\">

        <!-- Start: Bottom First -->          
        ";
            // line 303
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "pricetable_first", [], "any", false, false, true, 303)) {
                // line 304
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["pricetable_class"] ?? null), 304, $this->source), "html", null, true);
                echo ">
            ";
                // line 305
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "pricetable_first", [], "any", false, false, true, 305), 305, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 307
            echo "          
        <!-- End: Bottom First -->

        <!-- Start: Bottom Second -->
        ";
            // line 311
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "pricetable_second", [], "any", false, false, true, 311)) {
                // line 312
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["pricetable_class"] ?? null), 312, $this->source), "html", null, true);
                echo ">
            ";
                // line 313
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "pricetable_second", [], "any", false, false, true, 313), 313, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 315
            echo "          
        <!-- End: Bottom Second -->

        <!-- Start: Bottom third -->          
        ";
            // line 319
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "pricetable_third", [], "any", false, false, true, 319)) {
                // line 320
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["pricetable_class"] ?? null), 320, $this->source), "html", null, true);
                echo ">
            ";
                // line 321
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "pricetable_third", [], "any", false, false, true, 321), 321, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 323
            echo "          
        <!-- End: Bottom Third -->

        <!-- Start: Bottom third -->          
        ";
            // line 327
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "pricetable_forth", [], "any", false, false, true, 327)) {
                // line 328
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["pricetable_class"] ?? null), 328, $this->source), "html", null, true);
                echo ">
            ";
                // line 329
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "pricetable_forth", [], "any", false, false, true, 329), 329, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 331
            echo "          
        <!-- End: Bottom Third -->

      </div>
    </div>
  </div>

";
        }
        // line 339
        echo "
<!--End: Price table widgets -->


<!-- Start: Bottom widgets -->

";
        // line 345
        if ((((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_first", [], "any", false, false, true, 345) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_second", [], "any", false, false, true, 345)) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_third", [], "any", false, false, true, 345)) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_forth", [], "any", false, false, true, 345))) {
            // line 346
            echo "
  <div class=\"bottom-widget\" id=\"bottom-widget\">    
    <div class=\"container\">
      <div class=\"row\">

        <!-- Start: Bottom First -->          
        ";
            // line 352
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_first", [], "any", false, false, true, 352)) {
                // line 353
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null), 353, $this->source), "html", null, true);
                echo ">
            ";
                // line 354
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_first", [], "any", false, false, true, 354), 354, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 356
            echo "          
        <!-- End: Bottom First -->

        <!-- Start: Bottom Second -->
        ";
            // line 360
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_second", [], "any", false, false, true, 360)) {
                // line 361
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null), 361, $this->source), "html", null, true);
                echo ">
            ";
                // line 362
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_second", [], "any", false, false, true, 362), 362, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 364
            echo "          
        <!-- End: Bottom Second -->

        <!-- Start: Bottom third -->          
        ";
            // line 368
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_third", [], "any", false, false, true, 368)) {
                // line 369
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null), 369, $this->source), "html", null, true);
                echo ">
            ";
                // line 370
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_third", [], "any", false, false, true, 370), 370, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 372
            echo "          
        <!-- End: Bottom Third -->

        <!-- Start: Bottom Forth -->
        ";
            // line 376
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_forth", [], "any", false, false, true, 376)) {
                // line 377
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null), 377, $this->source), "html", null, true);
                echo ">
            ";
                // line 378
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "bottom_forth", [], "any", false, false, true, 378), 378, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 381
            echo "        <!-- End: Bottom Forth -->

      </div>
    </div>
  </div>

";
        }
        // line 388
        echo "
<!--End: Bottom widgets -->


<!-- Start: Team widgets -->

";
        // line 394
        if ((((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_first", [], "any", false, false, true, 394) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_second", [], "any", false, false, true, 394)) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_third", [], "any", false, false, true, 394)) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_forth", [], "any", false, false, true, 394))) {
            // line 395
            echo "
  <div class=\"team\" id=\"team\">    
    <div class=\"container\">
      <div class=\"row\">

        <!-- Start: Bottom First -->          
        ";
            // line 401
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_first", [], "any", false, false, true, 401)) {
                // line 402
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["team_class"] ?? null), 402, $this->source), "html", null, true);
                echo ">
            ";
                // line 403
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_first", [], "any", false, false, true, 403), 403, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 405
            echo "          
        <!-- End: Bottom First -->

        <!-- Start: Bottom Second -->
        ";
            // line 409
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_second", [], "any", false, false, true, 409)) {
                // line 410
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["team_class"] ?? null), 410, $this->source), "html", null, true);
                echo ">
            ";
                // line 411
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_second", [], "any", false, false, true, 411), 411, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 413
            echo "          
        <!-- End: Bottom Second -->

        <!-- Start: Bottom third -->          
        ";
            // line 417
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_third", [], "any", false, false, true, 417)) {
                // line 418
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["team_class"] ?? null), 418, $this->source), "html", null, true);
                echo ">
            ";
                // line 419
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_third", [], "any", false, false, true, 419), 419, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 421
            echo "          
        <!-- End: Bottom Third -->

        <!-- Start: Bottom Forth -->
        ";
            // line 425
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_forth", [], "any", false, false, true, 425)) {
                // line 426
                echo "          <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["team_class"] ?? null), 426, $this->source), "html", null, true);
                echo ">
            ";
                // line 427
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "team_forth", [], "any", false, false, true, 427), 427, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 430
            echo "        <!-- End: Bottom Forth -->

      </div>
    </div>
  </div>

";
        }
        // line 437
        echo "
<!--End: Team widgets -->


<!-- Start: Footer widgets -->

";
        // line 443
        if (((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_first", [], "any", false, false, true, 443) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_second", [], "any", false, false, true, 443)) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_third", [], "any", false, false, true, 443))) {
            // line 444
            echo "
  <div class=\"footer\" id=\"footer\">
    <div class=\"container\">
      <div class=\"parallax-region wow- bounceInUp\">  
        <div class=\"row\">

          <!-- Start: Footer First -->
          ";
            // line 451
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_first", [], "any", false, false, true, 451)) {
                // line 452
                echo "            <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["footer_class"] ?? null), 452, $this->source), "html", null, true);
                echo ">
              ";
                // line 453
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_first", [], "any", false, false, true, 453), 453, $this->source), "html", null, true);
                echo "
            </div>
          ";
            }
            // line 456
            echo "          <!-- End: Footer First -->

          <!-- Start :Footer Second -->
          ";
            // line 459
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_second", [], "any", false, false, true, 459)) {
                // line 460
                echo "            <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["footer_class"] ?? null), 460, $this->source), "html", null, true);
                echo ">
              ";
                // line 461
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_second", [], "any", false, false, true, 461), 461, $this->source), "html", null, true);
                echo "
            </div>
          ";
            }
            // line 464
            echo "          <!-- End: Footer Second -->

          <!-- Start: Footer third -->
          ";
            // line 467
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_third", [], "any", false, false, true, 467)) {
                // line 468
                echo "            <div class = ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["footer_class"] ?? null), 468, $this->source), "html", null, true);
                echo ">
              ";
                // line 469
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_third", [], "any", false, false, true, 469), 469, $this->source), "html", null, true);
                echo "
            </div>
          ";
            }
            // line 472
            echo "          <!-- End: Footer Third -->

        </div>
      </div>
    </div>
  </div>

";
        }
        // line 480
        echo "
<!--End: Footer widgets -->

<!-- Start: Copyright -->

<div class=\"copyright\">

    <div class=\"container\">

      ";
        // line 489
        if (($context["show_social_icon"] ?? null)) {
            // line 490
            echo "        <p class=\"social-media\">
          ";
            // line 491
            if (($context["facebook_url"] ?? null)) {
                // line 492
                echo "            <a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["facebook_url"] ?? null), 492, $this->source), "html", null, true);
                echo "\"  class=\"facebook\" target=\"_blank\" ><i class=\"fab fa-facebook-f\"></i></a>
          ";
            }
            // line 494
            echo "          ";
            if (($context["google_plus_url"] ?? null)) {
                // line 495
                echo "            <a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["google_plus_url"] ?? null), 495, $this->source), "html", null, true);
                echo "\"  class=\"google-plus\" target=\"_blank\" ><i class=\"fab fa-google-plus-g\"></i></a>
          ";
            }
            // line 497
            echo "          ";
            if (($context["twitter_url"] ?? null)) {
                // line 498
                echo "            <a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["twitter_url"] ?? null), 498, $this->source), "html", null, true);
                echo "\" class=\"twitter\" target=\"_blank\" ><i class=\"fab fa-twitter\"></i></a>
          ";
            }
            // line 500
            echo "          ";
            if (($context["linkedin_url"] ?? null)) {
                // line 501
                echo "            <a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["linkedin_url"] ?? null), 501, $this->source), "html", null, true);
                echo "\" class=\"linkedin\" target=\"_blank\"><i class=\"fab fa-linkedin-in\"></i></a>
          ";
            }
            // line 503
            echo "          ";
            if (($context["pinterest_url"] ?? null)) {
                // line 504
                echo "            <a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["pinterest_url"] ?? null), 504, $this->source), "html", null, true);
                echo "\" class=\"pinterest\" target=\"_blank\" ><i class=\"fab fa-pinterest-p\"></i></a>
          ";
            }
            // line 506
            echo "          ";
            if (($context["rss_url"] ?? null)) {
                // line 507
                echo "            <a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["rss_url"] ?? null), 507, $this->source), "html", null, true);
                echo "\" class=\"rss\" target=\"_blank\" ><i class=\"fa fa-rss\"></i></a>
          ";
            }
            // line 509
            echo "        </p>
      ";
        }
        // line 511
        echo "
      <p>Copyright © ";
        // line 512
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo ". All rights reserved.</p>

      ";
        // line 514
        if (($context["show_credit_link"] ?? null)) {
            // line 515
            echo "        <p class=\"credit-link\">Designed By <a href=\"http://www.zymphonies.com\" target=\"_blank\">Zymphonies</a></p>
      ";
        }
        // line 517
        echo "
  </div>

</div>

<!-- End: Copyright -->





";
    }

    public function getTemplateName()
    {
        return "themes/startup_zymphonies_theme/templates/layout/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  905 => 517,  901 => 515,  899 => 514,  894 => 512,  891 => 511,  887 => 509,  881 => 507,  878 => 506,  872 => 504,  869 => 503,  863 => 501,  860 => 500,  854 => 498,  851 => 497,  845 => 495,  842 => 494,  836 => 492,  834 => 491,  831 => 490,  829 => 489,  818 => 480,  808 => 472,  802 => 469,  797 => 468,  795 => 467,  790 => 464,  784 => 461,  779 => 460,  777 => 459,  772 => 456,  766 => 453,  761 => 452,  759 => 451,  750 => 444,  748 => 443,  740 => 437,  731 => 430,  725 => 427,  720 => 426,  718 => 425,  712 => 421,  706 => 419,  701 => 418,  699 => 417,  693 => 413,  687 => 411,  682 => 410,  680 => 409,  674 => 405,  668 => 403,  663 => 402,  661 => 401,  653 => 395,  651 => 394,  643 => 388,  634 => 381,  628 => 378,  623 => 377,  621 => 376,  615 => 372,  609 => 370,  604 => 369,  602 => 368,  596 => 364,  590 => 362,  585 => 361,  583 => 360,  577 => 356,  571 => 354,  566 => 353,  564 => 352,  556 => 346,  554 => 345,  546 => 339,  536 => 331,  530 => 329,  525 => 328,  523 => 327,  517 => 323,  511 => 321,  506 => 320,  504 => 319,  498 => 315,  492 => 313,  487 => 312,  485 => 311,  479 => 307,  473 => 305,  468 => 304,  466 => 303,  458 => 297,  456 => 296,  448 => 290,  440 => 285,  435 => 282,  433 => 281,  424 => 274,  416 => 269,  411 => 266,  409 => 265,  401 => 259,  392 => 252,  386 => 249,  381 => 248,  379 => 247,  374 => 244,  368 => 241,  363 => 240,  361 => 239,  356 => 236,  350 => 233,  345 => 232,  343 => 231,  335 => 225,  333 => 224,  318 => 211,  311 => 207,  305 => 205,  303 => 204,  298 => 201,  291 => 197,  285 => 195,  283 => 194,  278 => 191,  271 => 187,  265 => 185,  263 => 184,  255 => 178,  249 => 175,  246 => 174,  244 => 173,  233 => 164,  225 => 159,  220 => 156,  218 => 155,  211 => 150,  204 => 146,  200 => 144,  198 => 143,  190 => 137,  181 => 130,  173 => 129,  171 => 128,  165 => 124,  157 => 123,  155 => 122,  149 => 118,  141 => 117,  139 => 116,  132 => 111,  130 => 110,  124 => 106,  119 => 103,  110 => 101,  106 => 100,  102 => 98,  100 => 97,  90 => 89,  83 => 85,  80 => 84,  74 => 82,  72 => 81,  68 => 79,  66 => 78,  60 => 74,  54 => 72,  52 => 71,  39 => 60,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/startup_zymphonies_theme/templates/layout/page.html.twig", "/var/www/html/web/themes/startup_zymphonies_theme/templates/layout/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 71, "for" => 100);
        static $filters = array("escape" => 72, "raw" => 101, "date" => 512);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for'],
                ['escape', 'raw', 'date'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
