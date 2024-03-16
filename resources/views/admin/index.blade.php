<x-app-layout>
	<div class="space-y-6">
		<a href="{{ route('admin.create') }}" class="btn">tambah admin</a>
		<div class="overflow-x-auto border rounded-lg">
		  <table class="table w-full">
		    <thead>
		      <tr>
		        <th>no</th>
		        <th>nama</th>
		        <th>email</th>
		        <th>aksi</th>
		      </tr>
		    </thead>
		    <tbody>
				@forelse($list_admin as $admin)
					<tr>
						<th>{{ $loop->iteration }}</th>
						<td>{{ $admin->nama }}</td>
						<td>{{ $admin->email }}</td>
						<td>
							<div class="space-x-2">
								<form class="inline-flex" action="{{ route('admin.destroy', ['admin' => $admin]) }}" method="post">
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



{{-- 


Kinanti Balqis Maharani
kinantimhrn@gmail.com
085659091825
3273114112950008
01 Desember 1995



total tiket: 2
kategori Utama: FESTIVAL
kategori Cadangan (wajib beda cat): CAT 3


 --}}