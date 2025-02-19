<?php
global $the_query, $load_posts, $load_card_type;

    $max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 3;
    $load_posts = 3;
    $query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
    $args = array(
        's'                 => $query,
        'post_type'         => 'notizia',
        'posts_per_page'    => -1,
        'orderby'           => 'none',
    );

    $the_query = new WP_Query( $args );
    $posts = $the_query->posts;

    $publication_dates = [];
    foreach ($posts as $post) {
        $publication_dates[$post->ID] = dci_get_data_pubblicazione_ts("data_pubblicazione", '_dci_notizia_', $post->ID);
    }

    usort($posts, function ($a, $b) use ($publication_dates) {
        return $publication_dates[$b->ID] - $publication_dates[$a->ID]; 
    });
    
    $total_posts = count($posts);
    $visible_posts = array_slice($posts, 0, $max_posts);

    $view_button=false;
    
    $remaining_posts = array_slice($posts, $max_posts);
    if(count($remaining_posts) > 0){
        $view_button=true;
    }

?>

<div class="bg-grey-card py-5">
    <form role="search" id="search-form" method="get" class="search-form">
        <button type="submit" class="d-none"></button>
        <div class="container">
            <h2 class="title-xxlarge mb-4">
                Esplora tutte le novità
            </h2>
            <div>
                <div class="cmp-input-search">
                    <div class="form-group autocomplete-wrapper mb-0">
                        <div class="input-group">
                            <label for="autocomplete-two" class="visually-hidden">Cerca</label>
                            <input type="search" class="autocomplete form-control" placeholder="Cerca per parola chiave"
                                id="autocomplete-two" name="search" value="<?php echo esc_attr($query); ?>"
                                data-bs-autocomplete="[]" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="button-3">
                                    Invio
                                </button>
                            </div>
                            <span class="autocomplete-icon" aria-hidden="true"><svg class="icon icon-sm icon-primary"
                                    role="img" aria-labelledby="autocomplete-label">
                                    <use href="#it-search"></use>
                                </svg>
                            </span>
                        </div>
                        <p id="autocomplete-label" class="u-grey-light text-paragraph-card mt-2 mb-30 mt-lg-3 mb-lg-40">
                            <?php echo $the_query->found_posts; ?> notizie trovate in ordine alfabetico
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4" id="news-list">
                <?php
                foreach (  $visible_posts as $post ) {
                    $load_card_type = 'notizia';
                    get_template_part('template-parts/novita/cards-list');
                }
                wp_reset_postdata();
                ?>
            </div>

            <div class="d-flex justify-content-center mt-4" >
                <?php if ($view_button) : ?>
                    <button id="load-more-news" type="button" class='btn btn-outline-primary pt-15 pb-15 pl-90 pr-90 mb-30 mb-lg-50 full-mb text-button' >
                        <span>Carica altri risultati</span>
                    </button>
                <?php endif; ?>
                <p class="text-center text-paragraph-regular-medium mt-4 mb-0 <?php if ($view_button) { echo 'd-none';} ?>" id="no-more-results">
                    Nessun altro risultato
                </p>
            </div>
        </div>
    </form>
</div>
<?php wp_reset_query(); 

    $posts_data = [];

    if($view_button){
        foreach($remaining_posts as $post){
    
            $description = dci_get_meta('descrizione_breve');
            $arrdata = explode("-", date('d-m-y',$publication_dates[$post->ID])) ;
            $monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10));
            $img_url = dci_get_meta('immagine');
            $image_alt = get_post_meta( $post->ID, '_wp_attachment_image_alt', true);
            $image_title = get_the_title( $post->ID );
            $tipo = get_the_terms($post->ID, 'tipi_notizia')[0];
    
            $posts_data[] = [
                'title'         => get_the_title(),
                'description'   => $description,
                'date'          => $arrdata[0] . ' ' . strtoupper($monthName) . ' ' . $arrdata[2],
                'image_url'     => $img_url ? $img_url : null, 
                'image_alt'     => $image_alt,
                'image_title'   => $image_title,
                'tipo'          => $tipo ? strtoupper($tipo->name) : '',
                'tipo_link'     => $tipo ? get_term_link($tipo->term_id) : '',
                'link'          => get_permalink(),
            ];
        }
        
    }
    $to_render = base64_encode(json_encode($posts_data));
?>


<script>
const remainingPosts=JSON.parse(atob("<?php echo $to_render; ?>"));document.addEventListener("DOMContentLoaded",(function(){const e=document.getElementById("load-more-news"),n=document.getElementById("news-list"),s=document.getElementById("no-more-results");e&&n?e.addEventListener("click",(function(){remainingPosts.splice(0,3).forEach((e=>{const s=`\n <div class="col-md-6 col-xl-4">\n <div class="card-wrapper border border-light rounded shadow-sm ${e.image_url?" ":"cmp-list-card-img cmp-list-card-img-hr"} ">\n <div class="card no-after rounded">\n ${e.image_url?`\n <div class="img-responsive-wrapper">\n <div class="img-responsive img-responsive-panoramic">\n <figure class="img-wrapper">\n <img src="${e.image_url}" alt="${e.image_alt}" title="${e.image_title}">\n </figure>\n </div>\n </div>`:""}\n\n <div class="card-body ${e.image_url?" ":"card-img-none rounded-top"} ">\n <div class="category-top">\n <a class="category text-decoration-none" href="${e.tipo_link}">${e.tipo}</a>\n <span class="data">${e.date}</span>\n </div>\n <a class="text-decoration-none" href="${e.link}">\n <h3 class="card-title">${e.title}</h3>\n </a>\n <p class="card-text text-secondary">${e.description}</p>\n </div>\n\n </div>\n </div>\n </div> \n `;n.insertAdjacentHTML("beforeend",s)})),0===remainingPosts.length&&(e.style.display="none",s.classList.remove("d-none"))})):(e.style.display="none",s.classList.remove("d-none"),console.error("Elementi necessari non trovati nel DOM."))}));
</script>