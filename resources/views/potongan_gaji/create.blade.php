<x-app-layout>
	<a href="{{ route('potongan-gaji.index') }}" class="btn mb-6">daftar potongan gaji</a>
	<form class="grid gap-4" action="{{ route('potongan-gaji.store') }}" method="post">
		@csrf
		
		<x-form-control>
			<x-label>keterangan</x-label>
			<x-text-input
				name="keterangan"
				value="{{old('keterangan')}}"
				placeholder="nama keterangan"
			/>
			@error('keterangan')
				<x-error-label>{{ $message }}</x-error-label>
			@enderror
		</x-form-control>
		<x-form-control>
			<x-label>nilai potongan</x-label>
			<x-text-input
				name="nilai_potongan"
				type="number"
				value="{{old('nilai_potongan')}}"
				placeholder="nilai potongan"
			/>
			@error('nilai_potongan')
				<x-error-label>{{ $message }}</x-error-label>
			@enderror
		</x-form-control>
		<div class="flex justify-end items-center gap-4">
			<button type="reset" class="btn btn-primary-outlite">reset</button>
			<button type="submit" class="btn btn-primary">submit</button>
		</div>
	</form>
</x-app-layout>