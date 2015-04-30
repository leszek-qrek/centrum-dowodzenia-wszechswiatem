<div class="widget">
    <h2>W systemie</h2>
    <div class="inner">
    <?php
    $user_count = user_count();
    $grammatic_form = ($user_count !=1) ? ' użytkowników w systemie' : ' użytkownik w systemie';
    ?>
       <?php echo $user_count; echo $grammatic_form;?> 
    </div>
</div> 