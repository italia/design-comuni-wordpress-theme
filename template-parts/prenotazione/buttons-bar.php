<div class="cmp-nav-steps">
    <nav class="steppers-nav" aria-label="Step">
        <button
        type="button"
        class="btn btn-sm steppers-btn-prev p-0 btn-back-step"
        disabled
        >
        <svg class="icon icon-primary icon-sm" aria-hidden="true">
            <use
            href="#it-chevron-left"
            ></use>
        </svg>
        <span class="text-button-sm t-primary">Indietro</span>
        </button>

        <button
        type="button"
        class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-none d-lg-block saveBtn"
        >
        <span class="text-button-sm t-primary"
            >Salva Richiesta</span
        >
        </button>

        <button
        type="button"
        class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-block d-lg-none saveBtn center"
        >
        <span class="text-button-sm t-primary">Salva</span>
        </button>

        <button
        type="submit"
        class="btn btn-primary btn-sm steppers-btn-confirm btn-next-step"
        data-bs-validate="validate"
        disabled
        >
        <span class="text-button-sm">Avanti</span>
        <svg class="icon icon-white icon-sm" aria-hidden="true">
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