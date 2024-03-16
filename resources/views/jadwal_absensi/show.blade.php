<x-app-layout>
	@php

	$timestamp = time();
	$timezone = new DateTimeZone("Asia/Jakarta");

	$now = new DateTime();
	$now->setTimestamp($timestamp);
	$now->setTimezone($timezone);
	@endphp
	<div class="space-y-6">
		<a href="{{ route('jadwal-absensi.index') }}" class="btn">daftar jadwal per bulan</a>
		<div class="overflow-x-auto border rounded-lg">
			<table class="table w-full">
				<thead>
					<tr>
						<th>tanggal</th>
						<th>shift</th>
						<th>absen</th>
						<th>aksi</th>
					</tr>
				</thead>
				<tbody>
					@php
					$dari = new DateTime($periode->dari);
					$dari->setTimezone($timezone);

					$hingga = new DateTime($periode->hingga);
					$hingga->setTimezone($timezone);
					
					$interval = DateInterval::createFromDateString('1 day');

					$daterange = new DatePeriod($dari, $interval, $hingga->add($interval));
					@endphp

					@foreach($daterange as $current_date) 
						@php 
						$jadwal_anggota = $list_jadwal->where("tanggal", "=", $current_date->format('Y-m-d'))->first(); 

						$shift = new DateTime($current_date->format('Y-m-d'), $timezone);
						$unix_shift_pagi = $shift->setTime(7, 0, 0)->getTimestamp();
						$unix_shift_siang = $shift->setTime(15, 0, 0)->getTimestamp();
						$unix_shift_malam = $shift->setTime(23, 0, 0)->getTimestamp();
						@endphp
						<tr @if($jadwal_anggota != null && $current_date->format('Y-m-d') == $now->format('Y-m-d')) class="active" @endif>

							<th>{{ $current_date->format("d F, Y") }}</th>
							
							@if($jadwal_anggota == null) 
								<td>off</td>
								<td></td>
								<td></td>
							@else
								<td>{{ $jadwal_anggota->shift }}</td>
								<td>
									@if($jadwal_anggota->absensi == null && $jadwal_anggota->shift == 'pagi' && 
										$unix_shift_pagi < $now->getTimestamp())

										<span class="badge badge-lg badge-warning" >tanpa keterangan</span>

									@elseif($jadwal_anggota->absensi == null && $jadwal_anggota->shift == 'siang' && 
										$unix_shift_siang < $now->getTimestamp())

										<span class="badge badge-lg badge-warning" >tanpa keterangan</span>
									@elseif($jadwal_anggota->absensi == null && 
										$jadwal_anggota->shift == 'malam' && 
										$unix_shift_malam < $now->getTimestamp())

										<span class="badge badge-lg badge-warning" >tanpa keterangan</span>
									@elseif($jadwal_anggota->absensi == null && 
										(int)$current_date->format('d') > (int)$now->format('d'))

										<span class="badge badge-lg badge-ghost italic">belum tersedia</span>
									@elseif($jadwal_anggota->absensi != null)
										@if($jadwal_anggota->absensi != null && $jadwal_anggota->absensi->keterangan == 'hadir')
											<span class="badge badge-lg badge-neutral">hadir</span>
										@else($jadwal_anggota->absensi != null && $jadwal_anggota->absensi->keterangan == 'sakit' || $jadwal_anggota->absensi->keterangan == 'izin')
											<span class="badge badge-lg badge-warning">{{ $jadwal_anggota->absensi->keterangan }}</span>
										@endif
									@else
										<a href="#{{$jadwal_anggota->tanggal}}" class="btn">isi absensi</a>
										<!-- Put this part before </body> tag -->
										<div class="modal" id="{{$jadwal_anggota->tanggal}}">
										  <div class="modal-box">
										    <h3 class="font-bold text-lg">isi absensi</h3>
										    <form action="{{ route('jadwal-absensi.store') }}" method="post" class="grid gap-2" enctype="multipart/form-data">
										    	@csrf
										    	<input type="hidden" value="{{ $jadwal_anggota->id }}" name="jadwal_id">

										    	<x-form-control>
										    		<x-label>nama anggota</x-label> 
										    		<x-text-input value="{{Auth::user()->nama}}" readonly disabled/>
										    	</x-form-control>

										    	<div class="grid grid-cols-2 gap-2">
											    	<x-form-control>
											    		<x-label>tanggal</x-label>
											    		@php  $datetime = new DateTime($jadwal_anggota->tanggal); @endphp
											    		<x-text-input value="{{ $datetime->format('d F, Y') }}" readonly disabled/>
											    	</x-form-control>

											    	<x-form-control>
											    		<x-label>shift</x-label>
											    		<x-text-input value="{{ $jadwal_anggota->shift }}" readonly disabled/>
											    	</x-form-control>
										    	</div>

										    	<x-form-control>
										    		<x-label>pilih keterangan</x-label>
										    		<select name="keterangan"  class="select select-bordered">
										    			<option value="hadir">hadir</option>
										    			<option value="sakit">sakit</option>
										    			<option value="izin">izin</option>
										    		</select>
										    		@error('keterangan')
										    			<label class="label">
										    				<span class="label-text text-error">{{ $message }}</span>
										    			</label>
										    		@enderror
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
											    <div class="modal-action">
											      <a href="#" class="btn btn-outline">cancel</a>
											      <button class="btn" type="submit">submit</button>
											    </div>
										    </form>
										  </div>
										  <a href="#" class="modal-backdrop"></a>
										</div>
									@endif
								</td>
								<td>
									@if($jadwal_anggota->absensi != null)
										<label for="absensi-{{$jadwal_anggota->absensi->id}}" class="btn btn-link">detail</label>

										<!-- Put this part before </body> tag -->
										<input type="checkbox" class="modal-toggle" id="absensi-{{$jadwal_anggota->absensi->id}}" />
										<label for="absensi-{{$jadwal_anggota->absensi->id}}" class="modal  cursor-pointer">
										  <label class="modal-box mt-8 relative" for="">
										    <h3 class="font-bold text-lg">detail absensi</h3>
										    <div class="grid @if($jadwal_anggota->absensi->keterangan == 'hadir') grid-cols-2 @endif gap-4">
										    	<x-form-control>
										    		<x-label>keterangan</x-label>
										    		<x-text-input value="{{ $jadwal_anggota->absensi->keterangan }}" readonly/>
										    	</x-form-control>
										    	@if($jadwal_anggota->absensi->keterangan == 'hadir')
											    	<x-form-control>
											    		<x-label>jam masuk</x-label>
											    		@php
											    		$jam_masuk = new DateTime($jadwal_anggota->absensi->jam_masuk, new DateTimeZone('Asia/Jakarta'));
											    		@endphp
											    		<x-text-input value="{{ $jam_masuk->format('H:i:s') }}" readonly/>
											    	</x-form-control>
										    	@endif
										    	<div class="col-span-2">
										    		<x-label>bukti kehadiran</x-label>
											    	<img src="{{ $jadwal_anggota->absensi->bukti_kehadiran }}" alt="bukti kehadiran">
										    	</div>
										    </div>
										    <div class="flex justify-between items-center">
									    		<label for="absensi-{{$jadwal_anggota->absensi->id}}" class="btn">tutup</label>
										    </div>
										  </label>
										</label>
									@endif
								</td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</x-app-layout>