<?php
    $uffici = get_posts(array(
        'posts_per_page' => -1,
        'post_type' => 'unita_organizzativa'
    ));
?>

<!-- Step 1 -->
<section class="firstStep page-step active" data-steps="1">
    <div class="cmp-card">
        <div class="card has-bkg-grey shadow-sm p-big">
        <div class="card-header border-0 p-0 mb-lg-30">
            <div class="d-flex">
            <h2 class="title-xxlarge mb-0" id="office">Ufficio</h2>
            </div>
            <p class="subtitle-small mb-0">
            Scegli l’ufficio a cui vuoi richiedere l’appuntamento
            </p>
        </div>
        <div class="card-body p-0">
            <div class="select-wrapper p-0 select-partials">
            <label for="office-choice" class="visually-hidden"
                >Tipo di ufficio</label
            >
            <select id="office-choice" class="">
                <option selected="selected" value="">
                Seleziona opzione
                </option>
                <?php foreach ($uffici as $uo_id) {
                $ufficio = get_post($uo_id);
                echo '<option value="'.$ufficio->post_title.'">'.$ufficio->post_title.'</option>';
                } ?>
            </select>
            </div>
            <div class="cmp-info-radio radio-card">
                <div class="card p-3 p-lg-4">
                    <div class="card-header mb-0 p-0">
                    <div class="form-check m-0">
                        <input
                        class="radio-input"
                        name="beneficiaries"
                        type="radio"
                        id="first"
                        />
                        <label for="first">
                        <h3 class="big-title mb-0 pb-0">
                            Municipalità 1 - Chiaia, Posillipo, S.
                            Ferdinando
                        </h3></label
                        >
                    </div>
                    </div>
                    <div class="card-body p-0">
                    <div class="info-wrapper">
                        <span class="info-wrapper__label">Sportello</span>
                        <p class="info-wrapper__value">CIE</p>
                    </div>
                    <div class="info-wrapper">
                        <span class="info-wrapper__label">Indirizzo</span>
                        <p class="info-wrapper__value">
                        via S. Caterina a Chiaia, 76
                        </p>
                    </div>
                    <div class="info-wrapper">
                        <span class="info-wrapper__label">Apertura</span>
                        <p class="info-wrapper__value">
                        lun, mar, mer ore 9:00 – 12:00
                        </p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>

<!-- Step 1 -->
<section class="d-none page-step" data-steps="2">
    <div class="cmp-card mb-40">
        <div class="card has-bkg-grey shadow-sm p-big">
        <div class="card-header border-0 p-0 mb-lg-30">
            <div class="d-flex">
            <h2
                class="title-xxlarge mb-2"
                id="appointment-available"
            >
                Appuntamenti disponibili*
            </h2>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="select-wrapper p-0 mt-1 select-partials">
            <label for="appointment" class="visually-hidden"
                >Seleziona un mese</label
            >
            <select id="appointment" class="">
                <option selected="selected" value="">
                Seleziona un mese
                </option>
                <option value="Gennaio">Gennaio</option>
                <option value="Febbraio">Febbraio</option>
                <option value="Marzo">Marzo</option>
                <option value="Aprile">Aprile</option>
                <option value="Maggio">Maggio</option>
                <option value="Giugno">Giugno</option>
                <option value="Luglio">Luglio</option>
                <option value="Agosto">Agosto</option>
                <option value="Settembre">Settembre</option>
                <option value="Ottobre">Ottobre</option>
                <option value="Novembre">Novembre</option>
                <option value="Dicembre">Dicembre</option>
            </select>
            </div>

            <div class="cmp-card-radio-list mt-4">
            <div class="card p-3">
                <div class="card-body p-0">
                <div class="form-check m-0">
                    <div
                    class="radio-body border-bottom border-light"
                    >
                    <input name="radio" type="radio" id="radio-1" />
                    <label for="radio-1"
                        >Giovedì 11 Marzo 2022 ore 10:00</label
                    >
                    </div>
                    <div
                    class="radio-body border-bottom border-light"
                    >
                    <input name="radio" type="radio" id="radio-2" />
                    <label for="radio-2"
                        >Venerdì 12 Marzo 2022 ore 11:15</label
                    >
                    </div>
                    <div
                    class="radio-body border-bottom border-light"
                    >
                    <input name="radio" type="radio" id="radio-3" />
                    <label for="radio-3"
                        >Lunedì 15 Marzo 2022 ore 09:00</label
                    >
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="cmp-card">
        <div class="card has-bkg-grey shadow-sm p-big">
        <div class="card-header border-0 p-0 mb-lg-30">
            <div class="d-flex">
            <h2 class="title-xxlarge mb-0" id="office-2">Ufficio</h2>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="cmp-info-summary bg-white mb-4 mb-lg-30 p-4">
            <div class="card">
                <div
                class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end"
                >
                <h3 class="title-large-semi-bold mb-3">
                    Municipalità 1 - Chiaia, Posillipo, S. Ferdinando
                </h3>
                </div>

                <div class="card-body p-0">
                <div class="single-line-info border-light">
                    <div class="text-paragraph-small">Sportello</div>
                    <div class="border-light">
                    <p class="data-text">CIE</p>
                    </div>
                </div>
                <div class="single-line-info border-light">
                    <div class="text-paragraph-small">Indirizzo</div>
                    <div class="border-light">
                    <p class="data-text">
                        via S. Caterina a Chiaia, 76
                    </p>
                    </div>
                </div>
                <div class="single-line-info border-light">
                    <div class="text-paragraph-small">Apertura</div>
                    <div class="border-light">
                    <p class="data-text">
                        lun, mar, mer ore 9:00 – 12:00
                    </p>
                    </div>
                </div>
                </div>
                <div class="card-footer p-0"></div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>

