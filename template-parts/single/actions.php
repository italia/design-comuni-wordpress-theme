<?php
global $post;
$argomenti = get_the_terms($post, 'argomenti');
$post_url = get_permalink();
?>

<div class="dropdown">
    <button
        class="btn btn-dropdown dropdown-toggle"
        type="button"
        id="shareActions"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
    >
        <svg class="icon">
            <use xlink:href="#it-share"></use>
        </svg>
        <small>Condividi</small>
    </button>
    <div class="dropdown-menu shadow-lg" aria-labelledby="shareActions">
        <div class="link-list-wrapper">
            <ul class="link-list">
                <li>
                <a class="list-item" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" aria-label="Condividi questo articolo su facebook" title="Condividi questo articolo su facebook" target="_blank">
                <svg class="icon">
                    <use
                        xlink:href="#it-facebook"
                    ></use>
                    </svg>
                    <span>Facebook</span></a
                >
                </li>
                <li>
                <a class="list-item" href="https://twitter.com/intent/tweet?text=<?php echo $post_url; ?>" aria-label="Condividi questo articolo su twitter" title="Condividi questo articolo su twitter" target="_blank">
                <svg class="icon">
                    <use
                        xlink:href="#it-twitter"
                    ></use>
                    </svg>
                    <span>Twitter</span></a
                >
                </li>
                <li>
                <a class="list-item" href="https://www.linkedin.com/shareArticle?url=<?php echo $post_url; ?>" aria-label="Condividi questo articolo su linkedin" title="Condividi questo articolo su linkedin" target="_blank">
                <svg class="icon">
                    <use
                        xlink:href="#it-linkedin"
                    ></use>
                    </svg>
                    <span>Linkedin</span></a
                >
                </li>
                <li>
                <a class="list-item" href="https://api.whatsapp.com/send?text=<?php echo $post_url; ?>" aria-label="Condividi questo articolo su whatsapp" title="Condividi questo articolo su whatsapp" target="_blank">
                <svg class="icon">
                    <use
                        xlink:href="#it-whatsapp"
                    ></use>
                    </svg>
                    <span>Whatsapp</span></a
                >
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="dropdown">
    <button
        class="btn btn-dropdown dropdown-toggle"
        type="button"
        id="viewActions"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
    >
        <svg class="icon">
        <use
            xlink:href="#it-more-items"
        ></use>
        </svg>
        <small>Vedi azioni</small>
    </button>
    <div class="dropdown-menu shadow-lg" aria-labelledby="viewActions">
        <div class="link-list-wrapper">
            <ul class="link-list">
                <li>
                <a class="list-item" href="#" aria-label="Scarica notizia" title="Scarica notizia"
                    ><svg class="icon">
                    <use
                        xlink:href="#it-download"
                    ></use>
                    </svg>
                    <span>Scarica</span></a
                >
                </li>
                <li>
                <a class="list-item" href="#" onclick="window.print()"  aria-label="Stampa notizia" title="Stampa notizia">
                    <svg class="icon">
                    <use
                        xlink:href="#it-print"
                    ></use>
                    </svg>
                    <span>Stampa</span></a
                >
                </li>
                <li>
                <a class="list-item" href="#"  aria-label="Ascolta notizia" title="Ascolta notizia"
                    ><svg class="icon">
                    <use
                        xlink:href="#it-hearing"
                    ></use>
                    </svg>
                    <span>Ascolta</span></a
                >
                </li>
                <li>
                <a class="list-item" href="mailto:?subject=<?php echo the_title(); ?>&body=<?php echo get_permalink(); ?>" aria-label="Invia notizia" title="Invia notizia"
                    ><svg class="icon">
                    <use
                        xlink:href="#it-mail"
                    ></use>
                    </svg>
                    <span>Invia</span></a
                >
                </li>
            </ul>
        </div>
    </div>
</div>
<?php if (is_array($argomenti) && count($argomenti) ) { ?>
<div class="mt-4 mb-4">
    <h6><small>Argomenti</small></h6>
    <?php foreach ($argomenti as $argomento) { ?>
    <a href="<?php echo get_term_link($argomento->term_id); ?>" aria-label="Vai all'argomento: <?php echo $argomento->name; ?>" title="Vai all'argomento: <?php echo $argomento->name; ?>" data-element="service-topic">
        <div class="chip chip-simple chip-primary">
            <span class="chip-label"><?php echo $argomento->name; ?></span>
        </div>
    </a>
    <?php } ?>
</div>
<?php } ?>