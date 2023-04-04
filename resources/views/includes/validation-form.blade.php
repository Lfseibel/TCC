@if ($errors->any())
<div class="flex items-center justify-center">
    <div class="w-1/2 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4">
        <ul class="errors">
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif