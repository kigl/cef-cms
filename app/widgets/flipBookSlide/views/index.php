<script type="text/javascript">

    $(function () {
        $("#flipBook").flipBook({
            btnThumbs: false,
            btnToc: false,
            btnShare: false,
            pages: [
                <?php
                foreach ($data['model']->items as $model) {
                    echo "{
                    src: '{$model->getBehavior('imageContent')->getFileUrl()}',
                    thumb: '{$model->getBehavior('imageContent')->getFileUrl()}'
                    },";
                }
                ?>
            ]

        });
    });
</script>
<div id="flipBook"></div>