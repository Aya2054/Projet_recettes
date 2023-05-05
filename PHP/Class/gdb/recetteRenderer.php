<?php

namespace gdb;

class recetteRenderer
{
    public function getHTML()
    { ?>
        <article class=" ">
            <h1><?= $this->titre ?></h1>
            <div class="">
                <?php if ($this->image != null) : ?>

                    <img src="<?= $GLOBALS['DOCUMENT_DIR'] . "../" . \gdb\recette::UPLOAD_DIR . $this->image ?>">

                <?php endif; ?>
                <div class="">
                    <?= $this->description ?>
                </div>
            </div>
        </article>
    <?php }
}