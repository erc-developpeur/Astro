




























var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("openBtn");
var closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

/* Set the width of the side navigation to 250px */
function openNav() {
  sidenav.classList.add("active");
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  sidenav.classList.remove("active");
}







































const button = document.getElementById('avatar-navbar');
const closeButton = document.querySelector('.close-button');
const navigationMenu = document.querySelector('.navigation__menu');

button.addEventListener('click', () => {
    navigationMenu.classList.remove('none');
    navigationMenu.classList.remove('hide');
});

closeButton.addEventListener('click', () => {
    navigationMenu.classList.add('hide');
});



















const mainItems = document.querySelectorAll(
  '.main-item'
);

mainItems.forEach((mainItem) => {
  mainItem.addEventListener('click', () => {
    mainItem.classList.toggle(
      'main-item--open'
    );
  })
});











var upload = document.getElementById("upload");
var preview = document.getElementById("preview");
var avatar = document.getElementById("avatar");
var avatar_name = document.getElementById("name");
var avatar_name_change_box = document.getElementById("change-name-box");

var avatars = {
  srcList: [
    {
      name: "Cosmos",
      src: encodeURIComponent("https://source.unsplash.com/rTZW4f02zY8/150x150")
    },
    {
      name: "Walrus",
      src: encodeURIComponent("https://source.unsplash.com/h13Y8vyIXNU/150x150")
    },
    {
      name: "Flowers",
      src: encodeURIComponent("https://source.unsplash.com/PwWkzeJeJZE/150x150")
    },
    {
      name: "Dog",
      src: encodeURIComponent("https://source.unsplash.com/oCJuJQqvCzc/150x150")
    }
  ],
  activeKey: 1,
  add: function(_name, _src) {
    this.activeKey = this.srcList.length;
    return (
      this.srcList.push({ name: _name, src: encodeURIComponent(_src) }) - 1
    );
  },
  changeName: function(key, _name) {
    if (!Number.isInteger(key)) {
      return false;
    }
    this.srcList[key].name = _name;
    if (avatar_name.dataset.key == key) {
      avatar_name.textContent = _name;
    }
    return _name;
  },
  showNext: function() {
    var _next = this.activeKey + 1;
    if (_next >= this.srcList.length) {
      _next = 0;
    }
    this.showByKey(_next);
  },
  showLast: function() {
    var _next = this.activeKey - 1;
    if (_next < 0) {
      _next = this.srcList.length - 1;
    }
    this.showByKey(_next);
  },
  showByKey: function(_next) {
    var _on = this.srcList[_next];
    if (!_on.name) return;

    while (preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }

    var img = document.createElement("img");
    img.src = decodeURIComponent(_on.src);
    img.className = "avatar_img--loading";
    img.onload = function() {
      img.classList.add("avatar_img");
    };
    avatar_name.textContent = _on.name;
    avatar_name.setAttribute("data-key", _next);
    preview.appendChild(img);
    this.activeKey = _next;
  }
};

function showAvatar(key) {
  if (!key) {
    key = avatars.activeKey;
  }
}

/*

/** Handle uploading of files */
upload.addEventListener("change", handleFiles, false);
function handleFiles() {
  var files = this.files;
  for (var i = 0; i < files.length; i++) {
    var file = files[i];
    var imageType = /^image\//;

    if (!imageType.test(file.type)) {
      avatar.classList.add("avatar--upload-error");
      setTimeout(function() {
        avatar.classList.remove("avatar--upload-error");
      }, 1200);
      continue;
    }

    avatar.classList.remove("avatar--upload-error");

    while (preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }

    var img = document.createElement("img");
    img.file = file;
    img.src = window.URL.createObjectURL(file);
    img.onload = function() {
      // window.URL.revokeObjectURL(this.src);
    };
    img.className = "avatar_img";

    /* Clear focus and any text editing mode */
    document.activeElement.blur();
    window.getSelection().removeAllRanges();

    var _avatarKey = avatars.add(file.name, img.src);
    avatar_name.textContent = file.name;
    avatar_name.setAttribute("data-key", _avatarKey);
    preview.appendChild(img);
  }
}

