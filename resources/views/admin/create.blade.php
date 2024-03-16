<x-app-layout>
	<div class="space-y-6">
		<a href="{{ route('admin.index') }}" class="btn">daftar admin</a>

		<form class="grid gap-4" action="{{ route('admin.store') }}" method="post">
			@csrf

			<x-form-control>
				<x-label>nama</x-label>
				<x-text-input  name="nama" placeholder="nama admin" required />
				@error('nama')
					<x-error-label>{{ $message }}</x-error-label>
				@enderror
			</x-form-control>

			<x-form-control>
				<x-label>email</x-label>
				<x-text-input value="{{ old('email ') }}" type="email" name="email" placeholder="admin@email.com" required />
				@error('email')
					<x-error-label>{{ $message }}</x-error-label>
				@enderror
			</x-form-control>

			<x-form-control>
				<x-label>password</x-label>
				<x-text-input value="{{ old('password') }}" name="password" type="password" placeholder="password ..." required />
				@error('password')
					<x-error-label>{{ $message }}</x-error-label>
				@enderror
			</x-form-control>

			<x-form-control>
				<x-label>konfirmasi password</x-label>
				<x-text-input name="password_confirmation" type="password" placeholder="ulangi password" required />
				@error('password_confirmation')
					<x-error-label>{{ $message }}</x-error-label>
				@enderror
			</x-form-control>
			

			<div class="flex item-center justify-end gap-4">
				<button type="reset" class="btn btn-outline">reset</button>
				<button type="submit" class="btn">submit</button>
			</div>
		</form>
	</div>
</x-app-layout>