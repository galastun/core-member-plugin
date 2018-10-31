<?php
  $attendWeekly = $this->options['attend-weekly'];
  $servingMinistry = $this->options['serving-ministry'];
  $attendLifegroup = $this->options['attend-lifegroup'];
  $educatingSelf = $this->options['educating-self'];
?>

<h1>Success</h1>

<?php
  if(!$attendWeekly) {
    echo '<li>Come to church!</li>';
  }

  if(!$servingMinistry) {
    echo '<li>Do Something!</li>';
  }

  if(!$attendLifegroup) {
    echo '<li>You should find a Life Group!</li>';
  }

  if(!$educatingSelf) {
    echo '<li>Make it happen!</li>';
  }
?>
