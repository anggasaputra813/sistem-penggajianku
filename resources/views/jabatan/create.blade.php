<x-app-layout>
	<a href="{{ route('jabatan.index') }}" class="btn mb-6">daftar jabatan</a>
	<form class="grid gap-4" action="{{ route('jabatan.store') }}" method="post">
		@csrf
		<x-form-control>
			<x-label>Jabatan</x-label>
			<x-text-input
				name="nama_jabatan"
				value="{{old('nama_jabatan')}}"
				placeholder="nama jabatan"
			/>
			@error('nama_jabatan')
				<x-error-label>{{ $message }}</x-error-label>
			@enderror
		</x-form-control>
		<x-form-control>
			<x-label>Gaji</x-label>
			<x-text-input
				name="gaji"
				type="number"
				value="{{old('gaji')}}"
				placeholder="gaji karyawan"
			/>
			@error('gaji')
				<x-error-label>{{ $message }}</x-error-label>
			@enderror
		</x-form-control>
		<div class="flex justify-end items-center gap-4">
			<button type="reset" class="btn btn-primary-outlite">reset</button>
			<button type="submit" class="btn btn-primary">submit</button>
		</div>
	</form>
</x-app-layout>
