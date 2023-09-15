<?php
global $argomento_full, $count;

$argomenti_evidenza = array();
$arg1 = dci_get_option('argomenti_evidenziati_1','homepage')[0] ?? null;
if ($arg1) $argomenti_evidenza[1] = $arg1;

$arg2 = dci_get_option('argomenti_evidenziati_2','homepage')[0] ?? null;
if ($arg2) $argomenti_evidenza[2] = $arg2;

$arg3 = dci_get_option('argomenti_evidenziati_3','homepage')[0] ?? null;
if ($arg3) $argomenti_evidenza[3] = $arg3;

$altri_argomenti = dci_get_option('argomenti_altri','homepage');
?>

<div class="container">
    <?php if ($argomenti_evidenza) { ?>
    <div class="row">
        <h2 class="text-white title-xlarge mb-3">Argomenti in evidenza</h2>
    </div>
    <div>
        <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3">
            <?php
            if(is_array($argomenti_evidenza)) {
                foreach ($argomenti_evidenza as $key => $argomento_full) {
                    $count = $key;
                    if ($argomento_full){
                        if($argomento_full['argomento_'.$count.'_argomento']){
                            get_template_part("template-parts/home/scheda-argomento");
                        }
                    }
                } 
            }?>
        </div>
    </div>
    <?php } 
    if ($altri_argomenti) { ?>
    <div class="row pt-30">
        <div class="col-lg-10 col-xl-6 offset-lg-1 offset-xl-2">
            <div class="row d-lg-inline-flex">
                <div class="col-lg-3">
                    <h3 class="text-uppercase mb-3 title-xsmall-bold text u-grey-light">
                        Altri argomenti
                    </h3>
                </div>
                <div class="col-lg-9">
                    <ul class="d-flex flex-wrap gap-1">
                        <?php if (is_array($altri_argomenti)) {
                            foreach ($altri_argomenti as $arg_id) {
                                $argomento = get_term_by('term_taxonomy_id', $arg_id);
                                $url = get_term_link(intval($arg_id),'argomenti');
                        ?>
                        <li>
                            <a href="<?php echo $url ?>" class="chip chip-simple">
                                <span class="chip-label"><?php echo $argomento->name ?></span>
                            </a>
                        </li>
                        <?php } } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2 text-center">
            <a href="<?php echo dci_get_template_page_url("page-templates/argomenti.php"); ?>" class="btn btn-primary mt-40">Mostra tutti</a>
        </div>
    </div>
    <?php } ?>
</div>
