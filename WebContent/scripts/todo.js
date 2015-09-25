$(function() {
	"use strict";

	$(document).ready(function() {
		$("body").on("click", "#btnSaveTodo", function() {
			var postData = $.trim($("#txtNewTodo").val());
			$("#txtNewTodo").val("");

			if (postData) {
				$.post("addpost.php", {
					"newpost" : postData,
					"dataType" : "json"
				}).done(successfulPost).fail(failedPost);
			}
		});
	});

	$(document).ready(function() {
		$("body").on("click", ".btn-success", function() {
			var inputCommentId = this.id.split("-")[1];
			var postComment = $.trim($("#form-control-" + inputCommentId).val());
			$("#form-control-" + inputCommentId).val("");
						
			if (postComment) {
				$.post("addcomment.php", {
					"newcomment" : postComment,
					"postid" : inputCommentId,
					"dataType" : "json"
				}).done(successfulComment).fail(failedComment);
			}
		});
	});
	
	$(document).ready(function() {
		$("body").on("click", ".btn-default", function() {
			var btnId = this.id;
			var url = "";
			$(".list-group-item").remove();
			$("#"+btnId).addClass("active");
			if(btnId === "btnAllList") {
				url = "allposts.php";
				$("#btnMyList").removeClass("active");
			}
			else if(btnId === "btnMyList") {
				$("#btnAllList").removeClass("active");
				url = "myposts.php";
			}
			
			$.post(url, {
				"dataType": "json"
			}).done(displayTodoList).fail(failedPost);
		});
	});
	
	function displayTodoList(data) {
		var posts = jQuery.parseJSON(data);
		$(posts.reverse()).each(function(){
			addPost(this);
			var postId = this["item_id"];
			$.post("comments.php", {
				"postId": postId
			}).done(addAllComments).fail(failedComment);
		});
	}
	
	function addAllComments(data) {
		var comments = jQuery.parseJSON(data);
		$(comments).each(function() {
			addComment(this);
		});
	}
	
	function successfulComment(data) {
		var d = jQuery.parseJSON(data);
		var comment = d[d.length - 1];
		addComment(comment);
	}
	
	function addComment(comment) {
		var comment_id = comment["comment_id"];
		var post_id = comment["item_id"];

		var rootLi = $("<li>").attr({"id": "commentLi-" + comment_id});

		var commentTextDiv = $("<div>").attr({"class": "commentText", "id": "commentText-" + comment_id});
		var commentP = $("<p>").attr({"class": ""}).text(comment["comment_text"]);
		var actionButtonDiv = $("<div>").attr({"class": "pull-right action-buttons"});

		var editComment = $("<a>").attr({"id": "editComment-" + comment_id}).append($("<span>").attr({"class": "glyphicon glyphicon-pencil"}));
		var deleteComment = $("<a>").attr({"id": "deleteComment-" + comment_id, "class": "comment-trash trash"}).append($("<span>").attr({"class": "glyphicon glyphicon-trash"}));
		actionButtonDiv.append(editComment).append(deleteComment);

		var authorSpan = $("<span>").attr({"class": "date sub-text"});
				
		$.post("getuser.php", {
			"userId" : comment["user_id"]
		}).done(function(data, status, xhr) {
			setAuthor(data, status, xhr, authorSpan, comment["created_date"]);
		}).fail(userNotFound);

		commentTextDiv.append(commentP).append(actionButtonDiv).append(authorSpan);
		rootLi.append(commentTextDiv);
		
		$("#commentList-" + post_id).append(rootLi);
	}
	
	function setAuthor(data, status, xhr, authorSpan, createdDate) {
		authorSpan.text("By " + data + " on " + createdDate);
	}
	
	function userNotFound(xhr, status, exception) {
		console.log(xhr, status, exception);
	}
	
	function failedComment(xhr, status, exception) {
		console.log(xhr, status, exception);
	}

	function successfulPost(data) {
		var post = jQuery.parseJSON(data)[0];
		addPost(post);
	}

	function addPost(post) {
		var post_id = post["item_id"];

		var rootLi = $("<li>").attr({"class": "list-group-item titleBox", "id": post_id});

		var postLabel = $("<label>").attr({"id": "item-" + post_id}).text(post["item_text"]);
		rootLi.append(postLabel);

		

		var postActionDiv = $("<div>").attr({"class": "pull-right action-buttons", "id": "action-buttons-" + post_id});
		var editList = $("<a>").attr({"id": "editList-" + post_id}).append($("<span>").attr({"class": "glyphicon glyphicon-pencil"}));
		var deleteList = $("<a>").attr({"id": "deleteList-" + post_id, "class": "post-trash trash"}).append($("<span>").attr({"class": "glyphicon glyphicon-trash"}));
		var markList = $("<a>").attr({"id": "markList-" + post_id, "class": "flag"}).append($("<span>").attr({"class": "glyphicon glyphicon-ok"}));
		postActionDiv.append(editList).append(deleteList).append(markList);
		rootLi.append(postActionDiv);

		var actionBoxDiv = $("<div>").attr({"class": "actionBox", "id": "actionBox-" + post_id});
		var commentListUl = $("<ul>").attr({"class": "commentList", "id": "commentList-" + post_id});
		var inlineForm = $("<div>").attr({"class": "form-inline"});

		var newCommentDiv = $("<div>").attr({"class": "form-group"}).append($("<input>").attr({"class": "form-control", "id": "form-control-" + post_id, "type": "text", "placeholder": "Your comments"}));
		var addCommentDiv = $("<div>").attr({"class": "form-group"}).append($("<button>").attr({"class": "btn btn-success", "id": "btn-" + post_id}).text("Add"));
		inlineForm.append(newCommentDiv).append(addCommentDiv);

		actionBoxDiv.append(commentListUl).append(inlineForm);
		rootLi.append(actionBoxDiv);

		$(".list-group").prepend(rootLi);
	}
	
	function failedPost(xhr, status, exception) {
		console.log(xhr, status, exception);
	}
	

	$(document).ready(function() {
		$("body").on("click", ".post-trash", function() {
			if (confirm("Are you sure?")) {
				var deleteId = this.id.split("-")[1];
				$.post("deletepost.php", {
					"postId" : deleteId
				}).done(function(data, staus, xhr) {
					successfulPostDelete(data, status, xhr, deleteId);
				}).fail(failedPostDelete);
			}
		});
	});

	function successfulPostDelete(data, status, xhr, deleteId) {
		if (data === "1") {
			$("#" + deleteId).remove();
		} else
			alert("Cannot delete");
	}

	function failedPostDelete(xhr, status, exception) {
		console.log(xhr, status, exception);
	}
	
	$(document).ready(function() {
		$("body").on("click", ".comment-trash", function() {
			if (confirm("Are you sure?")) {
				var deleteId = this.id.split("-")[1];
				$.post("deletecomment.php", {
					"commentId" : deleteId
				}).done(function(data, staus, xhr) {
					successfulCommentDelete(data, status, xhr, deleteId);
				}).fail(failedCommentDelete);
			}
		});
	});

	function successfulCommentDelete(data, status, xhr, deleteId) {
		if (data === "1") {
			$("#commentLi-" + deleteId).remove();
		} else
			alert("Cannot delete");
	}

	function failedCommentDelete(xhr, status, exception) {
		console.log(xhr, status, exception);
	}
	

	$(document).ready(function() {
		$("body").on("click", ".flag", function() {
			if (confirm("Mark it as done?")) {
				var postId = this.id.split("-")[1];
				$.post("postdone.php", {
					"postId" : postId
				}).done(function(data, staus, xhr) {
					successfulDonePost(data, status, xhr, postId);
				}).fail(failedDonePost);
			}
		});
	});


	  function successfulDonePost(data, status, xhr, postId) {
		if (data === "1") {
			$("#" + postId).remove();
		} else
			alert("Cannot mark it as done.");
	}

	function failedDonePost(xhr, status, exception) {
		console.log(xhr, status, exception);
	}
	

	
	$(document).ready(function() {
		$(".edit-post").hide();
		$(".comment-edit").hide();
		$(".post-edit").hide();
	});

	/*
	$(document).ready(function() {
		$("body").on("click", ".post-edit", function() {
			var postId = this.id.split("-")[1];
			var post = $("#item-" + postId).text();
			$("#edit-post-" + postId).show();
			$("#edit-post-text-" + postId).val(post);

			$("body").on("click", "#edit-post-btn-" + postId, function() {
				$.post("editpost.php", {
					"postId" : postId,
					"post" : post
				}).done(function(data, staus, xhr) {
					editPost(data, staus, xhr, postId)
				}).fail(failedPost);
			});
		});
	});
	
	function editPost(data, staus, xhr, postId) {
		if (data === "1") {
			$("#edit-post-" + postId).hide();
			$("#item-" + postId).text($("#edit-post-text-" + postId).val());
		} else {
			alert("Cannot edit the post.");
		}
	}
	*/
});