/** Inline functions */
window.changeAvatarName = function(event, key, name) {
  if (event.keyCode != 13 && event != "blur") return;
  key = parseInt(key);
  if (!name) return;
  var change = avatars.changeName(key, name);
  document.activeElement.blur();
  // remove selection abilities
  window.getSelection().removeAllRanges();
};

window.changeAvatar = function(dir) {
  if (dir === "next") {
    avatars.showNext();
  } else {
    avatars.showLast();
  }
};
window.handleAriaUpload = function(e, obj) {
  if (e.keyCode == 13) {
    obj.click();
  }
};












const timeSince = (date) => {
  const seconds = Math.floor(
      (new Date() - date) / 1000);
  let interval = seconds / 31536000;

  if (interval > 1) {
    return Math.floor(interval) + 
    " years ago";
  }
  interval = seconds / 2592000;
  if (interval > 1) {
    return Math.floor(interval) + 
    " months ago";
  }
  interval = seconds / 86400;
  if (interval > 1) {
    return Math.floor(interval) + 
    " days ago";
  }
  interval = seconds / 3600;
  if (interval > 1) {
    return Math.floor(interval) + 
    " hours ago";
  }
  interval = seconds / 60;
  if (interval > 1) {
    return Math.floor(interval) + 
    " minutes ago";
  }
  if (seconds < 10) {
      return "just now";
  }
  return Math.floor(seconds) + 
  " seconds ago";
}

//? defined comment authors
const users = {
  'alex1': {
      name: 'Alex Cooper',
      src: 'assets/alex.jpg'
  }, 
};

const loggedUser = users['alex1'];
let comments = [
  {
      id: 1,
      text: 'Thanks everyone!',
      author: users['alex1'],
      createdAt: '2023-09-03 12:00:00',
  }, // more comments
];

const authedUser = document.querySelector(
  '.authed-user');
const authorHTML = DOMPurify.sanitize(
  `<img class="avatar" src="${loggedUser.src}"
      alt="${loggedUser.name}">`
  );

authedUser.innerHTML = authorHTML;

const commentsWrapper = document.querySelector(
  '.discussion__comments');

//? generate comment HTML based on comment object
const createComment = (comment) => {
  const newDate = new Date(comment.createdAt);
  //? sanitize comment HTML
  return DOMPurify.sanitize(`<div class="comment">
      <div class="avatar">
          <img
              class="avatar"
              src="${comment.author.src}"
              alt="${comment.author.name}"
          >
      </div>
      <div class="comment__body">
          <div class="comment__author">
              ${comment.author.name}
              <time
                  datetime="${comment.createdAt}"
                  class="comment__date"
              >
                  ${timeSince(newDate)}
              </time>
          </div>
          <div class="comment__text">
              <p>${comment.text}</p>
          </div>
      </div>
  </div>`);
}

const commentsMapped = comments.map(comment =>
  createComment(comment)
);

const innerComments = commentsMapped.join('');
commentsWrapper.innerHTML = innerComments;

const newCommentForm = document.getElementById(
  'newcomment__form'
);
const newCommentTextarea = document.querySelector(
  '#newcomment__form textarea'
);

newCommentForm.addEventListener(
  'submit', 
  (e) => {
      e.stopPropagation();
      e.preventDefault();
      const newCommentTextareaValue = newCommentTextarea.value;

      const newComment = {
          id: comments.length + 1,
          text: newCommentTextareaValue,
          author: loggedUser,
          createdAt: new Date().toISOString(),
      };

      const comment = document.createElement('div');
      comment.innerHTML = createComment(newComment);

      if (commentsWrapper.hasChildNodes()) {
          commentsWrapper.insertBefore(
              comment, 
              commentsWrapper.childNodes[0]
          );          
      } else {
          commentsWrapper.appendChild(comment);
      }

      //? reset form after submit
      newCommentForm.reset();
  }
);










































function toggleMenu () {  
  const navbar = document.querySelector('.navbar');
  const burger = document.querySelector('.burger');
  
  burger.addEventListener('click', (e) => {    
    navbar.classList.toggle('show-nav');
  });    
  // bonus
  const navbarLinks = document.querySelectorAll('.navbar a');
  navbarLinks.forEach(link => {
    link.addEventListener('click', (e) => {    
      navbar.classList.toggle('show-nav');
    }); 
  })
   
}
toggleMenu();








