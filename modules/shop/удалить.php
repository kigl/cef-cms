<div class="row">
    <div class="col-md-12">
        <?php foreach ($model as $collection) { ?>
            <div class="collection-box">
                <?php
                // костыль ссылки
                // не стандартные размеры коллекций
                ?>
                <div class="collection-box-item">
                    <div class="box-item-block">
                        <h2>
                            <?php echo $collection->title; ?>
                        </h2>
                        <ul class="list-unstyled">
                            <?php if ($collection->filesExists('booklet')) : ?>
                                <li>
                                    <?php
                                    // костыль ссылки
                                    // не стандартные размеры коллекций
                                    if ($collection->id == 11) { ?>
                                    <a href="/protected/modules/collection/public/images/collection/11/booklet">
                                        <?php } elseif ($collection->id == 5){ ?>
                                        <a href="/protected/modules/collection/public/images/collection/5/booklet/italy">
                                            <?php } elseif ($collection->id == 15) { ?>
                                            <a href="/protected/modules/collection/public/images/collection/15/booklet">
                                                <?php } else {?>
                                            <a href="<?php echo CHtml::normalizeUrl(array(
                                                '/collection/frontend/collection/booklet',
                                                'id' => $collection->id
                                            )); ?>">
                                                <?php } ?>
                                                Буклет
                                            </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($collection->filesExists('lookbook')) : ?>
                                <li>
                                    <a href="<?php echo CHtml::normalizeUrl(array(
                                        '/collection/frontend/collection/lookbook',
                                        'id' => $collection->id
                                    )); ?>">
                                        lookbook
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($collection->content != '') : ?>
                                <li>
                                    <a href="<?php echo CHtml::normalizeUrl(array(
                                        '/collection/frontend/collection/reportage',
                                        'id' => $collection->id
                                    )); ?>">
                                        Репортаж
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <img src="<?php echo "{$this->dirImage}/{$collection->id}"; ?>/wi.jpg" class="collection-box__img"/>
            </div>
        <?php } ?>
    </div>
</div>