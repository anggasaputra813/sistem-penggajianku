<x-app-layout>
	<div class="space-y-6">
		<a href="{{ route('anggota.index') }}" class="btn">daftar anggota</a>
		<form action="{{ route('anggota.update', ['anggotum' => $anggota]) }}" method="post" class="grid gap-4 lg:grid-cols-2">
			@csrf
			@method('PATCH')

			<x-form-control class="lg:col-span-2">
				<x-label>nama</x-label>
				<x-text-input name="nama" value="{{ $anggota->user->nama }}" placeholder="nama anggota" />
				@error('nama')
					<x-error-label>{{ $message }}</x-error-label>
				@enderror
			</x-form-control>

			<x-form-control class="lg:col-span-2">
				<x-label>nik</x-label>
				<x-text-input name="nik" value="{{ $anggota->nik }}" placeholder="nik"/>
				@error('nik')
					<x-error-label>{{ $message }}</x-error-label>
				@enderror
			</x-form-control>

			<x-form-control>
				<x-label>lokasi</x-label>
				<select class="select select-bordered" name="lokasi_id" required>
					@forelse($list_lokasi as $lokasi)
						<option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
					@empty
						<option disabled>belum ada data</option>
					@endforelse
				</select>
			</x-form-control>

			<x-form-control>
				<x-label>jabatan</x-label>
				<select class="select select-bordered" name="jabatan_id" required>
					@forelse($list_jabatan as $jabatan)
						<option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
					@empty
						<option disabled>belum ada data</option>
					@endforelse
				</select>
			</x-form-control>

			<div class="flex items-center justify-end gap-4 lg:col-span-2">
				<button type="reset" class="btn btn-outline">reset</button>
				<button type="submit" class="btn">submit</button>
			</div>
		</form>
	</div>
</x-app-layout>