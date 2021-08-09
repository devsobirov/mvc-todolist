<?php if (SessionHelper::hasAnyMessage()): ?>
    <section class="messages">
        <div class="container">
            <div class="d-flex flex-column w-80 mx-auto">
                <?php if (isset($_SESSION['errors'])): ?>
                    <?php foreach (SessionHelper::getFlushMessage('errors') as $error) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <?php foreach (SessionHelper::getFlushMessage('success') as $msg) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $msg ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>