<x-app-layout>
	<div class="space-y-6">
		<form method="get" class="grid gap-4">
			<x-form-control>
				<x-label>pilih bulan</x-label>
				<select required name="periode_id" class="select select-bordered w-full">
					@foreach($list_periode as $p)
						@php
							$timezone = new DateTimeZone('Asia/Jakarta');
							$datetime = new DateTime($p->tanggal, $timezone);
						@endphp
						<option value="{{ $p->id }}">{{ $datetime->format('F') }}</option>
					@endforeach
				</select>
			</x-form-control>

			<div class="flex justify-end">
				<button type="submit" class="btn">apply</button>
			</div>
		</form>

		<div class="overflow-x-auto border rounded-lg">
			<table class="table w-full">
				<thead>
					<tr>
						<th>no</th>
						<th>menggantikan</th>
						<th>tanggal</th>
						<th>shift</th>
						<th>kehadiran</th>
					</tr>
				</thead>
				<tbody>
					@forelse($list_jadwal_pengganti as $jp)
						<tr>
							<th>{{ $loop->iteration }}</th>
							<td>{{ $jp->jadwal->anggota->user->nama }}</td>
							@php
							$timezone = new DateTimeZone('Asia/Jakarta');
							$datetime = new DateTime($jp->jadwal->tanggal, $timezone);

							if($jp->jadwal->shift == 'pagi') {
								$datetime->setTime(7, 0);
							}
							if($jp->jadwal->shift == 'siang') {
								$datetime->setTime(15, 0);
							}
							if($jp->jadwal->shift == 'malam') {
								$datetime->setTime(23, 0);
							}

							$now = new DateTime('now', $timezone);
							@endphp
							<td>{{ $datetime->format('D, d F Y') }}</td>
							<td>{{ $jp->jadwal->shift }}</td>
							<td>
								@if($jp->absensi_pengganti == null && $now->getTimestamp() >= $datetime->getTimestamp())
									<span class="badge badge-lg badge-error">tidak hadir</span>

								@elseif($jp->absensi_pengganti == null && $now->getTimestamp() < $datetime->getTimestamp())
									<a href="{{ route('create-jadwal-lembur', ['jadwal_pengganti' => $jp]) }}" class="btn btn-link">isi absen</a>
								@else
									<span class="badge badge-lg">hadir</span>
								@endif

							</td>
						</tr>
					@empty
						<tr>
							<td colspan="5">
								<h1 class="text-lg text-center text-base-200">belum ada data</h1>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</x-app-layout>