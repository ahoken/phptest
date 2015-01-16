<?php

class CommandCode extends CCodeModel
{
   public $command;
   public $className;
   public $baseClassName = 'CConsoleCommand';
   public $scriptPath='application.extensions';
    
   // Prefix and case options only affect the JavaScript 
   // automatic class naming.
   public $classPrefix = 'A';   // Prefix class, so &quot;run-test&quot; 
                                // becomes &quot;aRunTestCommand&quot;
   public $classUcFirst = true; // Keep first letter capitalized, 
                                // e.g. &quot;ARunTestCommand&quot;
    
   public function attributeLabels()
   {
      return array(
         'command'         => 'Command',
         'className'       => 'Class Name',
         'baseClassName'   => 'Base Class',
         'scriptPath'      => 'Script Path',
      );
   }
    
   public function rules()
   {
      return array_merge(parent::rules(), array(
         array('command, className, baseClassName', 
          'required'),
         array('command', 'match', 
            'pattern'=>'/^([a-zA-Z0-9_-])+$/', 
          'message'=>'{attribute} is restricted to a-z, A-Z, 0-9, '
            . '_ and -.'),
         array('className, baseClassName', 'match', 
            'pattern'=>'/^w+$/', 
            'message'=>'{attribute} should only contain word characters.'),
         array('baseClassName', 'sticky'),
         array('scriptPath', 'validateScriptPath'),
         array('scriptPath', 'sticky'),
      ));
   }
    
   public function validateScriptPath($attribute,$params)
   {
      if ($this->hasErrors('scriptPath'))
      {
         return;
      }
       
      if (Yii::getPathOfAlias($this->scriptPath) === false)
      {
         $this->addError('scriptPath',
            'Script path must be a valid path alias.');
      }
   }
    
   public function prepare()
   {
      $basePathAlias = $this->scriptPath . '.' . $this->command;
      $classPath = Yii::getPathOfAlias($basePathAlias
         . '.' . $this->className) . '.php';
       
      $code = $this->render($this->templatePath 
         . PATH_SEPARATOR . 'command.php');
      $this->files[] = new CCodeFile($classPath, $code);
   }
    
   public function successMessage()
   {
      $path = Yii::getPathOfAlias(
         'application.gii.command.views.config-add');
       
      return $this->render($path.'.php', array(
        'command'=>$this->command,
        'className'=>$this->className,
        'scriptPath'=>$this->scriptPath));
   }
}