@if ($crud->hasAccess('update'))
	@if (!$crud->model->translationEnabled())

	<!-- Single edit button -->
	<a data-button-type="update" onclick="onNavigate(this)" href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}</a>

	@else

	<!-- Edit button group -->
	<div class="btn-group">
	  <a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}</a>
	  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    <span class="caret"></span>
	    <span class="sr-only">Toggle Dropdown</span>
	  </button>
	  <ul class="dropdown-menu dropdown-menu-right">
  	    <li class="dropdown-header">{{ trans('backpack::crud.edit_translations') }}:</li>
	  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
		  	<li><a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}</a></li>
	  	@endforeach
	  </ul>
	</div>

	@endif
@endif

<script>
	if (typeof onNavigate != 'function') {
		$("[data-button-type=update]").unbind('click');

		function onNavigate(button) {
			// ask for confirmation before deleting an item
			// e.preventDefault();
			document.querySelector('tr.active-import-border')?.classList.remove('active-import-border');
			const parentTR = button.closest('tr');
			if (parentTR) {
				parentTR.classList.add('active-import-border');
			}
		}
	}

</script>

