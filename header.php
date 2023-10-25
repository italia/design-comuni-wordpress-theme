<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Design_Comuni_Italia
 */
$theme_locations = get_nav_menu_locations();
$current_group = dci_get_current_group();
?>
<!doctype html>
<html lang="it">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_template_part("template-parts/common/svg"); ?>
<?php get_template_part("template-parts/common/sprites"); ?>
<?php get_template_part("template-parts/common/skiplink"); ?>

<header
    class="it-header-wrapper"
    data-bs-target="#header-nav-wrapper"
    style=""
>
    <?php get_template_part("template-parts/header/slimheader"); ?> 

    <div class="it-nav-wrapper">
    <div class="it-header-center-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="it-header-center-content-wrapper">
              <div class="it-brand-wrapper">
                <a 
                href="<?php echo home_url(); ?>" 
                <?php if(!is_front_page()) echo 'title="Vai alla Homepage"'; ?>>
                    <div class="it-brand-text d-flex align-items-center">
                      <?php get_template_part("template-parts/common/logo"); ?>
                      <div>
                        <div class="it-brand-title"><?php echo dci_get_option("nome_comune"); ?></div>
                        <div class="it-brand-tagline d-none d-md-block">
                          <?php echo dci_get_option("motto_comune"); ?>
                        </div>
                      </div>
                    </div>
                </a>
              </div>
              <div class="it-right-zone">
              <?php
                    $show_socials = dci_get_option( "show_socials", "socials" );
                    if($show_socials == "true") : 
                    $socials = dci_get_option('link_social', 'socials');
                    ?>
                    <div class="it-socials d-none d-lg-flex">
                        <span>Seguici su:</span>
                        <ul>
                            <?php foreach ($socials as $social) { ?>
                              <li>
                                <a href="<?php echo $social['url_social'] ?>" target="_blank">
                                    <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" href="#<?php echo $social['icona_social'] ?>"></use>
                                  </svg>
                                  <span class="visually-hidden"><?php echo $social['nome_social']; ?></span>
                                </a>
                            </li>
                            <?php } ?>                            
                        </ul><!-- /header-social-wrapper -->
                    </div><!-- /it-socials -->
                    <?php endif ?>
                <div class="it-search-wrapper">
                  <span class="d-none d-md-block">Cerca</span>
                  <button class="search-link rounded-icon" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="Cerca nel sito">
                      <svg class="icon">
                        <use href="#it-search"></use>
                      </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="it-header-navbar-wrapper" id="header-nav-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div
              class="navbar navbar-expand-lg has-megamenu"
            >
              <button
                class="custom-navbar-toggler"
                type="button"
                aria-controls="nav4"
                aria-expanded="false"
                aria-label="Mostra/Nascondi la navigazione"
                data-bs-target="#nav4"
                data-bs-toggle="navbarcollapsible"
              >
                <svg class="icon">
                  <use href="#it-burger"></use>
                </svg>
              </button>
              <div class="navbar-collapsable" id="nav4">
                <div class="overlay" style="display: none"></div>
                <div class="close-div">
                  <button class="btn close-menu" type="button">
                    <span class="visually-hidden">Nascondi la navigazione</span>
                    <svg class="icon">
                      <use href="#it-close-big"></use>
                    </svg>
                  </button>
                </div>
                <div class="menu-wrapper">
                <a href="<?php echo home_url(); ?>" aria-label="Vai alla homepage" class="logo-hamburger">
                    <?php get_template_part("template-parts/common/logo-mobile"); ?>
                  <div class="it-brand-text">
                    <div class="it-brand-title"><?php echo dci_get_option("nome_comune"); ?></div>
                  </div>
                </a>
                <nav aria-label="Principale">
                  <?php
                      $location = "menu-header-main";
                      if ( has_nav_menu( $location ) ) {
                          wp_nav_menu(array(
                            "theme_location" => $location, 
                            "depth" => 0,  
                            "menu_class" => "navbar-nav", 
                            'items_wrap' => '<ul class="%2$s" id="%1$s" data-element="main-navigation">%3$s</ul>',
                            "container" => "",
                            'list_item_class'  => 'nav-item',
                            'link_class'   => 'nav-link',
                            'current_group' => $current_group,
                            'walker' => new Main_Menu_Walker()
                          ));
                      }
                    ?>
                </nav>
                <nav aria-label="Secondaria">
                  <?php
                    $location = "menu-header-right";
                    if ( has_nav_menu( $location ) ) {
                        wp_nav_menu(array(
                          "theme_location" => $location, 
                          "depth" => 0,  
                          "menu_class" => "navbar-nav navbar-secondary", 
                          "container" => "",
                          'list_item_class'  => 'nav-item',
                          'link_class'   => 'nav-link',
                          'walker' => new Menu_Header_Right_Walker()
                        ));
                    }
                    ?>
                </nav>
                  <?php
                    $show_socials = dci_get_option( "show_socials", "socials" );
                    if($show_socials == "true") : 
                    $socials = dci_get_option('link_social', 'socials');
                    ?>
                    <div class="it-socials">
                        <span>Seguici su:</span>
                        <ul>
                            <?php foreach ($socials as $social) { ?>
                              <li>
                                <a href="<?php echo $social['url_social'] ?>" target="_blank">
                                    <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" href="#<?php echo $social['icona_social'] ?>"></use>
                                  </svg>
                                  <span class="visually-hidden"><?php echo $social['nome_social']; ?></span>
                                </a>
                            </li>
                            <?php } ?>                            
                        </ul><!-- /header-social-wrapper -->
                    </div><!-- /it-socials -->
                    <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</header>

<?php
if(!is_user_logged_in())
    get_template_part("template-parts/common/access-modal");
?>
