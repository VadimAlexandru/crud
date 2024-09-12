@if ($crud->hasAccess('show'))
	@if (!$crud->model->translationEnabled())

	<!-- Single edit button -->
	<a data-button-type="navigate" onclick="onNavigate(this)" href="{{ url($crud->route.'/'.$entry->getKey()) }}" class="btn btn-xs btn-default"><i class="fa fa-eye"></i> {{ trans('backpack::crud.preview') }}</a>

	@else

	<!-- Edit button group -->
	<div class="btn-group">
	  <a href="{{ url($crud->route.'/'.$entry->getKey()) }}" class="btn btn-xs btn-default"><i class="fa fa-eye"></i> {{ trans('backpack::crud.preview') }}</a>
	  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    <span class="caret"></span>
	    <span class="sr-only">Toggle Dropdown</span>
	  </button>
	  <ul class="dropdown-menu dropdown-menu-right">
  	    <li class="dropdown-header">{{ trans('backpack::crud.preview') }}:</li>
	  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
		  	<li><a href="{{ url($crud->route.'/'.$entry->getKey()) }}?locale={{ $key }}">{{ $locale }}</a></li>
	  	@endforeach
	  </ul>
	</div>

	@endif
@endif

<script>
	if (typeof onNavigate != 'function') {
		$("[data-button-type=navigate]").unbind('click');

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

