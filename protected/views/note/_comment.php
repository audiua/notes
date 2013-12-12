<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'comment-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'text'); ?>
        <?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'text'); ?>
    </div>
    <?php if(Yii::app()->user->isGuest):?>
    
        <div class="row">
            <?php echo $form->labelEx($model,'author'); ?>
            <?php echo $form->textField($model,'author'); ?>
            <?php echo $form->error($model,'author'); ?>
        </div>

        <?php if(CCaptcha::checkRequirements()): ?>
            <div class="row">
                <?php echo $form->labelEx($model,'verifyCode'); ?>
                <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model,'verifyCode'); ?>
                </div>
                <div class="hint">Please enter the letters as they are shown in the image above.
                <br/>Letters are not case-sensitive.</div>
                <?php echo $form->error($model,'verifyCode'); ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Create'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->