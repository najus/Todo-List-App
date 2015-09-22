$(function() {
	"use strict";

	$("#submit-post").click(function() {
		var postData = $("#newpost").val();
		$.post("addpost.php", {
			"newpost" : postData
		}).done(successfulPost).fail(failedPost);
	});

	function successfulPost(data) {
//		alert(data);
		var rootDiv = $("<div>");
		rootDiv.addClass("row posts");
		
		var postDiv = $("<div>");
		postDiv.addClass("col-lg-12 admin");
		postDiv.text(data);
		
		var input = $("<input>").attr({'type': 'text'});
		var button = $("<button>").text("+ Comment");
		button.addClass("btn-primary add-post-height");
		
		rootDiv.append(postDiv);
		postDiv.append(input);
		postDiv.append(button);
		
		$("#posts").prepend(rootDiv);
	}

	function failedPost(xhr, status, exception) {
		console.log(xhr, status, exception);
	}
});