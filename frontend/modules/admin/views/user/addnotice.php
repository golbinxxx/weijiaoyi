<?php $form = self::beginForm() ?>
<?= $model->title('发送战略信') ?>
<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'content')->editor() ?>
<?= $form->field($model, 'time')->datepicker() ?>
<?= $form->submit($model) ?>
<?php self::endForm() ?>
<script>
$(function () {
    $("#submitBtn").click(function () {
        $("form").ajaxSubmit($.config('ajaxSubmit', {
            success: function (msg) {
                if (msg.state) {
                    $.alert(msg.info || '操作成功', function () {
                        window.parent.location.reload();
                    });
                } else {
                    $.alert(msg.info);
                }
            }
        }));
        return false;
    });
})
</script>