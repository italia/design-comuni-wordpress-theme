<?php 
    global $post;

    // metadata
    $last_edit = explode(' ', $post->post_modified);
    $last_edit_day = implode('/',array_reverse(explode('-',$last_edit[0])));
?>

<p class="text-paragraph-small mb-0">Pagina aggiornata il <?php echo $last_edit_day; ?></p>