<x-app-layout>
	<div class="space-y-6">
		<a href="{{ route('list-absensi-anggota') }}" class="btn">list absensi</a>

		<form action="{{ route('store-jadwal-pengganti', ['jadwal' => $jadwal]) }}" method="post" class="grid gap-4">
			@csrf()

			<x-form-control>
				<x-label>pemilik jadwal</x-label>
				<x-text-input readonly disable value="{{ $anggota->user->nama }}" />
			</x-form-control>

			<x-form-control>
				<x-label>shift</x-label>
				<x-text-input readonly disable value="{{ $jadwal->shift }}" />
			</x-form-control>

			<x-form-control>
				<x-label>tanggal</x-label>
				@php
					$timezone = new DateTimeZone('Asia/Jakarta');
					$datetime = new DateTime($jadwal->tanggal, $timezone)
				@endphp
				<x-text-input readonly disable value="{{ $datetime->format('D, d F Y') }}" />
			</x-form-control>

			<x-form-control>
				<x-label>nama pengganti</x-label>
				<select required name="anggota_id" id="" class="select select-bordered w-full">
					@foreach($list_anggota as $a) 
						@if($a->id != $anggota->id)
							<option value="{{ $a->id }}">{{ $a->user->nama }}</option>
						@endif
					@endforeach
				</select>
			</x-form-control>

			<div class="flex justify-end items-center gap-2">
				<button type="reset" class="btn btn-outline">reset</button>
				<button type="submit" class="btn">submit</button>
			</div>
		</form>
		
	</div>
</x-app-layout>