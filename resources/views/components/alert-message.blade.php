@if (session('info') || !empty($info))
	<x-alert-message-sub-component :type="'info'" :color="'info'">
		<svg aria-hidden="true" class="flex-shrink-0 inline w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
		</svg>

		<div>
			<span class="font-medium">
				{{ ucfirst(__('info')) }} !
			</span>

			{!! $info ?? session('info') !!}
		</div>
	</x-alert-message-sub-component>
@elseif (session('success') || !empty($success))
	<x-alert-message-sub-component :type="'success'" :color="'success'">
		<svg aria-hidden="true" class="flex-shrink-0 inline w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
			<path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
		</svg>

		<div>
			<span class="font-medium">
				{{ ucfirst(__('success')) }} !
			</span>

			{!! $success ?? session('success') !!}
		</div>
	</x-alert-message-sub-component>
@elseif (session('warning') || !empty($warning))
	<x-alert-message-sub-component :type="'warning'" :color="'warning'">
		<svg aria-hidden="true" class="flex-shrink-0 inline w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
		</svg>

		<div>
			<span class="font-medium">
				{{ ucfirst(__('warning')) }} !
			</span>

			{!! $warning ?? session('warning') !!}
		</div>
	</x-alert-message-sub-component>
@elseif (session('error'))
	<x-alert-message-sub-component :type="'error'" :color="'danger'">
		<svg aria-hidden="true" class="flex-shrink-0 inline w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
		</svg>

		<div>
			<span class="font-medium">
				{{ ucfirst(__('error')) }} !
			</span>

			{!! $error ?? session('error') !!}
		</div>
	</x-alert-message-sub-component>
@elseif ($errors->any())
	<x-alert-message-sub-component :type="'error'" :color="'danger'">
		<svg aria-hidden="true" class="flex-shrink-0 inline w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
		</svg>

		<div>
			<span class="font-medium">
				{{ ucfirst(__('error')) }} !
			</span><br>

			@foreach ($errors->all() as $error)
				{{ $error }}<br>
			@endforeach
		</div>
	</x-alert-message-sub-component>
@endif

<div class="hidden text-success-700 bg-success-100"></div>
<div class="hidden text-info-700 bg-info-100"></div>
<div class="hidden text-warning-700 bg-warning-100"></div>
<div class="hidden text-danger-700 bg-danger-100"></div>
