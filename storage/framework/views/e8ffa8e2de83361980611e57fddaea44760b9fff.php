<?php if($errors->has()): ?>
    <div  class="alert alert-danger" role="alert">
        <button type="button" class="close pull-right" data-dismiss="alert">&times;</button>
        <?php foreach($errors->all('<p>:message</p>') as $message): ?>
            <?php echo $message; ?>

        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if(Session::has('message')): ?>
    <div class="alert alert-success" role="alert"><?php echo e(Session::get('message')); ?>

		<button type="button" class="close pull-right" data-dismiss="alert" >&times;</button>
    </div>
<?php endif; ?>