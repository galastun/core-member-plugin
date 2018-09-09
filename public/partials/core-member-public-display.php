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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
  if(count($_POST) > 0) {
    if(isset($_POST['core-member']['email'])) {
      echo $_POST['core-member']['email'];
    }
  }
?>

<div class="wrap">
  <h2>CORE Member</h2>

  <?php
    $email = '';
  ?>

  <form method="post" name="core_options" action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>">
    <fieldset>
      <legend class="screen-reader-text"><span>Email Address</span></legend>
      <label for="<?php echo $this->plugin_name; ?>-email">
        <span><?php esc_attr_e('Email Address', $this->plugin_name); ?></span>
        <input 
          type="email" 
          id="<?php echo $this->plugin_name; ?>-email" 
          name="<?php echo $this->plugin_name; ?>[email]"
          size=25
          value="<?php if(!empty($email)) echo $email; ?>"/>
      </label>
    </fieldset>

    <fieldset>
      <legend class="screen-reader-text"><span>I attend weekly services.</span></legend>
      <label for="<?php echo $this->plugin_name; ?>-attend-weekly">
        <input type="checkbox" 
          id="<?php echo $this->plugin_name; ?>-attend-weekly 
          name="<?php echo $this->plugin_name; ?>[attend-weekly]" 
          value="1"/>
          <span><?php esc_attr_e('I attend weekly services.', $this->plugin_name); ?></span>
      </label>
    </fieldset>

    <fieldset>
      <legend class="screen-reader-text"><span>I attend weekly services.</span></legend>
      <label for="<?php echo $this->plugin_name; ?>-attend-weekly">
        <input type="checkbox" 
          id="<?php echo $this->plugin_name; ?>-attend-weekly"
          name="<?php echo $this->plugin_name; ?>[attend-weekly]" 
          value="1"/>
          <span><?php esc_attr_e('I attend weekly services.', $this->plugin_name); ?></span>
      </label>
    </fieldset>

    <fieldset>
      <legend class="screen-reader-text"><span>I am serving in Ministry.</span></legend>
      <label for="<?php echo $this->plugin_name; ?>-serving-ministry">
        <input type="checkbox" 
          id="<?php echo $this->plugin_name; ?>-serving-ministry"
          name="<?php echo $this->plugin_name; ?>[serving-ministry]" 
          value="1"/>
          <span><?php esc_attr_e('I am serving in Ministry.', $this->plugin_name); ?></span>
      </label>
    </fieldset>

    <fieldset>
      <legend class="screen-reader-text"><span>I am in a LifeGroup.</span></legend>
      <label for="<?php echo $this->plugin_name; ?>-attend-lifegroup">
        <input type="checkbox" 
          id="<?php echo $this->plugin_name; ?>-attend-lifegroup 
          name="<?php echo $this->plugin_name; ?>[attend-lifegroup]" 
          value="1"/>
          <span><?php esc_attr_e('I am in a LifeGroup.', $this->plugin_name); ?></span>
      </label>
    </fieldset>

    <fieldset>
      <legend class="screen-reader-text"><span>I am educating myself in God's Word.</span></legend>
      <label for="<?php echo $this->plugin_name; ?>-educating-self">
        <input type="checkbox" 
          id="<?php echo $this->plugin_name; ?>-educating-self 
          name="<?php echo $this->plugin_name; ?>[educating-self]" 
          value="1"/>
          <span><?php esc_attr_e('I am educating myself in God\'s Word.', $this->plugin_name); ?></span>
      </label>
    </fieldset>

    <button type="submit">Submit</button>
  </form>
</div>
