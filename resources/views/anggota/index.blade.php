<x-app-layout>
	<div class="space-y-6">
		<a href="{{ route('anggota.create') }}" class="btn">tambah karyawan</a>

		<div class="overflow-x-auto border rounded-lg">
			<table class="table w-full">
				<thead>
					<tr>
						<th>no</th>
						<th>nama</th>
						<th>nik</th>
						<th>email</th>
						<th>jabatan</th>
						<th>aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse($list_anggota as $anggota)
					<tr>
						<th>{{ $loop->iteration }}</th>
						<td>{{ $anggota->user->nama }}</td>
						<td>{{ $anggota->nik }}</td>
						<td>{{ $anggota->user->email }}</td>
						<td>{{ $anggota->jabatan->nama_jabatan }}</td>
						<td>
							<div class="space-x-2">
								<a href="{{ route('anggota.edit', ['anggotum' => $anggota]) }}" class="btn">edit</a>
								<form class="inline-flex" action="{{ route('anggota.destroy', ['anggotum' => $anggota]) }}" method="post">
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
