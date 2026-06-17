<x-space-layout>
	<x-slot name="side_menu">
		@include('components.front.space.profile.side-menu')
	</x-slot>

	<div class="p-4">
		<div class="w-full bg-white px-6 pt-6 pb-10 mb-6">
			<div class="flex flex-row w-full gap-x-2 text-mnw-deepblue mb-4">
				<h2 class="mb-1 text-base md:text-[24px] !text-[40px] font-bold text-mnw-deepblue">
					{{ __('My orders and invoices') }}
				</h2>
			</div>
			<hr class="h-px border border-mnw-deepblue w-full my-[30px]">

			<div class="flex flex-col max-sm:items-start max-sm:space-y-4 sm:justify-between">
				@if($orders->isNotEmpty())
					<div class="overflow-x-auto">
						<div class="min-w-full inline-block align-middle">
							<div class="overflow-hidden rounded-2xl shadow-lg">
								<table class="min-w-full border-collapse bg-white">
									<thead class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wide">
										<tr>
											<th scope="col" class="px-6 py-3 text-left font-semibold">{{ __('Date') }}</th>
											<th scope="col" class="px-6 py-3 text-left font-semibold">{{ __('Offer') }}</th>
											<th scope="col" class="px-6 py-3 text-left font-semibold">{{ __('Total price') }}</th>
											<th scope="col" class="px-6 py-3 text-left font-semibold">{{ __('Payment method') }}</th>
											<th scope="col" class="px-6 py-3 text-left font-semibold">{{ __('Status') }}</th>
											<th scope="col" class="px-6 py-3 text-left font-semibold">{{ __('Facture') }}</th>
										</tr>
									</thead>

									<tbody class="divide-y divide-gray-200 text-sm text-gray-600">
										@foreach($orders as $order)
											<tr class="hover:bg-gray-50 transition">
												<td class="px-6 py-4 font-medium text-gray-900">
													{{ $order['created_at']->format('d/m/Y H:i:s') }}
												</td>

												<td class="px-6 py-4">
													{{ $order['product'] }}
												</td>

												<td class="px-6 py-4">
													{{ $order['price'] }}€
												</td>

												<td class="px-6 py-4">
													<span class="px-2 py-1 inline-flex text-xs font-medium rounded-full bg-green-100 text-green-700">
														{{ __($order['payment_method']) }}
													</span>
												</td>

												<td class="px-6 py-4">
													<span class="px-2 py-1 inline-flex text-xs font-medium rounded-full bg-green-100 text-green-700">
														{{ __($order['payment_status']) }}
													</span>
												</td>

												<td class="px-6 py-4">
													@if($order['invoice'])
														<a href="{{ $order['invoice']->hosted_invoice_url }}" target="_blank">
															{{ __('Download my invoice') }}
														</a>
													@else
														{{ __('Invoice unavailable') }}
													@endif
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				@else
					<span class="text-mnw-deepblue">{{ __('You have not invoices yet') }}</span>
				@endif
			</div>
		</div>
	</div>
</x-space-layout>
