<?php echo "<?php\n"; ?>
 
class <?php echo $this->className; ?> extends <?php echo $this->className."\n"; ?>
{
   public function getHelp()
   {
       return <?php echo "<<<"; ?>EOD
USAGE
   
 
DESCRIPTION
   
 
EOD;
   }
    
   public function run($args)
   {
       
   }
}