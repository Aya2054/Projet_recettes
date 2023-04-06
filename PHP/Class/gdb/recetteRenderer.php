<?php

namespace gdb;

class recetteRenderer
{
    public function getHTML()
    { ?>
        <article class="game neon">
            <h1><?= $this->titre ?></h1>
            <div class="game-content">
                <?php if ($this->image != null) : ?>

                    <img src="<?= $GLOBALS['DOCUMENT_DIR'] . "../" . \gdb\GameDB::UPLOAD_DIR . $this->image ?>">

                <?php endif; ?>
                <div class="game-description">
                    <?= $this->description ?>
                </div>
            </div>
        </article>
    <?php }
}