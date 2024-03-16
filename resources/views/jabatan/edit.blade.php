<x-app-layout>
	<a href="{{ route('jabatan.index') }}" class="btn mb-6">daftar jabatan</a>
	<form class="grid gap-4" action="{{ route('jabatan.update', ['jabatan' => $jabatan]) }}" method="post">
		@csrf
		@method('PATCH')
		<x-form-control>
			<x-label>nama jabatan</x-label>
			<x-text-input
				name="nama_jabatan"
				value="{{$jabatan->nama_jabatan}}"
				placeholder="nama jabatan"
			/>
			@error('nama_jabatan')
				<x-error-label>{{ $message }}</x-error-label>
			@enderror
		</x-form-control>



		<x-form-control>
			<x-label>gaji</x-label>
			<x-text-input name="gaji" type="number" value="{{ $jabatan->gaji }}"/>
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