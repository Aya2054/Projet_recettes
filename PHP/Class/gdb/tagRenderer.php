<?php

namespace gdb;

class tagRenderer
{
    public function getHTML()
    { ?>
        <article class="">
            <h1><?= $this->name ?></h1>
            <div class="">
                <?php if ($this->image != null) : ?>

                    <img src="<?= $GLOBALS['DOCUMENT_DIR'] . "../" . \gdb\tag::UPLOAD_DIR . $this->image ?>">

                <?php endif; ?>
                <div class="">
                    <?= $this->description ?>
                </div>
            </div>
        </article>
    <?php }

}