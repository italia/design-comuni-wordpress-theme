
<div class="mt-5">  
    <strong>Recensione:</strong>
    <div class="rating-list-wrapper my-4">
        <div class="rating-list">
        <div class="rating-list-aside rating-list-warning">
            <div class="rating-value fw-semibold">4</div>
            <div class="rating-total fw-semibold">su 5</div>
        </div>
        <div class="rating-list-content">
            <div class="rating-list-row">
            <div class="rating-list-stars">
                <div class="rating rating-read-only">
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                </div>
                <div class="rating rating-read-only">
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                </div>
                <div class="rating rating-read-only">
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                </div>
                <div class="rating rating-read-only">
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                </div>
                <div class="rating rating-read-only">
                <svg class="icon icon-warning">
                    <use xlink:href="#it-star-full"></use>
                </svg>
                </div>
            </div>
            <div class="rating-list-progress">
                <div class="progress progress-color">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="progress progress-color">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="progress progress-color">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="progress progress-color">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="progress progress-color">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="d-flex align-items-center mt-5">
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
        <div class="ms-3">
        <a class="btn btn-outline-primary btn-sm">
            <span>Invia valutazione</span>
        </a>
        </div>
    </div>
</div>