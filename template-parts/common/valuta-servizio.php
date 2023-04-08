<div class="bg-primary">
    <div class="container">
        <div class="row d-flex justify-content-center bg-primary">
        <div class="col-12 col-lg-6 p-lg-0 px-3">
            <div class="cmp-rating pt-lg-80 pb-lg-80" id="rating">
            <div class="card shadow card-wrapper" data-element="feedback">
                <div class="cmp-rating__card-first">
                <div class="card-header border-0">
                    <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">
                        Quanto sono chiare le informazioni su questa pagina?
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
                            <label class="full rating-star" for="<?php echo 'star'.$c.'a' ?>" data-element="<?php echo 'feedback-rate-'.$c ?>">
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
                    Grazie, il tuo parere ci aiuterà a migliorare il
                    servizio!
                    </h2>
                </div>
                </div>
                <div class="form-rating d-none">
                <div class="d-none rating-shadow" data-step="1">
                    <div class="cmp-steps-rating">
                        <fieldset class="fieldset-rating-one d-none" data-element="feedback-rating-positive">
                            <legend class="iscrizioni-header w-100">
                                <h3
                                class="step-title d-flex align-items-center justify-content-between drop-shadow"
                                >
                                <span class="d-block d-lg-inline" data-element="feedback-rating-question"
                                    >Quali sono stati gli aspetti che hai preferito? </span
                                ><span class="step">1/2</span>
                                </h3>
                            </legend>
                            <div class="cmp-steps-rating__body">
                                <div class="cmp-radio-list">
                                <div class="card-teaser shadow-rating">
                                    <div class="card-body">
                                    <div class="form-check m-0">
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating1"
                                            type="radio"
                                            id="radio-1"
                                        />
                                        <label for="radio-1" data-element="feedback-rating-answer"
                                            >Le indicazioni erano chiare</label
                                        >
                                        </div>
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating1"
                                            type="radio"
                                            id="radio-2"
                                        />
                                        <label for="radio-2" data-element="feedback-rating-answer"
                                            >Le indicazioni erano complete</label
                                        >
                                        </div>
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating1"
                                            type="radio"
                                            id="radio-3"
                                        />
                                        <label for="radio-3" data-element="feedback-rating-answer"
                                            >Capivo sempre che stavo procedendo correttamente</label
                                        >
                                        </div>
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating1"
                                            type="radio"
                                            id="radio-4"
                                        />
                                        <label for="radio-4" data-element="feedback-rating-answer"
                                            >Non ho avuto problemi tecnici</label
                                        >
                                        </div>
                                        <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                            <input name="rating1" type="radio" id="radio-5">
                                            <label for="radio-5" data-element="feedback-rating-answer">
                                                Altro
                                            </label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="fieldset-rating-two d-none"  data-element="feedback-rating-negative">
                            <legend class="iscrizioni-header w-100">
                                <h3
                                class="step-title d-flex align-items-center justify-content-between drop-shadow"
                                >
                                <span class="d-block d-lg-inline" data-element="feedback-rating-question"
                                    >Dove hai incontrato le maggiori difficoltà?</span
                                ><span class="step">1/2</span>
                                </h3>
                            </legend>
                            <div class="cmp-steps-rating__body">
                                <div class="cmp-radio-list">
                                <div class="card-teaser shadow-rating">
                                    <div class="card-body">
                                    <div class="form-check m-0">
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating2"
                                            type="radio"
                                            id="radio-6"
                                        />
                                        <label for="radio-6" data-element="feedback-rating-answer"
                                            >A volte le indicazioni non erano chiare</label
                                        >
                                        </div>
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating2"
                                            type="radio"
                                            id="radio-7"
                                        />
                                        <label for="radio-7" data-element="feedback-rating-answer"
                                            >A volte le indicazioni non erano complete</label
                                        >
                                        </div>
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating2"
                                            type="radio"
                                            id="radio-8"
                                        />
                                        <label for="radio-8" data-element="feedback-rating-answer"
                                            >A volte non capivo se stavo procedendo correttamente</label
                                        >
                                        </div>
                                        <div
                                        class="radio-body border-bottom border-light cmp-radio-list__item"
                                        >
                                        <input
                                            name="rating2"
                                            type="radio"
                                            id="radio-9"
                                        />
                                        <label for="radio-9" data-element="feedback-rating-answer"
                                            >Ho avuto problemi tecnici</label
                                        >
                                        </div>
                                        <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                            <input name="rating2" type="radio" id="radio-10">
                                            <label for="radio-10" data-element="feedback-rating-answer">Altro</label>
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
                            <legend class="iscrizioni-header w-100">
                                <h3
                                class="step-title d-flex align-items-center justify-content-between drop-shadow mb-4"
                                >
                                <span class="d-block d-lg-inline"
                                    >Vuoi aggiungere altri dettagli? </span
                                ><span class="step">2/2</span>
                                </h3>
                            </legend>
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
                                    data-element="feedback-input-text"
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
