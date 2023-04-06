<?php

namespace gdb;

class tagRenderer
{
    public function getHTML()
    { ?>
        <article class="game neon">
            <h1><?= $this->name ?></h1>
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