<?php 
    global $post;

    // metadata
    $last_edit = explode(' ', $post->post_modified);
    $last_edit_day = implode('/',array_reverse(explode('-',$last_edit[0])));
    $last_edit_hour_arr = explode(':', $last_edit[1]);
    $last_edit_hour = $last_edit_hour_arr[0].":".$last_edit_hour_arr[1];  
?>

<article id="ultimo-aggiornamento" class="it-page-section anchor-offset mt-5">
    <h5 class="font-serif">Ultimo aggiornamento</h5>
    <p class="h6"><strong><?php echo $last_edit_day.', '.$last_edit_hour; ?></strong></p>
    <!-- <small><a href="#">Consulta versioni precedenti</a></small> -->
</article>