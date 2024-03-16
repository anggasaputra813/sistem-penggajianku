<x-app-layout>
	<div class="space-y-6">
		<a href="{{ route('list-absensi-anggota') }}" class="btn">list absensi</a>

		<table class="table">
			<tr>
				<td>nama pengganti</td>
				<td>:</td>
				<td>{{ $pengganti->user->nama }}</td>
			</tr>
			<tr>
				<td>status</td>
				<td>:</td>
				<td>
					@php
					$timezone = new DateTimeZone('Asia/Jakarta');
					$now = new DateTime('now', $timezone);

					$batas = new DateTime($jadwal->tanggal, $timezone);
					$interval = DateInterval::createFromDateString('8 hours');

					if($jadwal->shift == 'pagi') {
						$batas->setTime(7, 0);	
						if($absensi == null) {
							$batas->add($interval);
						}
					}
					if($jadwal->shift == 'siang') {
						$batas->setTime(15, 0);		
						if($absensi == null) {
							$batas->add($interval);
						}
					}
					if($jadwal->shift == 'pagi') {
						$batas->setTime(23, 0);		
						if($absensi == null) {
							$batas->add($interval);
						}
					}

					@endphp
					@if($absensi_pengganti == null && $now->getTimestamp() < $batas->getTimestamp()) 
						<span class="badge badge-lg badge-ghost">belum hadir</span>
					@elseif($absensi_pengganti == null && $now->getTimestamp() >= $batas->getTimestamp()) 
						<span class="badge badge-lg badge-error">tidak hadir</span>

					@else 
						<span class="badge badge-lg badge-ghost">hadir</span>
					@endif

				</td>
			</tr>
			<tr>
				<td>tanggal</td>
				<td>:</td>
				@php
					$tanggal = new DateTime($jadwal->tanggal, $timezone);
				@endphp
				<td>{{ $tanggal->format('D, d F Y') }}</td>
			</tr>
			<tr>
				<td>jam masuk</td>
				<td>:</td>
				<td>
					@if($absensi_pengganti != null) 
						@php
							$jam_masuk = new DateTime($absensi_pengganti->jam_masuk, $timezone);
						@endphp
						{{ $jam_masuk->format('H:m:s') }}
					@endif
				</td>
			</tr>
			<tr>
				<td>bukti kehadiran</td>
				<td>:</td>
				<td>
					@if($absensi_pengganti != null) 
						<img src="{{ $absensi_pengganti->bukti_kehadiran }}" alt="">
					@endif
				</td>
			</tr>
		</table>
	</div>
</x-app-layout>