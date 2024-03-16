<x-app-layout>
	<div class="space-y-6">
		<form action="{{ route('store-jadwal-lembur', ['jadwal_pengganti' => $jadwal->jadwal_pengganti]) }}" class="grid gap-4" method="post" enctype="multipart/form-data">
			@csrf()
			<x-form-control>
				<x-label>pemilik jadwal</x-label>
				<x-text-input readonly disabled value="{{ $jadwal->anggota->user->nama }}"/>
			</x-form-control>
			<x-form-control>
				@php
				$timezone = new DateTimeZone('Asia/Jakarta');
				$datetime = new DateTime($jadwal->tanggal, $timezone);
				@endphp
				<x-label>tanggal</x-label>
				<x-text-input readonly disabled value="{{ $datetime->format('D, d F Y') }}"/>
			</x-form-control>
			<x-form-control>
				<x-label>shift</x-label>
				<x-text-input readonly disabled value="{{ $jadwal->shift }}"/>
			</x-form-control>
			<x-form-control>
				<x-label>bukti kehadiran</x-label>
				<input type="file" capture="user" accept="image/*" name="bukti_kehadiran" required class="file-input file-input-bordered"/>	
				@error('bukti_kehadiran')
					<label class="label">
						<span class="label-text text-error">{{ $message }}</span>
					</label>
				@enderror
			</x-form-control>
			<div class="flex justify-end items-center gap-2">
				<button type="reset" class="btn btn-outline">reset</button>
				<button type="submit" class="btn">submit</button>
			</div>
		</form>
	</div>
</x-app-layout>