<button {{ $attributes->merge(['type' => 'button', 'class' => 'bg-danger rounded p-3']) }}>
    {{ $slot }}
</button>
