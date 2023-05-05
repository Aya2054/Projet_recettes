<?php

namespace gdb;

class ingrRenderer
{
    public function getHTML()
    { ?>
        <article class="">
            <h1><?= $this->nom ?></h1>
            <div class="">
                <?php if ($this->image != null) : ?>

                    <img src="<?= $GLOBALS['DOCUMENT_DIR'] . "../" . \gdb\ingredient::UPLOAD_DIR . $this->image ?>">

                <?php endif; ?>

            </div>
        </article>
    <?php }

}