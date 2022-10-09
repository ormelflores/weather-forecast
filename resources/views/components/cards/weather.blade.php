@props(['title', 'temperature', 'icon'])
<div class="flex items-center p-4 bg-gray-600 rounded-lg shadow">
      <img src="{{$icon}}"/>
    <div>
      <p
        class="mb-2 text-sm font-medium text-gray-200"
      >
        {{$title}}
      </p>
      <p
        class="text-lg font-semibold text-gray-100"
      >
        {{$temperature}} &deg;
      </p>
    </div>
</div>