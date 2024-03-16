<x-app-layout>
	<form method="get" class="grid gap-4">
		<x-form-control>
			<x-label>nama karyawan</x-label>
			<select name="anggota_id" class="select select-bordered w-full">
				@foreach ($list_anggota as $anggota)
					<option value="{{$anggota->id}}">{{$anggota->user->nama}}</option>
				@endforeach
			</select>
		</x-form-control>
		<x-form-control>
			<x-label>periode</x-label>
			<select name="periode_id" class="select select-bordered w-full">
				@foreach ($list_periode as $periode)
					@php
						$datetime = new DateTime($periode->dari);
					@endphp
					<option value="{{$periode->id}}">{{ $datetime->format('F') }}</option>
				@endforeach
			</select>
		</x-form-control>

		<div class="flex justify-end items-center">
			<button class="btn">apply</button>
		</div>
	</form>
</x-app-layout>
