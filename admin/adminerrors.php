<?php  if (count($errors) > 0) : ?>
    <div class="error">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php  endif ?>

<?php  if($_SESSION['success'] AND count($errors) == 0) : ?>
    <div class="successmsg">
        <p><?php echo "Update successful!"; ?></p>
    </div>
<?php  endif ?>
