<?php
/* Template Name: Assistenza
 *
 * assistenza template file
 *
 * @package Design_Comuni_Italia
 */

get_header();
?>
	<main>
		<?php
		while ( have_posts() ) :
			the_post();
			
			$description = dci_get_meta('descrizione','_dci_page_',$post->ID);
            $categorie_servizio_names = dci_categorie_servizio_array();
            console_log($categorie_servizio_names,'categs');
			?>
            <div class="container" id="main-container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
						<?php get_template_part("template-parts/common/breadcrumb"); ?>
                    </div>
                </div>
            </div>
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
                        <a
                            class="title-small-semi-bold t-primary underline"
                            href="/accesso"
                            title="Accedi all'area riservata tramite SPID o CIE"
                            aria-label="Accedi all'area riservata tramite SPID o CIE"
                            >Accedi</a
                        >
                        </p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-50">
                <div class="col-12 col-lg-3 d-lg-block mb-4 d-none">
                    <aside
                    class="cmp-navscroll sticky-top"
                    aria-labelledby="accordion-title-one"
                    >
                    <div class="inline-menu">
                        <div class="link-list-wrapper">
                        <ul class="link-list">
                            <li>
                            <a
                                class="list-item large medium right-icon p-0 text-decoration-none"
                                href="#collapse-one"
                                data-bs-toggle="collapse"
                                aria-expanded="true"
                                aria-controls="collapse-one"
                                data-focus-mouse="true"
                                aria-label="Apri e chiudi il menù INFORMAZIONI RICHIESTE"
                                title="Apri e chiudi il menù INFORMAZIONI RICHIESTE"
                            >
                                <span class="list-item-title-icon-wrapper pb-10 px-3">
                                <span
                                    id="accordion-title-one"
                                    class="title-xsmall-semi-bold"
                                    >INFORMAZIONI RICHIESTE</span
                                >
                                <svg class="icon icon-xs right">
                                    <use
                                    href="#it-expand"
                                    ></use>
                                </svg>
                                </span>
                                <!-- Progress Bar -->
                                <div class="progress bg-light">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    aria-label="Progress bar dell'indice della pagina"
                                    style="width: 15%"
                                    aria-valuenow="15"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                                </div>
                            </a>
                            <ul
                                class="link-sublist collapse show"
                                id="collapse-one"
                                data-element="index-link-list"
                            >
                                <li>
                                <a
                                    class="list-item"
                                    href="#applicant"
                                    aria-label="Vai alla sezione Richiedente"
                                    title="Vai alla sezione Richiedente"
                                >
                                    <span class="title-medium">Richiedente</span>
                                </a>
                                </li>
                                <li>
                                <a
                                    class="list-item"
                                    href="#request"
                                    aria-label="Vai alla sezione Richiesta"
                                    title="Vai alla sezione Richiesta"
                                >
                                    <span class="title-medium">Richiesta</span>
                                </a>
                                </li>
                            </ul>
                            </li>
                        </ul>
                        </div>
                    </div>
                    </aside>
                </div>
                <div class="col-12 col-lg-8 offset-lg-1">
                    <form
                    class="steppers-content"
                    aria-live="polite"
                    id="justValidateForm"
                    >
                    <div class="cmp-card mb-40">
                        <div class="card has-bkg-grey shadow-sm p-big">
                        <div class="card-header border-0 p-0 mb-lg-30">
                            <div class="d-flex">
                            <h2 class="title-xxlarge mb-0" id="applicant">
                                Richiedente
                            </h2>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="form-wrapper bg-white p-4">
                            <div class="form-group cmp-input mb-0">
                                <label class="cmp-input__label" for="name">Nome*</label>
                                <input
                                type="text"
                                class="form-control mt-4"
                                id="name"
                                name="name"
                                required
                                />
                                <div class="d-flex">
                                <span class="form-text cmp-input__text">
                                    Inserisci il tuo nome</span
                                >
                                </div>
                            </div>

                            <div class="form-group cmp-input mb-0">
                                <label class="cmp-input__label" for="surname"
                                >Cognome*</label
                                >
                                <input
                                type="text"
                                class="form-control"
                                id="surname"
                                name="surname"
                                required
                                />
                                <div class="d-flex">
                                <span class="form-text cmp-input__text">
                                    Inserisci il tuo cognome</span
                                >
                                </div>
                            </div>

                            <div class="form-group cmp-input mb-0">
                                <label class="cmp-input__label" for="email"
                                >Email*</label
                                >
                                <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                required
                                />
                                <div class="d-flex">
                                <span class="form-text cmp-input__text">
                                    Inserisci la tua email</span
                                >
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

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
                                <label for="category" class=""
                                >Categoria di servizio*</label
                                >
                                <select
                                id="category"
                                class="bg-transparent form-control"
                                required
                                >
                                    <option selected="selected" value="">
                                        Seleziona categoria
                                    </option>
                                    <?php foreach ($categorie_servizio_names as $categoria) {
                                        echo '<option value="'.$categoria.'">'.$categoria.'</option>';
                                    } ?>
                                </select>
                                <div class="d-flex">
                                <span class="form-text cmp-input__text">
                                    Seleziona la categoria del servizio per cui vuoi
                                    richiedere assistenza</span
                                >
                                </div>
                            </div>

                            <div class="select-wrapper p-big bg-transparent p-0">
                                <label for="service" class="">Servizio*</label>
                                <select
                                id="service"
                                class="bg-transparent form-control"
                                required
                                >
                                <option selected="selected" value="">
                                    Scegli il servizio
                                </option>
                                <option value="Iscrizione alla Scuola dell’infanzia">
                                    Iscrizione alla Scuola dell’infanzia
                                </option>
                                <option value="Permessi ZTL">Permessi ZTL</option>
                                <option value="Assegno di maternità">
                                    Assegno di maternità
                                </option>
                                </select>
                                <div class="d-flex">
                                <span class="form-text cmp-input__text">
                                    Seleziona il servizio per cui vuoi richiedere
                                    assistenza</span
                                >
                                </div>
                            </div>

                            <div class="cmp-text-area p-0 mt-40">
                                <div class="form-group">
                                <label for="description" class="d-block"
                                    >Dettagli*</label
                                >
                                <textarea
                                    class="text-area form-control"
                                    id="description"
                                    rows="2"
                                    required
                                ></textarea>
                                <span class="label"
                                    >Inserire massimo 600 caratteri</span
                                >
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="privacy-wrapper">
                        <p class="text-paragraph mb-3">
                        Per i dettagli sul trattamento dei dati personali consulta l’
                        <a
                            href="#"
                            class="t-primary underline"
                            aria-label="Vai alla pagina dell'informativa sulla privacy"
                            title="Vai alla pagina dell'informativa sulla privacy"
                            >informativa sulla privacy.</a
                        >
                        </p>

                        <div class="form-check mb-2">
                        <div
                            class="checkbox-body d-flex align-items-center flex-wrap"
                        >
                            <input
                            type="checkbox"
                            id="privacy"
                            name="privacy-field"
                            value="privacy-field"
                            required
                            />
                            <label class="title-small-semi-bold pt-1 mb-0" for="privacy"
                            >Ho letto e compreso l’informativa sulla privacy</label
                            >
                        </div>
                        </div>
                    </div>
                    <div class="cmp-nav-steps">
                        <nav class="steppers-nav">
                        <button
                            type="button"
                            class="btn btn-sm steppers-btn-prev p-0"
                            aria-label="Torna indietro allo step precedente"
                        >
                            <svg class="icon icon-primary icon-sm">
                            <use
                                href="#it-chevron-left"
                            ></use>
                            </svg>
                            <span class="text-button-sm t-primary">Indietro</span>
                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary btn-sm steppers-btn-confirm send"
                            data-bs-validate="validate"
                            aria-label="Invia la richiesta"
                        >
                            <span class="text-button-sm">Invia</span>
                            <svg class="icon icon-white icon-sm">
                            <use
                                href="#it-chevron-right"
                            ></use>
                            </svg>
                        </button>
                        </nav>
                        <div
                        id="alert-message"
                        class="alert alert-success cmp-disclaimer rounded d-none"
                        role="alert"
                        >
                        <span
                            class="d-inline-block text-uppercase cmp-disclaimer__message"
                            >Richiesta salvata con successo</span
                        >
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>

			<?php get_template_part("template-parts/common/assistenza-contatti"); ?>
		<?php 
			endwhile; // End of the loop.
		?>
	</main>

<?php
get_footer();



