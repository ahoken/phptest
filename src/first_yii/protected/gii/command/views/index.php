<h1>Console Command Generator</h1>
<?php $form = $this->beginWidget('CCodeForm',
array('model'=>$model)); ?>
<div class='row' >
<?php echo $form->labelEx($model, 'command'); ?>
<?php echo $form->textField($model, 'command',
array('size'=>45)); ?>
<div class='tooltip'>
Command must only contain word characters and hyphens
</div>
 
<?php echo $form->error($model, 'command'); ?>
</div>
 
<div class='row' >
<?php echo $form->labelEx($model, 'className'); ?>
<?php echo $form->textField($model, 'className',
array('size'=>45,'readonly'=>'readonly')); ?>
<div class='tooltip'>
Class name must only contain word characters
</div>
<?php echo CHtml::checkBox('autoClassName', true,
		array('id'=>'autoClassName')); ?> Auto
		<?php echo $form->error($model, 'className'); ?>
		</div>
		 
		<div class=&quot;row sticky&quot;>
		<?php echo $form->labelEx($model,'scriptPath'); ?>
		<?php echo $form->textField($model,'scriptPath',
		array('size'=>45)); ?>
		<div class=&quot;tooltip&quot;>
		This refers to the directory that contains your console
		commands. It should be specified in the form of a path alias,
		for example, <code>application.commands</code>
		or <code>application.extensions</code>.
		</div>
		<?php echo $form->error($model,'scriptPath'); ?>
		</div>
		 
		<div class='row template sticky'>
		<?php echo $form->labelEx($model, 'baseClassName'); ?>
		<?php echo $form->dropDownList($model, 'baseClassName',
		array(
		'CConsoleCommand'=>'CConsoleCommand',
		)); ?>
		</div>

		<?php $this->endWidget(); ?>

		<script type=&quot;text/javascript&quot;>
		function dashToCamel(str) {
			return str.replace(/W+(.)/g, function (x, chr) {
				return chr.toUpperCase();
			});
		}

		(function($){
			var autoSet = true;
			var prefix = <?php echo CJSON::encode($model->classPrefix); ?>;
			var ucFirst = <?php echo CJSON::encode($model->classUcFirst); ?>;

			var $commandName = $('#CommandCode_command'),
			$className = $('#CommandCode_className'),
			$autoToggle = $('#autoClassName');

			$commandName.bind('keyup keypress blur', function() {
				if (autoSet)
				{
					var dashPrefix = (prefix ? prefix + '-' : '');
					var camelSet = dashToCamel(dashPrefix+$commandName.val()+'Command');
					if (ucFirst)
					{
						var f = camelSet.charAt(0).toUpperCase();
						camelSet = f + camelSet.substr(1);
					}
					$className.val(camelSet);
				}
			});

				$autoToggle.click(function() {
					autoSet = this.checked == true;
					 
					if (autoSet)
					{
						$className.attr('readonly', 'readonly');
						$commandName.trigger('blur');
					}
					else
					{
						$className.removeAttr('readonly');
					}
				});
		})(jQuery);
		</script>