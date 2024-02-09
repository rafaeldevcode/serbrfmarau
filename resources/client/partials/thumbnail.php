<?php
    use Src\Models\Gallery;

    $id = isset($id) ? $id : 0;
    $gallery = new Gallery();
    $thumbnail = $gallery->find($id);
?>

<?php if($thumbnail->data): ?>
    <img 
        class="<?php echo isset($class) ? $class : '' ?>" 
        src="<?php asset("assets/images/{$thumbnail->data->file}") ?>" 
        alt="<?php echo $alt ?>"
        width="<?php echo isset($width) ? $width : '' ?>"
        height="<?php echo isset($height) ? $height : '' ?>"
    >
<?php endif ?>
