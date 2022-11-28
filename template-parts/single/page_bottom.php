<?php 
    global $post;

    // metadata
    $last_edit = explode(' ', $post->post_modified);
    $last_edit_day = implode('/',array_reverse(explode('-',$last_edit[0])));
    $last_edit_hour_arr = explode(':', $last_edit[1]);
    $last_edit_hour = $last_edit_hour_arr[0].":".$last_edit_hour_arr[1];  
?>

<article id="ultimo-aggiornamento" class="it-page-section mt-5">
    <h4 class="h6">Ultimo aggiornamento:
    <span class="h6 fw-normal"><?php echo $last_edit_day.', '.$last_edit_hour; ?></span>
    </h4>
</article>