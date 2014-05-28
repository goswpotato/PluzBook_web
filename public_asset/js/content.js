

function series_operation()
{
	if($(this).attr("name")=="edit")
	{
		
	}
	else if($(this).attr("name")=="remove")
	{
		if(remove_check())
		{
			
		}
	}
	
	return false;
}

function remove_event()
{
	if(confirm("Are you sure to delete this series?"))
	{
		return true;
	}

	return false;
}


function check_series_name()
{
	if($("input[name='new_series_name']").val()=="")
	{
		alert("series name cannot be empty.");
		
		return false;
	}
	
	return true;
}



