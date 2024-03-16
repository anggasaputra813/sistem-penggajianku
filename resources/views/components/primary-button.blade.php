<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-info']) }}>
    {{ $slot }}
</button>
