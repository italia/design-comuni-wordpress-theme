<?php
    $pages = dci_get_children_pages('amministrazione');
    $arr_pages = array_keys((array)$pages);
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="title-xxlarge mt-60 mb-4 mt-lg-80 mb-lg-40">
                Esplora l'amministrazione
            </h2>
            <div class="row flex-wrap justify-content-between gy-3 gy-md-5 gx-lg-5 pb-3 pb-lg-60 align-items-stretch">
                <?php foreach ($arr_pages as $key => $page_name) { 
                    $page = $pages[$page_name]; ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="cmp-card-simple card-wrapper pb-0 rounded border border-light">
                    <div class="card shadow-sm">
                        <div class="card-body">
                        <a href="<?php echo $page['link']; ?>" aria-label="Vai all'argomento <?php echo $page_name; ?>" title="Vai all'argomento <?php echo $page_name; ?>"><h3 class="card-title t-primary title-xlarge"><?php echo $page_name; ?></h3></a>
                        <p class="titillium text-paragraph mb-0">
                            <?php echo $page['description']; ?>
                        </p>
                        </div>
                    </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>