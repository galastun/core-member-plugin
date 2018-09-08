<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/galastun
 * @since      1.0.0
 *
 * @package    Core_Member
 * @subpackage Core_Member/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

  <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

  <form method="post" name="core_options" action="options.php">

  <?php
    $options = get_option($this->plugin_name);
    $clientId = $options['client-id'];
    $clientSecret = $options['client-secret'];
  ?>

  <?php
    settings_fields($this->plugin_name);
    do_settings_sections($this->plugin_name);
  ?>

  <?php settings_fields($this->plugin_name); ?>
    <fieldset>
      <legend class="screen-reader-text"><span>Client API ID</span></legend>
      <label for="<?php echo $this->plugin_name; ?>-client-id">
        <span><?php esc_attr_e('Client API ID', $this->plugin_name); ?></span>
        <input 
          type="text" 
          id="<?php echo $this->plugin_name; ?>-client-id" 
          name="<?php echo $this->plugin_name; ?>[client-id]"
          size=75
          value="<?php if(!empty($clientSecret)) echo $clientSecret; ?>"/>
      </label>
    </fieldset>

    <fieldset>
      <legend class="screen-reader-text"><span>Client API Secret</span></legend>
      <label for="<?php echo $this->plugin_name; ?>-client-secret">
        <span><?php esc_attr_e('Client API Secret', $this->plugin_name); ?></span>
        <input type="text" 
          id="<?php echo $this->plugin_name; ?>-client-secret" 
          name="<?php echo $this->plugin_name; ?>[client-secret]" 
          size=75
          value="<?php if(!empty($clientSecret)) echo $clientSecret; ?>"/>
      </label>
    </fieldset>

    <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

  </form>

</div>