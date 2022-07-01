
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
        class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-none d-lg-block saveBtn"
        aria-label="Salva richiesta di prenotazione appuntamento"
        >
            <span class="text-button-sm t-primary">Salva Richiesta</span>
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