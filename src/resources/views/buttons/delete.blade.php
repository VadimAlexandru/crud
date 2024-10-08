@if ($crud->hasAccess('delete'))
	<a href="javascript:void(0)" onclick="deleteEntry(this)" data-route="{{ url($crud->route.'/'.$entry->getKey()) }}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{ trans('backpack::crud.delete') }}</a>
@endif

<script>
	if (typeof deleteEntry != 'function') {
	  $("[data-button-type=delete]").unbind('click');

	  function deleteEntry(button) {
	      // ask for confirmation before deleting an item
	      // e.preventDefault();
		  document.querySelector('tr.active-import-border')?.classList.remove('active-import-border');
		  const parentTR = button.closest('tr');
		  if (parentTR) {
			  parentTR.classList.add('active-import-border');
		  }

	      var button = $(button);
	      var route = button.attr('data-route');
	      var row = $("#crudTable a[data-route='"+route+"']").closest('tr');

	      setTimeout(() => {
			  if (confirm("{{ trans('backpack::crud.delete_confirm') }}") == true) {
				  $.ajax({
					  url: route,
					  type: 'DELETE',
					  success: function(result) {
						  if (result != 1) {
							  // Show an error alert
							  new PNotify({
								  title: "{{ trans('backpack::crud.delete_confirmation_not_title') }}",
								  text: "{{ trans('backpack::crud.delete_confirmation_not_message') }}",
								  type: "warning"
							  });
						  } else {
							  // Show a success alert with the result
							  new PNotify({
								  title: "{{ trans('backpack::crud.delete_confirmation_title') }}",
								  text: "{{ trans('backpack::crud.delete_confirmation_message') }}",
								  type: "success"
							  });

							  // Hide the modal, if any
							  $('.modal').modal('hide');

							  // Remove the details row, if it is open
							  if (row.hasClass("shown")) {
								  row.next().remove();
							  }

							  // Remove the row from the datatable
							  row.remove();
						  }
					  },
					  error: function(result) {
						  // Show an alert with the result
						  new PNotify({
							  title: "{{ trans('backpack::crud.delete_confirmation_not_title') }}",
							  text: "{{ trans('backpack::crud.delete_confirmation_not_message') }}",
							  type: "warning"
						  });
					  }
				  });
			  } else {
				  // Show an alert telling the user we don't know what went wrong
				  new PNotify({
					  title: "{{ trans('backpack::crud.delete_confirmation_not_deleted_title') }}",
					  text: "{{ trans('backpack::crud.delete_confirmation_not_deleted_message') }}",
					  type: "info"
				  });
			  }
		  }, 300)
      }
	}

	// make it so that the function above is run after each DataTable draw event
	// crud.addFunctionToDataTablesDrawEventQueue('deleteEntry');
</script>

