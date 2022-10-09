@props([ 'name' => null, 'required', 'label', 'labelstyle', 'placeholder', 'for' => 'default'])
<div>
    <div class="mt-2 border rounded-md px-3 py-1.5 shadow-sm focus-within:ring-1 @error($name) border-red-500  @enderror">
        <label for="{{$for}}"
            class="block text-xs font-medium text-gray-600  @if(empty($label)) text-white px-3 py-1.5 @endif"
            style="pointer-events: none; {{$labelstyle ?? ''}}">
            {{$label ?? ''}}
            @if(!empty($required) && $required=='true' && !empty($label))
            <span class="text-red-400">*</span>
            @endif
        </label>
        <input name="{{ $name }}" {{$attributes}} placeholder="" onfocus="this.placeholder = '{{ $placeholder ?? '' }}'"
            onfocusout="this.placeholder = ''" maxlength="100"
            class="form-input bg-gray-800 block w-full border-0 p-0 text-white placeholder-gray-500 focus:ring-0 sm:text-sm {{ $errors->has($name) ? 'text-red-500' : '' }}">
    </div>
    @error($name)
    <x-text.error class="capitalize">{{ $message }}</x-input.error>
    @enderror
</div>
