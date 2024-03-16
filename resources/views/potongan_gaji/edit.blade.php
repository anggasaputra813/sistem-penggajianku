<x-app-layout>
	<a href="{{ route('potongan-gaji.index') }}" class="btn mb-6">daftar potongan gaji</a>
	<form class="grid gap-4" action="{{ route('potongan-gaji.update', ['potongan_gaji' => $potongan_gaji]) }}" method="post">
		@csrf
		@method("PUT")

		<x-form-control>
			<x-label>keterangan</x-label>
			<x-text-input
				name="keterangan"
				value="{{$potongan_gaji->keterangan}}"
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
				value="{{$potongan_gaji->nilai_potongan}}"
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