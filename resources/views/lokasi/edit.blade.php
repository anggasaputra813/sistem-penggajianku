<x-app-layout>
	<a href="{{ route('lokasi.index') }}" class="btn mb-6">daftar lokasi</a>
	<form class="grid gap-4" action="{{ route('lokasi.update', ['lokasi' => $lokasi]) }}" method="post">
		@csrf
		@method('PATCH')

		<x-form-control>
			<x-label>nama tempat</x-label>
			<x-text-input
				name="nama_lokasi"
				value="{{$lokasi->nama_lokasi}}"
				placeholder="nama lokasi"
			/>
			@error('nama_lokasi')
				<x-error-label>{{ $message }}</x-error-label>
			@enderror
		</x-form-control>

		<x-form-control>
			<x-label>alamat lengkap</x-label>
			<textarea placeholder="alamat lengkap" name="alamat" class="textarea textarea-bordered" rows="8">{{$lokasi->alamat}}</textarea>
			@error('alamat')
				<x-error-label>{{ $message }}</x-error-label>
			@enderror
		</x-form-control>

		<div class="flex justify-end items-center gap-4">
			<button type="reset" class="btn btn-primary-outlite">reset</button>
			<button type="submit" class="btn btn-primary">submit</button>
		</div>
	</form>
</x-app-layout>