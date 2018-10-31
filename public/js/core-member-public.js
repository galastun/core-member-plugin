(function( $ ) {
	'use strict';

  const coreMember = {
    values: {
      addMemberIndex: 0
    },
    
    addMember: function() {
      const addMemberDiv = document.getElementById('additional-members');
      addMemberDiv.appendChild(coreMember.memberForm());
      coreMember.values.addMemberIndex++;
    },
  
    memberForm: function() {
      const div = document.createElement('div');
      const firstNameLabel = document.createElement('label');
      const lastNameLabel = document.createElement('label');
  
      const firstNameInput = document.createElement('input');
      const lastNameInput = document.createElement('input');
      
      div.className = 'flex-col';
      
      firstNameInput.setAttribute('id', 'firstName-' + coreMember.values.addMemberIndex);
      firstNameInput.setAttribute('name', 'core-member[add][firstName][]');
      firstNameInput.setAttribute('type', 'text');
      
      lastNameInput.setAttribute('id', 'lastName-' + coreMember.values.addMemberIndex);
      lastNameInput.setAttribute('name', 'core-member[add][lastName][]');
      lastNameInput.setAttribute('type', 'text');
      
      firstNameLabel.setAttribute('for', 'firstName-' + coreMember.values.addMemberIndex);
      firstNameLabel.appendChild(document.createTextNode('First Name'));
      lastNameLabel.setAttribute('for', 'lastName-' + coreMember.values.addMemberIndex);
      lastNameLabel.appendChild(document.createTextNode('Last Name'));
      
      div.appendChild(firstNameLabel);
      div.appendChild(firstNameInput);
      div.appendChild(lastNameLabel);
      div.appendChild(lastNameInput);
      
      return div;
    }
  };
  
  $(document).ready(function() {
    $('#add-more').on('click', coreMember.addMember);
  });
})( jQuery );
