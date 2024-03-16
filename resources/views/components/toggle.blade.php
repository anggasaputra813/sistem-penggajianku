@props([
    'label' => '',
])


<div class="form-control w-full">
    <label class="cursor-pointer flex flex-start gap-2">
      <input {{ $attributes->merge([
        'class' => 'toggle toggle-primary', 
        'type' => 'checkbox'
      ]) }}/>
      <span class="label-text">{{$label}}</span> 
    </label>
</div>