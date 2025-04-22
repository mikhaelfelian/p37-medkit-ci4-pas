<?php $pager->setSurroundCount(2) ?>

<ul class="pagination pagination-sm no-margin pull-right">
    <?php if ($pager->hasPrevious()) : ?>
        <li>
            <a href="<?= $pager->getFirst() ?>" aria-label="First">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li>
            <a href="<?= $pager->getPrevious() ?>" aria-label="Previous">
                <span aria-hidden="true">&lsaquo;</span>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <li class="<?= $link['active'] ? 'active' : '' ?>">
            <a href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <li>
            <a href="<?= $pager->getNext() ?>" aria-label="Next">
                <span aria-hidden="true">&rsaquo;</span>
            </a>
        </li>
        <li>
            <a href="<?= $pager->getLast() ?>" aria-label="Last">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    <?php endif ?>
</ul> 