<x-app-layout>
	<div class="space-y-6">
		<form method="get" class="grid gap-4">
			<x-form-control>
				<x-label>anggota</x-label>
				<select name="anggota_id" class="select select-bordered w-full">
					@foreach ($list_anggota as $a)
						<option 
							value="{{$a->id}}" 
							@if($anggota->id == $a->id) selected @endif
						>{{$a->user->nama}}</option>
					@endforeach
				</select>
			</x-form-control>
			<x-form-control>
				<x-label>periode</x-label>
				<select name="periode_id" class="select select-bordered w-full">
					@foreach ($list_periode as $p)
						@php
							$datetime = new DateTime($p->dari);
						@endphp
						<option 
							value="{{$p->id}}"
							@if($periode->id == $p->id) selected @endif
						>{{ $datetime->format('F') }}</option>
					@endforeach
				</select>
			</x-form-control>

			<div class="flex justify-end items-center">
				<button class="btn">apply</button>
			</div>
		</form>

		<div class="overflow-x-auto w-full">
			<table class="table w-full">
				<thead>
					<tr>
						<th>no</th>
						<th>tanggal</th>
						<th>shift</th>
						<th>keterangan</th>
						<th>detail</th>
						<th>pengganti</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($list_jadwal as $jadwal)
						<tr>
							<th>{{ $loop->iteration }}</th>
							@php 
								$timezone = new DateTimeZone('Asia/Jakarta');
								$datetime = new DateTime($jadwal->tanggal, $timezone); 
							@endphp
							<td>
								<span class="@if($datetime->format('D') == 'Sun') text-rose-500 @endif">
									{{ $datetime->format('D, d F Y') }}
								</span>
							</td>
							<td>{{ $jadwal->shift }}</td>
							<td>
								@if($jadwal->absensi == null && $datetime->getTimestamp() <= time())
									<span class="badge badge-lg badge-warning">tidak ada keterangan</span>
								@elseif($jadwal->absensi == null && $datetime->getTimestamp() > time())
									<span class="badge badge-lg badge-ghost">belum tersedia</span>
								@elseif($jadwal->absensi->keterangan == 'sakit' || $jadwal->absensi->keterangan == 'izin')
									<span class="badge badge-lg badge-warning">{{ $jadwal->absensi->keterangan }}</span>

								@else
									<span class="badge badge-lg">hadir</span>
								@endif
							</td>
							<td>
								@if($jadwal->absensi != null)
									<label for="absensi-{{$jadwal->absensi->id}}" class="btn btn-link">detail</label>
									<!-- Put this part before </body> tag -->
									<input type="checkbox" class="modal-toggle" id="absensi-{{$jadwal->absensi->id}}" />
									<label for="absensi-{{$jadwal->absensi->id}}" class="modal  cursor-pointer">
									  <label class="modal-box mt-8 relative" for="">
									    <h3 class="font-bold text-lg">detail absensi</h3>
									    <div class="grid @if($jadwal->absensi->keterangan == 'hadir') grid-cols-2 @endif gap-4">
									    	<x-form-control>
									    		<x-label>keterangan</x-label>
									    		<x-text-input value="{{ $jadwal->absensi->keterangan }}" readonly/>
									    	</x-form-control>
									    	@if($jadwal->absensi->keterangan == 'hadir')
										    	<x-form-control>
										    		<x-label>jam masuk</x-label>
										    		@php
										    		$jam_masuk = new DateTime($jadwal->absensi->jam_masuk, new DateTimeZone('Asia/Jakarta'));
										    		@endphp
										    		<x-text-input value="{{ $jam_masuk->format('H:i:s') }}" readonly/>
										    	</x-form-control>
									    	@endif
									    	<div class="col-span-2">
									    		<x-label>bukti kehadiran</x-label>
										    	<img src="{{ $jadwal->absensi->bukti_kehadiran }}" alt="bukti kehadiran">
									    	</div>
									    </div>
									    <div class="flex justify-between items-center">
								    		<label for="absensi-{{$jadwal->absensi->id}}" class="btn">tutup</label>
									    </div>
									  </label>
									</label>
								@endif
							</td>
							<td>
								@if($jadwal->absensi == null && $datetime->getTimestamp() <= time())

									@php 
										$timezone = new DateTimeZone('Asia/Jakarta');
										$jam_keluar = new DateTime($jadwal->tanggal, $timezone); 

										if($jadwal->shift == 'pagi') {
											$jam_keluar->setTime(7, 0);
										}

										if($jadwal->shift == 'siang') {
											$jam_keluar->setTime(15, 0);
										}

										if($jadwal->shift == 'malam') {
											$jam_keluar->setTime(23, 0);
										}


										$interval = DateInterval::createFromDateString('8 hours');
										$jam_keluar->add($interval);

									@endphp
									@if($jam_keluar->getTimestamp() > time())
										<a href="{{ route('create-jadwal-pengganti', ['jadwal' => $jadwal]) }}" class="btn btn-link">buat pengganti</a>
									@elseif($jadwal->pengganti != null)
										<span>ada pengganti</span>
									@else
										<span class="badge badge-lg badge-error">Tidak ada pengganti</span>
									@endif
								@endif
								@if($jadwal->absensi != null && $jadwal->absensi->keterangan != 'hadir')

									@php 
										$timezone = new DateTimeZone('Asia/Jakarta');
										$jam_masuk = new DateTime($jadwal->tanggal, $timezone); 

										if($jadwal->shift == 'pagi') {
											$jam_masuk->setTime(7, 0);
										}

										if($jadwal->shift == 'siang') {
											$jam_masuk->setTime(15, 0);
										}

										if($jadwal->shift == 'malam') {
											$jam_masuk->setTime(23, 0);
										}

									@endphp
									@if($jam_masuk->getTimestamp() > time() && $jadwal->jadwal_pengganti == null)
										<a href="{{ route('create-jadwal-pengganti', ['jadwal' => $jadwal]) }}" class="btn btn-link">buat pengganti</a>
									@elseif($jadwal->jadwal_pengganti != null)
										<a href="{{ route('detail-jadwal-pengganti', [ 'jadwal_pengganti' => $jadwal->jadwal_pengganti, 'jadwal' => $jadwal]) }}" class="btn btn-link">detail pengganti</a>
									@else
										<span class="badge badge-lg badge-error">Tidak ada pengganti</span>
									@endif
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		
	</div>
</x-app-layout>