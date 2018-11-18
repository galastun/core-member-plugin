<?php
  $prefix = "$this->plugin_name[add]";
  $includeHousehold = $_POST['core-member']['include-household'];
  $attendWeekly = $_POST['core-member']['attend-weekly'];
  $servingMinistry = $_POST['core-member']['serving-ministry'];
  $attendLifegroup = $_POST['core-member']['attend-lifegroup'];
  $educatingSelf = $_POST['core-member']['educating-self'];
?>

<form method="POST">
  
  <div class="flex-col">
    <label for="email">Email</label>
    <input id="email" name="<?php echo $prefix; ?>[email]" type="text" value="<?php echo $_POST['core-member']['email'] ?>"/>
    <label for="firstName">First Name</label>
    <input id="firstName" name="<?php echo $prefix; ?>[firstName][]" type="text" />
    <label for="lastName">Last Name</label>
    <input id="lastName" name="<?php echo $prefix; ?>[lastName][]" type="text" />
    <input type="hidden" name="<?php echo $prefix; ?>[age][0]" value="adult" />
    <input type="hidden" name="<?php echo $prefix; ?>[include-household]" value="<?php echo $includeHousehold; ?>" />
    <?php 
      if(isset($attendWeekly)) {
        echo "<input type='hidden' name='{$prefix}[attend-weekly]' value='$attendWeekly' />"; 
      }
      if(isset($servingMinistry)) {
        echo "<input type='hidden' name='{$prefix}[serving-ministry]' value='$servingMinistry' />"; 
      }
      if(isset($attendLifegroup)) {
        echo "<input type='hidden' name='{$prefix}[attend-lifegroup]' value='$attendLifegroup' />"; 
      }
      if(isset($educatingSelf)) {
        echo "<input type='hidden' name='{$prefix}[educating-self]' value='$educationSelf' />"; 
      }
    ?>
  </div>
  <div id="additional-members" class="additional-members">
    
  </div>
  <button type="button" class="fusion-button button-flat fusion-button-round button-large button-default button-1" id="add-more">Add</button>
	<div class="fusion-clearfix" style="padding-bottom: 20px;"></div>
  <button type="submit" class="fusion-button button-flat fusion-button-round button-large button-default button-1">Submit</button>
</form>