<!-- Step 3 -->
<section class="d-none page-step" data-steps="3">
    <div class="cmp-card mb-40">
        <div class="card has-bkg-grey shadow-sm p-big">
        <div class="card-header border-0 p-0 mb-lg-30 mb-3">
            <div class="d-flex">
            <h2 class="title-xxlarge mb-0" id="reason">Motivo*</h2>
            </div>
            <p class="subtitle-small mb-0">
            Scegli il motivo dell’appuntamento
            </p>
        </div>
        <div class="card-body p-0">
            <div class="select-wrapper p-0 select-partials">
            <label for="motivo-appuntamento" class="visually-hidden"
                >Motivo dell&#x27;appuntamento</label
            >
            <select id="motivo-appuntamento" class="">
                <option selected="selected" value="">
                Seleziona opzione
                </option>
                <option value="Cambio residenza">
                Cambio residenza
                </option>
                <option value="Cambio residenza">
                Cambio residenza
                </option>
                <option value="Cambio residenza">
                Cambio residenza
                </option>
                <option value="Cambio residenza">
                Cambio residenza
                </option>
            </select>
            </div>
        </div>
        </div>
    </div>

    <div class="cmp-card">
        <div class="card has-bkg-grey shadow-sm p-big">
        <div class="card-header border-0 p-0 mb-lg-30 m-0">
            <div class="d-flex">
            <h2 class="title-xxlarge mb-0" id="details">
                Dettagli*
            </h2>
            </div>
            <p class="subtitle-small mb-0 mb-3">
            Aggiungi ulteriori dettagli
            </p>
        </div>
        <div class="card-body p-0">
            <div class="cmp-text-area p-0">
            <div class="form-group">
                <label for="form-details" class="visually-hidden"
                >Aggiungi ulteriori dettagli</label
                >
                <textarea
                class="text-area"
                id="form-details"
                rows="2"
                ></textarea>
                <span class="label"
                >Inserire massimo 200 caratteri</span
                >
            </div>
            </div>
        </div>
        </div>
    </div>
</section>

<!-- Step 4 -->
<section class="d-none page-step" data-steps="4">
    <p class="subtitle-small pb-40 mb-0 d-lg-none">
        Hai un’identità digitale SPID o CIE?
        <a
        class="title-small-semi-bold t-primary underline"
        href="./iscrizione-graduatoria-accedere-servizio.html"
        title="Accedi all'area riservata tramite SPID o CIE"
        aria-label="Accedi all'area riservata tramite SPID o CIE"
        >Accedi</a
        >
    </p>
    <div class="cmp-card">
        <div class="card has-bkg-grey shadow-sm p-big">
        <div class="card-header border-0 p-0 mb-lg-30 m-0">
            <div class="d-flex">
            <h2 class="title-xxlarge mb-3" id="applicant">
                Richiedente
            </h2>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="form-wrapper bg-white p-4">
            <div class="form-group cmp-input mb-0">
                <label class="cmp-input__label" for="name"
                >Nome*</label
                >
                <input
                type="text"
                class="form-control"
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
</section>

