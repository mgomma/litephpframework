<?php

    foreach($data['messages'] as $key => $items){
        if(empty($items)){

            continue;
        }
        ?>
        <div class="messages <?php echo $key; ?>">

        <?php foreach ($items as $item) { ?>
            <p class="message"> <?php echo $item; ?> </p><?php
        } ?>

        </div>
    <?php }
