<x-app-layout>
	<div class="space-y-6">
		<a href="{{ route('lokasi.create') }}" class="btn">tambah lokasi</a>

		<div class="overflow-x-auto border rounded-lg">
		  <table class="table w-full">
		    <thead>
		      <tr>
		        <th>no</th>
		        <th>nama lokasi</th>
		        <th>alamat</th>
		        <th>aksi</th>
		      </tr>
		    </thead>
		    <tbody>
				@forelse($list_lokasi as $lokasi)
					<tr>
						<th>{{ $loop->iteration }}</th>
						<td>{{ $lokasi->nama_lokasi }}</td>
						<td>{{ $lokasi->alamat }}</td>
						<td>
							<div class="space-x-2">
								<a href="{{ route('lokasi.edit', ['lokasi' => $lokasi]) }}" class="btn">edit</a>
								<form class="inline-flex" action="{{ route('lokasi.destroy', ['lokasi' => $lokasi]) }}" method="post">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-error">hapus</button>
								</form>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="4">
							<h1 class="text-xl text-center text-base-300">belum ada data</h1>
						</td>
					</tr>
				@endforelse
		    </tbody>
		  </table>
		</div>
		
	</div>
</x-app-layout>
