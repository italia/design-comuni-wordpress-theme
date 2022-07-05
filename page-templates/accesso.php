<?php
/* Template Name: Accesso
 *
 * accesso template file
 *
 * @package Design_Scuole_Italia
 */
global $post;
get_header();

?>
  <main>
    <div class="container" id="main-container">
      <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
          <?php get_template_part('template-parts/common/breadcrumb'); ?>
          <div class="cmp-heading pb-4">
            <h1 class="title-xxxlarge">Accedi</h1>
            <p class="subtitle-small mb-2">
              Per accedere al sito e ai suoi servizi, utilizza una delle
              seguenti modalità
            </p>
          </div>
        </div>
      </div>
      <hr class="d-none d-lg-block mb-2" />
      <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">
          <div class="cmp-text-button">
            <h2 class="title-xxlarge mb-0">SPID</h2>
            <div class="text-wrapper">
              <p class="subtitle-small mb-3">
                Accedi con SPID, il sistema Pubblico di Identità Digitale.
              </p>
            </div>
            <div class="button-wrapper mb-2">
              <button
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#"
                class="btn btn-primary btn-icon btn-re square"
              >
                <span class="rounded-icon"
                  ><svg class="icon icon-primary mb-1">
                    <use
                      href="#it-user"
                    ></use>
                  </svg> </span
                ><span class="">Entra con SPID</span>
              </button>
            </div>
            <a class="u-main-primary simple-link" href="#"
              >Come attivare SPID
              <span class="visually-hidden">Come attivare SPID</span></a
            >
          </div>
          <div class="cmp-text-button">
            <h2 class="title-xxlarge mb-0">CIE</h2>
            <div class="text-wrapper">
              <p class="subtitle-small mb-3">
                Accedi con la tua Carta d’Identità Elettronica.
              </p>
            </div>
            <div class="button-wrapper mb-2">
              <button
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#"
                class="btn btn-primary btn-icon btn-re square"
              >
                <span class="rounded-icon"
                  ><svg class="icon icon-primary mb-1">
                    <use
                      href="#it-user"
                    ></use>
                  </svg> </span
                ><span class="">Entra con CIE</span>
              </button>
            </div>
            <a class="u-main-primary simple-link" href="#"
              >Come richiedere CIE
              <span class="visually-hidden">Come richiedere CIE</span></a
            >
          </div>
          <div class="cmp-text-button">
            <h2 class="title-xxlarge mb-0">Altre utenze</h2>
            <div class="text-wrapper">
              <p class="subtitle-small mb-3">
                In alternativa puoi utilizzare le seguenti modalità.
              </p>
            </div>
            <div class="button-wrapper d-md-flex">
              <button
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#"
                class="btn btn-outline-primary btn-re pr-md-4"
              >
                <span class="">Accedi con ID azienda</span>
              </button>
              <button
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#"
                class="btn btn-outline-primary btn-re"
                onclick="location.href='/wp-admin'"
              >
                <span class="">Accedi come dipendente</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php get_template_part('template-parts/common/assistenza-contatti'); ?>
  </main>

<?php
get_footer();



