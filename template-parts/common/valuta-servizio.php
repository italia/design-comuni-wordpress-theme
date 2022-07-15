<div class="bg-primary">
    <div class="container">
        <div class="row d-flex justify-content-center bg-primary">
        <div class="col-12 col-lg-6 p-lg-0 px-3">
            <div class="cmp-rating pt-lg-80 pb-lg-80" id="">
            <div class="card shadow card-wrapper" data-element="feedback">
                <div class="cmp-rating__card-first">
                <div class="card-header border-0">
                    <h2 class="title-medium-2-semi-bold mb-0">
                    Quanto sono utili le informazioni in questa pagina?
                    </h2>
                </div>
                <div class="card-body">
                    <fieldset class="rating">
                        <?php 
                            $c = 5;
                            while ($c > 0) { ?>
                            <input
                                type="radio"
                                id="<?php echo 'star'.$c.'a' ?>"
                                name="ratingA"
                                value="<?php echo $c; ?>"
                            />
                            <label class="full rating-star" for="<?php echo 'star'.$c.'a' ?>">
                                <svg class="icon icon-sm" role="img" aria-labelledby="<?php echo $c; ?>-star">
                                    <use href="#it-star-full"></use>
                                </svg>
                                <span class="visually-hidden" id="<?php echo $c; ?>-star"
                                >Valuta <?php echo $c; ?> stelle su 5</span>
                            </label>
                        <?php --$c; } ?>
                    </fieldset>
                </div>
                </div>
                <div class="cmp-rating__card-second d-none" data-step="3">
                <div class="card-header border-0">
                    <h2 class="title-medium-2-bold mb-0" id="rating-feedback">
                    radioResponsezie, il tuo parere ci aiuterà a migliorare il
                    servizio!
                    </h2>
                </div>
                </div>
                <div class="form-rating d-none">
                <div class="d-none rating-shadow" data-step="1">
                    <div class="cmp-steps-rating">
                        <fieldset>
                            <div class="iscrizioni-header w-100">
                                <h3
                                class="step-title d-flex align-items-center justify-content-between drop-shadow"
                                >
                                <legend class="d-block d-lg-inline"
                                    >Cosa ha funzionato meglio? </legend
                                ><span class="step">1/2</span>
                                </h3>
                            </div>
                            <div class="cmp-steps-rating__body">
                                <div class="cmp-radio-list">
                                <div class="card card-teaser shadow-rating">
                                    <div class="card-body">
                                    <div class="form-check m-0">
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating"
                                            type="radio"
                                            id="radio-1"
                                        />
                                        <label for="radio-1"
                                            >Alcune indicazioni non erano chiare</label
                                        >
                                        </div>
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating"
                                            type="radio"
                                            id="radio-2"
                                        />
                                        <label for="radio-2"
                                            >Alcune indicazioni non erano corrette</label
                                        >
                                        </div>
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating"
                                            type="radio"
                                            id="radio-3"
                                        />
                                        <label for="radio-3"
                                            >Non capivo se quello che facevo era corretto</label
                                        >
                                        </div>
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating"
                                            type="radio"
                                            id="radio-4"
                                        />
                                        <label for="radio-4"
                                            >Ho avuto problemi tecnici</label
                                        >
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="d-none" data-step="2">
                    <div class="cmp-steps-rating">
                        <fieldset>
                            <div class="iscrizioni-header w-100">
                                <h3
                                class="step-title d-flex align-items-center justify-content-between drop-shadow mb-4"
                                >
                                <legend class="d-block d-lg-inline"
                                    >Vuoi aggiungere altri dettagli? </legend
                                ><span class="step">2/2</span>
                                </h3>
                            </div>
                            <div class="cmp-steps-rating__body">
                                <div class="form-group shadow-rating">
                                <label for="formGroupExampleInputWithHelp"
                                    >Dettaglio</label
                                >
                                <input
                                    class="form-control"
                                    id="formGroupExampleInputWithHelp"
                                    aria-describedby="formGroupExampleInputWithHelpDescription"
                                    maxlength="200"
                                    type="text"
                                />
                                <small
                                    id="formGroupExampleInputWithHelpDescription"
                                    class="form-text"
                                    >Inserire massimo 200 caratteri</small
                                >
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div
                    class="d-flex flex-nowrap pt-4 w-100 justify-content-center"
                >
                    <button
                    class="btn btn-outline-primary fw-bold me-4 btn-back"
                    type="button"
                    >
                    Indietro
                    </button>
                    <button
                    class="btn btn-primary fw-bold btn-next"
                    type="submit"
                    form="rating"
                    >
                    Avanti
                    </button>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>