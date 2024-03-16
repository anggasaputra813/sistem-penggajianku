<x-app-layout>
	<div class="space-y-6">
		<a href="{{ route('jadwal.create') }}" class="btn">tambah jadwal bulanan</a>

		@if (Session::get("error_hapus_jadwal"))
	      <div class="alert alert-error">
	         {{ Session::get("error_hapus_jadwal") }}
	      </div>
		@endif



		<div class="overflow-x-auto border rounded-lg">
		  <table class="table w-full">
		    <thead>
		      <tr>
		      	<th>no.</th>
		        <th>bulan</th>
		        <th>aksi</th>
		      </tr>
		    </thead>
		    <tbody>
				@forelse($list_jadwal as $jadwal)
					<tr>
						<th>{{ $loop->iteration }}</th>
						<td>{{ date('F, Y', strtotime($jadwal->dari)) }}</td>
						<td>
							<div class="flex gap-2 items-center">
								<a href="{{ route('jadwal.show', ['jadwal' => $jadwal]) }}" class="btn btn-primary">atur jadwal</a>
								<form method="post" action="{{ route('jadwal.destroy', ['jadwal' => $jadwal]) }}">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-error">hapus</button>
								</form>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="3">
							<h1 class="text-xl text-center text-base-300">belum ada data</h1>
						</td>
					</tr>
				@endforelse
		    </tbody>
		  </table>
		</div>
	</div>
</x-app-layout>