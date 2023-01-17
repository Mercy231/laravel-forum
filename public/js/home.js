'use strict';

let createButton = document.getElementById('create-postButton');
let formShow = document.querySelector('.createPost-area');
let createCross = document.getElementById('create-postClose');
let editShowButton = document.querySelectorAll('.btn-warning');
let editForm = document.querySelector('.editPost-area');
let editCross = document.getElementById('edit-postClose');
let editPostText = document.getElementById('edit-postText');
let postsArea = document.getElementById('posts-area');
let postButton = document.getElementById('create-post-button');
let editPostSave = document.getElementById('editPostSave');
let editPostDelete = document.getElementById('editPostDelete');
let post;

if (createButton) {
    createButton.addEventListener('click', function () {
        formShow.style.display = 'flex';
    });
    createCross.addEventListener('click', function () {
        formShow.style.display = 'none';
    });
}

if (editShowButton) {
    for(let btn of editShowButton) {
        btn.addEventListener('click', function (){
            editPostText.innerText = btn.parentNode.parentNode.children[1].innerText;
            editForm.style.display = 'flex';
            post = btn.parentNode.parentNode;
        });
    }
    editCross.addEventListener('click', function () {
        editPostText.innerText = '';
        editForm.style.display = 'none';
    });
}

postButton.addEventListener('click', function (e) {
    e.preventDefault();
    let userdata = $('.form-control').val();
    $.ajax({
        url: '/createPost',
        type: 'POST',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            'userdata': userdata
        },
        success: function (userdata){
            formShow.style.display = 'none';
            let post = document.createElement('div');
            let postUsername = document.createElement('div');
            let username = document.createElement('h4');
            post.id = userdata['id'];
            post.className = 'post';
            postUsername.className = 'username';
            username.innerText = userdata['username'];
            postUsername.appendChild(username);

            let postText = document.createElement('div');
            let text = document.createElement('p');
            text.innerText = userdata['text'];
            postText.appendChild(text);

            let postEdit = document.createElement('div');
            let postEditButton = document.createElement('button');
            postEdit.className = 'text-end';
            postEditButton.className = 'btn btn-warning';
            postEditButton.type = 'submit';
            postEditButton.innerText = 'Edit';
            postEdit.appendChild(postEditButton);

            postEditButton.addEventListener('click', function (){
                editPostText.innerText = userdata['text'];
                editForm.style.display = 'flex';
            });
            editCross.addEventListener('click', function () {
                editPostText.innerText = '';
                editForm.style.display = 'none';
            });
            post.appendChild(postUsername);
            post.appendChild(postText);
            post.appendChild(postEdit);
            postsArea.insertBefore(post, postsArea.firstChild.nextSibling);
        }
    });
});

editPostSave.addEventListener('click', function (e){
    e.preventDefault()
    let userdata = $("#edit-postText").val();
    let postId = post.id;
    $.ajax({
        url: '/editPost',
        type: 'POST',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            'userdata': userdata,
            'postId': postId
        },
        success: function (userdata){
            let post = document.getElementById(userdata['id']);
            post.children[1].children[0].innerText = userdata['text'];
            editForm.style.display = 'none';
        }
    });
});

editPostDelete.addEventListener('click', function (e){
    e.preventDefault();
    let postId = post.id;
    $.ajax({
        url: '/deletePost',
        type: 'POST',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            'postId': postId
        },
        success: function (userdata){
            let post = document.getElementById(userdata);
            post.remove();
            editForm.style.display = 'none';
        }
    });
});
