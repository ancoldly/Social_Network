const show_tools_profile = document.querySelector('.show-tools-profile');
const tools_profile = document.querySelector('.tools-profile');

show_tools_profile.addEventListener('click', function() {
  tools_profile.classList.toggle('hidden');
  tools_profile.classList.toggle('grid');
});

const deleteButtons = document.querySelectorAll('.delete-imageEditPost-preview');

deleteButtons.forEach(function(deleteButton) {
  deleteButton.addEventListener('click', function() {
    const postId = this.getAttribute('data-post-id');
    document.getElementById(`imageEditPost-preview-${postId}`).src = '';
    document.getElementById(`imageEdit-post-${postId}`).value = '';
    document.getElementById(`current-image-${postId}`).value = '';
    this.classList.add('hidden'); 
  });
});


const cogPosts = document.querySelectorAll('.cogPost');
const showCogPosts = document.querySelectorAll('.show-cogPost');
const editPostForms = document.querySelectorAll('.editPost-show');

showCogPosts.forEach((showCogPost, index) => {
  showCogPost.addEventListener('click', function() {
    const postId = this.getAttribute('data-post-id');

    cogPosts.forEach((cogPost) => {
      const post = cogPost.getAttribute('data-post-id');

      if (post === postId) {
        cogPost.classList.toggle('hidden');
        cogPost.classList.toggle('grid');

        if (cogPost.classList.contains('hidden')) {
          const editPostForm = cogPost.querySelector('.editPost-show');
          editPostForm.classList.add('hidden');
          editPostForm.classList.remove('grid');
        }
      }
    });
  });
});

const editPostButtons = document.querySelectorAll('.editPost');

editPostButtons.forEach(function(button, index) {
  button.addEventListener('click', function() {
    editPostForms[index].classList.toggle('hidden');
    editPostForms[index].classList.toggle('grid');
  });
});

const cogComments = document.querySelectorAll('.cogComments');
const showCogComments = document.querySelectorAll('.show-cogComments');
const formEditComments = document.querySelectorAll('.form-EditComment');
let activeCogCommentIndex = null;

showCogComments.forEach((showCogComment, index) => {
  showCogComment.addEventListener('click', function() {
    if (activeCogCommentIndex !== null && activeCogCommentIndex !== index) {
      cogComments[activeCogCommentIndex].classList.add('hidden');
      cogComments[activeCogCommentIndex].classList.remove('grid');
      
      if (cogComments[index].classList.contains('hidden')) {
        formEditComments[index].classList.add('hidden');
        formEditComments[index].classList.remove('grid');
      }
    }

    cogComments[index].classList.toggle('hidden');
    cogComments[index].classList.toggle('grid');
    activeCogCommentIndex = index;
  });
});



const editCommentsButtons = document.querySelectorAll('.show-form-EditComments');
let currentFormEditComments = null;

editCommentsButtons.forEach(function(editCommentsButton) {
  editCommentsButton.addEventListener('click', function() {
    const postId = editCommentsButton.dataset.editId;
    const commentId = editCommentsButton.dataset.idComments;
    const formEditComments = document.querySelector(`form[data-edit-id="${postId}"][data-id-comments="${commentId}"]`);

    const isFormVisible = formEditComments.classList.contains('flex');

    if (isFormVisible) {
      formEditComments.classList.remove('flex');
      formEditComments.classList.add('hidden');
      currentFormEditComments = null;
    } else {
      if (currentFormEditComments) {
        currentFormEditComments.classList.remove('flex');
        currentFormEditComments.classList.add('hidden');
      }

      formEditComments.classList.remove('hidden');
      formEditComments.classList.add('flex');

      currentFormEditComments = formEditComments;
    }
  });
});

function previewAvatar(event) {
  const input = event.target;
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const imagePostPreview = document.getElementById("avatar-preview");
      imagePostPreview.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

const delete_imagePost_preview = document.querySelector('.delete-imagePost-preview');

delete_imagePost_preview.addEventListener("click", function() {
  const imagePostInput = document.getElementById("image-post");
  const imagePostPreview = document.getElementById("imagePost-preview");
  imagePostPreview.src = ""; 

  if (imagePostInput) {
    imagePostInput.value = "";
  }

  delete_imagePost_preview.classList.add('hidden');
});

function previewImagePost(event) {
  const input = event.target;
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const imagePostPreview = document.getElementById("imagePost-preview");
      imagePostPreview.src = e.target.result;
      delete_imagePost_preview.classList.remove('hidden');
    };
    reader.readAsDataURL(input.files[0]);
  }
}

delete_imagePost_preview.addEventListener('click', function() {
  const avatarPreview = document.getElementById("imagePost-preview");
  avatarPreview.src = ''; 
  delete_imagePost_preview.classList.add('hidden');
});


function previewImageEditPost(event, postId) {
  const input = event.target;
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const imagePreview = document.getElementById(`imageEditPost-preview-${postId}`);
      imagePreview.src = e.target.result;
      const deleteButton = document.querySelector(`.delete-imageEditPost-preview[data-post-id="${postId}"]`);
      if (deleteButton) {
        deleteButton.classList.remove('hidden');
      }
    };
    reader.readAsDataURL(input.files[0]);
  }
}

const form = document.querySelector('.editPost-show');
const postId = form.getAttribute('data-post-id');

const imageHidden = document.getElementById(`imageEditPost-preview-${postId}`);

if (!imageHidden.getAttribute('src') || imageHidden.getAttribute('src') === '') {
  document.getElementById(`delete-imageEditPost-preview-${postId}`).classList.add('hidden');
}

setTimeout(function() {
  var notification = document.getElementById("notification");
  notification.style.display = "none";
}, 2000);

const edit_biography = document.querySelector('.edit-biography');
const btn_edit_biography = document.querySelector('.btn-biography');
const cancel_biography = document.querySelector('.cancel-biography');

btn_edit_biography.addEventListener('click', function() {
    edit_biography.classList.remove('hidden');
});

cancel_biography.addEventListener('click', function() {
  edit_biography.classList.add('hidden');
});

const textarea = document.getElementById('biography');
const charCount = document.getElementById('char-count');
const maxLength = 101;

textarea.addEventListener('input', function() {
  const currentChars = textarea.value.length;
  const remainingChars = maxLength - currentChars;
  
  charCount.textContent = 'Characters left: ' + remainingChars;
  
  if (remainingChars < 0) {
    textarea.value = textarea.value.slice(0, maxLength);
    charCount.textContent = 'Character limit exceeded!';
  }
});

const currentChars = textarea.value.length;
const remainingChars = maxLength - currentChars;
charCount.textContent = 'Characters left: ' + remainingChars;


