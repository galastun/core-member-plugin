<?php
  $attendWeekly = $this->options['attend-weekly'];
  $servingMinistry = $this->options['serving-ministry'];
  $attendLifegroup = $this->options['attend-lifegroup'];
  $educatingSelf = $this->options['educating-self'];
?>

<h1>Success</h1>

<?php
  if(!$attendWeekly) {
    echo '<li>We highly encourage you to join us weekly in worship to God. This is where some great encouragement to follow Jesus comes from.</li>';
  }

  if(!$servingMinistry) {
    echo '<li>Take the next step and get involved serving in ministry with us. Click the link below to learn more.</li>';
  }

  if(!$attendLifegroup) {
    echo '<li>You should find a LifeGroup! Click the link below to learn more.</li>';
  }

  if(!$educatingSelf) {
    echo '<li>Find an ABC or get involved in a LifeGroup to begin biblically educating yourself. Click on the link below to learn more.</li>';
  }
?>
