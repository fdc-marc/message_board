<?php

?>

<div class="thank-you-body">
    <div class="row">

        <div class="col-12 d-flex justify-content-center">
            <h1>Thank you for registering</h1>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <!-- <a href=""><button class="btn btn-light">Back to homepage</button></a> -->
            <?php echo $this->Html->link('Back to homepage', array('controller' => 'Users', 'action' => 'thank_you'), ['class' => 'btn btn-light px-3']); ?>
        </div>
    </div>

</div>
</div>