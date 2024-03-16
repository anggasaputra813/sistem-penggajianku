<x-app-layout>
	<div class="space-y-6">
		<a href="{{ route('jabatan.create') }}" class="btn">tambah jabatan</a>
		<div class="overflow-x-auto border rounded-lg">
		  <table class="table w-full">
		    <thead>
		      <tr>
		        <th>no</th>
		        <th>nama jabatan</th>
		        <th>gaji</th>
		        <th>aksi</th>
		      </tr>
		    </thead>
		    <tbody>
				@forelse($list_jabatan as $jabatan)
					<tr>
						<th>{{ $loop->iteration }}</th>
						<td>{{ $jabatan->nama_jabatan }}</td>
						<td>Rp. {{ number_format($jabatan->gaji, 0, ',', '.')  }}</td>
						<td>
							<div class="space-x-2">
								<a href="{{ route('jabatan.edit', ['jabatan' => $jabatan]) }}" class="btn">edit</a>
								<form class="inline-flex" action="{{ route('jabatan.destroy', ['jabatan' => $jabatan]) }}" method="post">
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
