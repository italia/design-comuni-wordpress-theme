<?php
global $file_url;

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' kB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

$attachment_id = attachment_url_to_postid($file_url) ;
$size = formatSizeUnits( filesize( get_attached_file( $attachment_id ) ) );
$extension = strtoupper( wp_check_filetype($file_url)['ext'] );
?>

<div class="cmp-icon-link">
    <a class="list-item icon-left d-inline-block" href="<?php echo $file_url; ?>" aria-label="Scarica Termini e condizioni di servizio (<?php echo $extension.' '.$size; ?>)" data-element="service-file">
    <span class="list-item-title-icon-wrapper">
        <svg class="icon icon-primary icon-sm me-1" aria-hidden="true">
        <use href="#it-clip"></use>
        </svg>
        <span class="list-item t-primary">Termini e condizioni di servizio (<?php echo $extension.' '.$size; ?>)</span>
    </span>
    </a>
</div>