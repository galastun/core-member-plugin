<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/galastun
 * @since      1.0.0
 *
 * @package    Core_Member
 * @subpackage Core_Member/public/partials
 */
?>

<?php
  if(count($_POST) > 0) {
    if(isset($_POST['core-member']['email'])) {
      $this->update_user($_POST['core-member']);
    }

    if(isset($_POST['core-member']['add'])) {
      $this->add_new($_POST['core-member']['add']);
    }
  }

  $email = '';
?>

<div class="wrap">
  <h2>CORE Member</h2>

  <?php
    switch($this->state) {
      case 'add':
        include_once('core-member-add-member.php');
        break;
      case 'success':
        include_once('core-member-success.php');
        break;
      default: 
        include_once('core-member-main-form.php');
    }
  ?>
</div>
