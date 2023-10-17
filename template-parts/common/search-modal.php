<?php 
  $links = dci_get_option('contenuti','ricerca');
?>
<!-- Search Modal -->
<div
    class="modal fade search-modal"
    id="search-modal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
  >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content perfect-scrollbar">
      <div class="modal-body">
        <form role="search" id="search-form-modal" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
          <div class="container">
            <div class="row variable-gutters">
              <div class="col">
                <div class="modal-title">
                  <button
                    class="search-link d-md-none"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#search-modal"
                    aria-label="Cerca nel sito"
                  >
                    <svg class="icon icon-md">
                      <use
                        href="#it-arrow-left"
                      ></use>
                    </svg>
                  </button>
                  <h2><?php _e("Cerca","design_comuni_italia"); ?></h2>
                  <button
                    class="search-link d-none d-md-block"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#search-modal"
                    data-dismiss="modal" 
                    aria-label="Chiudi e torna alla pagina precedente"
                  >
                    <svg class="icon icon-md">
                      <use
                        href="#it-close-big"
                      ></use>
                    </svg>
                  </button>
                </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <svg class="icon icon-md">
                            <use
                              href="#it-search"
                            ></use>
                          </svg>
                        </div>
                      </div>
                      <label for="search">Con Etichetta</label>
                      <input
                        type="search"
                        class="form-control"
                        id="search"
                        name="s"
                        placeholder="<?php _e("Cerca nel sito","design_comuni_italia"); ?>"
                        value="<?php echo get_search_query(); ?>"
                      />
                    </div>
                    <button type="submit" class="btn btn-primary">
                      <span class="">Cerca</span>
                    </button>
                  </div>
              </div>
            </div>
            <?php if ($links) { ?>
            <div class="row variable-gutters">
              <div class="col-lg-5">
                <div class="searches-list-wrapper">
                  <div class="other-link-title">FORSE STAVI CERCANDO</div>
                  <ul class="searches-list">
                    <?php foreach ($links as $link_id) { 
                      $link = get_post($link_id);  
                    ?>
                      <li>
                          <a class="list-item mb-3 active ps-0" href="<?php echo get_permalink($link_id); ?>" aria-label="Vai alla pagina <?php echo $link->post_title; ?>" title="Vai alla pagina <?php echo $link->post_title; ?>"
                          ><span class="text-button-normal"
                              ><?php echo $link->post_title; ?></span
                          ></a
                          >
                      </li>
                  <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Search Modal -->

