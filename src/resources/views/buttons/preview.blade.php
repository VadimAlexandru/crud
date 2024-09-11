{{-- This button is deprecated and will be removed in CRUD 3.5 --}}

@if ($crud->hasAccess('show'))
	<a data-button-type="navigate" onclick="onNavigate(this)" href="{{ url($crud->route.'/'.$entry->getKey()) }}" class="btn btn-xs btn-default"><i class="fa fa-eye"></i> {{ trans('backpack::crud.preview') }}</a>
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

