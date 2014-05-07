
/*
function edit_event()
{
	var thumbnail_object;
	var p_object;
	var textarea_object;
	var text;
	
	thumbnail_object=$(this).parent().parent();
	
	if($(this).attr("status")=="done")
	{
		p_object=thumbnail_object.children("p");
		p_object.replaceWith("<textarea rows='3' placeholder='' ></textarea>");
		
		textarea_object=thumbnail_object.children("textarea");
		text=p_object.text();
		textarea_object.val("");
		textarea_object.focus();
		textarea_object.val(text);
		
		//textarea_object.attr("temp_save", text);????
		
		$(this).attr("status", "editing");
	}
	else if($(this).attr("status")=="editing")
	{
		textarea_object=thumbnail_object.children("textarea");
		textarea_object.replaceWith("<p>" + textarea_object.val() + "</p>");

		image_id=thumbnail_object.parent().children("input[name='iid']").val();
		action_url=$("#description_url").val();
		
		// Ajax by jQuery
		
		$.ajax(
			{
			url: action_url,
			data: {iid: image_id, description: textarea_object.val()},
			type: "POST",
			async: true,
			dataType: "text",
			success: function(description)
			{
				textarea_object.val(description);
			},
			error: function(xhr, ajaxOptions, thrownError)
			{
				textarea_object.val(textarea_object.attr("temp_save"));
			},
			
			}
		);
		
		$(this).attr("status", "done");
	}
	
	
}
*/


function remove_check()
{
	if(confirm("Are you sure to delete this image?"))
	{
		return true;
	}

	return false;
}


function edit_name()
{
	var xmlhttp;
	if(window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	
	
	
	xmlhttp.open("GET", "ajax_test.asp",true);
	//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("fname=Henry&lname=Ford");
}

