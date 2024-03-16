<x-app-layout>
	<div class="space-y-6">
		<a href="{{ route('jadwal.index') }}" class="btn">daftar jadwal per bulan</a>

		<form action="{{ route('jadwal.store') }}" method="post" class="grid gap-6">
			@csrf

			<x-form-control>
				<x-label>bulan</x-label>
				<x-text-input type="month" required name="bulan" />
				@error('bulan')
					<x-error-label>{{ $message }}</x-error-label>
				@enderror
			</x-form-control>

			<div class="flex justify-end items-center gap-2">
				<button type="reset" class="btn">reset</button>
				<button type="submit" class="btn btn-primary">submit</button>
			</div>

		</form>
	</div>
</x-app-layout>