<!-- Step 5 -->
<section class="d-none page-step" data-steps="5">
    <div class="mt-2">
        <h2 class="visually-hidden">Dettagli dell'appuntamento</h2>
        <div class="cmp-card mb-4">
        <div class="card has-bkg-grey shadow-sm mb-0">
            <div class="card-header border-0 p-0 mb-lg-30">
            <div class="d-flex">
                <h2 class="title-xxlarge mb-0" id="">Riepilogo</h2>
            </div>
            </div>
            <div class="card-body p-0">
            <div
                class="cmp-info-summary bg-white mb-3 mb-lg-4 p-3 p-lg-4"
            >
                <div class="card">
                <div
                    class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end"
                >
                    <h4 class="title-large-semi-bold mb-3">
                    Ufficio
                    </h4>
                    <a
                    href="#"
                    class=""
                    title="Modifica Ufficio"
                    aria-label="Modifica Ufficio"
                    ><span class="text-button-sm-semi t-primary"
                        >Modifica</span
                    ></a
                    >
                </div>

                <div class="card-body p-0">
                    <div class="single-line-info border-light">
                    <div class="text-paragraph-small">
                        Tipologia ufficio
                    </div>
                    <div class="border-light">
                        <p class="data-text">Ufficio anagrafe</p>
                    </div>
                    </div>
                    <div class="single-line-info border-light">
                    <div class="text-paragraph-small">
                        Municipalità
                    </div>
                    <div class="border-light">
                        <p class="data-text">
                        Municipalità 1 - Chiaia, Posillipo, S.
                        Ferdinando
                        </p>
                    </div>
                    </div>
                </div>
                <div class="card-footer p-0"></div>
                </div>
            </div>
            <div
                class="cmp-info-summary bg-white mb-3 mb-lg-4 p-3 p-lg-4"
            >
                <div class="card">
                <div
                    class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end"
                >
                    <h4 class="title-large-semi-bold mb-3">
                    Data e orario
                    </h4>
                    <a
                    href="#"
                    class=""
                    title="Modifica Data e orario"
                    aria-label="Modifica Data e orario"
                    ><span class="text-button-sm-semi t-primary"
                        >Modifica</span
                    ></a
                    >
                </div>

                <div class="card-body p-0">
                    <div class="single-line-info border-light">
                    <div class="text-paragraph-small">Data</div>
                    <div class="border-light">
                        <p class="data-text">Giovedì 11 Marzo 2022</p>
                    </div>
                    </div>
                    <div class="single-line-info border-light">
                    <div class="text-paragraph-small">Ora</div>
                    <div class="border-light">
                        <p class="data-text">10:00 - 10:30</p>
                    </div>
                    </div>
                </div>
                <div class="card-footer p-0"></div>
                </div>
            </div>
            <div
                class="cmp-info-summary bg-white mb-3 mb-lg-4 p-3 p-lg-4"
            >
                <div class="card">
                <div
                    class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end"
                >
                    <h4 class="title-large-semi-bold mb-3">
                    Dettagli appuntamento
                    </h4>
                    <a
                    href="#"
                    class=""
                    title="Modifica Dettagli appuntamento"
                    aria-label="Modifica Dettagli appuntamento"
                    ><span class="text-button-sm-semi t-primary"
                        >Modifica</span
                    ></a
                    >
                </div>

                <div class="card-body p-0">
                    <div class="single-line-info border-light">
                    <div class="text-paragraph-small">Motivo</div>
                    <div class="border-light">
                        <p class="data-text">Cambio residenza</p>
                    </div>
                    </div>
                    <div class="single-line-info border-light">
                    <div class="text-paragraph-small">Dettagli</div>
                    <div class="border-light">
                        <p class="data-text">
                        Avrei bisogno di capire come spostare la mia
                        residenza da un altro comune.
                        </p>
                    </div>
                    </div>
                </div>
                <div class="card-footer p-0"></div>
                </div>
            </div>
            <div class="cmp-info-summary bg-white p-3 p-lg-4 mb-0">
                <div class="card">
                <div
                    class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end"
                >
                    <h4 class="title-large-semi-bold mb-3">
                    Richiedente
                    </h4>
                    <a
                    href="#"
                    class=""
                    title="Modifica Richiedente"
                    aria-label="Modifica Richiedente"
                    ><span class="text-button-sm-semi t-primary"
                        >Modifica</span
                    ></a
                    >
                </div>

                <div class="card-body p-0">
                    <div class="single-line-info border-light">
                    <div class="text-paragraph-small">Nome</div>
                    <div class="border-light">
                        <p class="data-text">Giulia</p>
                    </div>
                    </div>
                    <div class="single-line-info border-light">
                    <div class="text-paragraph-small">Cognome</div>
                    <div class="border-light">
                        <p class="data-text">Bianchi</p>
                    </div>
                    </div>
                    <div class="single-line-info border-light">
                    <div class="text-paragraph-small">Email</div>
                    <div class="border-light">
                        <p class="data-text">
                        giulia-bianchi@gmail.com
                        </p>
                    </div>
                    </div>
                </div>
                <div class="card-footer p-0"></div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>