<?php if (isset($results)) : ?>
    <?php
        $status = (isset($results['status'])) ? $results['status'] : '';
        $messages = (isset($results['messages'])) ? $results['messages'] : [];
    ?>
    <?php if ($messages) : ?> 
        <?php foreach ($messages as $key => $message) : ?>
            <p class="status <?= $status ?>"><?= $message; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>