<div class="row mb-2">
    <div class="col-6 col-sm-6 col-md-8">
        <h3 class="m-0 text-muted">{{ $pageTitle }}</h3>
    </div>
    <div class="col-6 col-sm-6 col-md-4">
        <ol class="breadcrumb" style="float: right;">
            @foreach($breadcrumbs as $key => $value)
                @if($loop->last)
                    <li class="breadcrumb-item active">{{ $value['title'] }}</li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $key }}" class="bread">{{ $value['title'] }}</a>
                    </li>
                @endif
            @endforeach
        </ol>
    </div>
</div>
