<?php
$calendario = dci_get_calendar();
$date = array_keys((array)$calendario);

$fisrt_date = explode("-", $date[0]);
$last_date = explode("-", $date[count($date) - 1]);

$currentMonth = date_i18n('F', mktime(0, 0, 0, $fisrt_date[1], 10));

$nextMonth = " ";
if ($fisrt_date[1] != $last_date[1]) {
	$nextMonth = "/" . date_i18n('F', mktime(0, 0, 0, $last_date[1], 10)) . " ";
}
$full_date = $currentMonth . $nextMonth . $fisrt_date[0];

$total_eventi = 0;
foreach ($date as $data) {
	if (is_array($calendario[$data]) && count($calendario[$data])) {
		$eventi = $calendario[$data]['eventi'];
		++$total_eventi;
	}
}

?>
<section id="calendario">
	<div class="section section-muted pb-90 pb-lg-50 px-lg-5 pt-0">
		<div class="container">
			<div class="row row-title pt-5 pt-lg-60 pb-3">
				<div class="col-12 d-lg-flex justify-content-between">
					<h2 class="mb-lg-0">Eventi</h2>
				</div>
			</div>
			<div class="row row-calendar">
				<?php if ($total_eventi > 0) { ?>
					<div class="it-carousel-wrapper it-carousel-landscape-abstract-four-cols it-calendar-wrapper splide" data-bs-carousel-splide>
						<div class="it-header-block">
							<div class="it-header-block-title">
								<h3 class="mb-0 text-center home-carousel-title"><?php echo $full_date; ?></h3>
							</div>
						</div>
						<div class="splide__track">
							<ul class="splide__list it-carousel-all">
								<?php foreach ($date as $data) {
									$arrdata =  explode("-", $data);
									$dayName = date_i18n('D', mktime(0, 0, 0, intval($arrdata[1]), intval($arrdata[2])));

									if (is_array($calendario[$data]) && count($calendario[$data]))
										$eventi = $calendario[$data]['eventi'];
									else $eventi = [];
								?>
									<li class="splide__slide">
										<div class="it-single-slide-wrapper h-100">
											<div class="card-wrapper h-100">
												<div class="card card-bg">
													<div class="card-body">
														<h4 class="card-title pb-4 mb-10"><?php echo $arrdata[2] ?><span><?php echo $dayName; ?></span></h4>
														<?php
														if (is_array($eventi) && count($eventi)) {
															foreach ($eventi as $evento) {
																$img = dci_get_meta('immagine', '_dci_evento_', $evento['id']);
														?>
																<p class="card-text px-2 pb-10 mb-10 d-flex">
																	<?php if ($img) dci_get_img($img, 'me-3 rounded'); ?>
																	<a href="<?php echo $evento['link'] ?>"><?php echo $evento['titolo'] ?></a>
																</p>
														<?php }
														} ?>
													</div>
												</div>
											</div>
										</div>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				<?php } else { ?>
					<div class="it-carousel-wrapper it-carousel-landscape-abstract-four-cols it-calendar-wrapper">
						<div class="it-header-block">
							<div class="it-header-block-title">
								<h4 class="mb-0 text-center home-carousel-title"><?php echo $full_date; ?></h4>
							</div>
						</div>
					</div>
					<div class="mt-4"> Nessun evento in programma. </div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>