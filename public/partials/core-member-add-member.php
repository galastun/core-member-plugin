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
    <input type="hidden" name="<?php echo $prefix; ?>[include-household]" value="<?php echo $includeHousehold; ?>" />
    <input type="hidden" name="<?php echo $prefix; ?>[attend-weekly]" value="<?php echo $attendWeekly; ?>" />
    <input type="hidden" name="<?php echo $prefix; ?>[serving-ministry]" value="<?php echo $servingMinistry; ?>" />
    <input type="hidden" name="<?php echo $prefix; ?>[attend-lifegroup]" value="<?php echo $attendLifegroup; ?>" />
    <input type="hidden" name="<?php echo $prefix; ?>[educating-self]" value="<?php echo $educatingSelf; ?>" />
  </div>
  <div id="additional-members">
    
  </div>
</form>
<button class="fusion-button button-flat fusion-button-round button-large button-default button-1" id="add-more">Add</button>
<div class="fusion-clearfix"></div>

<button type="submit" class="fusion-button button-flat fusion-button-round button-large button-default button-1">Submit</button>