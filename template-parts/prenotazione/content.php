<?php
    $uffici = get_posts(array(
        'posts_per_page' => -1,
        'post_type' => 'unita_organizzativa'
    ));
?>

<div class="col-12 col-lg-8 offset-lg-1">
    <div class="steppers-content" aria-live="polite">
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
                                echo '
                                <option value="'.$ufficio->post_title.'">'.$ufficio->post_title.'</option>';
                            } ?>                
                        </select>
                    </div>
                    <!-- Radio-Cards ? -->
                    <!-- <div class="cmp-info-radio radio-card">
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
                    <div class="cmp-info-radio radio-card">
                        <div class="card p-3 p-lg-4">
                        <div class="card-header mb-0 p-0">
                            <div class="form-check m-0">
                            <input
                                class="radio-input"
                                name="beneficiaries"
                                type="radio"
                                id="third"
                            />
                            <label for="third">
                                <h3 class="big-title mb-0 pb-0">
                                Municipalità 3 - Stella, S. Carlo all&#x27;Arena
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
                    <div class="cmp-info-radio radio-card">
                        <div class="card p-3 p-lg-4">
                        <div class="card-header mb-0 p-0">
                            <div class="form-check m-0">
                            <input
                                class="radio-input"
                                name="beneficiaries"
                                type="radio"
                                id="four"
                            />
                            <label for="four">
                                <h3 class="big-title mb-0 pb-0">
                                Municipalità 4 - S. Lorenzo, Vicaria,
                                Poggioreale, Zona Industriale
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
                    </div> -->
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
                type="button"
                class="btn btn-primary btn-sm steppers-btn-confirm"
                data-bs-toggle="modal"
                data-bs-target="#"
                aria-label="Vai avanti allo step successivo"
                >
                <span class="text-button-sm">Avanti</span>
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
    </div>
</div>