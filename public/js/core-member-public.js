(function( $ ) {
	'use strict';

  const coreMember = {
    values: {
      addMemberIndex: 0,
      nodes: {},
    },
    
    addMember: function() {
      const addMemberDiv = document.getElementById('additional-members');
      addMemberDiv.appendChild(coreMember.memberForm());
      coreMember.values.addMemberIndex++;
    },

    removeExtra: function(evt) {
      const target = evt.target;
      const id = target.id.split('-')[1];

      const addMemberDiv = document.getElementById('additional-members');
      addMemberDiv.removeChild(coreMember.values.nodes[id]);
      delete coreMember.values.nodes[id];
    },
  
    memberForm: function() {
      const index = coreMember.values.addMemberIndex;
      const ageIndex = index + 1; // this is to make it work right

      const div = document.createElement('div');
      const radioDiv = document.createElement('div');
      const adultFieldset = document.createElement('fieldset');
      const childFieldset = document.createElement('fieldset');
      const removeButton = document.createElement('span');

      const firstNameLabel = document.createElement('label');
      const lastNameLabel = document.createElement('label');
      const adultRadioLabel = document.createElement('label');
      const childRadioLabel = document.createElement('label');
  
      const firstNameInput = document.createElement('input');
      const lastNameInput = document.createElement('input');
      const adultRadio = document.createElement('input');
      const childRadio = document.createElement('input');
      
      div.className = 'flex-col extra-member';
      radioDiv.className = 'flex-col';

      removeButton.className = 'fa fa-times remove-x';
      removeButton.id = 'remove-' + index;
      
      firstNameInput.setAttribute('id', 'firstName-' + index);
      firstNameInput.setAttribute('name', 'core-member[add][firstName][]');
      firstNameInput.setAttribute('type', 'text');
      
      lastNameInput.setAttribute('id', 'lastName-' + index);
      lastNameInput.setAttribute('name', 'core-member[add][lastName][]');
      lastNameInput.setAttribute('type', 'text');

      // set index 
      adultRadio.setAttribute('id', 'adult-' + index);
      adultRadio.setAttribute('name', 'core-member[add][age][' + ageIndex + ']');
      adultRadio.setAttribute('value', 'adult');
      adultRadio.setAttribute('type', 'radio');
      adultRadio.setAttribute('checked', 'true');

      childRadio.setAttribute('id', 'child-' + index);
      childRadio.setAttribute('name', 'core-member[add][age][' + ageIndex + ']');
      childRadio.setAttribute('value', 'child');
      childRadio.setAttribute('type', 'radio');
      
      firstNameLabel.setAttribute('for', 'firstName-' + index);
      firstNameLabel.appendChild(document.createTextNode('First Name'));
      lastNameLabel.setAttribute('for', 'lastName-' + index);
      lastNameLabel.appendChild(document.createTextNode('Last Name'));
      adultRadioLabel.setAttribute('for', 'adult-' + index);
      adultRadioLabel.appendChild(document.createTextNode('Adult'));
      childRadioLabel.setAttribute('for', 'child-' + index);
      childRadioLabel.appendChild(document.createTextNode('Child'));

      adultFieldset.appendChild(adultRadio);
      adultFieldset.appendChild(adultRadioLabel);
      childFieldset.appendChild(childRadio);
      childFieldset.appendChild(childRadioLabel);

      div.appendChild(removeButton);
      div.appendChild(firstNameLabel);
      div.appendChild(firstNameInput);
      div.appendChild(lastNameLabel);
      div.appendChild(lastNameInput);

      radioDiv.appendChild(adultFieldset);
      radioDiv.appendChild(childFieldset);

      div.appendChild(radioDiv);

      coreMember.values.nodes[index] = div;
      
      return div;
    }
  };
  
  $(document).ready(function() {
    $('#add-more').on('click', coreMember.addMember);
    $(document).on('click', '.remove-x', coreMember.removeExtra);
  });
})( jQuery );
