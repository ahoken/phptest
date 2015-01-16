&lt;h1&gt;Console Command Generator&lt;/h1&gt;
&lt;?php $form = $this-&gt;beginWidget('CCodeForm',
array('model'=&gt;$model)); ?&gt;
&lt;div class='row' &gt;
&lt;?php echo $form-&gt;labelEx($model, 'command'); ?&gt;
&lt;?php echo $form-&gt;textField($model, 'command',
array('size'=&gt;45)); ?&gt;
&lt;div class='tooltip'&gt;
Command must only contain word characters and hyphens
&lt;/div&gt;
 
&lt;?php echo $form-&gt;error($model, 'command'); ?&gt;
&lt;/div&gt;
 
&lt;div class='row' &gt;
&lt;?php echo $form-&gt;labelEx($model, 'className'); ?&gt;
&lt;?php echo $form-&gt;textField($model, 'className',
array('size'=&gt;45,'readonly'=&gt;'readonly')); ?&gt;
&lt;div class='tooltip'&gt;
Class name must only contain word characters
&lt;/div&gt;
&lt;?php echo CHtml::checkBox('autoClassName', true,
		array('id'=&gt;'autoClassName')); ?&gt; Auto
		&lt;?php echo $form-&gt;error($model, 'className'); ?&gt;
		&lt;/div&gt;
		 
		&lt;div class=&quot;row sticky&quot;&gt;
		&lt;?php echo $form-&gt;labelEx($model,'scriptPath'); ?&gt;
		&lt;?php echo $form-&gt;textField($model,'scriptPath',
		array('size'=&gt;45)); ?&gt;
		&lt;div class=&quot;tooltip&quot;&gt;
		This refers to the directory that contains your console
		commands. It should be specified in the form of a path alias,
		for example, &lt;code&gt;application.commands&lt;/code&gt;
		or &lt;code&gt;application.extensions&lt;/code&gt;.
		&lt;/div&gt;
		&lt;?php echo $form-&gt;error($model,'scriptPath'); ?&gt;
		&lt;/div&gt;
		 
		&lt;div class='row template sticky'&gt;
		&lt;?php echo $form-&gt;labelEx($model, 'baseClassName'); ?&gt;
		&lt;?php echo $form-&gt;dropDownList($model, 'baseClassName',
		array(
		'CConsoleCommand'=&gt;'CConsoleCommand',
		)); ?&gt;
		&lt;/div&gt;

		&lt;?php $this-&gt;endWidget(); ?&gt;

		&lt;script type=&quot;text/javascript&quot;&gt;
		function dashToCamel(str) {
			return str.replace(/W+(.)/g, function (x, chr) {
				return chr.toUpperCase();
			});
		}

		(function($){
			var autoSet = true;
			var prefix = &lt;?php echo CJSON::encode($model-&gt;classPrefix); ?&gt;;
			var ucFirst = &lt;?php echo CJSON::encode($model-&gt;classUcFirst); ?&gt;;

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
		&lt;/script&gt;