<?php
/* Template Name: Assistenza
 *
 * assistenza template file
 *
 * @package Design_Comuni_Italia
 */

function dci_enqueue_dci_assistence_script()  {
    wp_enqueue_script( 'dci-assistenza', get_template_directory_uri() . '/assets/js/assistenza.js', array('jquery'), null, true );
    $variables = array(
        'url' => admin_url( 'admin-ajax.php' )
    );
    wp_localize_script('dci-assistenza', "data_assistenza", $variables);
}
add_action( 'wp_enqueue_scripts', 'dci_enqueue_dci_assistence_script' );

get_header();
?>
<main>
    <?php
		while ( have_posts() ) :
			the_post();

			$description = dci_get_meta('descrizione','_dci_page_',$post->ID);
            $categorie_servizio = get_terms(array (
                'taxonomy' => 'categorie_servizio',
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => true,
            ));
			?>
    <div class="container" id="main-container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <?php get_template_part("template-parts/common/breadcrumb"); ?>
            </div>
        </div>
    </div>
    <div id="first-step">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge mb-3">Richiesta assistenza</h1>

                        <p class="subtitle-small mb-0">
                            <?php echo $description; ?>
                        </p>
                    </div>
                    <p class="subtitle-small pb-40 mb-0">
                        Hai un’identità digitale SPID o CIE?
                        <a class="title-small-semi-bold t-primary text-decoration-none" href="#">Accedi</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="container container-assistenza">
            <div class="row mt-lg-50">
                <div class="col-12 col-lg-3 d-lg-block mb-4 d-none">
                    <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                        <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INFORMAZIONI RICHIESTE"
                            data-bs-navscroll>
                            <div class="navbar-custom" id="navbarNavProgress">
                                <div class="menu-wrapper">
                                    <div class="link-list-wrapper">
                                        <div class="accordion">
                                            <div class="accordion-item">
                                                <span class="accordion-header" id="accordion-title-one">
                                                    <button class="accordion-button pb-10 px-3" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse-one"
                                                        aria-expanded="true" aria-controls="collapse-one">
                                                        INFORMAZIONI RICHIESTE
                                                        <svg class="icon icon-xs right">
                                                            <use href="#it-expand"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <div class="progress">
                                                    <div class="progress-bar it-navscroll-progressbar"
                                                        role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div id="collapse-one" class="accordion-collapse collapse show"
                                                    role="region" aria-labelledby="accordion-title-one">
                                                    <div class="accordion-body">
                                                        <ul class="link-list" data-element="page-index">
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#applicant">
                                                                    <span class="title-medium">Richiedente</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#request">
                                                                    <span class="title-medium">Richiesta</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-12 col-lg-8 offset-lg-1">
                    <form class="steppers-content" aria-live="polite" id="justValidateForm">
                        <div class="it-page-sections-container">
                            <section class="it-page-section" id="applicant">
                                <div class="cmp-card mb-40">
                                    <div class="card has-bkg-grey shadow-sm p-big">
                                        <div class="card-header border-0 p-0 mb-lg-30">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-0">
                                                    Richiedente
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="form-wrapper bg-white p-4">
                                                <div class="form-group cmp-input mb-0">
                                                    <label class="cmp-input__label" for="name">Nome*</label>
                                                    <input type="text" class="form-control mt-4" id="name" name="name"
                                                        required />
                                                    <div class="d-flex">
                                                        <span class="form-text cmp-input__text">
                                                            Inserisci il tuo nome</span>
                                                    </div>
                                                </div>

                                                <div class="form-group cmp-input mb-0">
                                                    <label class="cmp-input__label" for="surname">Cognome*</label>
                                                    <input type="text" class="form-control" id="surname" name="surname"
                                                        required />
                                                    <div class="d-flex">
                                                        <span class="form-text cmp-input__text">
                                                            Inserisci il tuo cognome</span>
                                                    </div>
                                                </div>

                                                <div class="form-group cmp-input mb-0">
                                                    <label class="cmp-input__label" for="email">Email*</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        required />
                                                    <div class="d-flex">
                                                        <span class="form-text cmp-input__text">
                                                            Inserisci la tua email</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="it-page-section" id="request">
                                <div class="cmp-card mb-40">
                                    <div class="card has-bkg-grey shadow-sm p-big">
                                        <div class="card-header border-0 p-0 mb-lg-30">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-0" id="request">Richiesta</h2>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="form-wrapper bg-white p-4">
                                                <div class="select-wrapper mb-40 mt-4 bg-transparent p-0">
                                                    <label for="category" class="">Categoria di servizio*</label>
                                                    <select id="category" class="bg-transparent form-control" required>
                                                        <option selected="selected" value="">
                                                            Seleziona categoria
                                                        </option>
                                                        <?php foreach ($categorie_servizio as $categoria) {
                                                            echo '<option value="'.$categoria->term_id.'">'.$categoria->name.'</option>';
                                                        } ?>
                                                    </select>
                                                    <div class="d-flex">
                                                        <span class="form-text cmp-input__text">
                                                            Seleziona la categoria del servizio per cui vuoi
                                                            richiedere assistenza</span>
                                                    </div>
                                                </div>

                                                <div class="select-wrapper p-big bg-transparent p-0">
                                                    <label for="service" class="">Servizio*</label>
                                                    <select id="service" class="bg-transparent form-control" required>
                                                        <option selected="selected" value="">
                                                            Scegli il servizio
                                                        </option>
                                                    </select>
                                                    <div class="d-flex">
                                                        <span class="form-text cmp-input__text">
                                                            Seleziona il servizio per cui vuoi richiedere
                                                            assistenza</span>
                                                    </div>
                                                </div>

                                                <div class="cmp-text-area p-0 mt-40">
                                                    <div class="form-group">
                                                        <label for="description" class="d-block">Dettagli*</label>
                                                        <textarea class="text-area form-control" id="description"
                                                            rows="2" required></textarea>
                                                        <span class="label">Inserire massimo 600 caratteri</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="privacy-wrapper">
                                <p class="text-paragraph mb-3">
                                    Per i dettagli sul trattamento dei dati personali consulta l’
                                    <a href="#" class="t-primary">informativa sulla privacy.</a>
                                </p>

                                <div class="form-check mb-2">
                                    <div class="checkbox-body d-flex align-items-center flex-wrap">
                                        <input type="checkbox" id="privacy" name="privacy-field" value="privacy-field"
                                            required />
                                        <label class="title-small-semi-bold pt-1 mb-0" for="privacy">Ho letto e compreso
                                            l’informativa sulla privacy</label>
                                    </div>
                                </div>
                            </div>
                            <div class="cmp-nav-steps">
                                <nav class="steppers-nav" aria-label="Step">
                                    <button type="button" class="btn btn-sm steppers-btn-prev p-0">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="#it-chevron-left"></use>
                                        </svg>
                                        <span class="text-button-sm t-primary">Indietro</span>
                                    </button>

                                    <button type="submit" class="btn btn-primary btn-sm steppers-btn-confirm send"
                                        data-bs-validate="validate">
                                        <span class="text-button-sm">Invia</span>
                                        <svg class="icon icon-white icon-sm">
                                            <use href="#it-chevron-right"></use>
                                        </svg>
                                    </button>
                                </nav>
                                <div id="alert-message" class="alert alert-success cmp-disclaimer rounded d-none"
                                    role="alert">
                                    <span class="d-inline-block text-uppercase cmp-disclaimer__message">Richiesta
                                        salvata con successo</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="second-step" class="d-none">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="cmp-hero">
                        <section class="it-hero-wrapper bg-white align-items-start">
                            <div class="it-hero-text-wrapper pt-0 ps-0 pb-40 pb-lg-60">
                                <div class="categoryicon-top d-flex">
                                    <svg class="icon icon-success mr-10 icon-sm mb-1" aria-hidden="true">
                                        <use href="#it-check-circle"></use>
                                    </svg>
                                    <h1 class="text-black hero-title" data-element="page-name">Richiesta inviata</h1>
                                </div>

                                <p class="titillium hero-text">La richiesta di assistenza è stata inviata con successo,
                                    sarai ricontattato presto.<br><br>
                                    Abbiamo inviato il riepilogo all’email:<br>
                                    <strong id="email-recap"></strong></p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <?php get_template_part("template-parts/common/valuta-servizio"); ?>
    </div>

    <?php get_template_part("template-parts/common/assistenza-contatti"); ?>
    <?php
			endwhile; // End of the loop.
		?>
</main>

<?php
get_footer();