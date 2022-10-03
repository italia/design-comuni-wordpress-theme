<div class="it-header-slim-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="it-header-slim-wrapper-content">
          <a class="d-lg-block navbar-brand" target="_blank" href="<?php echo dci_get_option("url_sito_regione"); ?>" target="_blank" aria-label="Vai al portale <?php echo dci_get_option("nome_regione"); ?> - link esterno - apertura nuova scheda" title="Vai al portale <?php echo dci_get_option("nome_regione"); ?>"><?php echo dci_get_option("nome_regione"); ?></a>
          <div class="it-header-slim-right-zone" role="navigation">
            <div class="nav-item dropdown">
              <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true">
                <span class="visually-hidden">Lingua attiva:</span>
                <span>ITA</span>
                <svg class="icon">
                    <use href="#it-expand"></use>
                  </svg>
              </button>
              <div class="dropdown-menu">
                <div class="row">
                  <div class="col-12">
                    <div class="link-list-wrapper">
                      <ul class="link-list">
                        <li>
                          <a class="dropdown-item list-item" href="#">
                            <span>ITA<span class="visually-hidden">selezionata</span></span>
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item list-item" href="#">
                            <span>ENG</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
                if(!is_user_logged_in()) {
                    get_template_part("template-parts/header/header-anon");
                }else{
                    get_template_part("template-parts/header/header-logged");
                }
              ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
