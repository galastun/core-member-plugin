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
    <label for="<?php echo $this->plugin_name; ?>-include-household">
      <input type="checkbox" 
        id="<?php echo $this->plugin_name; ?>-include-household"
        name="<?php echo $this->plugin_name; ?>[include-household]" 
        value="1"/>
        <span><?php esc_attr_e('Include my entire family.', $this->plugin_name); ?></span>
    </label>
  </fieldset>
  <fieldset>
    <label for="<?php echo $this->plugin_name; ?>-attend-weekly">
      <input type="checkbox" 
        id="<?php echo $this->plugin_name; ?>-attend-weekly"
        name="<?php echo $this->plugin_name; ?>[attend-weekly]" 
        value="1"/>
        <span><?php esc_attr_e('I attend weekly services.', $this->plugin_name); ?></span>
    </label>
  </fieldset>

  <fieldset>
    <label for="<?php echo $this->plugin_name; ?>-serving-ministry">
      <input type="checkbox" 
        id="<?php echo $this->plugin_name; ?>-serving-ministry"
        name="<?php echo $this->plugin_name; ?>[serving-ministry]" 
        value="1"/>
        <span><?php esc_attr_e('I am serving in Ministry.', $this->plugin_name); ?></span>
    </label>
  </fieldset>

  <fieldset>
    <label for="<?php echo $this->plugin_name; ?>-attend-lifegroup">
      <input type="checkbox" 
        id="<?php echo $this->plugin_name; ?>-attend-lifegroup"
        name="<?php echo $this->plugin_name; ?>[attend-lifegroup]" 
        value="1"/>
        <span><?php esc_attr_e('I am in a LifeGroup.', $this->plugin_name); ?></span>
    </label>
  </fieldset>

  <fieldset>
    <label for="<?php echo $this->plugin_name; ?>-educating-self">
      <input type="checkbox" 
        id="<?php echo $this->plugin_name; ?>-educating-self"
        name="<?php echo $this->plugin_name; ?>[educating-self]" 
        value="1"/>
        <span><?php esc_attr_e('I am educating myself in God\'s Word.', $this->plugin_name); ?></span>
    </label>
  </fieldset>

  <button type="submit">Submit</button>
</form>