<?php

namespace gdb;

class ingrRenderer
{
    public function getHTML()
    { ?>
        <article class="game neon">
            <h1><?= $this->nom ?></h1>
            <div class="game-content">
                <?php if ($this->image != null) : ?>

                    <img src="<?= $GLOBALS['DOCUMENT_DIR'] . "../" . \gdb\GameDB::UPLOAD_DIR . $this->image ?>">

                <?php endif; ?>

            </div>
        </article>
    <?php }

}