@foreach($results as $key => $items)
    @if(count($items) > 0)
    <div class="card p-2">
        <div class="card-header mb-0">
            <h3 class="card-title">{{ ucwords(str_replace('_', ' ', class_basename($items->first()))) }}</h3>
        </div>
        @foreach($items as $value)
            <div class="card p-2">
                @include('world._entry', ['imageUrl' => $value->imageUrl, 'name' => $value->name ?? $value->title, 
                'searchUrl' => $value->url, 'description' => $value->description ?? $value->text])
            </div>
        @endforeach
    @endif
    </div>
@endforeach