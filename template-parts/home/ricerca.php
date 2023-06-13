<?php
    $links = dci_get_option('link','link_utili');
?>

<section id="novita" class="useful-links-section">
    <div class="section section-muted p-0 py-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-lg-6">
                <form role="search" id="search-form" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="cmp-input-search">
                        <div class="form-group autocomplete-wrapper mb-2 mb-lg-4">
                            <div class="input-group">
                                <label for="autocomplete-three" class="visually-hidden">Cerca una parola chiave</label>
                                <input type="search" class="autocomplete form-control" placeholder="Cerca una parola chiave" id="autocomplete-three" name="s" value="<?php echo get_search_query(); ?>" data-bs-autocomplete="[]">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-3">Invio</button>
                                </div>
                                <span class="autocomplete-icon" aria-hidden="true">
                                    <svg class="icon icon-sm icon-primary"><use href="#it-search"></use></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <?php if ($links) { ?>
                <div class="link-list-wrapper">
                    <div
                    class="link-list-heading text-uppercase mt-2 mt-lg-4 mb-3 ps-0"
                    >
                    Link utili
                    </div>
                    <ul class="link-list">
                        <?php foreach ($links as $link) { ?>
                            <li>
                                <a class="list-item mb-3 active ps-0" href="<?php echo $link['url']; ?>">
                                <span class="text-button-normal"
                                    ><?php echo $link['testo']; ?>
                                </span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
