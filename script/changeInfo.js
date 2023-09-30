function enableEdit(editButton, inputField) {
    editButton.addEventListener('click', function() {
      inputField.removeAttribute('readonly');
    });
  }
  
  const edituserName = document.querySelector('.edit-username');
  const inputuserName = document.querySelector('.ip-userName');
  enableEdit(edituserName, inputuserName);
  
  const edittelePhone = document.querySelector('.edit-telePhone');
  const inputtelePhone = document.querySelector('.ip-telePhone');
  enableEdit(edittelePhone, inputtelePhone);
  
  const editbirthDate = document.querySelector('.edit-birthDate');
  const inputbirthDate = document.querySelector('.ip-birthDate');
  enableEdit(editbirthDate, inputbirthDate);
  
  const editGender = document.querySelector('.edit-Gender');
  const inputGender = document.querySelector('.ip-Gender');
  enableEdit(editGender, inputGender);
  
  const editaddress = document.querySelector('.edit-address');
  const inputaddress = document.querySelector('.ip-address');
  enableEdit(editaddress, inputaddress);